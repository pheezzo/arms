<?php 
include('sys/confirm _login.php');
include('sys/functions.php');
//include('include/connect.php'); 
require_once('include/header.php');
$username = $_SESSION['username'];
$FileName = "";
if (isset($_POST['create_event']))
{
	$file_tempname = $_FILES['file']['name'];
	if (!empty($file_tempname))
	 {
		 $file_tempname = $_FILES['file']['name'];
		 //$file_tempname = "pheezzo.docx";
			
			//echo $FileName;
			$extss = substr($file_tempname,0,-5);
			//echo "<br/>";
 			//echo $extss;
 				//echo "<br/>";
				$ext = substr($file_tempname, strrpos($file_tempname, '.') + 1);
                
				//echo "<br/>";
 				//echo $ext;
				// echo "<br/>";
				 $allow_ext = array( 'doc', 'docx',); 
 				if(!in_array($ext,$allow_ext))
 					 { 
					 echo " Errorr file type is not acceptable";
					 }
 
					 else
					 {   
					    $ran = rand ();
					    $FileDir ="upload/";
						 $FileName = "".$FileDir . $username."_".$ran.".".$ext."";
						 //echo $FileName;
						 rename($file_tempname, $FileName);
						if(move_uploaded_file($_FILES['file']['tmp_name'],$FileName)) ;
						echo 'File Uploaded. Thank You.';
 					  }
}

 

	
	
	
$error_found = FALSE;  
           //validator		
			$Form->ValidField($event_code,'empty',"*  Please supply the event code");
			$Form->ValidField($event_name,'empty',"*  Please supply the event name");
			$Form->ValidField($event_type,'empty',"*  Please select the type of event");
			$Form->ValidField($event_start,'empty',"*  Please supply the date event will start");
			$Form->ValidField($event_end,'empty',"*  Please supply the date event will end");
			$Form->ValidField($article_submission_status,'empty',"*  Please select if article submission is allow");
			$Form->ValidField($article_start,'empty',"*  Please supply the date article submission will start");
			$Form->ValidField($article_end,'empty',"*  Please supply the date article submission will end");
			$Form->ValidField($event_description,'empty',"*  Please supply event description");
				
			//$Form->ValidField($article_body);
			if (!$Form->retval) {
				$error_found = TRUE;
				$message = $Form->ErrorString;
			}
			  if (!$error_found) 
			    {  
				 // echo $article_title;
				 // echo "<br/>";
				 // echo $article_body;
				 $message = "good";
				 
				 $now = date("Y-m-d");
				// $now = "ok";
				 $query = "INSERT INTO event (event_code, event_name, event_webpage, event_type, event_start, event_end, allow_article_submission, article_start, article_end, event_description, date_created, last_edited) 
				 VALUES (\"".$event_code."\", \"".$event_name."\", \"".$event_webpage."\", \"".$event_type."\", \"".$event_start."\", \"".$event_end."\", \"".$article_submission_status."\", \"".$article_start."\", \"".$article_end."\", \"".$event_description."\", \"".$now."\", '$now')";
				  //
				   //VALUES ('1', '2', '2', '2','2')
				  $result = mysqli_query($connection, $query);
				  if ($result)
				     {
												 $message = "<span style=' color: green;'>Event created successfully</span>"; 
					 }
					 else {
						     $message = "<span style=' color: red;'>Event creation Failed!</span>". mysqli_error($connection); 
   							// $message = "Error: " . $sql . "<br>" . mysqli_error($connection);
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
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
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

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Create Event</h1>
             </div>
           <?php if (!empty($message)) echo $message; ?>
          <!-- Content Row -->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
          <div class="form-group">
           <input type="text" name="event_code"   placeholder="Enter Event Short Name or Code..." size="100">
           </div>
           <div class="form-group">
           <input type="text" name="event_name"   placeholder="Enter Event Name..." size="100">
           </div>
           <div class="form-group">
           <input type="text" name="event_webpage"   placeholder="Enter Event webpage here..." size="100">
           </div>
           <div class="form-group">
           Select Event Type: <select name="event_type">
            <option></option>
            <option>Conference</option>
            <option>Journal</option>
            <option>Workshop</option>
            <option>Project</option>
           </select>
           </div>
           
          <div class="form-group">
                  
           Date of Event:  From <input type="date" name="event_start" placeholder=" Event start on"/> To <input type="date" name="event_end" placeholder=" Event start on"/></div>
           
           <div class="form-group">
           Allow Article Submission: <select name="article_submission_status">
            <option></option>
            <option>Yes</option>
            <option>No</option>
           </select>
           </div>
           
           <div class="form-group">
                  
           Article Submission Start:  From <input type="date" name="article_start" placeholder=" Event start on"/> To <input type="date" name="article_end" placeholder=" Event start on"/></div>
           
           <div class="form-group">
           <textarea placeholder="Event Description Here..." name="event_description" rows="15" cols="100"></textarea>
           </div>
           
           <div class="form-group">
           <input type="submit" name="create_event" placeholder="Create Event">
           </div>
          </form>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php require_once('include/footer.php'); ?>
      