<?php 

ini_set('log_errors', true);
ini_set('error_log', dirname(__FILE__).'/erroro.log');

add_action( 'init', 'wpd_init' );

function wpd_init(){
    wpd_register_codes();
}

function wpd_register_codes() {

	$labels = array(
		'name'               => _x( 'Codes', 'post type general name', 'wpd-theme' ),
		'singular_name'      => _x( 'Code', 'post type singular name', 'wpd-theme' ),
		'menu_name'          => _x( 'Codes', 'admin menu', 'wpd-theme' ),
		'name_admin_bar'     => _x( 'Code', 'add new on admin bar', 'wpd-theme' ),
		'add_new'            => _x( 'Add New', 'Code', 'wpd-theme' ),
		'add_new_item'       => __( 'Add New Code', 'wpd-theme' ),
		'new_item'           => __( 'New Code', 'wpd-theme' ),
		'edit_item'          => __( 'Edit Code', 'wpd-theme' ),
		'view_item'          => __( 'View Code', 'wpd-theme' ),
		'all_items'          => __( 'All Codes', 'wpd-theme' ),
		'search_items'       => __( 'Search Codes', 'wpd-theme' ),
		'parent_item_colon'  => __( 'Parent Codes:', 'wpd-theme' ),
		'not_found'          => __( 'No Codes found.', 'wpd-theme' ),
		'not_found_in_trash' => __( 'No Codes found in Trash.', 'wpd-theme' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => false,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title')
	);

	register_post_type( 'inv_code', $args );
}


add_filter( 'manage_edit-inv_code_columns', 'my_edit_inv_code_columns' ) ;

function my_edit_inv_code_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Code' ),
		'package' => __( 'Package' ),
		'left' => __( 'Left' ),
		'date' => __( 'Date Added' )
	);

	return $columns;
}

add_action( 'manage_inv_code_posts_custom_column', 'my_manage_inv_code_columns', 10, 2 );

function my_manage_inv_code_columns( $column, $post_id ) {
	global $post;
	
	switch( $column ) {

		/* If displaying the 'package' column. */
		case 'package' :

			/* Get the post meta. */
			$alid = get_post_meta( $post_id, 'package', true );
			echo __(get_package_name($alid));
			break;

		/* If displaying the 'left' column. */
		case 'left' :

			/* Get the genres for the post. */
			$left = get_post_meta( $post_id, 'leftcount',true );
			echo $left;
			break;

		/* Just break out of the switch statement for everything else. */
		default :
			break;
	}
}

add_action( 'admin_menu', 'wpd_members_area' );

function wpd_members_area(){
    
    add_menu_page( 'Access Levels', 'Access Levels', 'manage_options', 'access_levels', 'wpd_main_page','', 6 ); 
    add_submenu_page(
    'edit.php?post_type=inv_code','Generate Codes','Generate Codes','manage_options','wpd_generate_codes','wpd_generate_codes_page');
	//add_submenu_page( 'edit.php?post_type=inv_code','CSV Export','CSV  Export', 'manage_options', 'wpd_codes_export', 'wpd_export_codes_csv');

}

function wpd_code_exists($tite){
	global $wpdb;
	
	$sql = "SELECT ID FROM ".$wpdb->prefix . "posts WHERE `post_type` = 'inv_code' AND `post_title` LIKE '".$tite."'; ";
	$results = $wpdb->get_results($sql);
	$count = count($results);
	if($count == 0){
		return false;
	}else{
		return true;
	}
}

