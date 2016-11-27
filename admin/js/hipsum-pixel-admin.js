(function ($) {
    'use strict';

    /************ Variables ************/
    var options = '';
    var base_url_randomtext = '//www.randomtext.me/api/';
    var base_url_image = HIPSUM_PIXEL.image_source == 'lorempixel' ? 'http://lorempixel.com/' : 'https://placekitten.com/';
    var tags_for_num_elements = ['p', 'ol', 'ul'];
    var image_categories = ['abstract', 'city', 'people', 'transport', 'animals', 'food', 'nature',
        'business', 'nightlife', 'sports', 'cats', 'fashion', 'technics'];


    /************ Register Sliders *************/
    $("#num-elements-slider").slider({
        range: "max",
        min: 1,
        max: 10,
        value: 2,
        slide: function (event, ui) {
            $("#num-elements").val(ui.value);
        }
    });
    $("#num-elements").val($("#num-elements-slider").slider("value"));

    $("#num-words-slider").slider({
        range: true,
        min: 1,
        max: 100,
        values: [20, 35],
        slide: function (event, ui) {
            $("#num-words").val(ui.values[0] + " - " + ui.values[1]);
        }
    });
    $("#num-words").val($("#num-words-slider").slider("values", 0) +
        " - " + $("#num-words-slider").slider("values", 1));

    $('#image-width-slider').slider({
        range: "max",
        min: 1,
        max: 800,
        value: 300,
        slide: function (event, ui) {
            $('#image-width').val(ui.value);
        }
    });
    $('#image-width').val($("#image-width-slider").slider("value"));

    $('#image-height-slider').slider({
        range: "max",
        min: 1,
        max: 800,
        value: 300,
        slide: function (event, ui) {
            $('#image-height').val(ui.value);
        }
    });
    $('#image-height').val($("#image-height-slider").slider("value"));

    $('#type-of-element').on('change', function (e) {
        var selected = $(this).children(':selected').val()
        if ($.inArray(selected, tags_for_num_elements) == -1) {
            $('#num-elements-container').slideUp('slow');
        } else {
            $('#num-elements-container').slideDown('slow');
        }
    });


    /************* Populate categories selectmenu ****************/
    for (var i = 0; i < image_categories.length; i++) {
        options += '<option value"' + image_categories[i] + '">'
            + capitalize(image_categories[i]) + '</option>';
    }
    $('#image-category').append(options);


    /************* Event handlers *****************/
    // Insert HTML button
    $('#generate').on('click', function (e) {
        e.preventDefault();
        var query;
        var type = $('#type-of-element').val();
        var type_text = $('#type-of-text').val();
        var num_elements = $('#num-elements-slider').slider('value');
        var num_words_min = $('#num-words-slider').slider('values', 0);
        var num_words_max = $('#num-words-slider').slider('values', 1);

        if (!$.inArray(type, tags_for_num_elements)) {
            query = type_text + '/' + type + '-' + num_elements + '/' + num_words_min + '-' + num_words_max;
        } else {
            query = type_text + '/' + type + '/' + num_words_min + '-' + num_words_max;
        }
        var url = base_url_randomtext + query;
        $.getJSON(url, function (data) {
            $('#results textarea').val($('#results textarea').val() + data.text_out);
            $('#add-to-post-div').show();
            $('#preview').prop('disabled', false);
            $('#html').prop('disabled', true);
        });
    });

    // Insert Image button
    $('#generate-image').on('click', function (e) {
        // Api - http://lorempixel.com/400/200/sports
        e.preventDefault();
        var image_width = $('#image-width-slider').slider('values', 0);
        var image_height = $('#image-width-slider').slider('values', 1);
        var image_category = $('#image-category').val();
        var image_color = $('#image-color').val() == 'g' ? $('#image-color').val() + '/' : '';
        var image_align = $('input[name="image-align"]:checked').val();
        var query = '';
        if (HIPSUM_PIXEL.image_source == 'lorempixel') {
            query = base_url_image + image_color + image_width + '/' + image_height + '/' + image_category.toLowerCase();
        } else {
            query = base_url_image + image_color + image_width + '/' + image_height;
        }

        var image = '<img class="' + image_align + '" src="' + query + '" />';

        $("#results textarea").insertAtCaret(image);
        $('#add-to-post-div').show();
        $('#preview').prop('disabled', false);
        $('#html').prop('disabled', true);
    });

    // Preview button - render html in preview area
    $('#preview').on('click', function (e) {
        e.preventDefault();
        var $textarea = $('#results textarea');
        var html = $textarea.val();
        $textarea.remove();
        $('#results').append(html);
        $(this).prop('disabled', true);
        $('#generate, #generate-image').prop('disabled', true);
        $('#html').prop('disabled', false);
    });

    // HTML button - show code in preview area
    $('#html').on('click', function (e) {
        e.preventDefault();
        var results_div = $('#results');
        var results_html = results_div.html();
        results_div.html('<textarea class="results-box" rows="8">' + results_html + '</textarea>');

        // Disable buttons
        $(this).prop('disabled', true);
        $('#generate, #generate-image').prop('disabled', false);
        $('#preview').prop('disabled', false);
    });

    // Clear button - clear preview textarea
    $('#clear').on('click', function (e) {
        e.preventDefault();
        // check if there's a textarea and remove contents
        if ($('#results textarea').length) {
            $('#results textarea').val('');
        } else {
            $('#results')
                .empty()
                .html('<textarea class="results-box"></textarea>');
        }
        $('#add-to-post-div').hide();
        $('#generate, #generate-image').prop('disabled', false);

    });

    // Insert Into Post button
    $('#add-to-post').on('click', function (e) {
        e.preventDefault();
        var preview_button = $('#preview');
        var content = preview_button.prop('disabled') ? $('#results').html() : $('#results textarea').val();
        content = sanatize_input(content);
        // console.log(content);
        window.send_to_editor(content);
    });

    /*********** Helper functions *************/
    function capitalize(word) {
        return $.camelCase("-" + word);
    }

    function sanatize_input(data) {
        // Filter out html tag not allowed
        // var regex = /<(?:p|h[1-4])>[\w\s\d,.]*<\/(?:p|h[1-4])>|(?:<ul>|<ol>)\s*((?:<li>)[\w\s\d,.]*<\/li>[\n\r\t\s]*)*<\/[o|u]l>|<img\s*(class=\"\w*\")\s*src=\"http:\/\/\w*.\w*\/(g\/)?\d*\/\d*\/\w*\"\s*\/?>/g;
        var regex = /<(?:p|h[1-4])>[\w\s\d,.]*<\/(?:p|h[1-4])>|(?:<ul>|<ol>)\s*((?:<li>)[\w\s\d,.]*<\/li>[\n\r\t\s]*)*<\/[o|u]l>|<img\s*(class=\"\w*\")\s*src=\"https?:\/\/\w*.\w*\/(g\/)?\d*\/\d*\/?(\w*\"\s*)?\/?>/g;




        var result_arr = data.match(regex);
        var result_str = '';
        if ($.isArray(result_arr)) {
            if (result_arr.length) {
                for (i = 0; i < result_arr.length; i++) {
                    result_str += result_arr[i];
                }
            }
        }
        return result_str;
    }

})(jQuery);


/* jQuery Plugin - insert at caret */
jQuery.fn.extend({
    insertAtCaret: function (myValue) {
        return this.each(function (i) {
            if (document.selection) {
                this.focus();
                sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            }
            else if (this.selectionStart || this.selectionStart == '0') {
                var startPos = this.selectionStart;
                var endPos = this.selectionEnd;
                var scrollTop = this.scrollTop;
                this.value = this.value.substring(0, startPos) + myValue + this.value.substring(endPos, this.value.length);
                this.focus();
                this.selectionStart = startPos + myValue.length;
                this.selectionEnd = startPos + myValue.length;
                this.scrollTop = scrollTop;
            } else {
                this.value += myValue;
                this.focus();
            }
        })
    }
});
