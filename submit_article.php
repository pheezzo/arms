<?php 
include('sys/confirm _login.php');
include('sys/functions.php');
//include('include/connect.php'); 
require_once('include/header.php');
$event_code = $_GET["event"];
$username = $_SESSION['username'];
$FileName = "";
if (isset($_POST['submit_article']))
{
	
 

	
	
	
$error_found = FALSE;  
           //validator		
			$Form->ValidField($paper_title,'empty',"*  Please supply your paper title");
			$Form->ValidField($key_word,'empty',"*  Please supply your keyword");
			$Form->ValidField($abstract,'empty',"*  Please supply your abstract");
			$Form->ValidField($submit_article,'empty',"*  Please choose pdf file to upload");			
			//$Form->ValidField($article_body);
			if (!$Form->retval) {
				$error_found = TRUE;
				$message = $Form->ErrorString;
			}
			  if (!$error_found) 
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
				 $allow_ext = array( 'pdf'); 
 				if(!in_array($ext,$allow_ext))
 					 { 
					 $message = " Errorr file type is not acceptable";
					 }
 
					 else
					 {   
					    $ran = rand ();
					    $FileDir ="upload/";
						 $FileName = "".$FileDir .$event_code."submission".$paper_id.$username."_".$ran.".".$ext."";
						 //echo $FileName;
						 rename($file_tempname, $FileName);
						if(move_uploaded_file($_FILES['file']['tmp_name'],$FileName)) ;
						 {
							 ####################################################### Process Form ##################################
							 
							  // echo $article_title;
				 // echo "<br/>";
				 // echo $article_body;
				 $paper_title = clean_input(trim($paper_title));
				  $key_word = clean_input(trim($key_word));
				  $abstract = clean_input(trim($abstract));
				  
				 $now = date("Y-m-d h:i:s");
				// $now = "ok";
				
				  $query = "INSERT INTO paper (event_id, event_code, title, abstract, keyword, document, submission_date, updated_date, submitted_by) 
				 VALUES (\"".$_POST['event_id']."\", \"".$_POST['event_code']."\", \"".$paper_title."\", \"".$abstract."\",\"".$key_word."\",\"".$FileName."\", \"".$now."\", \"".$now."\",\"".$username."\")";
				  //
				   //VALUES ('1', '2', '2', '2','2')
				 
				 $result = mysqli_query($connection, $query);
				  if ($result)
				     {
												 //$message = "New record created successfully. Last inserted ID is: " . $last_id;
												 $last_id = mysqli_insert_id($connection); 
												 $paper_id = $last_id;								 
						 $query1 = "INSERT INTO author (paper_id, author_name, author_email, author_affiliation, corresponding_status) 
				 VALUES (\"".$paper_id."\", \"".$_POST['author_name1']."\", \"".$_POST['author_email1']."\", \"".$_POST['author_affliation1']."\",\"".$_POST['corresponding_author1']."\"),
				 (\"".$paper_id."\", \"".$_POST['author_name2']."\", \"".$_POST['author_email2']."\", \"".$_POST['author_affliation2']."\",\"".$_POST['corresponding_author2']."\"),
				 (\"".$paper_id."\", \"".$_POST['author_name3']."\", \"".$_POST['author_email3']."\", \"".$_POST['author_affliation3']."\",\"".$_POST['corresponding_author3']."\"),
				 (\"".$paper_id."\", \"".$_POST['author_name4']."\", \"".$_POST['author_email4']."\", \"".$_POST['author_affliation4']."\",\"".$_POST['corresponding_author4']."\")";
					
					 $result1 = mysqli_query($connection, $query1);
				  if ($result1)
				     {
												 $message = "<strong><span style=' color: green;'>Article submitted successfully. </span></strong> "; 
				     }
					 else {
   							 //$message = "Error: " . $sql . "<br>" . mysqli_error($connection);
							 $message = "<strong><span style=' color: red;'>Article submission  Failed!. </span></strong> ";
									}
					 }
					 else {
   							$message =  "<strong><span style=' color: red;'>Article submission  Failed!. </span></strong> ";
									}
				}
						//echo 'File Uploaded. Thank You.';
 					  }
}
else
{
	$message = "*  Please choose pdf file to upload"; 
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
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Submit Article for <?php echo $_GET["event"]; ?></h6>
            </div>
                        <?php if(!empty($message)) {echo $message; 
			        echo "<br/>"; }?>
          
             <div class="card-body">
              <?php
		 $sql = mysqli_query($connection, "
		SELECT *
		FROM event WHERE
		event_code = \"".$_GET["event"]."\"
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) { ?>
			<div class="col-lg-6">
			<?php while($row = mysqli_fetch_assoc($sql)) {    
				 
				       $sn++; ?>
				 				
			
			

              <!-- Default Card Example -->
              <div class="card mb-4">
                <div class="card-header">
                  <?php echo $row['event_code'] ; ?>
                </div>
                <div class="card-body">
                 <span style=" color:#350A90"><strong>Name of the event:</strong></span> <?php echo $row['event_name'] ; ?> <br/>
                 <span style=" color:#350A90"><strong>Web page: </strong></span><a href="<?php echo $row['event_webpage'] ; ?>" target="_blank"><?php echo $row['event_name'] ; ?></a> <br/>
                 <?php $event_id = $row['event_id'] ;
				  $event_codes = $row['event_code'];  ?>              
                 </div> 
                </div>
            <?php }} ?>
              </div>


      
      
           <?php //if (!empty($message)) echo $message; ?>
          <!-- Content Row -->
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
          <div class="form-group">
          <h3>Title and Abstract</h3>
The title and the abstract should be entered as plain text, they should not contain HTML elements <br/><br/>
           <input type="text" name="paper_title"   placeholder="Enter Paper Title..." size="100" class="form-control form-control-user">
           </div>
           <div class="form-group">
           <input type="text" name="key_word"   placeholder="Enter Key Word..." size="100" class="form-control form-control-user">
           </div>
           <div class="form-group">
           <textarea placeholder="Enter Abstract Here..." name="abstract" rows="15" cols="100" class="form-control form-control-user"></textarea>
           </div>
           <div class="form-group">
         <h3>Author Information</h3>
For each author please fill out the form below. Some items on the form are explained here:<br/><br/>

Email address will only be used for communication with the authors. It will not appear in public Web pages of this conference. The email address can be omitted for not corresponding authors. These authors will also have no access to the submission page.<br/>

Each author marked as a corresponding author will receive email messages from the system about this submission. There must be at least one corresponding author.
           <table>
           <tr><td>Author Name</td><td>Author Email</td><td>Author Affliation</td><td>Corresponding Author<input name="event_id" type="hidden" value="<?php echo $event_id ?>" />
      <input name="event_code" type="hidden" value="<?php echo $event_codes ?>" /></td></tr>
           <tr><td><input type="text" name="author_name1"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email1"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation1"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author1"/></td></tr>
           <tr><td><input type="text" name="author_name2"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email2"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation2"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author2"/></td></tr>
           <tr><td><input type="text" name="author_name3"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email3"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation3"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author3"/></td></tr>
           <tr><td><input type="text" name="author_name4"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email4"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation4"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author4"/></td></tr>
           <tr><td><input type="text" name="author_name5"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email5"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation5"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author5"/></td></tr>
           <tr><td><input type="text" name="author_name6"   placeholder="Author name here..." size="100" class="form-control form-control-user"/></td><td><input type="text" name="author_email6"   placeholder="Author email here..." size="100" class="form-control form-control-user"></td><td><input type="text" name="author_affliation6"   placeholder="Author afliation here..." size="100" class="form-control form-control-user"></td><td><input type="checkbox" name="corresponding_author6"/></td></tr>
           
      
		   </table>
           </div>
           
                   
           
           <div class="form-group">
               Upload your paper. The paper must be in PDF format (file extension .pdf) <br/><input type="file" name="file" id="file" /> 
           </div>
           <div class="form-group">
           <input type="submit" name="submit_article" class="btn btn-primary btn-user btn-block" placeholder="Submit Paper">
           </div>
          </form>
             </div>
             </div>
          </div>
      </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php require_once('include/footer.php'); ?>
      