function wpd_generate_codes_page(){
        
    if($_POST['generate_codes']==1){
/*         echo '<pre>';
        print_r($_POST);
        echo '</pre>'; */
        
        $generate = false;
        $prefix = isset( $_POST['wpd_field_prefix'] ) ? $_POST['wpd_field_prefix'] : '';
        $count = isset( $_POST['wpd_field_count'] ) ? (int)$_POST['wpd_field_count'] : 1;
        $length = isset( $_POST['wpd_field_length'] ) ? (int)$_POST['wpd_field_length'] : 8;
        $howmany = isset( $_POST['wpd_field_howmany'] ) ? (int)$_POST['wpd_field_howmany'] : 5;
        $discount_type = isset( $_POST['wpd_discount_type'] ) ? (int)$_POST['wpd_discount_type'] : 'fixed';
        $discount = isset( $_POST['wpd_discount'] ) ? (int)$_POST['wpd_discount'] : '0';
        $package = isset( $_POST['wpd_package'] ) ? (int)$_POST['wpd_package'] : '';
        $ecsv = isset( $_POST['wpd_csv_export'] ) ? (int)$_POST['wpd_csv_export'] : 0;
        $wpd_codes_list = array();
        $messageGo ='<div id="message" class="wrap">';
        $code_validation = false;
        if( $count<1 ):
            $messageGo .= "'How many time this code can be used? Minimum 1<br />";
        elseif( $length<4 || $length>16 ):
            $messageGo .= "Incorrect length. Minimum 4 and Maximum 16 <br />";
        elseif( $howmany<1 ):
            $messageGo .= "How many codes do you need? Minimum 1<br />";
        else:
        $generate = true;
        
        endif;
        $messageGo .= "</div>";
    }
?>
	<div class="wrap">
		<style>
            .form-table{}
            .form-table td{}
            .form-table td input,.form-table td select{float:left;}
            .form-table td em{float:left;clear:both}
        </style>
		<h2><?php _e( 'Invitation Codes, generate some!', 'baweic' ); ?></h2>
        <?php if($code_validation){ echo $messageGo; } ?>
        <form action="?post_type=inv_code&page=wpd_generate_codes" method="post">
            <h3>Add auto generated codes</h3>
                <table class="form-table">
                    <input type="hidden" name="generate_codes" value="1"/>
                    <tr valign="top">
                        <th scope="row">Code prefix</th>
                        <td>
                            <input type="text" name="wpd_field_prefix" size="10" value="" style="text-transform: uppercase;">
                            <em>All generated codes will start with this.</em>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Length</th>
                            <td>
                                <input type="number" size="10" min="4" max="16" name="wpd_field_length" value="8"> 
                                <em>Length of generated codes (Min. 4, Max. 16)</em>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">How many codes</th>
                        <td>
                            <input type="number" size="3" min="1" max="999999999" name="wpd_field_howmany" value="5">
                            <em>How many codes do you need?</em>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Max count</th>
                        <td>
                            <input type="number" size="3" min="1" name="wpd_field_count" value="1">
                            <em>How many time this code can be used?</em>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Discount Type</th>
                        <td>
                            <label><input type="radio" name="wpd_discount_type" value="fixed" checked="checked" /> Fixed Amount</label>
                            <label><input type="radio" name="wpd_discount_type" value="percent" /> Percentage</label>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Discount</th>
                        <td>
                            <input type="number" step="0.01" name="wpd_discount" value="" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row">Assign Package</th>
                        <td>
                            <?php wpd_get_packages(); ?>
                            <em>Please assign package.</em>
                        </td>
                    </tr>
                    
                </table>
			<?php submit_button( __( 'Generate codes', 'baweic' ) ); ?>
            
		</form>
	</div>
<?php

    if($generate){
        $temp = array();
        $i = 0;
		
        while( $i<$howmany ):
            $temp = strtoupper( $prefix . wp_generate_password( $length, false ) );
            if(!wpd_code_exists($temp)){
                if($ecsv==1) array_push($wpd_codes_list, $temp);

                    $cc = array(
                        'post_title'    => $temp,
                        'post_status'   => 'publish',
                        'post_author'   => 1,
                        'post_type' => 'inv_code'
                    );
                    
                    $post_id = wp_insert_post( $cc);
                    add_post_meta($post_id,'maxcount',$count);
                    add_post_meta($post_id,'leftcount',$count);
                    add_post_meta($post_id,'users','');
                    add_post_meta($post_id,'discount_type',$discount_type);
                    add_post_meta($post_id,'discount',$discount);
                    add_post_meta($post_id,'package',$package);
                    $i++;
            }
        endwhile;
      //  add_settings_error( 'baweic', '', sprintf( __( '%d code(s) have been added. <a href="%s">Check the codes list &raquo;</a>', 'baweic' ), $howmany, admin_url( 'admin.php?page=baweic_list_codes' ) ), 'updated' );

        if($ecsv == 1){
            foreach($wpd_codes_list  as $cc){
                echo $cc.'<br/>';
            }
            exit;
        }
        
    }
}

