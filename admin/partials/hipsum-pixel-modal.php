<div id="hipsum-pixel-modal" style="display:none;">

	<div class="container">
		<div class="row">
			<div class="col-sm-6">

				<h4>Random Text and HTML Generator</h4>
				<div id="form-container-textgen">
					<form class="form">

						<!-- nested row -->
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<label for="type-of-text" class="control-label block">Ipsum or Gibberish</label>
									<select id="type-of-text" class="form-control">
										<option value="ipsum">Ipsum</option>
										<option value="gibberish">Gibberish</option>
									</select>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label for="type-of-element" class="control-label block">Type of element</label>
									<select id="type-of-element" class="form-control">
										<option value="p">Paragraph</option>
										<option value="ul">Un-Ordered List</option>
										<option value="ol">Ordered List</option>
										<option value="h1">Heading 1</option>
										<option value="h2">Heading 2</option>
										<option value="h3">Heading 3</option>
										<option value="h4">Heading 4</option>
									</select>
								</div>
							</div>

						</div><!-- end nested row -->

						<div class="form-group" id="num-elements-container">
							<label for="num-elements" class="control-label">Number of elements:</label>
							<input type="text" id="num-elements" class="slider" readonly>
							<div id="num-elements-slider"></div>
						</div>

						<div class="form-group">
							<label for="num-words" class="control-label">Number of words:</label>
							<input type="text" id="num-words" class="slider" readonly>
							<div id="num-words-slider"></div>
						</div>

						<button type="submit" id="generate" class="btn btn-primary center-block">Insert HTML</button>

					</form>
				</div>

			</div><!-- end left -->
			<div class="col-sm-6">
				<h4>Random Image Generator</h4>
				<div id="form-container-imagegen">
					<form class="form">

						<div class="row"><!-- nested row -->
							<?php if ( isset( $this->options['image_source'] ) && $this->options['image_source'] == 'lorempixel' ) : ?>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="image-category" class="control-label block">Category</label>
										<select id="image-category" class="form-control"></select>
									</div>
								</div>
							<?php endif; ?>
							<div class="col-sm-6">
								<div class="form-group">
									<label for="image-color" class="control-label block">Color or Grayscale</label>
									<select id="image-color" class="form-control">
										<option value="c">Color Image</option>
										<option value="g">Gray Image</option>
									</select>
								</div>
							</div>
						</div><!-- end nested row -->

						<div class="form-group">
							<label for="image-width" class="control-label">Image width:</label>
							<input type="text" id="image-width" class="slider" readonly>
							<div id="image-width-slider"></div>
						</div>

						<div class="form-group">
							<label for="image-height" class="control-label">Image height:</label>
							<input type="text" id="image-height" class="slider" readonly>
							<div id="image-height-slider"></div>
						</div>

						<div class="form-group">
							<label class="control-label block">Image Align</label>
							<label class="radio-inline">
								<input type="radio" name="image-align" id="image-align-none" value="alignnone" checked>
								None
							</label>
							<label class="radio-inline">
								<input type="radio" name="image-align" id="image-align-left" value="alignleft"> Left
							</label>
							<label class="radio-inline">
								<input type="radio" name="image-align" id="image-align-right" value="alignright"> Right
							</label>
							<label class="radio-inline">
								<input type="radio" name="image-align" id="image-align-center" value="aligncenter">
								Center
							</label>
						</div>


						<button type="submit" id="generate-image" class="btn btn-primary center-block">Insert Image
						</button>
					</form>
				</div>
			</div>
		</div>
	</div><!-- /.container -->
	<br><br><br>
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-heading">Results</div>
			<div class="panel-body">
				<div id="results"><textarea rows="8" style="border: 0; width: 100%"></textarea></div>
			</div>
		</div>
		<div id="add-to-post-div" style="display:none">
			<button type="submit" id="preview" class="btn btn-primary">Preview</button>
			<button type="submit" id="html" class="btn btn-primary" disabled>HTML</button>
			<button type="submit" id="clear" class="btn btn-warning">Clear</button>
			<button type="submit" id="add-to-post" class="btn btn-success">Inert Into Post</button>
		</div>
	</div>

</div>