<?php 

require_once '../helper/helper.php';

if(isset($_POST['submit'])){

    $nama_dpn = $_POST['nama_depan'];
    $nama_blg = $_POST['nama_belakang'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $password1 = $_POST['password'];
    $password2 = $_POST['password2'];

    // jika didalam table terdapat email yang sama
    $connected  = conn();

    unset($_POST['password']);
    unset($_POST['password2']);
    $data_Form = http_build_query($_POST);

    if(!$connected){
        Header('Location:register.php?pesan=4');
    }
    else{
        $verif_Email = mysqli_query($connected,"SELECT email FROM tbuser WHERE email = $email");
    
        if(mysqli_num_rows($verif_Email) > 0){
            Header("Location:register.php?pesan=1&$data_Form");
        }
    
        else if( $password2 !== $password1 ){
            Header("Location:register.php?pesan=2&$data_Form");
        }
    
        else{
    
            $sql = "INSERT INTO tbuser (`user_id`,`nama_depan`,`nama_belakang`,`password`,`phone`,`alamat`,`email`,`level`,`status`) VALUES (NULL,'$nama_dpn','$nama_blg','$password1','$phone','$alamat','$email','customer','on')";
            
            echo "$sql";

            $query = mysqli_query($connected,$sql);
            
            var_dump($query);
            
            if($query){
                Header('Location:../login/login.php');
            }else{
                Header("Location:register.php?pesan=3&$data_Form");
            }
    
        }
    }





}else{
    Header("Location:register.php");
}