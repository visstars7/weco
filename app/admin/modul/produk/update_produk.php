<?php 

$conn = conn();

$kategori = getAll("SELECT kategori_id,nama_ktg FROM tbkategori ORDER BY kategori_id DESC");

if(isset($_GET['id'])){

    $produk_id = $_GET['id'];

    $sql = "SELECT * FROM tbproduk WHERE produk_id = $produk_id"; 
    
    $query = mysqli_query($conn,$sql);
}


if(isset($_POST['submit'])){

    $produk = htmlspecialchars($_POST['product']);
    $kategori = intval($_POST['kategori_id']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $harga = intval($_POST['harga']);
    $stok = intval($_POST['stok']);
    $status = htmlspecialchars($_POST['radio']);
    $image = upload($_FILES['gambar']);
    $format_file = $_FILES['gambar']['type'];

    switch ($image) {
        case '1':
            echo "<script>alert('Maaf extensi yang anda upload bukan gambar')</script>";
            break;
        case '2':
            echo "<script>alert('Maaf ukuran gambar terlalu besar')</script>";
            break;
        case '3':
            echo "<script>alert('gagal mengaupload gambar')</script>";
            break;
    }

    // jika size kosong maka tidak update gambar
    if($_FILES['gambar']['size'] == 0 ){

        $sql = " UPDATE tbproduk SET `nama_produk`='$produk', `kategori_id` = $kategori , `deskripsi` = '$deskripsi', `harga`  = $harga, `stok` = $stok, `status` = '$status' WHERE produk_id = $produk_id ";

    }else{
        $sql = " UPDATE tbproduk SET `nama_produk`='$produk', `kategori_id` = $kategori , `deskripsi` = '$deskripsi', `gambar` = '$image' , `tipe-file` = '$format_file' , `harga`  = $harga, `stok` = $stok, `status` = '$status' WHERE produk_id = $produk_id ";

    }

    mysqli_query($conn,$sql);

    if(mysqli_affected_rows($conn)){
        echo "<script>alert('Sukses mengupdate produk')</script>";
        header('Location:index.php?page=produk');
    }else{
        echo $sql;
        Header('Location:index.php?page=produk');
    }

}

?>

<div id="main-frame-insert">

    <div id="header-form form-group noto-sans-font">
    
        <h3 class="w-50">Update Product</h3>

    </div>

    <form action="" method="post" enctype="multipart/form-data">

        <?php foreach($query AS $key): ?>

        <div class="content-form form-group">

            <input class="form-control w-50" type='text' name='product' value="<?=$key['nama_produk']?>">

        </div>

        <div class="content-form form-group">

            <select class="form-control w-50" name="kategori_id" id="kategori">
                <?php foreach($kategori AS $row): ?>
                    <option value="<?=$row['kategori_id']?>" <?php if($row['kategori_id']==$key['kategori_id']) echo "selected"?>><?= $row['nama_ktg']; ?></option>
                <?php endforeach; ?>

            </select>

        </div>

        <div class="content-form form-group">

            <textarea class="form-control w-50" name="deskripsi" id="deskripsi"><?=$key['deskripsi']?></textarea>

        </div>

        <div class="content-form form-group">

            <input type='file' name="gambar" class="form-control-file w-50">
            
        </div>

        <div class="content-form form-group">
            
            <img style="width:100px; border-radius:3px" src="modul/produk/view_images.php?id=<?=$key['produk_id']?>" alt="<?=$key['nama_produk']?>">

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='harga' value="<?=$key['harga']?>">

        </div>


        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='stok' value="<?=$key['stok']?>"'>

        </div>

        <div class="content-form form-group">
        
            <input id="on" type="radio" name="radio" value="on" <?php if($key['status'] == "on" ) echo "checked" ?>>
            <label for="on">On</label>
            <input id="off" type="radio" name="radio" value="off" <?php if($key['status'] == "off" ) echo "checked" ?>>
            <label for="off">Off</label>

        </div>
        
        <div class="content-form">

            <button class="btn btn-success w-50" name="submit">Submit</button>

        </div>
        <?php endforeach; ?>
    </form>


</div>