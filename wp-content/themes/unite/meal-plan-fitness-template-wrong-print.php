<?php
/**
	* Tempddlate Namdded Meal Plan
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


get_header(); 

$success = false;
$user_id = get_current_user_id();;
$current_meal_plan = getCurrentMealPlanId($user_id);

if( !empty($_POST) && isset($_POST['mail_meal_plan'])  ){
	//pr($_POST);	
	
	//die;
	
	$data = $_POST['image'];

	list($type, $data) = explode(';', $data);
	list(, $data)      = explode(',', $data);
	$data = base64_decode($data);

	
	$image_name = $user_id.'-'.time().'.jpg';
	$folder = 'meal_plan/';
	
	$image_path = get_stylesheet_directory() . '/'.$folder.$image_name;
	
	
	file_put_contents($image_path, $data);
	
	//$_POST['meal_plan_id'];
	
	$meal_data = get_post($current_meal_plan);

	$to = 'testdeveloper30@gmail.com';
	$subject = 'Meal Plan - ' . $meal_data->post_title;
	
	$body = '<h2>Meal Plan - '.$meal_data->post_title.'</h2><br /><br />Please find attached meal plan.';
	//<img src="' . get_bloginfo('template_directory') . '/' . $folder.$image_name.'" />
	
	$attachments = array($image_path);
	
	
	
	
	
	
	$headers = 'From: Admin <info@projectstatus.co.uk>' . "\r\n";
	$headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	
	
	$mail = wp_mail( $to, $subject, $body, $headers, $attachments );
	
	@unlink($image_path);
	
	
	
	$success = 'Meal Plan mailed. Please check mail.';
	
	
}
if( !empty($_POST) && isset($_POST['change_name']) ){
	//pr($_POST);	die;
	
	if($_POST['meal_plan_id'] > 0) {
		$my_post = array(
		  'ID'           => $_POST['meal_plan_id'],
		  'post_title'   => $_POST['meal_plan_name']
		);

		// Update the post into the database
		wp_update_post( $my_post );
		
		$success = 'Meal Plan renamed successfully.';
	}
	
	
}
if( !empty($_POST) && isset($_POST['change_meal_plan']) ){
	
	setCurrentMealPlan( $_POST['meal_plan_select'], $user_id);
	$success = 'Current Meal Plan changed successfully.';
}

if( !empty($_POST) && isset($_POST['update_meal']) ){
	//pr($_POST);	die;
	
	$meal_plan_id = $_POST['post_id'];
	
	$meal_plan_fields = array(
					'monday' => 'field_565d3d234344e',
					'tuesday' => 'field_565d402053980',
					'wednesday' => 'field_565d403a53989',
					'thursday' => 'field_565d404353992',
					'friday' => 'field_565d404d5399b',
					'saturday' => 'field_565d405a539a4',
					'sunday' => 'field_565d4068539ad'
					);

	/*
	*  add a repeater row on a monday!!!
	monday
	*/
	
	foreach($meal_plan_fields as $day => $meal_plan_field){
		
		$data = $_POST['data'];
		
		$field_key = $meal_plan_field;
		$value = array();//get_field($field_key, $recipe_id);
		//$value[] = array("sub_field_1" => "Foo", "sub_field_2" => "Bar");
		
		$value[] = array(
					'is_fasting' => $data[$day]['is_fasting'] ? true : false,
					'fasting_plan' => $data[$day]['fasting_id'],
					'breakfast' => $data[$day]['breakfast']['id'],
					'breakfast_snack' => $data[$day]['breakfast_snack']['id'],
					'lunch' => $data[$day]['lunch']['id'],
					'lunch_snack' => $data[$day]['lunch_snack']['id'],
					'dinner' => $data[$day]['dinner']['id'],
					'post_workout' => $data[$day]['post_workout']['id']
					);
		
			
		update_field( $field_key, $value, $meal_plan_id );
		
		
	}
	
	$success = 'Meal Plan changed successfully.';

	
}

$fastArgs = array(
			'post_type' => 'fasting',
			'post_status' => 'publish'
			);
