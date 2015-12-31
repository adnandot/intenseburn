<?php
/**
	* Template Name: Add Recipe
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unite
 
*/
if(!isSubscriber()){
	wp_redirect(site_url('login'));
	exit;
}



if(!empty($_POST)){
		
	$my_post = array(
	  'post_title'    => $_POST['rec_title'],
	  'post_content'  => $_POST['rec_description'],
	  'post_status'   => 'publish',
	  'post_author'   => getLoggedinUserId(),
	  'post_type'   => 'recipe',
	  //'post_category' => $_POST['rec_category']
	);

	// Insert the post into the database
	$recipe_id = wp_insert_post( $my_post );
	
	if($recipe_id > 0) {
	
		/*	field_5657fab082a73 	prep_time
			field_5657fa7382a71		suitable_for
			field_56583b2623b6c		servings
			field_5657f9fc82a6f		ingredients
			field_5657fa5682a70		method
			field_5657fa8d82a72		allergens
			field_5657fada82a74		nutritional_information
			*/
		
		
		update_field( 'field_5657fab082a73', $_POST['rec_prep_time'], $recipe_id ); // field_5657fab082a73 		prep_time
		update_field( 'field_5657fa7382a71', $_POST['rec_suitable_for'], $recipe_id ); // field_5657fa7382a71		suitable_for
		update_field( 'field_56583b2623b6c', $_POST['rec_servings'], $recipe_id ); // field_56583b2623b6c		servings
		update_field( 'field_5657fa5682a70', $_POST['rec_method'], $recipe_id ); // field_5657fa5682a70		method
		update_field( 'field_5657fa8d82a72', $_POST['rec_allergens'], $recipe_id ); // field_5657fa8d82a72		allergens
		
		
		/*
		*  add a repeater row on a taxonomy!!!
		*/

		$field_key = "field_5657f9fc82a6f";
		$value = array();//get_field($field_key, $recipe_id);
		//$value[] = array("sub_field_1" => "Foo", "sub_field_2" => "Bar");
			
		$total_ing = count($_POST['rec_ingredients']);
		//update_post_meta($recipe_id, 'ingredients', $total_ing);
		
		for($i = 0; $i < $total_ing; $i++){
				$value[$i] = array('ingredient_value' => $_POST['rec_ingredients'][$i]);
				//update_post_meta($recipe_id, 'ingredients_'.$val.'_ingredient_value', $_POST['rec_ingredients'][$i]);
		}
			
		update_field( $field_key, $value, $recipe_id );
		
		$field_key = "field_5657fada82a74";
		$value = array();//get_field($field_key, $recipe_id);
			
		$total_ing = count($_POST['rec_nutritional_information']['name']);
			
		for($i = 0; $i < $total_ing; $i++){
				$value[$i] = array(
								'name' => $_POST['rec_nutritional_information']['name'][$i],
								'quantity' => $_POST['rec_nutritional_information']['qty'][$i]
								);
		}
			
		update_field( $field_key, $value, $recipe_id );
		
		
		
		// An array of IDs of categories we want this post to have.
		$cat_ids = $_POST['rec_category'];

		/*
		 * If this was coming from the database or another source, we would need to make sure
		 * these were integers:

		$cat_ids = array_map( 'intval', $cat_ids );
		$cat_ids = array_unique( $cat_ids );

		 */
		 
		if(!empty($cat_ids)) {
			$cat_ids = array_map( 'intval', $cat_ids );
			$cat_ids = array_unique( $cat_ids );

			$term_taxonomy_ids = wp_set_object_terms( $recipe_id, $cat_ids, 'recipe-cat' );

			if ( is_wp_error( $term_taxonomy_ids ) ) {
				// There was an error somewhere and the terms couldn't be set.
			} else {
				// Success! The post's categories were set.
			}
			
		}
		
		
		
		if ( ! function_exists( 'wp_handle_upload' ) ) {
			require_once( ABSPATH . 'wp-admin/includes/file.php' );
		}

		$uploadedfile = $_FILES['rec_image'];

		$upload_overrides = array( 'test_form' => false );

		$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
		

		if ( $movefile && !isset( $movefile['error'] ) ) {
			
			$file_path = $movefile['file'];
		
			// $filename should be the path to a file in the upload directory.
			$filename = $file_path;//'/path/to/uploads/2013/03/filename.jpg';

			// The ID of the post this attachment is for.
			$parent_post_id = $recipe_id;

			// Check the type of file. We'll use this as the 'post_mime_type'.
			$filetype = wp_check_filetype( basename( $filename ), null );

			// Get the path to the upload directory.
			$wp_upload_dir = wp_upload_dir();

			// Prepare an array of post data for the attachment.
			$attachment = array(
				'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
				'post_mime_type' => $filetype['type'],
				'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
				'post_content'   => '',
				'post_status'    => 'inherit'
			);

			// Insert the attachment.
			$attach_id = wp_insert_attachment( $attachment, $filename, $parent_post_id );

			// Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
			require_once( ABSPATH . 'wp-admin/includes/image.php' );

			// Generate the metadata for the attachment, and update the database record.
			$attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
			wp_update_attachment_metadata( $attach_id, $attach_data );

			set_post_thumbnail( $parent_post_id, $attach_id );
			
		} else {
			/**
			 * Error generated by _wp_handle_upload()
			 * @see _wp_handle_upload() in wp-admin/includes/file.php
			 */
			//echo $movefile['error'];
		}
		
		wp_redirect(site_url('/member-area/recipes?added'));
		exit;
		
	}
	
}
get_header(); ?>

