// http://www.randomtext.me/api/lorem/ul-2/5-8
//     "type": "gibberish",
//     "amount": 5,
//     "number": "5",
//     "number_max": "15",
//     "format": "p",
//     "time": "23:35:44",
//     "text_out":


jQuery(document).ready(function ($) {
    $("#hipster-pixel-shortcode-generate").click(function (e) {
        e.preventDefault();

        // Set default options
        var options = {
            type: "gibberish", // lorem or gibberish
            amount: 5, // number of elements
            number_min: 5, // min number words in each element
            number_max: 15, // max number words in each element
            format: "p" // html tag - p, ul, ol, h1-h6
        };

        // RandomText API endpoint
        var $rt_url = 'http://www.randomtext.me/api/';

        $shortcode = buildShortcode();

        $.getJSON($rt_url, function (data) {
            console.log(data);
            window.send_to_editor('[' + $shortcode + ']');
        });

        function buildShortcode() {
            // Get values from form fields
            $shortcode = '[hipster-'
            + 'type=' + options.type +
            + options.format + '-'
            + options.amount + '/'
            + options.number_min + '-'
            + options.number_max;

            return $shortcode;
        }

    });
});