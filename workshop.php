
<?php //include('sys/connect.php');
$conf_code = $_GET['conf'];
include('sys/functions.php');
require_once('include/front_header.php');		?>

            
		</div>
	</div>
    
    
    
    <div id="contents">
		<div class="clearfix">
			<div class="sidebar">
				<div>
					<h2>Quick Links</h2>
					<ul>
						
                        <?php
            $sql = mysqli_query($connection, "
		 SELECT *
		FROM event 
		WHERE event_type = 'workshop' 
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) {
			 while($row = mysqli_fetch_assoc($sql)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
				 
			echo" <a href='workshop.php?conf=". $row['event_code'] ."'><li>
					". $row['event_name'] ."
					</p>
				</li> 
				</a>
				 ";
			 }
		} ?>
                        
					</ul>
				</div>
				<div>
					
				</div>
			</div>
			<div class="main">
            
            
			<h1>Confrences</h1>
            <?php
		 $sql = mysqli_query($connection, "
		SELECT *
		FROM event 
		WHERE event_type = 'workshops'
		AND event_code = \"".$conf_code."\"
		");
	     if ($sql)
		if (mysqli_num_rows($sql) > 0) { ?>
		
			<?php while($row = mysqli_fetch_assoc($sql)) {    
				 
				       ?>
				 
				<h2>  <?php echo $row['event_name'] ; ?> [<?php echo $row['event_code'] ; ?>]</h2>
                
				<p>
				<a href="<?php echo $row['event_webpage'] ; ?>" target="_blank"><strong>CONFERENCE WEBSITE</strong></a> -----
				 <a href="submit_article.php?event=<?php echo $row['event_code'] ; ?>" target="_blank"><strong>PAPER SUBMISSION</strong></a></p>
				
				 <P><?php echo $row['event_description'] ; ?> </p>
                 
            <?php }} ?>
				</br><br/><br/><h2>Papers</h2>
				
         <ul class="news">       
          <?php $sqls = mysqli_query($connection, "
		 SELECT *
		FROM publish_paper 
		WHERE event_code = \"". $conf_code ."\" 
		");
		
		 if ($sqls)
		if (mysqli_num_rows($sqls) > 0) {
			 while($rows = mysqli_fetch_assoc($sqls)) {
				 
				 /*$event_id = $row['event_id']; 
				 $event_code = $row['event_code'];
				 $row['title'];*/
				 
				 $author_name = "";
					 $author_query = mysqli_query($connection,"SELECT * FROM author 
					  WHERE paper_id =\"".$rows['paper_id'] ."\" "); 
					  if (mysqli_num_rows($author_query) > 0) {
    					while($rowss = mysqli_fetch_assoc($author_query)) {
							$author_name .= "".$rowss['author_name'].", ";
						}
					  }
			echo" <p><li>
					". $rows['title'] .", ".$author_name."
				<a href='".$rows['document']."' target='_blank' class='more'> Full Article</a>	
				</li> </p>
				
				 ";
			 }
		} 
		 ?>		
				</ul>
        
			</div>
		</div>
	</div>
    
    
  <?php require_once('include/front_footer.php'); ?>