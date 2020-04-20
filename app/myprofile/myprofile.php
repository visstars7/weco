<?php 
include_once '../helper/helper.php';

// siapkan session
session_start();

// cek apakah user sudah login
if(!isset($_SESSION['user'])){
    Header("Location:login/login.php");
}

// ambil data user_id dalam session
$user_id = $_SESSION['user'];

// lanjutkan query data user_id
$query = mysqli_query(conn(),"SELECT * FROM tbuser WHERE user_id = $user_id");
$level  = mysqli_fetch_assoc($query);

// jika level  === admin maka redirect ke halaman admin
if($level['level'] == "superadmin"){
    Header('Location:../admin?page=dashboard');
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We.Co | My profile</title>
</head>
<body>
    
Hello User

</body>
</html>