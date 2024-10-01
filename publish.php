<?php 
include('sys/confirm _login.php');
include('sys/functions.php');
//include('include/connect.php'); 
$username = $_SESSION['username'];
$art_id = $_GET['paper'];
$FileName = "";
$sql = mysqli_query($connection, "
		 SELECT *
		FROM paper 
		WHERE paper_id =\"". $art_id ."\" 
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];
				 $row['abstract'];
				 $row['keyword'];
				 $row['document'];
				 $row['submission_date'];
				 $row['updated_date'];*/
				  $now = date("Y-m-d h:i:s");	
				 $query = "INSERT INTO publish_paper (paper_id, event_id, event_code, title, abstract, keyword, document, submission_date, updated_date) 
				 VALUES (\"".$row['paper_id']."\", \"".$row['event_id']."\", \"".$row['event_code']."\", \"".$row['title']."\", \"".$row['abstract']."\",\"".$row['keyword']."\",\"".$row['document']."\", \"".$row['submission_date']."\", \"".$now."\")";	
				 
				  $result = mysqli_query($connection, $query);
				  if ($result)
				     {
				 $_SESSION['sucmessage'] = "<span style='color: green;'>Paper published successfully</span>";
										
										header ("Location: publish_article.php");	
										
					 }
			 }
		}
		

?>