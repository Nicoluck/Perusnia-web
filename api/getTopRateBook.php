<?php
require_once('../controller/api/feedbackController.php');
$rate = new feedbackController();

echo $rate->getTopRateBook();
