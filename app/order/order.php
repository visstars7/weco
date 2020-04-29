<?php 

// session_start();

if(!isset($_SESSION['keranjang']) || !isset($_SESSION['user'])){
    Header('Location:index.php?page=home');
}

include_once 'helper/helper.php';

$pdo  = PDO();
$pdoStatementViewProv = $pdo->prepare("SELECT * FROM tbprovinsi WHERE status = 'on'");
$pdoStatementViewProv->execute();
$provinsi = $pdoStatementViewProv->fetchAll(PDO::FETCH_ASSOC);

$pdoStatementViewkota = $pdo->prepare("SELECT * FROM tbkota WHERE status = 'on' ");
$pdoStatementViewkota->execute();
$kota = $pdoStatementViewkota->fetchAll(PDO::FETCH_ASSOC);

$pdoStatementViewKec = $pdo->prepare("SELECT * FROM tbkecamatan WHERE status = 'on' ");
$pdoStatementViewKec->execute();
$kec = $pdoStatementViewKec->fetchAll(PDO::FETCH_ASSOC);

// filtering jika array yang di $_GET ada dalam produk
$arrayID = [];
foreach($_SESSION['keranjang'] AS $key){
    $arrayID[] = $key['produk_id']; 
}


$no = 1;

// var_dump($_SESSION['keranjang']);

?>

