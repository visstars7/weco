<?php 

require_once '../helper/helper.php';

if(isset($_POST['submit'])){

    $nama_dpn = htmlspecialchars($_POST['nama_depan']);
    $nama_blg = htmlspecialchars($_POST['nama_belakang']);
    $phone = $_POST['phone'];
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $password1 = htmlspecialchars($_POST['password']);
    $password2 = htmlspecialchars($_POST['password2']);
    $level= "customer";
    $status = "on";

    unset($_POST['password']);
    unset($_POST['password2']);
    $data_Form = http_build_query($_POST);


    // menggunakan PDO 

    $koneksi = PDO();
    // verifikasi email
    $Email = $koneksi->prepare("SELECT COUNT(email) FROM tbuser WHERE email = :email");
    $array_execute['email'] = $email;
    $Email->execute($array_execute);
    $num_rows = $Email->fetchColumn();
    if($num_rows > 0){
        Header("Location:register.php?pesan=1&$data_Form");
    }
    // verifikasi password
    elseif($password1 !== $password2){
        Header("Location:register.php?pesan=2&$data_Form");
    }else{

        $sql="INSERT INTO tbuser ( `user_id`,`nama_depan`,`nama_belakang`,`password`,`phone`,`alamat`,`email`,`level`,`status` ) VALUES (NULL,:nama_dpn,:nama_blg,:password1,:phone,:alamat,:email,:level,:status)";

        $pdoStatement = $koneksi->prepare($sql);

        $pdoStatement->bindParam(':nama_dpn',$nama_dpn);
        $pdoStatement->bindParam(':nama_blg', $nama_blg);
        $pdoStatement->bindParam(':password1', $password1);
        $pdoStatement->bindParam(':phone',$phone);
        $pdoStatement->bindParam(':alamat', $alamat);
        $pdoStatement->bindParam(':email' ,$email);
        $pdoStatement->bindParam(':level' ,$level);
        $pdoStatement->bindParam(':status',$status);

        if($pdoStatement->execute() == 1){
            Header('Location:../login/login.php');
        }else{
            Header("Location:register.php?pesan=3&$data_Form");
        }

    }

    


    // menggunakan MYSQLI

    // // jika didalam table terdapat email yang sama
    // $connected  = conn();

    // unset($_POST['password']);
    // unset($_POST['password2']);
    // $data_Form = http_build_query($_POST);

    // if(!$connected){
    //     Header('Location:register.php?pesan=4');
    // }
    // else{
    //     $verif_Email = mysqli_query($connected,"SELECT email FROM tbuser WHERE email = $email");
    
    //     if(mysqli_num_rows($verif_Email) > 0){
    //         Header("Location:register.php?pesan=1&$data_Form");
    //     }
    
    //     else if( $password2 !== $password1 ){
    //         Header("Location:register.php?pesan=2&$data_Form");
    //     }
    
    //     else{
    
    //         $sql = "INSERT INTO tbuser (`user_id`,`nama_depan`,`nama_belakang`,`password`,`phone`,`alamat`,`email`,`level`,`status`) VALUES (NULL,'$nama_dpn','$nama_blg','$password1','$phone','$alamat','$email','customer','on')";
            
    //         echo "$sql";

    //         $query = mysqli_query($connected,$sql);
            
    //         var_dump($query);
            
    //         if($query){
    //             Header('Location:../login/login.php');
    //         }else{
    //             Header("Location:register.php?pesan=3&$data_Form");
    //         }
    
    //     }
    // }





}else{
    Header("Location:register.php");
}