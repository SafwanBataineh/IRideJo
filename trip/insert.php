<?php
$connect = mysqli_connect("localhost", "root", "", "i_ride");
if(isset($_POST["uid"], $_POST["from_stop"], $_POST["where_to"], $_POST["trip_time"], $_POST["trip_date"]))
{
 
 $uid = mysqli_real_escape_string($connect, $_POST["uid"]);
 $from_stop = mysqli_real_escape_string($connect, $_POST["from_stop"]);
 $where_to = mysqli_real_escape_string($connect, $_POST["where_to"]);
 $trip_time = mysqli_real_escape_string($connect, $_POST["trip_time"]);
 $trip_date = mysqli_real_escape_string($connect, $_POST["trip_date"]);





if (!preg_match ("/^[0-9]*$/", $uid)) 
{
	echo "Error!! User ID  Input Most 0-9";
} 
elseif (!preg_match ("/^\d{1,2}:\d{2}$/", $trip_time)) 
{
	echo "Error!! Time  Input Most Ex 02:30 ";
} 
elseif (!preg_match ("/^\d{4}-\d{1,2}-\d{1,2}$/", $trip_date)) 
{
	echo "Error!! Date  Input Most yyyy-mm-dd ";
} 

else
{
	$query = "INSERT INTO trip (uid, from_stop, where_to, trip_time, trip_date) 
    VALUES('$uid', '$from_stop', '$where_to','$trip_time','$trip_date')";

	

  echo 'Data Inserted';
}



 
 if(mysqli_query($connect, $query))
 {
  echo '   Successfully';
 }
}
?>
