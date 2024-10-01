<?php

$uploadedStatus = 0;
$file_tempname = $_FILES['file']['name'];
$FileDir ="upload/";
$FileName = $FileDir . $file_tempname;

if(move_uploaded_file($_FILES['file']['tmp_name'],
$FileName)) ;
echo $FileName;
$extss = substr($FileName,0,-5);
echo "<br/>";
 echo $extss;
 echo "<br/>";
$ext = substr($FileName, strrpos($FileName, '.') + 1);

echo "<br/>";
 echo $ext;
 echo "<br/>";
{
//list($width, $height, $type, $attr) = getfsize($FileName);
//get info about the image being uploaded
/*switch ($type) {
case 1:
$ext = ".xlsx";
break;
case 2:
$ext = ".xls";
break;
default:
echo "Sorry, but the file you uploaded was not a excel file<br/>";
echo "Please hit your browser's 'back' button and try again.";*/
}
$newfilename = $FileName . $matric_no . $ext;
echo $newfilename;
//}
/*$insert = "INSERT INTO upload
(staff_id, upload_date, file_path)
VALUES
('$matric_no', '$today', '')";
$insertresults = mysql_query($insert)
or die(mysql_error());
$lastpicid = mysql_insert_id();
echo"$lastpicid";
$newfilename = $FileName . $matric_no . $ext;
rename($ImageName, $newfilename);

$update=mysql_query("UPDATE upload SET image_path = '$newfilename' WHERE staff_id = $matric_no") or die(mysql_error());
}*/

include("include/header.php");
?>
<div id="contents">
		<div class="clearfix">
			<div class="sidebar">
				<div>
					<h2>Recent News</h2>
					<p>
						This website template has been designed by Free Website Templates for you, for free. You can replace all this text with your own text.
					</p>
					
				</div>
			</div>
			<div class="main">
				<h1>News</h1>
				
			

<table>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">

<tr><td colspan="2" >Data Uploading System</td></tr>

<tr>
<td width="50%">Select file</td>
<td width="50%"><input type="file" name="file" id="file" /></td>
</tr>
<tr>
<td>Submit</td>
<td width="50%" ><input type="submit" name="submit" /></td>
</tr>

</table>

<?php if($uploadedStatus==1){

echo "<table align='center'><tr><td  ><center>============================= <b>File Uploaded<b/> =============================================</center></td></tr>";

echo "<tr><td ><center>============================= <b>Do you want to upload the data <a href='index.php'>Click Here</a> </b>========================</center></td></tr></table>";

}?>



</form>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38304687-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</div>
		</div>
	</div>
<?php include("include/footer.php"); ?>