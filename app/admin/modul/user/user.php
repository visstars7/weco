<?php 

$conn = conn();

$query = getAll("SELECT * FROM tbuser WHERE level = 'customer' ORDER BY user_id DESC ");

$fileName = isset($_GET['list']) ? "modul/user/".$_GET['list'].".php" : false;

if(isset($_GET['pesan'])){

    switch($_GET['pesan']){
        case 1:
            echo "<script>alert('User Telah menjadi superadmin')</script>";
            break;
        case 2:
            echo "<script>alert('User telah di blokir')</script>";
            break;
        case 3:
            echo "<script>alert('User Telah menjadi dihapus')</script>";
            break;
        case 4:
            echo "<script>alert('User Telah direcover')</script>";
            break;
    }


}


?>

<div id="frame-nav-product" class="row mt-2">

    <div class="col-md-12 col-sm-12 col-12 float-right">
    
        <form action="" method="post">

            <div id="frame-search">
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Produk..">
                <button name="search" class="search-btn noto-sans-font">search</button>

            </div>

        </form>

    </div>

</div>

<div id="frame-main-product">
    <?php if(file_exists($fileName)): ?>

        <?php include_once $fileName; ?>
        
    <?php else: ?>

    <div class="table-responsive">
        
        <table class="table text-brown table-striped noto-sans-font mt-2">
        
            <tr>

                <th class="text-center">No</th>
                <th class="text-center">User Id</th>
                <th class="text-center">Nama User</th>
                <th class="text-center">No.Telp</th>
                <th class="text-center">Email</th>
                <th class="text-center">Level</th>
                <th class="text-center">status</th>
                <th class="text-center">Aksi</th>

            </tr>

            <?php $i = 1 ?>
            <?php foreach($query AS $key): ?>
            <tr>
                    <td class="text-center"><?= $i ?></td>
                    <td class="text-center"><?= $key['user_id'] ?></td>
                    <td class="text-center"><?= $key['nama_depan']?></td>
                    <td class="text-center"><?= $key['phone'] ?></td>
                    <td class="text-center"><?= $key['email'] ?></td>
                    <td class="text-center"><?= $key['level'] ?></td>
                    <td class="text-center"><?= $key['status'] ?></td>
                    <td class="text-center">
                    <a class="btn btn-sm btn-info" onclick="return confirm('yakin menjadikan superadmin?')" href="?page=user&list=superadmin_user&id=<?=$key['user_id']?>">Superadmin</a> | 
                    <?php if($key['status']=='on'): ?>
                    <a class="btn btn-sm btn-warning" onclick="return confirm('yakin memblokir user?')" href="?page=user&list=blokir_user&id=<?=$key['user_id']?>">Block</a> |
                    <?php else: ?>
                    <a class="btn btn-sm btn-primary" onclick="return confirm('yakin ,memulihkan user?')" href="?page=user&list=recover_user&id=<?=$key['user_id']?>">Recover</a> |
                    <?php endif; ?> 
                    <a class="btn btn-sm btn-danger" onclick="return confirm('yakin menghapus user?')" href="?page=user&list=delete_user&id=<?=$key['user_id']?>">Delete</a></td>

            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        
        </table>

    </div>

    <?php endif; ?>

</div>