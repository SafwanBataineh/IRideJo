<?php
   include('../config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select username from admin where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:../login.php");
   }
?>

<html>
 <head>
  <title>Admin</title>
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
 <a target="" href="../booktrip" class="btn btn-primary">Book Trip</a>
</p>
  <div class="container box">
   <h1 align="center">Admin Panel</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info">Add</button>
    </div>
    <br />
    <div id="alert_message"></div>
    <div>
      <p style="color:#ffa500">  NOTE.. Admin Name Input Most A-z   ...  /  Admin Type Input Most 0 for Supervisor or 1 for Admin  </p>
    </div>
    <table id="user_data" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Username</th>
       <th>Password</th>
       <th>Admin Name</th>
       <th>Admin Type</th>
       <th></th>
      </tr>
     </thead>
    </table>
   </div>
  </div>
 </body>
 <p align="center">
  Copyright © 2018 
  <a href="#"> I Ride Jo Team</a>
 </p>
 
</html>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"fetch.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  $(document).on('click', '#insert', function(){
   var username = $('#data1').text();
   var password = $('#data2').text();
   var admin_name = $('#data3').text();
   var admin_type = $('#data4').text();
   
   if(username != '' && password != '' && admin_name != '' && admin_type != '' )
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{username:username, password:password, admin_name:admin_name, admin_type:admin_type},
     success:function(data)
     {
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5500);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5500);
   }
  });
 });
</script>
