<?php

session_start();
if ($_SESSION["userdata"]["id_level"] != 1) {
  header('Location:404.php');
}

$active = "edit_about.php";
require './layout/headerBookCenter.php';
require_once './controller/AboutController.php';
$about = new AboutController();


if (isset($_POST['submit'])) {
  if ($about->update($_POST['id_about']) > 0) {
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

$data = $about->index();

?>

<h4 class="my-4">Edit About Website</h4>

<div class="col-md-10">
  <form action="" method="post" enctype="multipart/form-data">
    <div class="col-md-2">
      <input type="hidden" name="id_about" id="" value="<?= $data['id_about'] ?>">
      <label for="foto_about" class="form-label">About Picture</label>
      <img src="./assets/images/<?= $data['foto_about']; ?>" class="img-thumbnail" alt="cover_about">
    </div><br>
    <div class="col-md-10">
      <div class="mb-3">
        <input type="file" name="gambar" id="about" class="form-control <?= isset($failed['foto_about']['required']) || isset($failed['foto_about']['extension']) || isset($failed['foto_about']['size']) ? 'is-invalid' : '' ?>">
        <div id="about" class="invalid-feedback">
          <?php ($failed['foto_about']) ?>
        </div>
      </div>
      <div class="mb-3">
        <div class="mb-3"><br>
          <label for="exampleFormControlTextarea1" class="form-label">Deskripsi</label>
          <textarea class="form-control" name="deskripsi" id="exampleFormControlTextarea1" rows="10" required><?= $data['isi_about'] ?></textarea>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <button type="submit" name="submit" class="btn btn-success px-5"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
    </div>
  </form>
</div>

<?php
require_once './layout/footerBookCenter.php';
?>