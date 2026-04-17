<?php





define('__ROOTFORCOOKIE2__', dirname(dirname(__FILE__)));



require_once('db_connect.php');



// $conn_for_cookie = conn();





if(!isset($_SESSION["username"]) )



{

		if(isset($_COOKIE["username"])  && isset($_COOKIE["user_session_token"]) )



		{



			$sql_check_session = "select * from user_session_token WHERE  session_token='".$_COOKIE["user_session_token"]."' AND deleted ='no' AND username ='".$_COOKIE["username"]."' " ;



			$res_check_session = mysqli_query($conn,$sql_check_session);

	



			if(mysqli_num_rows($res_check_session))



			{



				



				$_SESSION["username"] = $_COOKIE["username"];



			



			}



		



		}



		







}









if(!isset($_SESSION["m_id"]) )

{



		if(isset($_COOKIE["m_id"])  && isset($_COOKIE["user_session_token"]) )



		{



			$sql_check_session = "select * from user_session_token WHERE  session_token='".$_COOKIE["user_session_token"]."' AND deleted ='no' AND username='".$_COOKIE["m_id"]."' " ;



			$res_check_session = mysqli_query($conn,$sql_check_session);



			



			



			if(mysqli_num_rows($res_check_session))



			{



				



				$_SESSION["m_id"] = $_COOKIE["m_id"];



			



			}



			



			



			



		}



		







}















if(isset($_SESSION['m_id']))

{

	$sql_members = "SELECT * From admin where m_id='".$_COOKIE["m_id"]."'and deleted='no' ";

	$res_members= mysqli_query($conn,$sql_members);

	

	$members=mysqli_fetch_assoc($res_members);

	

	

	$member_type=$members['member_type'];



	if( $member_type == 'opt')

	{

		$sql_staff="SELECT * FROM admin where m_id='".$_SESSION['m_id']."' and deleted='no'";

		$res_staff=mysqli_query($conn,$sql_staff);



		// $allowed_menus=array();



		$staff = mysqli_fetch_assoc($res_staff);



		$menu_access = $staff['allowed_menu'];



		$allowed_menus = explode(',', $menu_access);

	}

}













require_once("check_admin.php");

//require_once(__ROOTFORCOOKIE2__."/admin/admin_check.php");









?>