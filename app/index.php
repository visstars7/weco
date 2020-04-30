<?php 

$page = isset($_GET['page']) ? $_GET['page'] : false;

session_start();

if(isset($_SESSION['pembayaran'])){
    $msg = $_SESSION['pembayaran'];
    echo "<script>alert('$msg')</script>";
    unset($_SESSION['pembayaran']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We.Co || WeCoffe</title>
    <!-- bootstrap 4 -->
    <link rel="stylesheet" href="../resource/bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="../resource/css/style.css">
    <!-- favicon -->

    <link rel="shortcut icon" href="../resource/img/Weco.png" type="image/x-icon">

    <!-- <script src="../resource/jquery-3.4.1.min.js" ></script> -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

</head>

<body>
    
    <div class="container">

        <?php include_once 'header.php'; ?>


            <?php 
                
                $file_name = $page."/".$page.".php";

                if(file_exists($file_name)){

                    include_once "$file_name";

                }
                else{
                    
                    echo "Maaf file tidak ditemukan";
                    
                }
            
            ?>



</div>

<?php include_once 'footer.php' ?>

<script src="../resource/popper/popper.min.js" ></script>
<script src="../resource/bootstrap-4.4.1-dist/js/bootstrap.min.js"></script>
</body>
</html>