function wpd_main_page(){ 
	global $wpdb;
	
	if(isset($_GET['alid']) && $_GET['alid']!=''){
		$alid = $_GET['alid'];
	}

	if(isset($_GET['wpd_action']) && $_GET['wpd_action']=='delete'){	
		$wpdb->query("DELETE FROM ".$wpdb->prefix . "wpd_access_level WHERE id=".$alid.";");
		$alid = '';
	}
	
	if(isset($_POST['add_new_level'])){
		$access = implode('|',$_POST['wpd_access_level']);
		$paypal = $_POST['wpd_access_pp'];
		$wpdb->query("INSERT INTO ".$wpdb->prefix . "wpd_access_level VALUES('' , '".$_POST['wpd_access_name']."', '".$access."', '".$_POST['wpd_access_expires']."','".$_POST['wpd_access_price']."','".$_POST['wpd_access_currency']."','".$paypal."','".$_POST['wpd_access_pp_bt']."' );");
		
		update_restricte_areas();
		
		$messageGo ='<div id="message" class="wrap">';
		$messageGo .= "New Access Level has been added.<br />";
		$messageGo .= "</div>";
		
	}
	
	if(isset($_POST['save_access_level'])){
		$alid = $_POST['alid'];
		$access = implode('|',$_POST['wpd_access_level']);
		$paypal = $_POST['wpd_access_pp'];
		$wpdb->query("UPDATE ".$wpdb->prefix . "wpd_access_level SET name='".$_POST['wpd_access_name']."', areas='".$access."', expires ='".$_POST['wpd_access_expires']."', price ='".$_POST['wpd_access_price']."', currency ='".$_POST['wpd_access_currency']."', paypal ='".$paypal."', paypal_bt ='".$_POST['wpd_access_pp_bt']."' WHERE id = ".$alid." ;");
		
		update_restricte_areas();
		
		$messageGo ='<div id="message" class="wrap">';
		$messageGo .= "Access Level has been updated.<br />";
		$messageGo .= "</div>";
	}
	
	if(isset($_POST['wpd_import'])){

		$row = 0;
		$dod = 0;
		if (($handle = fopen("/home/savitrad/public_html/wp-content/themes/theme/oz_codes.csv", "r")) !== FALSE) {
	
		/* while (($data = fgetcsv($handle, 50, ",")) !== FALSE) { */
			while ((($data = fgetcsv($handle, 50, ",")) !== FALSE)) {
					
				$temp = trim($data[0]);
				//print_r($temp);
			
				$page = get_page_by_title( $temp,'OBJECT','inv_code' );
				if(!isset($page->ID)):
				
					$cc = array(
						'post_title'    => $temp,
						'post_status'   => 'publish',
						'post_author'   => 1,
						'post_type' => 'inv_code'
					);
					
					$post_id = wp_insert_post( $cc);
					add_post_meta($post_id,'maxcount',1);
					add_post_meta($post_id,'leftcount',1);
					add_post_meta($post_id,'users','');
					add_post_meta($post_id,'access',1);
					
					$dod++;
				endif;
			
			$row++;
			}
			fclose($handle);
		}
		echo $row.' - '.$dod;
	}
	
	if(isset($_POST['wpd_remove_duplicates'])){
	
		$cq = new WP_Query(
			array(
				'post_type' => 'inv_code',
				'posts_per_page'=>-1,
				'orderby' => 'date',
				'order' =>'ASC'
			));
			
		if ( $cq->have_posts() ) {
			while ( $cq->have_posts() ) { 
				$cq->the_post();
					$ncq = new WP_Query(
						array(
							'post_type' => 'inv_code',
							'posts_per_page'=>-1,
							'orderby' => 'date',
							'order' =>'ASC'
					));
					if ( $ncq->have_posts() ){
						while ( $ncq->have_posts() ) { 
							$ncq->the_post();
							if($cq->post->post_title == $ncq->post->post_title){
								$keys = get_post_custom_keys($ncq->post->ID);
								foreach($keys as $key => $val){
									delete_post_meta($ncq->post->ID,$val);
								}
								wp_delete_post($ncq->post->ID);
								break;
							}
							
						}
					}
					wp_reset_postdata();	
				/*	
				if(!in_array($cq->post->post_title,$pages)){
					array_push($pages,$cq->post->post_title);
				}else{

					$keys = get_post_custom_keys($cq->post->ID);
					foreach($keys as $key => $val){
						delete_post_meta($cq->post->ID,$val);
					}
					wp_delete_post($cq->post->ID);
				}*/
			}

		}
		wp_reset_postdata();		
	
	}
?>
<style>
#aceess_levels{}
#aceess_levels tr{border-bottom:1px solid #ccc;}
#aceess_levels th{}
#aceess_levels td{overflow:hidden;white-space:nowrap;}
#aceess_levels td .description{display:block; overflow:hidden;padding:5px;height: 100px;}
</style>
<div class="wrap">
	<?php echo $messageGo ?>
		<div id="icon-edit" class="icon32"><br></div>		
		<h2>Access Levels</h2>
			<p></p>

<table  class="form-table" id="aceess_levels">
	<tr>
		<th width="140">Name</th>
		<th width="60">Price</th>
		<th>Access Level</th>
		<th>Expires</th>
		<th>PayPal</th>
		<th>Action</th>
	<tr>
<?php 
	$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level";
	$results = $wpdb->get_results($sql);
	foreach( $results as $result ) {
		
	?>
		<tr>
			<td ><?php echo $result->name ?></td>
			<td ><?php echo $result->price.' '.$result->currency ?></td>
			<td><span class="description"><?php 
				$pages = explode('|',$result->areas);
				$posts = get_pages(array(
					'include'=>$pages
					)
				);
				echo '<strong>'.count($posts).' pages</strong><br/>';
				foreach($posts as $po){
					echo $po->post_title ."</br>";
				}
			  ?></span></td>
			<td><?php 
				if($result->expires == 0 ){ $result->expires = 'Lifetime'; }
					echo $result->expires;
			?></td>
			<td><?php echo $result->paypal ?></td>
			<td><a href="?page=access_levels&wpd_action=edit&alid=<?php echo $result->id ?>#edit">Edit</a><br/><br/><a href="?page=access_levels&wpd_action=delete&alid=<?php echo $result->id ?>">Delete</a></td>
		</tr>
	<?php
	}
	?>
	</table>
	<p></p>
	<div id="icon-edit" class="icon32"><br></div>	
	<a name="edit"></a>
	<?php if(isset($_GET['wpd_action']) && $_GET['wpd_action']=='edit'){ 

		$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level WHERE id='".$alid."'";
		$results = $wpdb->get_results($sql);
	?>
		<h2>Edit Access Levels</h2>
	<?php }else{ ?>
		<h2>Add new Access Levels</h2>
	<?php } ?>
	
	<p></p>
	<form id="new_access" action="?page=access_levels" method="POST">
		<table class="form-table">
			<tr>
				<th><label for="wpd_access_name">Access Name</label></th>
				<td>
					<input name="wpd_access_name" id="wpd_access_name" value="<?php if($alid){
						echo $results[0]->name;
					}?>" /><br />
					<span class="description">--</span>
				</td>
			</tr>
			<tr>
				<th><label for="wpd_access_expires">Access for</label></th>
				<td>
					<input name="wpd_access_expires" id="wpd_access_expires" value="<?php if($alid){
						echo $results[0]->expires;
					}?>" /><br />
					<span class="description">--</span>
				</td>
			</tr>
			<tr>
				<th><label for="wpd_access_price">Price</label></th>
				<td>
					<input name="wpd_access_price" id="wpd_access_price" value="<?php if($alid){
						echo $results[0]->price;
					}?>" size="5" placeholder="Price"/>
					<input name="wpd_access_currency" id="wpd_access_currency" value="<?php if($alid){
						echo $results[0]->currency;
					}?>" size="5" placeholder="Currency"/><br />
					<span class="description"></span><span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="wpd_access_pp">Enable PayPal offer</label></th>
				<td>
					<input type="checkbox" name="wpd_access_pp" id="wpd_access_pp" value="yes" <?php if($results[0]->paypal=='yes'){ echo 'checked="checked"'; } ?> />
					<input type="text" style="disaply:none"name="wpd_access_pp_bt" id="wpd_access_pp_bt" value="<?php if($results[0]->paypal_bt){ echo $results[0]->paypal_bt; } ?>" placeholder="PayPal Button ID"/>
					<br />
					<span class="description"></span>
				</td>
			</tr>
			<tr>
				<th><label for="wpd_access_level">Access to</label></th>
				<td>
					<select multiple name="wpd_access_level[]" style="width: 200px;height: 170px;">
						<?php 
							
							$mypages = get_pages('sort_column=post_date');
							if($alid){
								
								$access = explode('|',$results[0]->areas);
								foreach( $mypages as $page ) { 
									if($page->post_title =='') continue; ?>
									<option value="<?php echo $page->ID ?>" <?php if(in_array($page->ID,$access)){ echo 'selected'; } ?>><?php if($page->post_parent !=0){ ?> - <?php } ?><?php echo $page->post_title; ?></option>
								<?php								
								}
							}else{
								foreach( $mypages as $page ) { 
									if($page->post_title =='') continue; ?>
									<option value="<?php echo $page->ID ?>" ><?php if($page->post_parent !=0){ ?> - <?php } ?><?php echo $page->post_title; ?></option>
								<?php 
								}
							}
						?>
					</select><br />
					<span class="description">--</span>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th> 
				<td>
				<?php if(isset($_GET['wpd_action']) && $_GET['wpd_action']=='edit'){ ?>
					<input type="hidden" name="alid" value="<?php echo $alid ?>" />
					<input type="submit" name="save_access_level" class="button button-primary" />
				<?php }else{ ?>
					<input type="submit" name="add_new_level" class="button button-primary" />
				<?php }?>
					
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th> 
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><!--<input type="submit" name="wpd_import" class="button button-primary" value="Import Codes" />--></th> 
				<td>
						<input type="submit" name="wpd_remove_duplicates" class="button button-primary" value="Remove Duplicate Codes"/>
				</td>
			</tr>
