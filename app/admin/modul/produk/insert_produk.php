<?php 

$conn = conn();

$kategori = getAll("SELECT kategori_id,nama_ktg FROM tbkategori WHERE `status` = 'on' ORDER BY kategori_id DESC");

if(isset($_POST['submit'])){

    $produk = $_POST['product'];
    $kategori = intval($_POST['kategori_id']);
    $deskripsi = $_POST['deskripsi'];
    $harga = intval($_POST['harga']);
    $berat = intval($_POST['berat']);
    $stok = intval($_POST['stok']);
    $format_file = $_FILES['gambar']['type'];
    $image = upload($_FILES['gambar']);

    switch ($image) {
        case '1':
            $_SESSION['error'] = "Extensi anda tidak cocok gunakan png / jpg";
            header('Location:index.php?page=produk');
            break;
        case '2':
            $_SESSION['error'] = "Ukuran File terlalu besar";
            break;
            header('Location:index.php?page=produk');
        case '3':
            $_SESSION['error'] = "Hubungi programmer";
            header('Location:index.php?page=produk');
            break;

        default:

            $sql = "INSERT INTO tbproduk (`produk_id`,`nama_produk`,`kategori_id`,`deskripsi`,`gambar`,`tipe-file`,`harga`,`berat`,`stok`,`status`)
                                    VALUES (NULL,'$produk',$kategori,'$deskripsi','$image','$format_file',$harga,$berat,$stok,'on')
            ";
        
            mysqli_query($conn,$sql);
        
            if(mysqli_affected_rows($conn)){
                echo "<script>alert('Sukses mengupload produk')</script>";
                header('Location:index.php?page=produk');
            }else{
                echo $sql;
                echo "<script>alert('Maaf,tidak bisa insert produk')</script>";
            }
        break;
    }


}

?>

<div id="main-frame-insert">
    <form action="" method="post" enctype="multipart/form-data">

        <div id="header-form form-group noto-sans-font">
        
            <h3 class="w-50">Insert Product</h3>

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='text' name='product' placeholder='Nama Product'>

        </div>

        <div class="content-form form-group">

            <select class="form-control w-50" name="kategori_id" id="kategori">
                <?php foreach($kategori AS $key): ?>
                    <option value="<?=$key['kategori_id']?>"><?= $key['nama_ktg']; ?></option>
                <?php endforeach; ?>

            </select>

        </div>

        <div class="content-form form-group">

            <textarea class="form-control w-50" name="deskripsi" id="deskripsi">Masukan Deskripsi</textarea>

        </div>

        <div class="content-form form-group">

            <input type='file' name="gambar" class="form-control-file w-50">

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='harga' placeholder='Harga'>

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='berat' placeholder='Berat barang /gram'>

        </div>

        <div class="content-form form-group">

            <input class="form-control w-50" type='number' name='stok' placeholder='stok'>

        </div>
        
        <div class="content-form">

            <button class="btn btn-success w-50" name="submit" >Submit</button>

        </div>

    </form>


</div>