<?php
//require("sqlog.php");

session_start();
session_destroy();
header("Location: ../index.php");
