<?php
                                //session_start();
 								//$_SESSION['download'] = $row['attachement'];
								if (isset($_GET['att']))
								{
								$file = $_GET['att']	; 
								echo $file;
										
								if (file_exists($file)) 
											{
											header('Content-Description: File Transfer');
											//header('Content-Type: application/octet-stream');
											header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
											header('Content-Disposition: attachment; filename="'.basename($file).'"');
											header('Expires: 0');
											header('Cache-Control: must-revalidate');
											header('Content-Transfer-Encoding: binary');
											header('Pragma: public');
											header('Content-Length: ' . filesize($file));
											readfile($file);
											exit; 
											
											
											//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			/*header('Content-Disposition: attachment;filename="'.$filename.'.xlsx'.'"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0
		
		   #header('Content-Type: application/vnd.ms-excel'); 
		   #header('Cache-Control: max-age=0'); 
		
		   $objWriter->save('php://output'); 
		   exit();*/
											
											
											}
										echo "success";
								}//header ("Location: my_article.php");	
								
								if (isset($_GET['rev_att']))
								{
								$file = $_GET['rev_att']	; 
								echo $file;
										
								if (file_exists($file)) 
											{
											header('Content-Description: File Transfer');
											header('Content-Type: application/msword');
											header('Content-Disposition: attachment; filename="'.basename($file).'"');
											header('Expires: 0');
											header('Cache-Control: must-revalidate');
											header('Pragma: public');
											header('Content-Length: ' . filesize($file));
											readfile($file);
											exit; 
											}
										echo "success";
								}//header ("Location: my_article.php");	



?>