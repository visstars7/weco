<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();
    mysqli_query($conn,"DELETE FROM tbkota WHERE kota_id = $id");
    if(mysqli_affected_rows($conn)){
        $_SESSION['message'] = "<script>alert('Data kota telah dihapus')</script>";
		Header('Location:index.php?page=wilayah');
    }
}else{
    $_SESSION['message'] = "<script>alert('tidak terdapat id')</script>";
    Header('Location:index.php?page=wilayah');
}

?>