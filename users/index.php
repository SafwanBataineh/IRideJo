
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
 



<html>
 <head>
  <title>Users</title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>

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
  <script>
$(document).ready(function() {
    $('input[type="checkbox"]').click(function() {
        var index = $(this).attr('name').substr(3);
        index--;
        $('table tr').each(function() { 
            $('td:eq(' + index + ')',this).toggle();
        });
        $('th.' + $(this).attr('name')).toggle();
    });
});
</script>

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

 <a target=""  href="../trip" class="btn btn-primary">Trip Panel</a>
 <a target="" href="../booktrip" class="btn btn-primary">Book Trip</a>
 <a target="" href="../admin" class="btn btn-primary">Admin Panel</a>
</p>
  <div class="container box">
   <h1 align="center">Users Panel</h1>
   <br />
   <div class="table-responsive">
   <br />
    <div align="right">
     <button type="button" name="add" id="add" class="btn btn-info" >Add</button>
     <button class="btn btn-primary hidden-print" onclick="myFunction()">
      <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>

    </div>
    <br />
    <input type="checkbox" name="col1" checked="checked" id="checkbox" /> Hide/Show password <br />
    <div id="data-table-container"></div>
</div>
<div id="alert_message"></div>
<div>
      <p style="color:#ffa500">  NOTE.. First and Last Name Most Inserted A-z  ...  /  Phone Inserted Most 0-9   ...  /  Email Inserted Most Example@example.com .../ User Type Most Rider or Driver  .../ Car Number & Password & Car Name Inserted A-z 0-9  </p>
    </div>
    
<table id="user_data" class="table table-bordered table-striped">
  <thead>
      <tr>
        <th>User ID</th>
       <th>Frist Name</th>
       <th>Last Name</th>
       <th>Phone</th>
       <th>email</th>
       <th>Car Number</th>
       <th>car name</th>
       <th class="col1">password</th>
       <th>User Type</th>
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

//------------------------------------------

//------------------------------------------


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
   }, 50000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){

   var html = '<tr>';
   html += '<td contenteditable id="data0">no input</td>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
   html += '<td contenteditable id="data5"></td>';
   html += '<td contenteditable id="data6"></td>';

   html += '<td contenteditable id="data7"></td>';
   html += '<td contenteditable id="data8"></td>';
   
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
   


  });
  
  $(document).on('click', '#insert', function(){

   //var id = $('#data1').text();
   var first_name = $('#data1').text();
   var last_name = $('#data2').text();
   var phone_number = $('#data3').text();
   
   var email = $('#data4').text();
   var car_number = $('#data5').text();
   var car_name = $('#data6').text();
   var password = $('#data7').text();
  //  if($_POST[value] == 'Rider')
  // {
    
  //    var user_type ="Rider";
  // }
  // else
  // {
  //    user_type ="Driver";
  // }
   var user_type = $('#data8').text();
   if(first_name != '' && last_name != '' && phone_number != '' && password != '' && email != '' && car_number != '' && car_name != '' && user_type != '')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{first_name:first_name, last_name:last_name, phone_number:phone_number, email:email, car_number:car_number, car_name:car_name, password:password, user_type:user_type},

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
