<?php 
    $query = getAll("SELECT * FROM tbprovinsi");

?>
<div class="header-frame-list">
    <a href="index.php?page=wilayah&action=insert_provinsi" class="btn btn-success noto-sans-font" >+Tambah</a>
</div>
<div class="table-responsive">
    <table class="table table-striped noto-sans-font mt-2 text-brown">
        <tr>
            <th>No.</th>
            <th>Provinsi_id</th>
            <th>Nama provinsi</th>
            <th>Jarak</th>
            <th>Status</th>
            <th class="text-center">Aksi</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach($query AS $key): ?>
        <tr>
            <td><?= $i ?></td>
            <td><?= $key['prov_id'] ?></td>
            <td><?= $key['nama_prov'] ?></td>
            <td><?= $key['jarak'] ?> Km</td>
            <td><?= $key['status'] ?></td>
            <td class="text-center">
                <a href="index.php?page=wilayah&action=update_provinsi&id=<?=$key['prov_id']?>" class="btn btn-sm btn-info">Edit</a>|
                <a href="index.php?page=wilayah&action=delete_provinsi&id=<?=$key['prov_id']?>" onclick="return confirm('yakin, menghapus data?')" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</div>