<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Online Journal - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-text mx-3"><img src="img/logo8.png" width="100%"> </div>
      </a>
        <br/>
      <!-- Divider -->
      <hr class="sidebar-divider my-0">

             
  <?php 
  
  $home = "dashboard.php";
  
   $query = "
SELECT * FROM menu_category 
ORDER BY sort_order
";
if ($result=mysqli_query($connection, $query))
{
	//menu opens
	//echo " <ul class=\"menu-0\">";
	//echo "<li class =\"glyphicons display ".$home."\"><a href=\"./\" class=\"menu\"><i></i> <span>Dashboard</span></a></li>";
	echo " <li class=\"nav-item active\">
        <a class=\"nav-link\" href=\"".$home."\">
          <i class=\"fas fa-fw fa-tachometer-alt\"></i>
          <span>Dashboard</span></a>
      </li>";
	while ($row = mysqli_fetch_assoc($result))
	{
		//FIND ALL MENU ITEMS IN THIS CATEGORY<span class=\"submenu\">
		$query = "
		SELECT * FROM menu_items 
		WHERE category_name = \"".$row['category_name']."\" 
		AND is_published = 1
		ORDER BY menu_sort_id
		";
		if ($result1= mysqli_query($connection, $query))
		{
			$menu_class = $row['category_name']; 
			$child_class = $row['category_name']."_".$row['sort_order']; 
			/*$menu_category = "
			<li class=\"hasSubmenu ".$$menu_class." \">
				<a class=\"glyphicons ".$row->category_icon."\" data-toggle=\"collapse\" href=\"#".$row->category_name."\" 
				title=\"".$row->category_title."\">
				<i></i><span>".$row->category_title."</span></a>
			<ul class=\"collapse ajax_menu\" id=\"{$row->category_name}\">			
			";*/
			$menu_category = "<li class=\"nav-item\">
        <a class=\"nav-link collapsed\" href=\"#".$row['category_name']."\" data-toggle=\"collapse\" data-target=\"#".$row['category_name']."\" aria-expanded=\"true\" aria-controls=\"".$row['category_name']."\">
          <i class=\"fas fa-fw fa-folder\"></i>
          <span>".$row['category_title']."</span>
        </a>
        <div id=\"".$row['category_name']."\" class=\"collapse\" aria-labelledby=\"headingPages\" data-parent=\"#accordionSidebar\">
          <div class=\"bg-white py-2 collapse-inner rounded\">";
			$items = ""; //".$$child_class."
			while($row1=mysqli_fetch_assoc($result1))
			{
				$sub_class = $row1['menu_unique_id'];
				// We will not display this item if the associated action is not available for user".$row1->menu_link."
				//if (!can_execute_action($row1->associated_action) || $row1->associated_action == 'home')
				//{
					/*$items.="<li class=\"".$menu_class." ".$$sub_class."\">
								<a href=\"javascript:;\" id=\"".$row1->menu_unique_id."\" title=\"{$row1->menu_title}\" 
								cat=\"{$row->category_title}\" class=\"menu\">
									<i class=\"icon-caret-right\"></i><span> {$row1->menu_title}</span>
								</a>
							 </li>";*/
		if (can_execute_action($row1['associated_action']) || $row1['associated_action'] == 'home') 
							$items.="<a class=\"collapse-item\" href=\"".$row1['menu_link']."\">{$row1['menu_title']}</a>";
				//}
			}
			$menu_category .= $items;
			$menu_category .= " </div>
        </div>
      </li>";
			if ($items!="") echo $menu_category;
		}
	}
	//menu closes
	//echo "</ul>";
}

function clean_input($string)
{
	 $patterns[0] = "/'/";
	 $patterns[1] = "/\"/";
	// $patterns[2] = "/:/";
	 $string = preg_replace($patterns,'',$string);
     //$string = ereg_replace("[^A-Za-z0-9]", "", $string);  
	 $string = trim($string);
	 if(get_magic_quotes_gpc()) $string = stripslashes($string);
	 return preg_replace("/[<>]/", '_', $string);
}
require("include/class.FormValidation.php");
?>
  
 </ul>   <!-- End of Sidebar -->