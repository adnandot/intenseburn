<?php

# http://phpexcel.codeplex.com/
require_once dirname(__FILE__) . '/PHPExcel/Classes/PHPExcel.php';


  /* //add_submenu_page( 'users.php', 'Export User Data','Export User Data','administrator', 'export_excel_user_data', 'export_excel_user_data' ); */
  add_action( 'admin_menu', function()
{
    add_submenu_page(  
        'users.php',                  
        'Export User Data',          
        'Export User Data',                  
        'administrator',            
        'export_excel',    
       'export_excel'
    );
   
}); 

function export_excel(){ ?>
<div class="wrap">
		<div id="icon-tools" class="icon32"></div>
		<h2>Export User Data</h2>
		<div style="min-width: 1200px;" id="ure_container">
		<div class="has-sidebar">
             <div id="ure_form_controls">
			 <div class="has-sidebar-content">
  			<div style="float: left; min-width:850px;" class="postbox">
				<a  style = 'float: left; padding: 10px; margin: 10px;' class="page-title-action" href="users.php?page=export_excel&getexcel=1">Export Excel</a>
			</div>
			</div>
			</div>
		</div>
	</div>
<?php 
	 

}

//export
if(isset($_GET['getexcel']) && $_GET['getexcel']==1){
		ob_start();
		 $args = array(
	'role'         => 'subscriber',
	'orderby'      => 'id',
	'order'        => 'ASC',
 );	
 //$allusers = get_users($args);
	$wp_user_query = new WP_User_Query($args);
	$allusers = $wp_user_query->get_results();
		
		/* echo '<pre>';
		print_r($allusers); */
		$objPHPExcel = new PHPExcel(); 
	    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
									 ->setLastModifiedBy("Maarten Balliauw")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");
									 
		// Initialise the Excel row number
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'User ID');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', 'User Login');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C1', 'User Email');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D1', 'Display Name');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E1', 'First Name');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F1', 'Last Name');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G1', 'DOB');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H1', 'Sex');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I1', 'Phone');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J1', 'Dite');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Street 1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Street 2');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'City');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'State');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'Country');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'Postcode');
		/* $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K1', 'Goal');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L1', 'Street 1');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M1', 'Street 2');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N1', 'City');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O1', 'State');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P1', 'Country');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q1', 'Postcode'); */
		$rowCount = 1; 
		
		 foreach($allusers as $userdata)
		 {
				$rowCount ++;
				 $first_name  = get_user_meta($userdata->ID,'first_name', true);
				 $last_name   = get_user_meta($userdata->ID,'last_name', true);
				 $dob         = get_user_meta($userdata->ID,'dob', true);
				 $sex 		  = get_user_meta($userdata->ID,'sex', true);
				 $phone  	  = get_user_meta($userdata->ID,'phone', true);
				 $dite        = get_user_meta($userdata->ID,'diet', true);
				//$goalid  	  = get_user_meta($userdata->ID,'goal', true);
				 $street1  	  = get_user_meta($userdata->ID,'street_1', true);
				 $street2     = get_user_meta($userdata->ID,'street_2', true);
				 $city        = get_user_meta($userdata->ID,'city', true);
				 $state       = get_user_meta($userdata->ID,'state', true);
				 $country     = get_user_meta($userdata->ID,'country', true);
				 $postcode    = get_user_meta($userdata->ID,'postcode', true);
					
								
					/* $getterm =  get_term_by('term_taxonomy_id', $goalid ,'goal');
					
					print_r($getterm); */
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A'.$rowCount, $userdata->ID);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B'.$rowCount,$userdata->user_login );
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$rowCount, $userdata->user_email );
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$rowCount, $userdata->display_name );
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$rowCount,  $first_name);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$rowCount, $last_name );
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$rowCount, $dob);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$rowCount, $sex);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$rowCount, $phone);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J'.$rowCount, $dite);
				/* $objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$rowCount, $goalid);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$rowCount, $street1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$rowCount, $street2);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$rowCount, $city);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$rowCount, $state);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$rowCount, $country);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('Q'.$rowCount, $postcode );  */
				 
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('K'.$rowCount, $street1);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('L'.$rowCount, $street2);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('M'.$rowCount, $city);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('N'.$rowCount, $state);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('O'.$rowCount, $country);
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue('P'.$rowCount, $postcode );
		}
		/* die; */
		// Sheet cells
		$objPHPExcel->getActiveSheet()->setTitle('User_data');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="User_data.xls"');
		header('Cache-Control: max-age=0'); 
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit(); 
	 } 
?>