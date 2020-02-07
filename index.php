<?php
   include('Config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:Login.php");
   }
?>
<html">
   
   <head>
      <title>Welcome </title>
     <link rel="icon" href="image/admin">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style type="text/css">
      body,td,th {
   font-size: 19px;
   
}
body {
   background-color:#f1f1f1;
   text-align: center;
   font-size: 36px;
}
</style>
   </head>
   
   <body>
      
<p>&nbsp;</p>
<p>welcome </p>
<p>&nbsp;</p>
<?php
        echo "$user_check";
      ?>
<br><br>
  
 <p align="center" >
 <a target="_blank" href="users" class="btn btn-primary">Users Panel</a>
 <a target="_blank"  href="trip" class="btn btn-primary">Trip Panel</a>
 <a target="_blank" href="booktrip" class="btn btn-primary">Book Trip</a>
 <a target="_blank" href="admin" class="btn btn-primary">Admin Panel</a>
 <br>
<p align="center">
  SignOut 
  <a href="Logout.php" class="btn btn-warning">Logoff</a>
 </p>
 <br>
</p>
   </body>
   
</html>