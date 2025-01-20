<?php
//logOut.php gère la déconnexion de l'utilisateur en supprimant ses cookies.
setcookie("token","",time() - 3600, '/');
setcookie("email","",time() - 3600, '/');
header("Location: ../accueil.html");
exit();