<div class="addrecipe_page">
<div class="container">
  <div class="col-md-12 col-sm-12 col-xs-12">
   <div class="recipe_container"> <div class="row">
      <div id="primary" class="col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
        
    <div class="row">
		
		<form enctype="multipart/form-data" method="post" action="" class="acf-form add-recipe" id="add-recipe-form">
          <div class="acf-fields acf-form-fields">
            <div data-required="1" data-key="field_55fac5fc7c94f" data-type="text" data-name="title" class="acf-field acf-field-text acf-field-55fac5fc7c94f field_type-text field_key-field_55fac5fc7c94f">
              <div class="acf-label">
                <label for="acf-field_55fac5fc7c94f">Title <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <div class="acf-input-wrap">
                  <input type="text" required placeholder="" value="" name="rec_title" class="" id="rec_title">
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac6107c950" data-type="textarea" data-name="description" class="acf-field acf-field-textarea acf-field-55fac6107c950 field_type-textarea field_key-field_55fac6107c950">
              <div class="acf-label">
                <label for="acf-field_55fac6107c950">Description <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <textarea rows="8" required placeholder="" name="rec_description" class="" id="rec_description"></textarea>
              </div>
            </div>
            <div data-required="1" data-key="" data-type="text" data-name="category" class="acf-field acf-field-text field_type-text ">
              <div class="acf-label">
                <label for="category">Category <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <div class="acf-input-wrap">
				
					<?php 
					$terms = getRecipeCats();
					if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
						echo '<ul class="category_ul">';
						foreach ( $terms as $term ) {
							?><li><label for="<?php echo $term->name;?>"> <input type="checkbox" name="rec_category[]" value="<?php echo $term->term_id;?>" id="<?php echo $term->name;?>" /> <?php echo $term->name;?></label></li><?php
						}
						echo '</ul>';
					}


					?> 
                </div>
              </div>
            </div>
            <div data-key="field_55fac62d7c951" data-type="image" data-name="image" class="acf-field acf-field-image acf-field-55fac62d7c951 field_type-image field_key-field_55fac62d7c951">
              <div class="acf-label">
                <label for="acf-field_55fac62d7c951">Image</label>
              </div>
              <div class="acf-input">
                <div class="acf-image-uploader acf-cf basic" data-preview_size="thumbnail" data-library="all">
                  <div class="view hide-if-value">
                    <input type="file" id="rec_image" name="rec_image">
                  </div>
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5a6a1" data-type="text" data-name="prep_time" class="acf-field acf-field-text acf-field-55fac5ed5a6a1 field_type-text field_key-field_55fac5ed5a6a1">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5a6a1">Prep time (excluding cook time) <span class="acf-required">*</span></label>
                <p class="description">Please Insert in Minutes</p>
              </div>
              <div class="acf-input">
                <div class="acf-input-wrap">
                  <input type="text" required placeholder="" value="" name="rec_prep_time" class="" id="rec_prep_time">
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5aa98" data-type="text" data-name="suitable_for" class="acf-field acf-field-text acf-field-55fac5ed5aa98 field_type-text field_key-field_55fac5ed5aa98">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5aa98">Suitable for <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <div class="acf-input-wrap">
                  <input type="text" required placeholder="" value="" name="rec_suitable_for" class="" id="rec_suitable_for">
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5ae92" data-type="number" data-name="servings" class="acf-field acf-field-number acf-field-55fac5ed5ae92 field_type-number field_key-field_55fac5ed5ae92">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5ae92">Servings <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <div class="acf-input-wrap">
                  <input type="number" required placeholder="" value="" name="rec_servings" step="1" max="5" min="1" class="" id="rec_servings">
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5b27e" data-type="repeater" data-name="ingredients" class="acf-field acf-field-repeater acf-field-55fac5ed5b27e field_type-repeater field_key-field_55fac5ed5b27e">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5b27e">Ingredients <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <input type="hidden" name="ingredients">
                <div data-max="0" data-min="0" class="acf-repeater empty">
                  <table class="acf-table acf-input-table table-layout ingredient-table">
                    <thead>
                      <tr>
                        <th class="order"></th>
                        <th data-key="field_55fac5ed65a73" class="acf-th acf-th-ingredient_value"> Ingredient Value </th>
                        <th class="remove"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="acf-row acf-clone">
                        <td title="Drag to reorder" class="order">1</td>
                        <td data-key="field_55fac5ed65a73" data-type="text" data-name="ingredient_value" class="acf-field acf-field-text acf-field-55fac5ed65a73 field_type-text field_key-field_55fac5ed65a73 appear-empty"><div class="acf-input">
                            <div class="acf-input-wrap">
                              <input type="text" required placeholder="" value="" name="rec_ingredients[]" class="" id="rec_ingredients" disabled="disabled">
                            </div>
                          </div></td>
                        <td class="remove"><a title="Add row" data-before="1" href="#" class="acf-icon small acf-repeater-add-row"><i class="acf-sprite-add"></i></a> <a title="Remove row" href="#" class="acf-icon small acf-repeater-remove-row"><i class="acf-sprite-remove"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                  <ul class="acf-hl acf-clearfix">
                    <li class="acf-fr"> <a class="acf-button blue acf-repeater-add-row" href="#">Add Row</a> </li>
                  </ul>
                </div>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5b64a"  data-name="method" class="acf-field  acf-field-55fac5ed5b64a  field_key-field_55fac5ed5b64a">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5b64a">Method <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <textarea required style="height:300px;" name="rec_method" class="" id="rec_method"></textarea>
              </div>
            </div>
            <div data-key="field_55fac5ed5ba34" data-type="textarea" data-name="allergens" class="acf-field acf-field-textarea acf-field-55fac5ed5ba34 field_type-textarea field_key-field_55fac5ed5ba34">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5ba34">Allergens</label>
              </div>
              <div class="acf-input">
                <textarea rows="8" placeholder="" name="rec_allergens" class="" id="rec_allergens"></textarea>
              </div>
            </div>
            <div data-required="1" data-key="field_55fac5ed5be0c" data-type="repeater" data-name="nutritional_information" class="acf-field acf-field-repeater acf-field-55fac5ed5be0c field_type-repeater field_key-field_55fac5ed5be0c">
              <div class="acf-label">
                <label for="acf-field_55fac5ed5be0c">Nutritional information (per serving) <span class="acf-required">*</span></label>
              </div>
              <div class="acf-input">
                <input type="hidden" name="nutritional_information">
                <div data-max="0" data-min="0" class="acf-repeater empty">
                  <table class="acf-table acf-input-table table-layout nutritional_information-table">
                    <thead>
                      <tr>
                        <th class="order"></th>
                        <th width="46.5%" data-key="field_55fac5ed71db5" class="acf-th acf-th-name"> Name <span class="acf-required">*</span> </th>
                        <th data-key="field_55fac5ed72190" class="acf-th acf-th-quantity"> Quantity <span class="acf-required">*</span> </th>
                        <th class="remove"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="acf-row acf-clone">
                        <td title="Drag to reorder" class="order">1</td>
                        <td data-required="1" data-key="field_55fac5ed71db5" data-type="text" data-name="name" class="acf-field acf-field-text acf-field-55fac5ed71db5 field_type-text field_key-field_55fac5ed71db5 appear-empty"><div class="acf-input">
                            <div class="acf-input-wrap">
                              <input type="text" required placeholder="" value="" name="rec_nutritional_information[name][]" class="" disabled="disabled">
                            </div>
                          </div></td>
                        <td data-required="1" data-key="field_55fac5ed72190" data-type="text" data-name="quantity" class="acf-field acf-field-text acf-field-55fac5ed72190 field_type-text field_key-field_55fac5ed72190 appear-empty"><div class="acf-input">
                            <div class="acf-input-wrap">
                              <input type="text" required placeholder="" value="" name="rec_nutritional_information[qty][]" class="" disabled="disabled">
                            </div>
                          </div></td>
                        <td class="remove"><a title="Add row" data-before="1" href="#" class="acf-icon small acf-repeater-add-row"><i class="acf-sprite-add"></i></a> <a title="Remove row" href="#" class="acf-icon small acf-repeater-remove-row"><i class="acf-sprite-remove"></i></a></td>
                      </tr>
                    </tbody>
                  </table>
                  <ul class="acf-hl acf-clearfix">
                    <li class="acf-fr"> <a class="acf-button blue acf-repeater-add-row" href="#">Add Row</a> </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- acf-form-fields --> 
          
          <!-- Submit -->
		  <div class="col-md-12 bottom_btn">
			<div class="row">
			<div class="acf-form-submit left text-center btnCancel">
            <input type="submit" value="Add Recipe" class="acf-button blue acf-repeater-add-row" />
          </div>
		  <div class="btnCancel right">
			<a class="acf-button blue acf-repeater-add-row" href="<?php echo site_url('member-area/recipe/');?>">Cancel</a>
		  </div>
		  </div>
          <div class="clear"></div>
		  </div>
          <!-- / Submit -->
          
        </form>
        
		
    </div>
		
		
		
        
        
      </div>
      <!-- #primary --> 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.validate.min.js"></script>
