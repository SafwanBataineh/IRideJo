<?php
$connect = mysqli_connect("localhost", "root", "", "i_ride");
if(isset($_POST["username"], $_POST["password"] ,$_POST["admin_name"], $_POST["admin_type"]))
{
 $username = mysqli_real_escape_string($connect, $_POST["username"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 $admin_name = mysqli_real_escape_string($connect, $_POST["admin_name"]);
 $admin_type = mysqli_real_escape_string($connect, $_POST["admin_type"]);
 






if (!preg_match ("/^[a-zA-Z ]*$/", $admin_name)) 
{
	echo "Error!! Admin Name Input Most A-z";
}
elseif ($admin_type !=0 && $admin_type !=1) 
{
	echo "Error!! Admin Type Input Most 0 or 1";
}  
else
{
	$query = "INSERT INTO admin(username, password, admin_name, admin_type) 
 VALUES('$username', '$password', '$admin_name','$admin_type')";
echo 'Data Inserted';
}
 
 if(mysqli_query($connect, $query))
 {
  echo '   Successfully';
 }
}
?>
