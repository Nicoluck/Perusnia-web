<?php
$active = "bookCatalog.php";
require './layout/headerBookCenter.php';

if (isset($_POST['submit'])) {
  $bookCatalog = new bookController();
  if ($bookCatalog->editBook($_GET['id_book']) > 0) {
    $_SESSION['success'] = "Data berhasil di update!";
    header("Location: bookCatalog.php");
  }
}
if (isset($_SESSION['failed'])) {
  $failed = $_SESSION['failed'];
}



?>

<form method="post" action="" enctype="multipart/form-data" id="identifier">
  <?php foreach ($bookCatalog->updateBook($_GET['id_book'])['data'] as $b) : ?>
    <input type="hidden" name="id_users" value="2">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="my-4"><a href="bookCatalog.php" class=" pe-3 btn-back"><i class="fa-solid fa-arrow-left text-dark"></i></a> Edit a book</h4>
      <div class="save">
        <button type="submit" name="submit" class="btn btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Save new Book</button>
      </div>
    </div>

    <div class="row justify-content-center">
      <figure class="text-center">
        <blockquote class="blockquote">
          <p>About the book</p>
        </blockquote>
        <figcaption class="blockquote-footer">
          Lengkapi data tentang buku anda
        </figcaption>
        <hr>
      </figure>
      <div class="col-md-10">
        <div class="mb-3">
          <label for="judul" class="form-label">Judul</label>
          <input type="text" name="judul" class="form-control <?= isset($failed['judul']) ? 'is-invalid' : '' ?>" id="judul" placeholder="" value="<?= $b['judul']; ?>">
          <div id="judul" class="invalid-feedback">
            <?= $failed['judul'] ?>
          </div>
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi</label>
          <div name="desc-editor" class="form-control <?= isset($failed['deskripsi']) ? 'is-invalid border-danger' : '' ?>" style="height: 200px;" id="text-editor" placeholder="">
            <?= $b['description']; ?>
          </div>
          <input type="hidden" name="deskripsi" class="form-control" id="deskripsi-hidden">
          <div id="desc-editor" class="invalid-feedback">
            <?= $failed['deskripsi'] ?>
          </div>
        </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label for="kode_buku" class="form-label">Kode buku</label>
          <input type="text" name="kode_buku" id="" class="form-control text-muted" value="<?= $b['kode_buku']; ?>" readonly>
        </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label for="publication_date" class="form-label">Publication date</label>
          <input type="date" name="publication_date" class="form-control " id="publication_date" value="<?= $b['publication_date']; ?>" placeholder="">
        </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label for="publisher_name" class="form-label">Publisher name</label>
          <input type="text" name="publisher_name" class="form-control text-muted" id="publisher_name" value="<?= $b['username']; ?>" placeholder="" readonly>
        </div>
      </div>
      <div class="col-md-5">
        <div class="mb-3">
          <label for="author" class="form-label">Author</label>
          <input type="text" name="author" class="form-control <?= isset($failed['author']) ? 'is-invalid' : '' ?>" id="author" value="<?= $b['author']; ?>" placeholder="">
          <div id="author" class="invalid-feedback">
            <?= $failed['author'] ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center my-5">
      <figure class="text-center">
        <blockquote class="blockquote">
          <p>Book File</p>
        </blockquote>
        <figcaption class="blockquote-footer">
          Upload file cover dan buku digital anda
        </figcaption>
        <hr>
      </figure>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-2">
            <img src="./assets/images/<?= $b['cover']; ?>" class="img-thumbnail" alt="cover_buku">
          </div>
          <div class="col-md-10">
            <div class="mb-3">
              <label for="book_cover" class="form-label">Book Cover</label>
              <input type="file" name="book_cover" id="book_cover" class="form-control <?= isset($failed['book_cover']['required']) || isset($failed['book_cover']['extension']) || isset($failed['book_cover']['size']) ? 'is-invalid' : '' ?>">
              <div id="book_cover" class="invalid-feedback">
                <?php foreach ($failed['book_cover'] as $c) {
                  echo $c . "<br>";
                } ?>
              </div>
            </div>
          </div>
          <div class="col-md-2">

          </div>
          <div class="col-md-4">
            <div class="mb-3">
              <label for="book_file" class="form-label">Book file</label>
              <input type="file" name="book_file" id="book_file" class="form-control <?= isset($failed['book_file']['required']) || isset($failed['book_file']['extension']) ? 'is-invalid' : '' ?>">
              <a href="viewPDF.php?file=<?= $b["file_buku"]; ?>">View PDF</a>
              <div id="book_file" class="invalid-feedback">
                <?php foreach ($failed['book_file'] as $f) {
                  echo $f;
                } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row justify-content-center my-5">
      <figure class="text-center">
        <blockquote class="blockquote">
          <p>Payment option</p>
        </blockquote>
        <figcaption class="blockquote-footer">
          isikan data pembayaran buku ini
        </figcaption>
        <hr>
      </figure>
      <div class="col-md-3">
        <div class="mb-3">
          <label for="harga" class="form-label">Price</label>
          <input type='currency' name="harga" id="price-book" value="<?= $b['harga']; ?>" placeholder='' class="form-control" />
          <span class="text-muted">no need to enter symbols (. , $ Rp /)</span>
        </div>
      </div>
      <div class="col-md-7">
        <div class="mb-3">
          <label for="pembayaran" class="form-label">Metode Pembayran</label>
          <select name="pembayaran" name="pembayaran" id="" class="form-control">
            <option selected value="" class="text-muted">-</option>
            <option value="">You not have payment method</option>
          </select>
        </div>
      </div>
      <div class="col-md-10 py-5 text-center">
        <button type="submit" name="submit" class="btn btn-success px-5"><i class="fa-solid fa-floppy-disk"></i> Save new Book</button>
      </div>
    </div>
  <?php endforeach ?>
</form>

<?php unset($_SESSION['failed']) ?>
<?php require './layout/footerBookCenter.php' ?>