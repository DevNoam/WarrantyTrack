<?php

session_start();
session_destroy();
header("Location: /WarrantyTrack/front/index.php");

?>