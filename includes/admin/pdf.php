<?php

if(isset($_GET['hg_view_name'])) {		
	
	if(isset($_GET) && !empty($_GET)){
		
		$hg_view_id = absint( $_GET['videogallery_id'] );
		$hg_video_id = absint( $_GET['hg_video_id'] );
		
		if($hg_view_id >= 0 && $hg_video_id >= 0) {
			
			if(is_numeric($hg_view_id) && is_numeric($hg_video_id) && is_numeric($_GET['hg_view_count'])) {
				require_once('../wp-load.php');
				
				global $wpdb;
				
				$sql_results_params_ip = "SELECT ip, date FROM ".$wpdb->prefix."huge_it_videogallery_params_ip WHERE video_id='".$hg_video_id."'";
				$get_results_params_ip = $wpdb->get_results($sql_results_params_ip);	
				
				$sql_huge_it_insert_get_results_galleries = "SELECT * FROM ".$wpdb->prefix."huge_it_videogallery_galleries WHERE id='".$hg_view_id."'";
				$get_results_galleries = $wpdb->get_results($sql_huge_it_insert_get_results_galleries);
						
				$data_ = array();

				foreach($get_results_params_ip as $get_results_params) {
					array_push($data_, $get_results_params->ip, $get_results_params->date);
				}

                foreach($get_results_galleries as $galleries_name) {

                }

				require('fpdf.php');

				class PDF extends FPDF
				{
					function Header(){
						
					}
					
					function Footer(){
						$this->SetY(-15);
						$this->SetFont('Arial','b',8);
						$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
					}
					
					function BasicTable($header, $data){
						
						foreach($header as $col){
							$this->Cell(97,7,$col,1);
						}
						$this->Ln();
						
						$i=1;
						foreach($data as $row){
							$this->Cell(97,6,$row,1);
							
							if($i==2){
								$this->Ln();
								$i=1;
							}else{
								$i++;
							}
						}
					}
				}
				$pdf = new PDF('P','mm','Letter');
				$header = array('User IP', 'Date/Time');
				$data = $data_;
				$pdf->AddPage();
				$pdf->SetFont('Arial','b',16);
				$pdf->Cell(0,0,'Gallery Name: '.$galleries_name->name,0,0,'C');
				$pdf->ln(1.5);
				$pdf->Cell(0,15,'Video Name: '.$_GET['hg_view_name'],0,0,'C');
				$pdf->ln(1.5);
				$pdf->Cell(0,30,'Total Views: '.$_GET['hg_view_count'],0,0,'C');
				$pdf->Ln();
				$pdf->SetFont('Arial','b',14);
				$pdf->BasicTable($header,$data);
				$pdf->Output("PDF.pdf", "D");	
				//ob_end_clean();
			}
			else {
				die;
			}
		}	
		else {
			die;
		}		
	}	
	else {
		die;
	}
}

	
													
 ?>