=
	</table>

	</form>
	</div>
	<?php
}

function wpd_export_codes_csv(){
	global $wpdb;
	$export = false;
	
	if(isset($_POST['wpd_export_all'])){
		$export = true;
		$sql = "SELECT post_title FROM ".$wpdb->prefix . "posts WHERE `post_type` = 'inv_code' AND `post_status` = 'publish'; ";
	}	
	
	if(isset($_POST['wpd_export_prefix'])){
		$export = true;
		$title = $_POST['wpd_eport_prefix'];
		$sql = "SELECT post_title FROM ".$wpdb->prefix . "posts WHERE `post_type` = 'inv_code' AND `post_status` = 'publish' AND `post_title` LIKE '".$title."%'; ";
	}
	
	if($export){
		$results = $wpdb->get_results($sql);
		// output headers so that the file is downloaded rather than displayed


		// create a file pointer connected to the output stream	
	
	$filename = "SaviTradingCodes-".date("Ymdhi").".csv";
	$link = ABSPATH.'wp-content/uploads/codes/'.$filename;
    $output ='';
		foreach($results as $result){
			if($result->post_title != '')$output .=$result->post_title." \n";
		}
	file_put_contents($link , $output);
	echo 'Here You can Download Your Codes <br>';
	echo '<a href="http://www.savitrading.com/wp-content/uploads/codes/'.$filename.'"> Download </a>'; 
    exit();
	}
	
	
	
	?>
	<style>
#export_actions{}
#export_actions tr{border-bottom:1px solid #ccc;}
#export_actions th{}
#export_actions td{}
</style>
<div class="wrap">
	<?php echo 'Working....';return;echo $messageGo ?>
		<div id="icon-edit" class="icon32"><br></div>		
		<h2>CSV Export</h2>
			<p></p>
<form id="wpd_exprot" action="?post_type=inv_code&page=wpd_codes_export" method="POST">
		<table class="form-table">
			<tr>
				<th><label for="wpd_access_name">Export all codes</label><br />
					<span class="description">Export all codes from the database.</span></th>
				<td width="100">
					&nbsp;
				</td>
				<td>
					<input type="submit" name="wpd_export_all" class="button button-primary" value="Export All Codes"/><br />
					<span class="description">&nbsp;</span>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td width="100">
					&nbsp;
				</td>
				<td>
					&nbsp;
				</td>
			</tr>
			<tr>
				<th><label for="wpd_eport_prefix">Export codes starting with</label><br />
					<span class="description"></span></th>
				<td width="100">
					<input name="wpd_eport_prefix" id="wpd_eport_prefix" value="" /><br />
					<span class="description">Prefix</span>
				</td>
				<td>
					<input type="submit" name="wpd_export_prefix" class="button button-primary" value="Export Codes"/><br />
					<span class="description">&nbsp;</span>
				</td>
			</tr>
			

</table>
</div>
Backups : <br>
<?php
$link = ABSPATH.'wp-content/uploads/codes/';

$index= 0;
$files = glob(ABSPATH.'wp-content/uploads/codes/'."*");
$now   = time();

  foreach ($files as $file){
	if (is_file($file)){
      if ($now - filemtime($file) >= 60 * 60 * 24 * 30 ) {
	  unlink($file); }
	}
  }
  $files = scandir($link);
foreach($files as $value){
	if($index > 1)
	{
		echo '<a href="http://www.savitrading.com/wp-content/uploads/codes/'.$value.'">'.$value.'</a><br>';
	}
	$index++;
}
?>
	<?php
}


