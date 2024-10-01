<?php 
include('sys/confirm _login.php');
include('sys/functions.php');
//include('include/connect.php'); 
require_once('include/header.php');
$username = $_SESSION['username'];
$FileName = "";


###################################
##############################

if(isset($_POST['assign_editor']))
						{
										$error_found = FALSE;  
					   //validator		
						$Form->ValidField($article_id,'empty',"*  Please supply your Username");	
						$Form->ValidField($editor,'empty',"*  Please Select Editor");
						if (!$Form->retval) {
							$error_found = TRUE;
							$messages = $Form->ErrorString;
											}
						  
						  
						  if (!$error_found) 
							{  
							
							  $article_id = clean_input(trim($article_id));
							  $editor = clean_input(trim($editor));
							 
							  //$en_password = sha1($password.$username);
								if(!$error_found)
										{
											
											
											$query = "INSERT INTO paper_review (paper_id, edithor_id, result, comment, review_status) 
				 					VALUES (\"".$article_id."\", \"".$editor."\", '', '','0')";
				  //
				   //VALUES ('1', '2', '2', '2','2')
				  $result = mysqli_query($connection, $query);
				  if ($result)
				     {                         $user_type = "edithor";
												 $querry2 = mysqli_query($connection, " UPDATE user SET usertype = \"".$user_type."\" WHERE username =\"".$editor."\" ");
												 if ($querry2)
												 {
												 $messages = "Article Suceefully assigned to " . $editor; 
												 }
												  else {
   													$messages = "Error: " . $querry2 . "<br>" . mysqli_error($connection);
													}
					 }
					 else {
   							 $messages = "Error: " . $query . "<br>" . mysqli_error($connection);
									}
										}
							}
							
						}


#################################
################################



	$sn = 0;
	$sql = mysqli_query($connection, "
		SELECT *
		FROM paper 
		ORDER BY submission_date
		");
		
		/* 
		WHERE paper_id NOT IN (SELECT paper_id FROM paper_review)
		
		"SELECT DISTINCT course_code, rstatus
		FROM student_result					
		WHERE matric_number = '".$matric_number."' 
		".$where_semester." 
		AND rscore < \"".$sem_min_pass_score."\"
		AND course_code NOT IN 
			(SELECT course_code FROM student_registration_holder 
			 WHERE matric_number = '".$matric_number."')					
		AND course_code NOT IN 
			(SELECT course_code FROM student_result as sr1
			 WHERE sr1.matric_number = '".$matric_number."'
			 AND sr1.rscore >= \"".$sem_min_pass_score."\")				
		";*/
		
		
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			$message = "<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'> 
			<thead><tr><th>SN</th><th>Paper Title</th> <th>Abstract</th> <th>Author</th> <th>Action</th></tr></thead>
			<tbody>";
			
    // output data of each row
    while($row = mysqli_fetch_assoc($sql)) {
		
		         
			
                      $paper_id = $row['paper_id'];
					 
					 
					  $author_name = "";
					 $author_query = mysqli_query($connection,"SELECT * FROM author 
					  WHERE paper_id =\"".$paper_id ."\" "); 
					  if (mysqli_num_rows($author_query) > 0) {
    					while($rows = mysqli_fetch_assoc($author_query)) {
							$author_name .= "".$rows['author_name']."<br/>";
						}
					  }
				 
				       $sn++;
				 #############################################
				 ################################
				 
				 $sqls = mysqli_query($connection, "SELECT* FROM user 
										WHERE active = '1' AND 
										username NOT IN (SELECT edithor_id FROM paper_review WHERE paper_id = '\"".$article_id."\"' )") ;
										
										while($frow = mysqli_fetch_assoc($sqls)) {
																				 						
																					$option .= "<option ".$selected." value=\"".$frow['username']."\">".$frow['name']."</option>";					
																										
																				} 
				 
				 #########################################
				 ########################################
		               $body = "";
						$body2 = "";
						//$abstract = $row['abstract'];
		              if(!empty($row['abstract']))
					     $abstract = " <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong".$sn."'>
  									View Abstract
									</button>


								<div class='modal fade' id='exampleModalLong".$sn."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
								  <div class='modal-dialog' role='document'>
									<div class='modal-content'>
									  <div class='modal-header'>
										<h5 class='modal-title' id='exampleModalLongTitle'>".$row['title']."</h5>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
										  <span aria-hidden='true'>&times;</span>
										</button>
									  </div>
									  <div class='modal-body'>
									   ".$row['abstract']."
									  </div>
									  <div class='modal-footer'>
										<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
										<button type='button' class='btn btn-primary'>Save changes</button>
									  </div>
									</div>
								  </div>
								</div>";
								
								
							 $assign_edithor = " <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLang".$sn."'>
  									Assign Edithor view
									</button>


								<div class='modal fade' id='exampleModalLang".$sn."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
								  <div class='modal-dialog' role='document'>
									<div class='modal-content'>
									  <div class='modal-header'>
										<h5 class='modal-title' id='exampleModalLongTitle'>".$row['title']."</h5>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
										  <span aria-hidden='true'>&times;</span>
										</button>
									  </div>
									  <div class='modal-body'>
									   
									  
									   
									   <div class='form-group'>
           <input type='hidden' name='article_id' value ='".$article_id."' >
           <input type='text' name='article_title'   placeholder='".$row['title'].">' value='".$row['title']."'  size='100'>
           </div>
           <div class='form-group'>
               <input type='hidden' name='article_id".$row['paper_id']."' id='".$row['paper_id']."' value='".$row['paper_id']."'>
											  
                                           <select  id='editor' name='editor'>
										<option value=''>--- Select Course Lecturer ---</option>
										".$option."
										</select>							
              </div>
									   					   
									 
									   
		
									  </div>
									  <div class='modal-footer'>
										<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
										<input type='submit' name='assign_editor' placeholder='Assign Editor'  value='Assign Editor'>
									  </div>
									</div>
								  </div>
								</div>";
					    //$body = "<a href='download2.php'><span>View</span></a>";
						if(!empty($row['attachement']))
						/*$body2 =" <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLond".$sn."'>
  									Download
									</button> 
		                          
								 <div class='modal fade' id='exampleModalLong".$sn."' tabindex='-1' role='dialog' aria-labelledby='exampleModalLongTitle' aria-hidden='true'>
								  <div class='modal-dialog' role='document'>
									<div class='modal-content'>
									  <div class='modal-header'>
										<h5 class='modal-title' id='exampleModalLongTitle'>".$row['title']."</h5>
										<button type='button' class='close' data-dismiss='modal' aria-label='Close'>
								 		 ".$file = $row['attachement']."";*/
										 
										$body2 = "<a href='download.php?att=".$row['attachement']."'><span>Download</span></a>";
										 
										
								/*$body2 .=	"". 
											//if (file_exists($file)) {
											header('Content-Description: File Transfer');
											header('Content-Type: application/octet-stream');
											header('Content-Disposition: attachment; filename="'.basename($file).'"');
											header('Expires: 0');
											header('Cache-Control: must-revalidate');
											header('Pragma: public');
											header('Content-Length: ' . filesize($file));
											readfile($file);
											exit 
											//}
											
											
											."";*/
							/*$assign_form = "<form method = 'POST'  '>
							                  <input type='hidden' name='article_id<?=$article_id?>' id='<?=$article_id?>' value='<?=$article_id?>'>
											  <select style='width: 100%;' id='editor' name='editor'>
										<option value=''>--- Select Course Lecturer ---</option>'";
										$sqls = mysqli_query($connection, "SELECT* FROM user WHERE user_type = 'Editor' AND active = '1'");
										
										while($frow = mysqli_fetch_assoc($sqls)) {
																				 						
																					$assign_form .=  "<option ".$selected." value=\"".$frow['username']."\">".$frow['name']."</option>";					
																										
																				}
										$assign_form .= "<input type='submit' name='assign_editor' placeholder='Assign Editor' class='btn btn-primary btn-user btn-block' value='Assign Editor'>					</form>";	*/
										$assign_form = "<a href='assign_editor.php?paper=".$row['paper_id']."'><span>Assign Editor</span></a>";	
											
														 
                    	$message .= "<tr><td>".$sn."</td><td>".$row['title']."</td><td>".$abstract."</td><td>".$author_name."</td><td>".$assign_form." 
						";  ?> 
						
						
						<?php $message .= "</td></tr>";
									}
						$message .= "<tbody></table>";
					}
				    else
					$message = "<strong> No article available</strong>";
					else {
   							 echo "Error: " . $sql . "<br>" . mysqli_error($connection);
									}
									
						
						
					 if(isset($_POST['assign_editor']))
						{
										$error_found = FALSE;  
					   //validator		
						$Form->ValidField($article_id,'empty',"*  Please supply your Username");	
						$Form->ValidField($editor,'empty',"*  Please Select Editor");
						if (!$Form->retval) {
							$error_found = TRUE;
							$messages = $Form->ErrorString;
											}
						  
						  
						  if (!$error_found) 
							{  
							
							  $article_id = clean_input(trim($article_id));
							  $editor = clean_input(trim($editor));
							 
							  //$en_password = sha1($password.$username);
								if(!$error_found)
										{
											echo $editor;
											echo "<br/>";
											echo  $article_id;
											$query = "INSERT INTO review_article (article_id, comment, review_status, reviewed_by, reviewed_article) 
				 VALUES (\"".$article_id."\", '', 0, \"".$editor."\",'')";
				  //
				   //VALUES ('1', '2', '2', '2','2')
				  $result = mysqli_query($connection, $query);
				  if ($result)
				     {
												 $querry2 = mysqli_query($connection, " UPDATE article SET editor = \"".$editor."\" WHERE article_id =\"".$article_id."\" ");
												 if ($querry2)
												 {
												 $messages = "New record created successfully. Last inserted ID is: " . $last_id; 
												 }
												  else {
   													$messages = "Error: " . $sql . "<br>" . mysqli_error($connection);
													}
					 }
					 else {
   							 $messages = "Error: " . $sql . "<br>" . mysqli_error($connection);
									}
										}
							}
							
						}
 ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">


      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Valerie Luna</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

        
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Assign Editor</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
          <!-- Content Row -->
          <?php if(!empty($messages)) echo $messages;
		  
		  if(!empty($message)) echo $message; ?>
         
            </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
     </div>
<?php require_once('include/footer.php'); ?>
      