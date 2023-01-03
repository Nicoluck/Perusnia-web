<?php
$active = "setting.php";
require './layout/headerBookCenter.php';
?>

<?php
if (isset($_POST["submit"])) {
  if ($user->update($_SESSION['userdata']['id_users']) > 0) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Data berhasil di update
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Data gagal di update
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
}

?>

<h4 class="my-4">Setting Account</h4>

<form action="" method="post" enctype="multipart/form-data">
<img src="<?= isset($user->getUserById($_SESSION['userdata']['id_users'])['foto']) ? "./assets/images/" . $user->getUserById($_SESSION['userdata']['id_users'])['foto'] : "./assets/images/default_image.png" ?>" class="rounded" width="200px" >
<input type="file" name="foto" class="form-control mt-4 mb-4">

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">username</label>
  <input type="text" name="username"  class="form-control" id="exampleFormControlInput1" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['username']?>">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Nama_Depan</label>
  <input type="text" name="nama_depan" class="form-control" id="exampleFormControlInput1" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['nama_depan']?>">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Nama_Belakang</label>
  <input type="text" name="nama_belakang" class="form-control" id="exampleFormControlInput1" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['nama_belakang']?>">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Tgl_Lahir</label>
  <input type="date" name="tgl_lahir" class="form-control" id="exampleFormControlInput1" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['tgl_lahir']?>">
</div>



    <p>Jenis Kelamin</p>
    <p><input type='radio' name='jenis_kelamin' value='pria' <?=$user->getUserById($_SESSION['userdata']['id_users'])['jenis_kelamin'] == "laki-laki" ? "checked" : "" ?> />Laki-laki</p>
    <p><input type='radio' name='jenis_kelamin' value='perempuan' <?=$user->getUserById($_SESSION['userdata']['id_users'])['jenis_kelamin'] == "perempuan" ? "checked" : "" ?> />Perempuan</p>


<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">No_Telp</label>
  <input type="text" name="no_telp" class="form-control" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['no_telp']?>" id="exampleFormControlInput1">
</div>

<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
  <textarea class="form-control" name="alamat"  id="exampleFormControlTextarea1" rows="3"><?=$user->getUserById($_SESSION['userdata']['id_users'])['alamat']?></textarea>
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Negara</label>
  <input type="text" name="negara" class="form-control" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['negara']?>" id="exampleFormControlInput1">
</div>

<div class="mb-5">
  <label for="exampleFormControlInput1" class="form-label">Kota</label>
  <input type="text" name="kota" class="form-control" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['kota']?>" id="exampleFormControlInput1">
</div>

<div class="mb-4">
  <label for="exampleFormControlInput1" class="form-label">Email</label>
  <input type="email" name="email" class="form-control" value="<?=$user->getUserById($_SESSION['userdata']['id_users'])['email']?>" id="exampleFormControlInput1" placeholder="name@gmail.com">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password</label>
  <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
</div>

<div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password verification</label>
  <input type="password" name="password_verification" class="form-control" id="exampleFormControlInput1">
</div>

<button type="submit" name="submit" class="btn btn-success px-5"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
</form>

<?php
require_once './layout/footerBookCenter.php';
?>