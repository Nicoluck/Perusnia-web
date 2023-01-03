<?php
session_start();
if ($_SESSION["userdata"]["id_level"] != 1) {
  header('Location:404.php');
}
$active = "bookCatalog.php";
require './layout/headerBookCenter.php';
?>

<h4 class="my-4">Book Catalog</h4>

<?php if (isset($_SESSION['success'])) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  ' . $_SESSION['success'] . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  unset($_SESSION['success']);
} ?>

<?php if (isset($_SESSION['failed'])) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  ' . $_SESSION['failed'] . '
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  unset($_SESSION['failed']);
} ?>
<a href="<?= $bookCatalog->addBook(); ?>" id="addBook" class="btn btn-success "><i class="fa-solid fa-plus"></i> Add Book</a>
<div class="table-responsive py-3">
  <table class="table table-hover align-middle " id="table">
    <thead class="bg-default shadow-sm">
      <tr>
        <th>No</th>
        <th>Cover</th>
        <th>Kode Buku</th>
        <th>Judul</th>
        <th>Author</th>
        <th>Harga</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; ?>
      <?php
      if (isset($bookCatalog->index()['book'])) :
        foreach ($bookCatalog->index()['book'] as $b) :
      ?>
          <tr>
            <td class="text-center"><?= $no++; ?></td>
            <td>
              <img src="./assets/images/<?= $b['cover']; ?>" alt="cover_buku" width="80px">
            </td>
            <td><?= $b['kode_buku']; ?></td>
            <td><?= $b['judul']; ?></td>
            <td><?= $b['author']; ?></td>
            <td>IDR <?= number_format($b['harga'], 2) ?></td>
            <td><?= $b['publication_date'] <= date("Y-m-d") ? '<span class="text-white bg-success p-1 rounded-5">Published</span>' : '<span class="text-white bg-secondary p-1 rounded-5">Pending</span>' ?></td>
            <td>
              <a href="viewPDF.php?file=<?= $b["file_buku"]; ?>" target="_blank" class="btn btn-light "><i class="fa-solid fa-eye"></i></a>
              <a href="updateBook.php?id_book=<?= $b["id_book"]; ?>" class="btn btn-warning "><i class="fa-solid fa-edit"></i></a>
              <button onclick="confirmationHapusData('deleteBook.php?id_book=<?= $b['id_book'] ?>')" class="btn btn-danger sweet-delete"><i class=" fa-solid fa-trash"></i></button>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </tbody>
  </table>
</div>



<?php require './layout/footerBookCenter.php' ?>