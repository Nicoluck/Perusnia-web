<?php

session_start();
if ($_SESSION["userdata"]["id_level"] != 1) {
    header('Location:404.php');
}

$active = "about_website.php";
require './layout/headerBookCenter.php';
require_once './controller/GaleryController.php';
$galery = new GaleryController();
$data = $galery->tampil();
?>

<h4 class="my-4">Galeri Perusnia</h4>
<a href="galeri_input.php" id="addBook" class="btn btn-success "><i class="fa-solid fa-plus"></i> Add Picture</a>
<div class="table-responsive py-3">
    <table class="table table-hover" id="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Deskripsi</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data as $d) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><img src="./assets/images/<?= $d['foto'] ?>" alt="Foto Perusnia" width="200px"></td>
                    <td><?= $d['deskripsi']; ?> </td>
                    <td>
                        <a href="galeri_edit.php?id_galeri=<?= $d['id_galeri']; ?>" class="btn btn-warning"><i class=" fa fa-edit" role="button"></i></a>
                        <a onclick="confirmationHapusData('deleteGalery.php?id_galeri=<?= $d['id_galeri']; ?>')" class="btn btn-danger" role="button"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php require './layout/footerBookCenter.php' ?>