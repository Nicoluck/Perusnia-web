<?php
require 'root/base_url.php';
$filename = $_GET['file'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Read book page</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- Flipbook StyleSheet -->
  <link href="./assets/dflip/css/dflip.min.css" rel="stylesheet" type="text/css">
  <!-- Icons Stylesheet -->
  <link href="./assets/dflip/css/themify-icons.min.css" rel="stylesheet" type="text/css">

  <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>

  <div id="flipbookContainer">
  </div>


  <!-- jQuery  -->
  <script src="./assets/dflip/js/libs/jquery.min.js" type="text/javascript"></script>
  <!-- Flipbook main Js file -->
  <script src="./assets/dflip/js/dflip.min.js" type="text/javascript"></script>
  <!-- Flipbook main Js file -->
  <script>
    jQuery(document).ready(function() {
      //uses source from online(make sure the file has CORS access enabled if used in cross domain)
      var pdf = '<?= BASE_URL ?>api/files.php?api_key=fasih123&file=<?= $filename; ?>';
      var options = {
        height: 1000,
        duration: 700,
        backgroundColor: "#fffff",
        enableDownload: false,
        overwritePDFOutline: true,
        allControls: "altPrev,pageNumber,altNext,play,outline,thumbnail,zoomIn,zoomOut,fullScreen,download,more,pageMode,startPage,endPage,sound",
        spotLightIntensity: 0.22,
        ambientLightColor: "#fffff",
        ambientLightIntensity: 0.8,
        shadowOpacity: 0.15
      };
      var flipBook = $("#flipbookContainer").flipBook(pdf, options);
    });
  </script>

</body>

</html>