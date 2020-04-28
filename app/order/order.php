<?php 

// session_start();
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

$no = 1;

// var_dump($_SESSION['keranjang']);

?>

<div class="row">

    <div class="col-md-4">

        <div class="product-frame">

            <div class="title-header-product">
            
                <h3>Produk yang anda beli</h3>

            </div>

            <div class="content-product table-responsive">
            
                <table class="table table-striped table-hover table-sm ">

                    <thead>

                        <tr>
                            <th>No.</th>
                            <th>Nama Product</th>
                            <th>Gambar</th>
                            <th>Qty</th>
                            <th>Total harga</th>

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
                            <td><?= $keranjang[$id]['qty'] ?></td>
                            <td><?=rupiah($keranjang[$id]['qty']*$keranjang[$id]['harga'])?></td>
                            
                        </tr>


                        <?php else: ?>
                            <?php foreach($_SESSION['keranjang'] AS $row): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row['nama_produk'] ?></td>
                            <td><img style="width:150px" src="order/image.php?id=<?=$row['produk_id']?>" alt="<?= $row['nama_produk'] ?>"></td>
                            <td><?= $row['qty'] ?></td>
                            <td><?=rupiah($row['qty']*$row['harga'])?></td>
                            
                        </tr>
                            <?php $no++ ?>
                            <?php endforeach; ?>

                        <?php endif; ?>
                    
                    </tbody>

                </table>
            
            </div>
        
        </div>

    </div>

    <div class="col-md-8">

        <div class="stranger-frame">

            <form action="" method="post">
            
                <ul>
                
                    <li>
                    
                        <label for='penerima'>Nama Penerima</label>
                        <input type='text' name='penerima' id='penerima' placeholder='penerima'>
                    
                    </li>

                    <li>
                    
                        <label for='nomor'>Telp penerima</label>
                        <input type='number' max-length="12" name='nomor' id='nomor' placeholder='nomor'>
                    
                    </li>

                    <li>
                    
                        <label for='penerima'>Alamat Penerima</label>
                        <textarea name="alamat" id="alamat"></textarea>
                    
                    </li>

                    <li>
                    
                        <label for='kota'>Kota Penerima</label>
                        <select name="kota" id="kota">
                            <?php foreach($kota AS $key): ?>
                                <option value="<?=$key['kota_id']?>"><?= $key['nama_kota'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    
                    </li>

                    <li>
                    
                        <label for='kecamatan'>kecamatan Penerima</label>
                        <select name="kecamatan" id="kecamatan">

                            <?php foreach($kec AS $key): ?>
                                <option value="<?=$key['kec_id']?>"><?= $key['nama_kec'] ?></option>
                            <?php endforeach; ?>
                        
                        </select>
                    
                    </li>

                    <li>
                    
                        <label for='provinsi'>provinsi Penerima</label>
                        <select name="provinsi" id="provinsi">
                            <?php foreach($provinsi AS $key): ?>
                                <option value="<?=$key['prov_id']?>"><?= $key['nama_prov'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    
                    </li>

                    <li>
                    
                        <label for='kode pos'>Kode Pos</label>
                        <input type='number' name='kode pos' id='kode pos' placeholder='kode pos'>
                    
                    </li>

                    <li>
                    
                        <button class="btn btn-info" name="data-penerima" >Kirim</button>
                    
                    </li>
                    
                
                </ul>
            
            </form>

        </div>

    </div>


</div>