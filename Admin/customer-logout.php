
<?php
unset($_SESSION['username']);
unset($_SESSION['name']);
unset($_SESSION['password'] );
unset($_SESSION['phone']);
unset($_SESSION['address']);
unset($_SESSION['roleid']);
unset($_SESSION['status']);
header("location:../Admin/login.php");
?>
