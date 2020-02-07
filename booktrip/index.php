<?php
   include('../Config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:../Login.php");
   }
?>

<?php  
 $connect = mysqli_connect("localhost", "root", "", "i_ride");  
 $sql = "SELECT * FROM mytrips INNER JOIN users  ON mytrips.uid = users.id ";  
 $result = mysqli_query($connect, $sql);
 ?> 

 
 <script type="text/javascript">
  function myFunction() {
    var divToPrint=document.getElementById("user_data");
   var htmlToPrint = '' +
        '<style type="text/css">' +
        'table th, table td {' +
        'border-bottom: 1px solid #ddd; text-align: center;' +
        '}' +
       ' table { '+
    'border-collapse: collapse;'+
    'width: 100%;'+
       '}'+
        '</style>';
    htmlToPrint += divToPrint.outerHTML;
    newWin = window.open("");
    newWin.document.write(htmlToPrint);
    newWin.print();
    newWin.close();
}

</script> 
<html>
 <head>
  <title>booking trips</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <style>
  body
  {
   margin:0;
   padding:0;
   background-color:#f1f1f1;
  }
  .box
  {
   width:1270px;
   padding:20px;
   background-color:#fff;
   border:1px solid #ccc;
   border-radius:5px;
   margin-top:25px;
   box-sizing:border-box;
  }
  </style>
 </head>
 <body>
   <br>
  <p align="right">
  SignOut 
  <a href="Logout.php" class="btn btn-warning">Logoff</a>
 </p>
 <p align="center" >
 <a target=""  href="../" class="btn btn-primary btn-lg">Home</a>
 </p>
 <br>
 <p align="center" >
 <a target=""  href="../users" class="btn btn-primary">Users Panel</a>
 <a target="" href="../trip" class="btn btn-primary">Trip Panel</a>
 <a target="" href="../admin" class="btn btn-primary">Admin Panel</a>
</p>
  <div class="container box">
   <h1 align="center">Trip Report</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button class="btn btn-primary hidden-print" onclick="myFunction()">
      <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
    </div>
    <br />
    
     <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="user_data"></label>

    <!-- <form action="" method="post">
<input type="text" name="search">
<input type="submit" name="submit" value="Search">
</form> -->

    <br>
    <div class="table-responsive">  
                     <table id="user_data" class="table table-bordered table-striped">  
                          <tr>  
                               <th>Booking ID</th>  
                               <th>Trip ID</th>
                               <!-- <th>From Stop</th>  
                               <th>Where To</th> -->
                               <th>User ID</th>  
                               <th>First Name</th>
                               <th>Last Name</th>
                               <th>Phone</th>   
                          </tr>  
                          <?php  
                          if(mysqli_num_rows($result) > 0)  
                          {  
                               while($row = mysqli_fetch_array($result))  
                               {  
                          ?>  
                          <tr>  
                               <td><?php echo $row["id"];?></td>  
                               <td><?php echo $row["tripID"];?></td>
                               <!-- <td><?php echo $row["from_stop"];?></td> 
                               <td><?php echo $row["where_to"];?></td>  --> 
                               <td><?php echo $row["uid"];?></td>   
                               <td><?php echo $row["first_name"]; ?></td> 
                               <td><?php echo $row["last_name"];?></td>  
                               <td><?php echo $row["phone_number"]; ?></td>  
                          </tr>  
                          <?php  
                               }  
                          }  
                          ?>  
                     </table>  
                </div>  
  </div>
 </body>
 <p align="center">
  Copyright © 2018 
  <a href="#"> I Ride Jo Team</a>
 </p>
 
</html>
<!--         $sql="select * from trip where tripID like '%$$search_value%'";
 -->
