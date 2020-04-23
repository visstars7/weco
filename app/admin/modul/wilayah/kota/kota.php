
<?php 

$query = getAll("SELECT * FROM tbkota");

if(isset($_SESSION['message'])){
    echo $_SESSION['message'];
}

?>
<div class="header-frame-list">
    <a href="index.php?page=wilayah&action=insert_kota" class="btn btn-success noto-sans-font" >+Tambah</a>
</div>
<div class="table-responsive">
    <table class="table table-striped noto-sans-font mt-2 text-brown">
        <tr>
            <th>No.</th>
            <th>kota_id</th>
            <th>Nama kota</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
        <?php $i=1; ?>
        <?php foreach($query AS $key): ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $key['kota_id']; ?></td>
            <td><?= $key['nama_kota']; ?></td>
            <td><?= $key['status']; ?></td>
            <td class="text-center">
                <a href="index.php?page=wilayah&action=update_kota&id=<?=$key['kota_id']?>" class="btn btn-sm btn-info">Edit</a>|
                <a href="index.php?page=wilayah&action=delete_kota&id=<?=$key['kota_id']?>" onclick="return confirm('yakin,menghapus data?')"class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</div>