<?php
$active = "about_website.php";
require './layout/headerBookCenter.php';
require_once './controller/GaleryController.php';

if (isset($_POST["submit"])) {
    $galeri = new GaleryController();
    if ($galeri->addGaleri($_POST) > 0) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil di tambahkan
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Data berhasil di update
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
}
?>

<h4 class="my-4"><a href="galeri.php" class=" pe-3 btn-back"><i class="fa-solid fa-arrow-left text-dark"></i></a>Input Gambar</h4>

<form action="" method="post" enctype="multipart/form-data">
    <!-- rows -->
    <div class="mb-3">
        <div class="form-group">
            <input type="file" name="gambar" class="form-control mt-4 mb-4" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="3" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-success">Simpan</button>
</form>





<?php require './layout/footerBookCenter.php' ?>