function update_restricte_areas(){
	global $wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level";
	$results = $wpdb->get_results($sql);
	$areas = array();
	foreach($results as $rr){
		$arr = explode('|',$rr->areas);
		foreach($arr as $ar){
			array_push($areas, $ar);
		}
	}
	
	$areas = array_unique($areas);
	sort($areas);
	update_option( 'wpd_restricted_areas', $areas );
	
}

function wpd_get_packages($package_id=''){
	global $wpdb;
	

		$args = array( 'post_type' => 'package', 'posts_per_page' => -1, 'post_status' => 'publish' );

		$myposts = get_posts( $args );
	?>
		<select name="wpd_package">
		<?php

		foreach ( $myposts as $ppost ) : 
			 ?>
			<option value="<?php echo $ppost->ID; ?>"><?php echo $ppost->post_title; ?></option>
				
		<?php endforeach; 
		wp_reset_postdata();?>

		</select>
	<?php
	
}

function wpd_get_access_levels($cacc=''){
	global $wpdb;
	
	if(current_user_can('moderate_comments')){
		$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level";
		$results = $wpdb->get_results($sql);
		?>
		<select name="wpd_access_area" style="width: 200px;">
		<?php foreach($results as $rr){ 
			if($rr->expires == 0 ) $rr->expires = 'Lifetime';
		?>
			<option value="<?php echo $rr->id ?>" <?php if($cacc==$rr->id){ echo 'selected="selected" ';} ?>><?php echo $rr->name .' - for '.$rr->expires ?></option>
		<?php } ?>
		</select>
		<?php
	}else{ 
		$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level";
		$results = $wpdb->get_results($sql);
		?>
			
		<input type="text" name="wpd_access_area" id="wpd_access_area" value="<?php echo $results[0]->name .' - for '.$results[0]->expires ?>" class="regular-text"  disabled />
		
	<?php }
	
}

