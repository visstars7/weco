<?php 

$conn = conn();

$kota = getAll("SELECT * FROM tbkota");
$provinsi = getAll("SELECT * FROM tbprovinsi");
$kecamatan = getAll("SELECT * FROM tbkecamatan");
$option = isset($_POST['destination']) ? "modul/wilayah/".$_POST['destination']."/".$_POST['destination'].".php" : false;

$ViewDefault = "modul/wilayah/provinsi/provinsi.php";

$wilayahOpt = false;

if(isset($_GET['action'])){
    $explode = explode('_',$_GET['action']);
    $wilayahOpt = isset($_GET['action'])? "modul/wilayah/".$explode[1]."/".$_GET['action'].".php":false;
}

if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

    
?>

<div id="frame-nav-product" class="row mt-2">

    <div class="col-md-12 col-sm-12 col-12 float-right">
    
        <form action="" method="post">

            <div id="frame-search">
            
                <input type="search" class="input-form noto-sans-font" placeholder="Search Produk..">
                <button name="search" class="search-btn noto-sans-font">search</button>

            </div>

            <div id="frame-select">
                <?php if(isset($_POST['destination'])): ?>
                <select name="destination" id="wilayah">

                    <option <?php if($_POST['destination'] == 'kota') echo "selected"?> value="kota">Kota</option>
                    <option <?php if($_POST['destination'] == 'provinsi') echo "selected"?> value="provinsi">Provinsi</option>
                    <option <?php if($_POST['destination'] == 'kecamatan') echo "selected"?> value="kecamatan">Kecamatan</option>

                </select>

                <?php elseif(isset($_GET['action'])): ?>
                <select name="destination" id="wilayah">

                    <option <?php if($explode[1] == 'kota') echo "selected"?> value="kota">Kota</option>
                    <option <?php if($explode[1] == 'provinsi') echo "selected"?> value="provinsi">Provinsi</option>
                    <option <?php if($explode[1] == 'kecamatan') echo "selected"?> value="kecamatan">Kecamatan</option>

                </select>

                <?php else: ?>
                    <select name="destination" id="wilayah">

                    <option value="kota">Kota</option>
                    <option value="provinsi" selected >Provinsi</option>
                    <option value="kecamatan">Kecamatan</option>

                </select>
                <?php endif; ?>

                <button name="select" class="btn btn-sm btn-primary noto-sans-font">Select</button>

            </div>

        </form>

    </div>

</div>

<div id="frame-main-product">
    <?php if(file_exists($option)): ?>

        <?php include_once $option; ?>

    <?php elseif(file_exists($wilayahOpt)): ?>

        <?php include_once $wilayahOpt; ?>

    <?php else: ?>

        <?php include_once $ViewDefault; ?>
        
    <?php endif; ?>

</div>