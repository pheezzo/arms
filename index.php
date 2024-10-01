
<?php //include('sys/connect.php');
include('sys/functions.php');
require_once('include/front_header.php');		?>
		<div id="contents">
		<div id="adbox">
			<div class="clearfix">
				<img src="images/family-large.jpg" alt="Img" height="382" width="594">
				<div class="detail">
					<h1>Welcome to<br> CMS.</h1>
					<p>
						Conference Management System.
					</p>
				</div>
			</div>
		</div>
		<div class="highlight">		
		</div>
		<div class="featured">
			<h2>Confrences</h2>
          <ul class="clearfix">  
            <?php
            $sql = mysqli_query($connection, "
		 SELECT *
		FROM event 
		WHERE event_type = 'conference' 
		ORDER BY date_created DESC
		LIMIT 4
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
			echo" <a href='conference.php?conf=". $row['event_code'] ."'><li>
					<div class='frame1'>
						<div class='box'>
							<img src='images/meeting.jpg' alt='Img' height='130' width='197'>
						</div>
					</div>
					<p>
						<b>". $row['event_name'] ."</b>
					</p>
				</li> 
				</a>
				 ";
			 }
		} ?>
			
				
			</ul>
            
            <h2>Journal</h2>
			<ul class="clearfix">
				
                 <ul class="clearfix">  
            <?php
            $sql = mysqli_query($connection, "
		 SELECT *
		FROM event 
		WHERE event_type = 'journal' 
		ORDER BY date_created DESC
		LIMIT 4
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
			echo"<a href='journal.php?conf=". $row['event_code'] ."'><li>
					<div class='frame1'>
						<div class='box'>
							<img src='images/meeting.jpg' alt='Img' height='130' width='197'>
						</div>
					</div>
					<p>
						<b>". $row['event_name'] ."</b>
					</p>
				</li> </a>
				 ";
			 }
		} ?>
                
			</ul>
			
			
			 <h2>Workshop</h2>
			<ul class="clearfix">
				
                 <ul class="clearfix">  
            <?php
            $sql = mysqli_query($connection, "
		 SELECT *
		FROM event 
		WHERE event_type = 'workshop' 
		ORDER BY date_created DESC
		LIMIT 4
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
			echo"<a href='workshop.php?conf=". $row['event_code'] ."'><li>
					<div class='frame1'>
						<div class='box'>
							<img src='images/meeting.jpg' alt='Img' height='130' width='197'>
						</div>
					</div>
					<p>
						<b>". $row['event_name'] ."</b>
					</p>
				</li> </a>
				 ";
			 }
		} ?>
                
			</ul>
			
			 <h2>Project/Theses</h2>
			<ul class="clearfix">
				
                 <ul class="clearfix">  
            <?php
            $sql = mysqli_query($connection, "
		 SELECT *
		FROM event 
		WHERE event_type = 'project' 
		ORDER BY date_created DESC
		LIMIT 4
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
			echo"<a href='project.php?conf=". $row['event_code'] ."'><li>
					<div class='frame1'>
						<div class='box'>
							<img src='images/meeting.jpg' alt='Img' height='130' width='197'>
						</div>
					</div>
					<p>
						<b>". $row['event_name'] ."</b>
					</p>
				</li> </a>
				 ";
			 }
		} ?>
                
			</ul>
            
		</div>
	</div>
    
  <?php require_once('include/front_footer.php'); ?>