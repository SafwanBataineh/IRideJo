<?php
$connect = mysqli_connect("localhost", "root", "", "i_ride");
if(isset($_POST["id"]))
{
 $query = "DELETE FROM trip WHERE id = '".$_POST["id"]."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
}
?>
