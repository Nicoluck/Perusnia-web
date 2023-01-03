<?php
require 'root/base_url.php';

$filename = $_GET['file'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $_GET['file']; ?></title>
  <style type="text/css">
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
    }
  </style>
</head>

<body>

  <object data="<?= BASE_URL ?>api/files.php?api_key=fasih123&file=<?= $filename; ?>" type="application/pdf" width="100%" height="100%">
    <p>Your web browser doesn't have a PDF plugin.
      Instead you can <a href="filename.pdf">click here to
        download the PDF file.</a></p>
  </object>
</body>

</html>