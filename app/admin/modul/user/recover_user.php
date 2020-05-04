<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = conn();
    if(mysqli_query($conn,"UPDATE tbuser SET `status` = 'on' WHERE user_id = $id")){
        Header('Location:index.php?page=user&pesan=4');
    }
}else{
    Header('Location:index.php?page=user');
}

?>