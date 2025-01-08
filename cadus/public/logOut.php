<?php
setcookie("token","",time() - 3600, '/');
setcookie("email","",time() - 3600, '/');
header("Location: ../index.php");
exit();