<?php /*?><script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/additional-methods.js"></script><?php */?>
<script type="text/javascript">

jQuery(document).ready(function(){
	
var signup_rules = {
				"rec_title": "required",
				"rec_description": "required",
				"rec_category[]": "required",
				"rec_prep_time": "required",
				"rec_suitable_for": "required",
				"rec_method": "required",
				"rec_servings": {
					required : true
				},
				"rec_ingredients[]": "required",
				"rec_nutritional_information[name][]": "required",
				"rec_nutritional_information[qty][]": "required",
			}


jQuery("#add-recipe-form").validate({
			rules: signup_rules,
			errorPlacement: function(error, element) {
				if(element.attr("name") == "category[]") {
					jQuery('ul.category_ul').after( error.css({'clear':'both'}) );
				} else if(element.attr("name") == "ingredients[]") {
					jQuery('.ingredient-table').after( error.css({'clear':'both'}) );
				} else if(element.attr("name") == "nutritional_information[name][]") {
					jQuery('.nutritional_information-table').after( error.css({'clear':'both'}) );
				} else if(element.attr("name") == "nutritional_information[qty][]") {
					jQuery('.nutritional_information-table').after( error.css({'clear':'both'}) );
				} else {
					error.insertAfter(element);
				}
			},
			errorElement: "label",
			messages: {
				"rec_title": "Title is required.",
				"rec_description": "Description is required.",
				"rec_category[]": "Category is required.",
				"rec_prep_time": "Preparation time is required.",
				"rec_suitable_for": "This field is required.",
				"rec_servings": {
					required : "Serving is required"
				},
				"rec_ingredients[]": "Please enter ingredients.",
				"rec_method": "Method is required.",
				"rec_nutritional_information[name][]": "Nutrition name is required.",
				"rec_nutritional_information[qty][]": "Nutrition quantity is required.",
			}
		});
		
	
});

</script>
    </div> </div>
  </div>
</div>
</div>

<?php get_footer(); ?>
