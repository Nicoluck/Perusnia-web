<?php
require('../root/base_url.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap % Fontawesome -->
  <link href="../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap % Fontawesome -->
  <title>Perusnia API</title>
</head>
<style>
  .col {
    margin-top: auto;
    margin-bottom: auto;
  }
</style>

<body>

  <div class="container">
    <h2 class="py-4">API Documentation</h2>
    <div class="row ">
      <div class="col">
        <!-- user api -->
        <div class="api mb-5">
          <h4>Users API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/user.php<span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Select all
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/user.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id}</span>
            </div>
            <div class="col">
              Select spesific data
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/Login.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Sign in
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">form-data</span>
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">x-www-form-urlencoded</span>
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/insertUser.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Insert data / Signup,
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">form-data</span>
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">x-www-form-urlencoded</span>
            </div>
          </div>
          <div class="row p-3 bg-info bg-opacity-10 border border-info rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-primary">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/updateUser.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{id}</span>
            </div>
            <div class="col">
              Update data,
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">form-data</span>,
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">id_users</span>
            </div>
          </div>
          <div class="row p-3 bg-danger bg-opacity-10 border border-danger rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-danger">DELETE</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/deleteUser.php<span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Delete data
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">x-www-form-urlencoded</span>,
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">id_users</span>
            </div>
          </div>
        </div>

        <!-- files api -->
        <div class="api mb-5">
          <h4>Files API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/files.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">(file}</span>
            </div>
            <div class="col">
              Select file
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">.pdf</span>
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">png/jpg/jpeg</span>
            </div>
          </div>
        </div>

        <!-- book api -->
        <div class="api mb-5">
          <h4>Book API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/book.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Select all
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/book.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id}</span>
            </div>
            <div class="col">
              Select spesific data
            </div>
          </div>
        </div>

        <!-- Rating book api -->
        <div class="api mb-5">
          <h4>Rating Book API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/getTopRateBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Get top rated book
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/rateBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Get All ratebook in book
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/rateBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Get user spesific rated book
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/insertFeedback.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Insert feedback
            </div>
          </div>
          <div class="row p-3 bg-info bg-opacity-10 border border-info rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-info">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/updateFeedback.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Update feedback
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/deleteFeedback.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Delete feedback
            </div>
          </div>

        </div>

        <!-- Favorite book api -->
        <div class="api mb-5">
          <h4>Favorite Book API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/favoriteBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{id_users}</span>

            </div>
            <div class="col">
              Get user all favorite book
            </div>
          </div>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/favoriteBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Get user spesific favorite book
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/insertFavoriteBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Inset Favorite Book
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST </a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/deleteFavoriteBook.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_book}</span>
            </div>
            <div class="col">
              Delete favorite book
            </div>
          </div>
        </div>

        <!-- Note api -->
        <div class="api mb-5">
          <h4>Note API</h4>
          <div class="row p-3 bg-success bg-opacity-10 border border-success rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-success">GET</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/notes.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_users}</span>

            </div>
            <div class="col">
              Get spesification note
            </div>
          </div>
          <div class="row p-3 bg-warning bg-opacity-10 border border-warning rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-warning">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/insertNote.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>
            </div>
            <div class="col">
              Insert Note
            </div>
          </div>
          <div class="row p-3 bg-info bg-opacity-10 border border-info rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-info">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/updateNote.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_notes}</span>

            </div>
            <div class="col">
              Update Note
            </div>
          </div>
          <div class="row p-3 bg-danger bg-opacity-10 border border-danger rounded mb-3">
            <div class="col-md-1">
              <a href="#" class="btn btn-light text-danger">POST</a>
            </div>
            <div class="col">
              <?= BASE_URL ?>api/deleteNote.php
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">?{api_key}</span>&
              <span class="text-danger bg-danger bg-opacity-10 px-2 rounded-pill">{id_notes}</span>

            </div>
            <div class="col">
              Delete Note
            </div>
          </div>


        </div>

      </div>
    </div>
  </div>



  <script src="../assets/bootstrap/js/popper.min.js"></script>
  <script src="../assets/fontawesome/js/all.js"></script>
  <script src="../assets/js/jquery.min.js"></script>
</body>

</html>