$fastData	= get_posts($fastArgs);

				  
$fastPlan = array();
foreach($fastData as $fstDta) {
	$fastPlanData = getFastPlanArray($fstDta);
	$fastPlanData['fasting_id'] = $fstDta->ID;
	$fastPlan[$fstDta->ID] = $fastPlanData;
}

//pr($fastPlan);

$fasting_array_keys = array_keys($fastPlan);

//pr($fasting_array_keys);


?>

<div class="container">
  <div class="col-md-12 col-sm-12">
    <div class="row">
      <div id="primary" class="content-area col-sm-12 col-md-12 <?php echo of_get_option( 'site_layout' ); ?>">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
              <div class="receipy_boxes_men">
                <header class="entry-header page-header">
                  <h1 class="entry-title">Take fitness Plan </h1>
                </header>
                <!-- .entry-header -->
                
                <div class="col-md-6 col-sm-6">
                  <div class="create-new-mealplan">
				<div class="create-new-mealplan-text">
					You can Create new Meal plan
				</div>
				<form style="float:left; width:50%;" action="" method="post">
					<input type="hidden" name="new_meal_plan">
					<button class="create-mealplan">Create</button>
				</form>
			</div>
                </div>
                <div class="col-md-6 col-sm-6">
                  
                  <div class="change-new-mealplan">
				<div class="change-new-mealplan-text">
					You can change Meal plan name
				</div>
				<form style="float:left; width:50%;" action="" method="post" onsubmit="return changeMealPlanForm();">
					<button style="float:left;" class="create-mealplan" type="submit" name="change_name">Change</button>
					<input type="hidden" name="meal_plan_id" id="meal_plan_id" value="0" />
					<input placeholder="Write Mealplan name" name="meal_plan_name" id="meal_plan_name" value="" style="width:100%;" class="input-100">
				</form>
			</div>
                  
                </div>
                <div class="clear"></div>
              </div>
            </article>
            <!-- #post-## -->
            
            <div class="col-md-12 col-sm-12">
              <div class="row">
				<?php $mpArgs = array(
								'post_type' => 'meal',
								'post_status' => 'publish',
								'author' => $user_id
								);
								
					
					$mpData	= get_posts($mpArgs);
					
					$first_plan = 0;
					$current_plan_found = false;
					?>
			  
                <div class="mealplan">
				<form method="post" name="change_meal_plan_frm" id="change_meal_plan_frm">
                  <select style="float:left;" class="choice-mealplan" onchange="document.getElementById('change_meal_plan_frm').submit();" name="meal_plan_select">
					<?php foreach($mpData as $k => $mpD){
						if($first_plan < 1){
							$first_plan = $mpD->ID;
						}
						if($mpD->ID == $current_meal_plan){
							$current_plan_found = true;
							?><option value="<?php echo $mpD->ID?>" selected="selected">Current : <?php echo $mpD->post_title;?></option><?php
						} else {
							?><option value="<?php echo $mpD->ID?>"><?php echo $mpD->post_title;?></option><?php
						}
						
					}?>
                  </select>
				  <input type="hidden" name="change_meal_plan" value="1" />
				</form>
				  <?php 
				  
				  if(!$current_plan_found){
					  $current_meal_plan = $first_plan;
					  setCurrentMealPlan($first_plan, $user_id);
				  ?>
				  <script type="text/javascript">
					jQuery('.choice-mealplan option:first').prepend('Current : ');
				  </script>
				  <?php 
				  }
				  
				  
				  $meal_data = get_post($current_meal_plan);
				  
				  
				  
				  $dayArray = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
				  
				  $mealPlan = array();
				  foreach($dayArray as $dayArr){
					  
					$mealPlanData = getMealPlanArray(get_field($dayArr, $meal_data->ID));
					$mealPlan[$dayArr] = $mealPlanData;
				  }
				  
				  //pr($mealPlan);
				  
				  ?>
				  
				
				<?php if($success){?>
				<div class="success"><?php echo $success;?></div>
				<?php }?>
				  
				<div id="print-meal-div">
				
                  <div class="title-fitness">Meal plan : <span id="current_meal_plan"><?php echo $meal_data->post_title;?></span></div>
				  
				  
				  
				  
                  <form method="post" action="" name="mealplan" id="mealplan" onsubmit="return validateForm();">
				  <input type="hidden" id="post_id" name="post_id" value="<?php echo $meal_data->ID;?>" />
                    <div id="print_able" style="backgroud:#FFF;">
                      <div class="meal-plan-week">
                        <div id="image-png" class="right-meal-plan">
                          <div class="meal-plan-top-names">
                            <div style="background:#fff !important;" class="meal-plan-top-single-name"> </div>
                            <div style="border-left:none;" class="meal-plan-top-single-name"> Breakfast </div>
                            <div class="meal-plan-top-single-name"> Snack </div>
                            <div class="meal-plan-top-single-name"> Lunch </div>
                            <div class="meal-plan-top-single-name"> Snack </div>
                            <div class="meal-plan-top-single-name"> Dinner </div>
                            <div class="meal-plan-top-single-name"> Post Workout </div>
                          </div>
                          
						  <?php foreach($mealPlan as $day => $mp){?>
						  
						  
                          <div class="meal-plan-information" id="<?php echo $day?>_wrappper">
                            <div class="meal-plan-day">
                              <div class="<?php echo $day?>-change change-fasting" style="display:<?php echo $mp['is_fasting'] ? 'block' : 'none';?>"> 
							  
								<?php 
								$fast_plan_pos = 0;
								if($mp['is_fasting']){
									$fast_plan_pos = array_search($mp['fasting_id'], array_keys($fastPlan)) + 1;
								}
								?>
								<span class="prev" data-type="prev"  data-day="<?php echo $day?>">&lt;</span><span id="<?php echo $day?>-liczba" data-current="<?php echo $fast_plan_pos;?>"> <?php echo $fast_plan_pos;?> </span><span class="next"  data-type="next" data-day="<?php echo $day?>">&gt;</span> 
							  
							  </div>
                              <div class="meal-plan-day-name"> <?php echo ucfirst($day);?> </div>
                              <div class="fasting-day">
                                <input type="hidden" id="_<?php echo $day?>-fasting-checkbox" name="data[<?php echo $day;?>][is_fasting]" value="0">
                                <input type="checkbox" id="<?php echo $day?>-fasting-checkbox" <?php echo $mp['is_fasting'] ? 'checked="checked"  class="disable fasting-checkbox"' : ' class="fasting-checkbox"';?> name="data[<?php echo $day;?>][is_fasting]" data-day="<?php echo $day?>" value="1">
                                <input type="hidden" id="<?php echo $day?>-fasting_plan-hidden" name="data[<?php echo $day;?>][fasting_id]" value="<?php echo $mp['fasting_id'];?>">
                                <span> Fasting day </span> </div>
                            </div>
                            <div class="lists">
							
							
							<?php 
							
								global $mealPlanColumns;
								
				
								foreach($mealPlanColumns as $mpc){
									
									if($mp['is_fasting']){
										$mp[$mpc] = $mp['fasting_plan'][$mpc];
									}
									?>
									<div id="<?php echo $day?>_<?php echo $mpc;?>" class="meal-plan-information-single">
									<?php if(isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != ''){?>
										<div class="title-meal-plan-single">
										  <div class="wyslij-do-przepisu"><?php echo $mp[$mpc]['title']?></div>
										</div>
										<div class="change-this-<?php echo $mpc;?>-<?php echo $day;?> change-this-eat"  style="display:<?php echo $mp['is_fasting'] ? 'none' : 'block';?>"  data-toggle="modal" href="<?php echo admin_url('admin-ajax.php'); ?>?action=select_recipe&amp;current_recipe_id=<?php echo isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != '' ? $mp[$mpc]['id'] : ''?>&amp;mpc=<?php echo $mpc;?>&amp;day=<?php echo $day;?>" data-target="#myModal"> Change </div>
										<a  id="<?php echo $day;?>-<?php echo $mpc;?>-link_plan"  style="display:none"  data-toggle="modal" href="<?php echo admin_url('admin-ajax.php'); ?>?action=select_recipe&amp;current_recipe_id=<?php echo isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != '' ? $mp[$mpc]['id'] : ''?>&amp;mpc=<?php echo $mpc;?>&amp;day=<?php echo $day;?>" data-target="#myModal">&gt; Link &lt;</a>
											<?php } else {?>
										<div class="title-meal-plan-single" style="display:none;">
										  <div class="wyslij-do-przepisu"></div>
										</div>
										<div class="change-this-<?php echo $mpc;?>-<?php echo $day;?> change-this-eat" style="display:none;"  data-toggle="modal" href="<?php echo admin_url('admin-ajax.php'); ?>?action=select_recipe&amp;current_recipe_id=<?php echo isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != '' ? $mp[$mpc]['id'] : ''?>&amp;mpc=<?php echo $mpc;?>&amp;day=<?php echo $day;?>" data-target="#myModal"> Change </div>
										
										<a id="<?php echo $day;?>-<?php echo $mpc;?>-link_plan"  style="display:<?php echo $mp['is_fasting'] ? 'none' : 'block';?>"  data-toggle="modal" href="<?php echo admin_url('admin-ajax.php'); ?>?action=select_recipe&amp;current_recipe_id=<?php echo isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != '' ? $mp[$mpc]['id'] : ''?>&amp;mpc=<?php echo $mpc;?>&amp;day=<?php echo $day;?>" data-target="#myModal">&gt; Link &lt;</a>
											<?php }?>
										<div id="new-name-to-<?php echo $mpc;?>-<?php echo $day;?>" class="new-name-to-eat">  </div>
										<input type="hidden" value="<?php echo isset($mp[$mpc]['id']) && trim($mp[$mpc]['id']) != '' ? $mp[$mpc]['id'] : ''?>" name="data[<?php echo $day;?>][<?php echo $mpc;?>][id]" id="<?php echo $day;?>_<?php echo $mpc;?>_id">
									</div>
									<?php
								}
							?>
                              
							  
                            </div>
                          </div>
						  <?php }?>
                   </div>
                      </div>
                    </div>
                    <div class="submit-area">
                      <input type="submit" value="SAVE" name="update_meal">
                    </div>
                  </form>
                  
				</div>
				  
				  <div class="title-what-can-do"> You can Also : </div>
                  <div class="print-recipe">
                    <button onclick="printContent('print-meal-div')"><img src="<?php bloginfo('template_directory'); ?>/images/print_page.png" alt="" /></button>
                  </div>
				  <script>
				setTimeout(function(){ 
				jQuery(function() { 
						html2canvas(jQuery("#print-meal-div"), {
						onrendered: function(canvas) {
							theCanvas = canvas;
							
							var dataURL = canvas.toDataURL("image/jpeg", 1);
							jQuery( ".image-input" ).val(dataURL);
							},
							background:'#FFF'
						});
					
				}); 
				jQuery( "#btnSave" ).prop('disabled', false);
				}, 5000);
				</script>

                  <div class="send-mail-meal">
                    <form style="float:left;" action="" method="post">
                      <input type="hidden" name="image" class="image-input" value="">
                      <input type="hidden" name="meal_plan_id" class="image-input" value="<?php echo $current_meal_plan;?>">
                      <input type="submit" value="Send to Email" name="mail_meal_plan" id="btnSave" disabled>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- #primary --> 
          <script type="text/javascript">
		  var fasting_plans = <?php echo json_encode($fastPlan);?>;
		  var fasting_array_keys = <?php echo json_encode($fasting_array_keys);?>;
		  <?php 
		  global $mealPlanColumns;
		  ?>
		  var mealPlanColumns = <?php echo json_encode($mealPlanColumns);?>;
		  var mealPlan = <?php echo json_encode($mealPlan);?>;
		  
		  function keyupRecipe(obj){
			  var search = jQuery.trim(jQuery(obj).val()).toLowerCase();
			  
			  jQuery('.no_recipe_found_li').hide();
			  
			  var choose_recipe_found = 0;
			  jQuery('.choose_recipe_title').each(function(){
				  var titlee = jQuery.trim(jQuery(this).html()).toLowerCase();
				  var choose_post_id = jQuery(this).attr('rel');
				  if(titlee.indexOf(search) < 0){
					  jQuery('#choose_recipe_li_'+choose_post_id).hide();
				  } else {
					  choose_recipe_found++;
					  jQuery('#choose_recipe_li_'+choose_post_id).show();
				  }
				  
			  });
			  
			  if(choose_recipe_found == 0){
				  jQuery('.no_recipe_found_li').show();
			  }
		  }
		  
		  
		  function disableCheckboxes(){
			  
			  if(jQuery('.fasting-checkbox:checked').size() > 1){
				  jQuery('.fasting-checkbox').not(':checked').attr("disabled", true);
			  } else {
				  jQuery('.fasting-checkbox').not(':checked').attr("disabled", false);
			  }
			  
		  }
	  
		  
		  jQuery(document).ready(function(){
			  
			  disableCheckboxes();
			  
			  jQuery('.fasting-checkbox').on('change', function(){
				  
				  var day = jQuery(this).data('day');
				  var is_checked = jQuery(this).is(':checked');
				  var type = 'next';
				  var current_fast_pos = 0;
				  
				  if(is_checked){
					  
					  changeFasting(day, type, current_fast_pos);
					  
					  
					  jQuery('.'+day+'-change').show();
					  
				  } else {
					  revertFasting(day);
					  jQuery('.'+day+'-change').hide();
				  }
				  
				  
					  disableCheckboxes();
				  
				  
			  });
			  
			  
			  jQuery('.change-fasting span.prev, .change-fasting span.next').on('click', function(){
				  
				  
				  var day = jQuery(this).data('day');
				  var type = jQuery(this).data('type');
				  var current_fast_pos = jQuery('#'+day+'-liczba').attr('data-current');
				  
				  changeFasting(day, type, current_fast_pos);
			  });
			  
			  jQuery('.modal-body').html(jQuery('#emptyModal').html());
		  });
		  
		  function revertFasting(day){
			  
			  
			dataChanged = true;
			  jQuery(mealPlanColumns).each(function(index){
					  var mpc = mealPlanColumns[index];
					  
					  fillColumnData(day, mpc, mealPlan[day]);
					  
						
					  if(mealPlan[day][mpc]['title'] != ''){
						  
						
						jQuery('.change-this-'+mpc+'-'+day).show();
						jQuery('#'+day+'_wrappper #'+day+'-'+mpc+'-link_plan').hide();
					  } else {
						
						jQuery('.change-this-'+mpc+'-'+day).hide();
						jQuery('#'+day+'_wrappper #'+day+'-'+mpc+'-link_plan').show();
					  }
					  
					  
					  
					  
				  });
			  
			jQuery('#'+day+'-fasting_plan-hidden').val('0');
		  }
		  
		  function changeFasting(day, type, current_fast_pos){
			  
			  
				  
			dataChanged = true;
				  var new_fast_pos = getNewFastingPos(current_fast_pos, type);
				  var new_fast_id = fasting_array_keys[(new_fast_pos-1)];
				  
				  
				  //#day-fasting_plan-hidden
				  
				  
				  jQuery(mealPlanColumns).each(function(index){
					  var mpc = mealPlanColumns[index];
					  
					  fillColumnData(day, mpc, fasting_plans[new_fast_id]);
					  
					  
					  
				  });
				  
				  
				jQuery('#'+day+'-fasting_plan-hidden').val(fasting_plans[new_fast_id]['fasting_id']);
				  
				  changeFastingPos(new_fast_pos, day);
			  
		  }
		  
		  function fillColumnData(day, mpc, colData){
		  
				 //#day_mpc
				  //.title-meal-plan-single .wyslij-do-przepisu
				  
				  jQuery('#'+day+'_'+mpc+ ' .title-meal-plan-single').show();
				  jQuery('#'+day+'_'+mpc+ ' .title-meal-plan-single .wyslij-do-przepisu').html(colData[mpc]['title']);
				  
				  
				  //.change-this-mpc-day
				  jQuery('.change-this-'+mpc+'-'+day).hide();
				  
				  
				  //.link_plan
				  jQuery('#'+day+'_'+mpc+ ' #'+day+'-'+mpc+'-link_plan').hide();
				
				
				  //#new-name-to-mpc-day
				  
				  //#day_mpc_id
				  jQuery('#'+day+'_'+mpc+'_id').val(colData[mpc]['id']);
			  
		  }
		  
		function changeFastingPos(new_pos, day){
			
			//jQuery('#'+day+'_wrappper .change-fasting span.prev').data('day', getNewFastingPos(new_pos, 'prev'));
			
			//jQuery('#'+day+'_wrappper .change-fasting span.next').data('day', getNewFastingPos(new_pos, 'next'));
			jQuery('#'+day+'-liczba').attr('data-current', new_pos);
			jQuery('#'+day+'-liczba').html(' ' + new_pos + ' ');

		}
		  
		  function getNewFastingPos(current_fast_pos, type){
			  
			 var new_pos = 1;
			 var total_fasting = fasting_array_keys.length;
			 
			if(type == 'prev'){
				
				new_pos = parseInt(current_fast_pos)-1;
				if(new_pos < 1){
					new_pos = total_fasting;
				}
				
				
			} else if(type == 'next'){
				
				new_pos = parseInt(current_fast_pos)+1;
				if(new_pos > total_fasting){
					new_pos = 1;
				}
			  
			}
			
			return new_pos;
			  
		  }
		  
		  jQuery('body').on('hidden.bs.modal', '.modal', function () {
			  jQuery(this).removeData('bs.modal');
			  jQuery('.modal-body').html(jQuery('#emptyModal').html());
			  
		});
		
		function mealPicked(day, mpc, pick_id, pick_title){
			
			
			jQuery('#myModal').modal('hide');
			
			
			jQuery('#'+day+'_'+mpc+'_id').val(pick_id);
			jQuery('#new-name-to-'+mpc+'-'+day).html(pick_title);
			
			dataChanged = true;
			
		}
		
		var dataChanged = false;
		  function validateForm(){
			  
			  if(dataChanged){
				  
				  return true;
			  }
			  
			  jQuery('.modal-body').html('Meal Plan is not changed.');
			  jQuery('#myModal').modal('show');
			  return false;
			  
		  }
		  
		  
		function printContent(el){ 
			var restorepage = document.body.innerHTML; 
			var printcontent = document.getElementById(el).innerHTML; 
			document.body.innerHTML = printcontent; 
			var all = jQuery('.change-this-eat, a')
			all.hide();
			window.print(); 
			document.body.innerHTML = restorepage;
			all.show();
		} 
		
		function changeMealPlanForm(){
			
			var MPName = jQuery.trim(jQuery('#meal_plan_name').val());
			
			if(MPName == '') {
			  jQuery('#myModal1 .modal-body').html('Name is required.');
			  jQuery('#meal_plan_name').focus();
			  jQuery('#myModal1').modal('show');
			  return false;
			}
			
			jQuery('#meal_plan_id').val(jQuery('#post_id').val());
			return true;
			
			
			
		}
</script>
        </div>
      </div>
    </div>
  </div>
</div>




<div id="emptyModal">
<div class="loadingimage">
Please wait... Fetching recipes
<img src="<?php bloginfo('template_directory'); ?>/images/clock-loading.gif" alt="<?php the_title()?>" /><br />
<br />

</div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Choose Recipe</h4>

            </div>
            <div class="modal-body">
			
			</div>
			
			<?php /*?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
			<?php */?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Error</h4>

            </div>
            <div class="modal-body error">
			
			</div>
			
			<?php /*?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
			<?php */?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script src="<?php bloginfo('template_directory'); ?>/js/html2canvas.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.plugin.html2canvas.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/html2canvas.svg.js"></script>

<?php get_footer(); ?>
