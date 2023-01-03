<?php

session_start();
if ($_SESSION["userdata"]["id_level"] != 1) {
    header('Location:404.php');
}

$active = "about_website.php";
require './layout/headerBookCenter.php';
require_once './controller/ContactController.php';
$contact = new ContactController();


if (isset($_POST["submit"])) {
    $contact = new ContactController();
    if ($contact->updateContact($_POST) > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil di update
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil di update
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
}

$data = $contact->index();
?>

<h4 class="my-4">Input Contact</h4>

<form action="" method="post">
    <!-- rows -->
    <div class="mb-3">
        <div class="form-group">
            <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="3" required><?= $data['alamat'] ?></textarea>
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Nomor Telepon</label>
        <input type="text" name="nomor" class="form-control" id="exampleFormControlInput1" value="<?= $data['telepon'] ?>" placeholder="628132xxxxx" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Hari Buka</label>
        <input type="text" name="hari" class="form-control" id="exampleFormControlInput1" value="<?= $data['hari_buka'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Jam Buka</label>
        <input type="time" name="buka" class="form-control" id="exampleFormControlInput1" value="<?= $data['jam_buka'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Jam Tutup</label>
        <input type="time" name="tutup" class="form-control" id="exampleFormControlInput1" value="<?= $data['jam_tutup'] ?>" required>
    </div>
    <!--<div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Kordinat</label>
                        <textarea class="form-control" name="kordinat"  id="exampleFormControlTextarea1" rows="3" required> </textarea>
                </div>-->
    <div class="mb-3">
        <button type="submit" name="submit" class="btn btn-success">Simpan</button>
    </div>
</form>




<?php require './layout/footerBookCenter.php' ?>