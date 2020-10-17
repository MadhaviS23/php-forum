<?php
session_start();

session_destroy();

header("Location: /php_projects/wediscuss/index.php");

echo"logging you out.. plaease wait";


?>