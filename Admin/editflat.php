<?php
include 'checklogin.php';
include '../db_conn.php';
include 'navbar.php';
ob_start();
$ai=$_GET['ci'];
$bo=$_GET['bo'];
$fl=$_GET['fl'];

$dr=$_GET['dr'];
?>



<style>
  .bg-password-image2 {
  background: url("https://images.unsplash.com/photo-1515263487990-61b07816b324?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=1050&q=80");
  background-position: center;  
  background-size: cover;
}
</style>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Edit Flat</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-password-image2">
</div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                              
                                <h1 class="h4 text-gray-900 mb-4">Change Flat Informations!</h1>
                                <br><br><br><br>
                            </div>

                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                      <label>Door Number </label>
                                       <input type="text" name="door_number" value="<?php echo "$dr" ?>" class="form-control form-control-user" id="exampleFirstName">

                                     <input type="hidden" name="ai"  value="<?php echo "$ai" ?>" id="lastName">
                                      <br><br>
                                    </div>
                                    <div class="col-sm-4 mb-3 mb-sm-0">
                                      <label>Floor </label>
                                       <input type="text" name="floor" value="<?php echo "$fl" ?>" class="form-control form-control-user" id="exampleFirstName">

                                    
                                      <br><br>
                                    </div>
                                    <div class="col-sm-4">
                                      <label>Block</label>
                                        <input type="text" class="form-control form-control-user" id="exampleLastName" name="Block"  value="<?php echo "$bo" ?>"
                                            placeholder="Last Name">
 
  
                                   </div>
                                    </div>
                             <div> <input  type="submit" class="btn btn-primary btn-user btn-block" name="submit" value="Update Flat"  />
                               </div>
                                <hr>
                                <br><br><br><br><br><br>
                                </form>
                                
       <?php

if (isset($_GET['submit']))
{

  $Block=$_GET['Block'];
   $floor=$_GET['floor'];
   $door_number=$_GET['door_number'];
    $ai=$_GET['ai'];

$query="UPDATE flats SET floor='$floor',door_number='$door_number', Block='$Block' WHERE flat_id='$ai'";
$data=mysqli_query($conn,$query);
if(isset($data))
{


 $message = 'Updated Successfully!! .';

    echo "<SCRIPT> //not showing me this
        alert('$message')
        window.location.replace('viewflats.php');
    </SCRIPT>";
}
else{
 echo "There is an Error ";
}
}
?>           
                                
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

 
</html>
<?php 
ob_flush(); ?>