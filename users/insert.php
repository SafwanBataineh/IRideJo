<?php
$connect = mysqli_connect("localhost", "root", "", "i_ride");

if(isset($_POST["first_name"], $_POST["last_name"] ,$_POST["phone_number"], $_POST["password"],$_POST["email"],$_POST["car_number"],$_POST["car_name"],$_POST["user_type"]))
{
	$first_name = mysqli_real_escape_string($connect, $_POST["first_name"]);
 $last_name = mysqli_real_escape_string($connect, $_POST["last_name"]);
 $phone_number = mysqli_real_escape_string($connect, $_POST["phone_number"]);
 $password = mysqli_real_escape_string($connect, $_POST["password"]);
 //$email = mysqli_real_escape_string($connect, $_POST["email"]);
 $email = mysqli_real_escape_string($connect,$_POST["email"]);

 $car_number = mysqli_real_escape_string($connect, $_POST["car_number"]);



$car_name = mysqli_real_escape_string($connect, $_POST["car_name"]);
$user_type = mysqli_real_escape_string($connect, $_POST["user_type"]);


if (!preg_match ("/^[a-zA-Z ]*$/", $first_name)) 
{
	echo "Error!! First Name Input Most A-Z";
} 
elseif (!preg_match ("/^[a-zA-Z ]*$/",$last_name)) 
{
	echo "Error!! Last Name Input Most A-Z";
}
 elseif (!preg_match ("/^[0-9]*$/",$phone_number)) 
{
	echo "phone number Error !!";
}
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
 {
	echo "Email error !!";
}
elseif($user_type !="Driver" && $user_type !="Rider" )
{
	echo "Error!! User Type Most Rider Or Driver";
}
else
{

	$query = "INSERT INTO users(first_name, last_name, phone_number, password, email, car_number, car_name, user_type) 
  VALUES('$first_name', '$last_name', '$phone_number','$password','$email','$car_number', '$car_name','$user_type')";

  echo 'Data Inserted';
}

  
 // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
 //  	echo "email error"; 
 //  } else {
 //  	$query = "INSERT INTO users(first_name, last_name, phone_number, password, email, car_number, car_name, user_type) 
 // VALUES('$first_name', '$last_name', '$phone_number','$password','$email','$car_number', '$car_name','$user_type')";
 // echo 'Data Inserted';
 //  }
   
  if(mysqli_query($connect, $query))
 {
  echo '  Successfully';
 }
  
}
?>