<?php if(isset($_GET['id'])): ?>

    <?php if(in_array($_GET['id'],$arrayID) == true): ?>

        <div class="row">

            <div class="col-md-4">

                <div class="product-frame">

                    <div class="title-header-product">
                    
                        <h3 class="ubuntu-font text-center">Produk yang anda beli</h3>

                    </div>

                    <div class="content-product table-responsive">
                    
                        <table class="table table-striped table-hover table-sm text-brown abel-font">

                            <thead>

                                <tr>
                                    <th>No.</th>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Gambar</th>
                                    <th>Qty</th>
                                    <th class="text-center">harga</th>

                                </tr>

                            </thead>

                            <tbody>
                                <?php if(isset($_GET['id'])): ?>
                                <?php 
                                    $id = intval($_GET['id']);
                                    $keranjang = $_SESSION['keranjang'];
                                    
                                ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $keranjang[$id]['nama_produk'] ?></td>
                                    <td><img style="width:150px" src="order/image.php?id=<?=$keranjang[$id]['produk_id']?>" alt="<?= $keranjang[$id]['nama_produk'] ?>"></td>
                                    <td class="text-center"><?= $keranjang[$id]['qty'] ?></td>
                                    <td><?=rupiah($keranjang[$id]['qty']*$keranjang[$id]['harga'])?></td>
                                    
                                </tr>

                                <?php endif; ?>
                            
                            </tbody>

                        </table>
                    
                    </div>
                
                </div>

            </div>

            <div class="col-md-8">

                <div class="stranger-frame">

                    <form action="order/orderInsert.php" method="post">
                    
                        <ul class='form-group'>
                        
                            <li>
                            
                                <label for='penerima'>Nama Penerima</label>
                                <input class="form-control" type='text' name='penerima' id='penerima' placeholder='penerima'>
                                <input class="form-control" type='hidden' name='id' id='id' placeholder='penerima' value="<?=$_GET['id']?>">
                            
                            </li>

                            <li>
                            
                                <label for='nomor'>Telp penerima</label>
                                <input class="form-control" type='number' max-length="12" name='nomor' id='nomor' placeholder='nomor'>
                            
                            </li>

                            <li>
                            
                                <label for='penerima'>Alamat Penerima</label>
                                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                            
                            </li>

                            <li class="form-row">
                                <div class="col-4">

                                    <label for='kota'>Kota </label>
                                    <select class="form-control" name="kota" id="kota">
                                        <?php foreach($kota AS $key): ?>
                                            <option value="<?=$key['kota_id']?>"><?= $key['nama_kota'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                
                                </div>
                                            
                                <div class="col-4">
                                
                                    <label for='kecamatan'>kecamatan</label>
                                    <select class="form-control" name="kecamatan" id="kecamatan">

                                        <?php foreach($kec AS $key): ?>
                                            <option value="<?=$key['kec_id']?>"><?= $key['nama_kec'] ?></option>
                                        <?php endforeach; ?>
                                    
                                    </select>
                                
                                </div>
                                
                                <div class="col-4">

                                    <label for='provinsi'>provinsi</label>
                                    <select class="form-control" name="provinsi" id="provinsi">
                                        <?php foreach($provinsi AS $key): ?>
                                            <option value="<?=$key['prov_id']?>"><?= $key['nama_prov'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                </div>

                            <li>
                            
                                <label for='kode pos'>Kode Pos</label>
                                <input class="form-control" type='number' name='kodepos' id='kode pos' placeholder='kode pos'>
                            
                            </li>

                            <li class="mt-2 text-center">
                        
                                <button class="btn btn-info w-50" name="data-penerima" >Kirim</button>
                        
                            </li>
                        
                        
                        </ul>
                    
                    </form>

                </div>

            </div>


        </div>

    <?php else: ?>

    <?php 

        Header('Location:index.php?page=home');
        
    ?>

    <?php endif; ?>

<?php else: ?>

    <div class="row">

        <div class="col-md-4">

            <div class="product-frame">

                <div class="title-header-product">
                
                    <h3 class="ubuntu-font text-center">Produk yang anda beli</h3>

                </div>

                <div class="content-product table-responsive">
                
                    <table class="table table-striped table-hover table-sm text-brown abel-font">

                        <thead>

                            <tr>
                                <th>No.</th>
                                <th class="text-center">Product</th>
                                <th class="text-center">Gambar</th>
                                <th>Qty</th>
                                <th class="text-center">harga</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach($_SESSION['keranjang'] AS $row): ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $row['nama_produk'] ?></td>
                                <td><img style="width:150px" src="order/image.php?id=<?=$row['produk_id']?>" alt="<?= $row['nama_produk'] ?>"></td>
                                <td class="text-center"><?= $row['qty'] ?></td>
                                <td><?=rupiah($row['qty']*$row['harga'])?></td>
                                
                            </tr>
                                <?php $no++ ?>
                                <?php endforeach; ?>
                        
                        </tbody>

                    </table>
                
                </div>
            
            </div>

        </div>

        <div class="col-md-8">

            <div class="stranger-frame">

                <form action="order/orderInsert.php" method="post">
                
                <ul class='form-group'>
                        
                        <li>
                        
                            <label for='penerima'>Nama Penerima</label>
                            <input class="form-control" type='text' name='penerima' id='penerima' placeholder='penerima'>
                        
                        </li>

                        <li>
                        
                            <label for='nomor'>Telp penerima</label>
                            <input class="form-control" type='number' max-length="12" name='nomor' id='nomor' placeholder='nomor'>
                        
                        </li>

                        <li>
                        
                            <label for='penerima'>Alamat Penerima</label>
                            <textarea class="form-control" name="alamat" id="alamat"></textarea>
                        
                        </li>

                        <li class="form-row">
                            <div class="col-4">

                                <label for='kota'>Kota </label>
                                <select class="form-control" name="kota" id="kota">
                                    <?php foreach($kota AS $key): ?>
                                        <option value="<?=$key['kota_id']?>"><?= $key['nama_kota'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            
                            </div>
                                        
                            <div class="col-4">
                            
                                <label for='kecamatan'>kecamatan</label>
                                <select class="form-control" name="kecamatan" id="kecamatan">

                                    <?php foreach($kec AS $key): ?>
                                        <option value="<?=$key['kec_id']?>"><?= $key['nama_kec'] ?></option>
                                    <?php endforeach; ?>
                                
                                </select>
                            
                            </div>
                            
                            <div class="col-4">

                                <label for='provinsi'>provinsi</label>
                                <select class="form-control" name="provinsi" id="provinsi">
                                    <?php foreach($provinsi AS $key): ?>
                                        <option value="<?=$key['prov_id']?>"><?= $key['nama_prov'] ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>

                        <li>
                        
                            <label for='kode pos'>Kode Pos</label>
                            <input class="form-control" type='number' name='kodepos' id='kode pos' placeholder='kode pos'>
                        
                        </li>

                        <li class="mt-2 text-center">
                        
                            <button class="btn btn-info w-50" name="data-penerima" >Kirim</button>
                        
                        </li>
                        
                    
                    </ul>
                
                </form>

            </div>

        </div>


        </div>

<?php endif; ?>