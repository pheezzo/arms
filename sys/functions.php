<?php
include('connect.php'); 

function session_valid() {

	$error_found = FALSE;
	
	// return false if any important session data is not set
	$user = "username";
	if (!isset($_SESSION[$user])){		
		return FALSE;
	}
	/**/
	// return false if any important session data is empty
	$user = "username";
	if ($_SESSION[$user] == ""){
		return FALSE;
	}
	
	else {
		
		return TRUE;
	}		
	
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}


if (!function_exists('can_execute_action'))
{
	function can_execute_action($action)
	{
		global $message;
		global $applications_session_prefix;
		global $connection;
		// A valid session is required
		if (!session_valid()) return FALSE;
		$user = "username";
		$username = $_SESSION[$user];
		// We will get all permissions for this user into an array
		$user_permissions = array();
		
		$query = "SELECT * FROM user WHERE username = \"".$username."\"";
		$result = mysqli_query($connection, "SELECT * FROM user WHERE username = \"".$username."\"");
		if($result)
		{
			$user_type = mysqli_result($result,0,'user_type');
			
			// SELECT PERMISSIONS FOR THIS USER BASED ON THE USER TYPE
			$query = "SELECT permission_name FROM admin_group_permission WHERE user_type = \"".$user_type."\"";
			if ($result = mysqli_query($connection, $query))
			{
				while ($row = mysqli_fetch_assoc($result))
				{
					$user_permissions[] = $row['permission_name'];
				}
			}	
			
	}
		
		// Now that we have all available permission for the use
		// We find out if the requested action is available for user
		if (in_array($action,$user_permissions)) 
		{
			unset($user_permissions);
			return true;
		}
		else
		{
			unset($user_permissions);
			return false;
			$message = "ERROR";
		}
	}
}




function loguserout($type)
{
	global $applications_session_prefix;
	$user = $applications_session_prefix."username";
	$query = mysql_query("
	UPDATE admin_users 
	SET online_status = 0 
	WHERE username = \"".$_SESSION[$user]."\"
	");
	unset($_SESSION[$user]);
	$_SESSION = array();
	if (ini_get("session.use_cookies")) {
		$params = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"] 
		);
	}
	$MySession = new Session_Tracker();
	$MySession->stop();
	if($type == "user") $url_get = "exit"; else $url_get = "expire";
	header("Location: ?ss={$url_get}");
	exit;
}


?>