function wpd_get_access_levels_paypal($pid){
	global $wpdb;
	
	 $c_user = wp_get_current_user();
	 
	
	$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level where `paypal`='yes'";
	$results = $wpdb->get_results($sql); ?>
	<h1>Pay with PayPal</h1>
	<form id="subscriptions" method="POST" action="">
	<?php foreach($results as $rr){ 
		$res = explode('|',$rr->areas);
		if(in_array($pid,$res)){
			if($rr->expires==0){
				$rr->expires =  'Lifetime';
			}
				echo '<label><input type="radio" name="savi_subscription" value="'.$rr->id.'" det-name="'.$rr->name.'" det-price="'.$rr->price.'" det-currency="'.$rr->currency.'" det-expires="'.$rr->expires.'">'.$rr->name.' - '.$rr->price.' '.$rr->currency.' (' . $rr->expires;
				if($rr->expires !=  'Lifetime'){
					echo ' recurring';
				}
				echo  ')</label><br/>';
		
		}
		
	} ?>
	<input type="image" id="subbs" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
	</form>
	<script>
		$(document).ready(function(){
			$('#subscriptions').submit(function(){
				var s_sub = $('#subscriptions').find('input[name="savi_subscription"]:checked');
				var s_name = s_sub.attr('det-name');
				var s_price = s_sub.attr('det-price');
				var s_crc = s_sub.attr('det-currency');
				var s_exp = s_sub.attr('det-expires');
				var s_acl = s_sub.val();
				var r_url = '<?php echo get_page_link($pid) ?>?paypal=1&acc='+s_acl;
				/*
				ff.attr('target','contactss');
				$('#paypallf').find('input[name="email"]').val($('form.wpcf7-form').find('input[name="email-add"]').val());
				$('#paypallf').find('input[name="first_name"]').val($('form.wpcf7-form').find('input[name="first-name"]').val());
				$('#paypallf').find('input[name="last_name"]').val($('form.wpcf7-form').find('input[name="last-name"]').val());
				$('#paypallf').find('input[name="H_PhoneNumber"]').val($('form.wpcf7-form').find('input[name="phone"]').val());
				$('#paypallf').find('input[name="address1"]').val($('form.wpcf7-form').find('input[name="address"]').val());
				$('#paypallf').find('input[name="address2"]').val($('form.wpcf7-form').find('input[name="address2"]').val());
				$('#paypallf').find('input[name="city"]').val($('form.wpcf7-form').find('input[name="address3"]').val());
				$('#paypallf').find('input[name="zip"]').val($('form.wpcf7-form').find('input[name="address4"]').val());
				$('#paypallf').find('input[name="quantity"]').val($('form.wpcf7-form').find('input[name="product_quantity"]').val());
				*/
				//ff.submit();
				if(s_exp!='Lifetime'){
					var ex = s_exp.split(' '); 
					var per = ex[1].substring(0,1).toUpperCase();
					$('#paypallf .stand').remove();
					var ncode = '<input type="hidden" name="a3" value="'+s_price+'"><input type="hidden" name="p3" value="'+ex[0]+'"><input type="hidden" name="t3" value="'+per+'"><input type="hidden" name="src" value="1"><input type="hidden" name="sra" value="1"><input type="hidden" name="cmd" value="_xclick-subscriptions">';
					$('#paypallf').append(ncode);
				}else{
					
					$('#total_price').val(s_price);
					$('#currency').val(s_crc);
		
				}
				$('#access_l').val(s_name+' for '+s_exp);
				$('#return_url').val(r_url);
				$('#subb').trigger('click');		
				return false;	
			});
		});
	</script>
	<div id="paypall-form" style="display:none;">
		<!--<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="paypallf">-->
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="paypallf">
			<input type="hidden" name="cmd" value="_xclick" class="stand">
			<input type="hidden" name="business" value="pawel@wordpressdevelopers.co.uk">
			<input type="hidden" name="item_name" value="" id="access_l" >
			<!--<input type="hidden" name="item_number" value="MEM32507725">-->
			<input type="hidden" name="amount" value="" id="total_price" class="stand">
			<input type="hidden" name="tax" value="0" class="stand">
			<input type="hidden" name="quantity" value="1" class="stand">
			<input type="hidden" name="no_note" value="0" class="stand">
			<input type="hidden" name="no_shipping" value="1" >
			<input type="hidden" name="currency_code" value="" id="currency">
			<input type="hidden" name="return" value="" id="return_url">
			<input type="hidden" name="email" value="<?php echo $c_user->user_email ?>">
			<!-- Enable override of buyers's address stored with PayPal . -->
			<input type="hidden" name="address_override" value="1">
			<!-- Set variables that override the address stored with PayPal. -->
			<input type="hidden" name="first_name" value="<?php echo $c_user->user_firstname ?>">
			<input type="hidden" name="last_name" value="<?php echo $c_user->user_lastname ?>">
<!--			<input type="hidden" name="address1" value="">
			<input type="hidden" name="address2" value="">
			<input type="hidden" name="city" value="">
			<input type="hidden" name="zip" value="">
			<input type="hidden" name="H_PhoneNumber" value=""> -->
			<!--<input type="hidden" name="state" value="CA">
			<input type="hidden" name="country" value="">-->
			<input type="image" id="subb" name="submit" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
		</form>
	</div>
<?php }

