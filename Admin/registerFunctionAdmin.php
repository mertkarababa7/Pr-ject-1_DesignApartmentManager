<?php

$link = mysqli_connect("localhost", "root", "", "webapartment");
 
function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	// datayı validate ile kontrol ettikten sonra html sayfasında ki text valuesinden postladı
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

if (isset($_POST['signUp'])) {
if (empty($_POST['name']) || empty($_POST['user_name']) || empty($_POST['password'])|| empty($_POST['phoneNumber'])|| empty($_POST['email']) ) {
 $message = 'Please Fill In The Blanks!! .';

    echo "<SCRIPT> //not showing me this
        alert('$message')
    </SCRIPT>";
}
else{


$name=validate($_POST['name']);
$user_name=validate($_POST['user_name']);
$password=validate($_POST['password']);
$email=validate($_POST['email']);
$phoneNumber=validate($_POST['phoneNumber']);
$hash = password_hash($password, PASSWORD_DEFAULT); 
 
$sql = "INSERT INTO users (user_name, name, password,phoneNumber,email) VALUES ('$user_name', '$name', '$hash','$phoneNumber','$email')";
if(mysqli_query($link, $sql)){
        $message = 'Admin Successfully Created.';

    echo "<SCRIPT> //not showing me this
        alert('$message')
        window.location.replace('admin.php');
    </SCRIPT>";
    
} else{ 
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}


mysqli_close($link);
}
}
?>

