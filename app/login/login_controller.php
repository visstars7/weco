<?php 

include_once '../helper/helper.php';
session_start();


if(isset($_POST['submit'])){

    $connected = conn();

    if(!$connected){
        echo "<script>alert('Maaf,database tidak terkoneksi')</script>";
    }

    else{

        $email = $_POST['email'];
        $password = $_POST['password'];
    
        // jika di dalam database terdapat email dan password yang di ketikan user maka benar
    
        $query = mysqli_query($connected,"SELECT email,password,user_id,nama_depan FROM tbuser WHERE email = '$email' && password = '$password'&&status='on'");
        
        // var_dump($query);
        
        if(mysqli_num_rows($query) > 0){
            
            $user_data  = mysqli_fetch_assoc($query);

                $_SESSION['user'] = $user_data['user_id'];
                $_SESSION['nama'] = $user_data['nama_depan'];

                Header('Location:../index.php?page=home');

        }else{
            Header('Location:../login/login.php?pesan=0');
        }
        

    }


}else{
    Header('Location:../login/login.php');
}