function wpd_csv_export(){ ?>
<input type="checkbox" name="wpd_csv_export" value="1"  />
<?php }

function get_access_name($id){
	global $wpdb;
	
	$sql = "SELECT name FROM ".$wpdb->prefix . "wpd_access_level WHERE id='".$id."'";
	$results = $wpdb->get_results($sql);
	return $results[0]->name;
}

function get_package_name($id){
	global $wpdb;
	
	$package = get_post($id);
	if(!empty($package))
		return $package->post_title;
	else
		return '';
}


function wpd_invitation_code( $code, $count=1, $access )
{
	global $baweic_options;
	$count = (int)$count>0 ? $count : 1;
	if( isset( $baweic_options['codes'][$code] ) || trim( $code )=='' ):
		return false;
	else:
		$baweic_options['codes'][$code] = array( 
			'maxcount'=>$count, 
			'leftcount'=>$count, 
			'users'=>'',
			'access' => $access
		);
		update_option( 'baweic_options', $baweic_options );
		return true;
	endif;
}


 function wpd_update_acces_level() {
	$user_ID = get_current_user_id();
	$user_acces_level = get_user_meta( $user_ID,'wpd_access_level', true );
	$user_acces_code = get_user_meta( $user_ID,'wpd_invitation_code', true );
	$page = get_page_by_title( $user_acces_code,'OBJECT','inv_code' );
	$post_id = $page->ID;
	$wpd_access_level_post = get_post_meta( $post_id , 'access', true);
	if(empty($user_acces_level))
	{
	global $baweic_options,$wpdb;
	$sql = "SELECT * FROM ".$wpdb->prefix . "wpd_access_level WHERE id=".$code_level_1;
	$results = $wpdb->get_results($sql);
	$expire = $results[0]->expires;
	if($expire ==0 ){
		$date = new DateTime('2114-01-01');
		$exp = $date->format('Y-m-d H:i:s');
	}elseif($expire !=0 && !empty($expire)){
		$expire = '+'.$expire;	
		$date = new DateTime();
		$exp = $date->modify($expire)->format('Y-m-d H:i:s');
	}else{
		$expire = '+90 days';
		$date = new DateTime();
		$exp = $date->modify($expire)->format('Y-m-d H:i:s');
	}
	$user_id = get_current_user_id();
	update_usermeta($user_id, 'wpd_access_level', $wpd_access_level_post);
	update_usermeta($user_id, 'wpd_access_expires', $exp);
	}
	}
 
?>