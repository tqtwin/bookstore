<?php
require("../Database/DBHandle.php"); // Import your DBHandle class
$DB = new Database(); // Create an instance of your DBHandle class

if (!isset($_SESSION['name'])) {
    header("Location: admin-login.php");
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
 
    $sql = "UPDATE `account` SET `name` = '$newName', `email` = '$newEmail' WHERE `username` = '" . $_SESSION['username'] . "'";
    $result = $DB->ExecuteSQL($sql);
    
    if ($result) {
        echo '<script>alert("Thông tin người dùng đã được cập nhật!");</script>';
        echo '<script>window.location = "index.php?Page=update-info";</script>';
    } else {
        echo '<script>alert("Lỗi cập nhật thông tin người dùng: ' . mysqli_error($conn) . '");</script>';
    }
}
$sql = "SELECT `name`, `email` FROM `account` WHERE `username` = '" . $_SESSION['username'] . "'";
$result = $DB->GetData($sql);

if ($result != NULL) {
    $row = mysqli_fetch_array($result);
    $currentName = $row['name']; 
    $currentEmail = $row['email'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cập nhật thông tin người dùng</title>
</head>
<body>
  <h1>Cập nhật thông tin người dùng</h1>
  <form method="post" action="">
    <label for="name">Tên:</label>
    <input type="text" name="name" value="<?php echo $currentName; ?>"><br>
    <label for="email">Email:</label>
    <input type="text" name="email" value="<?php echo $currentEmail; ?>"><br>
    <input type="submit" value="Cập nhật">
  </form>
</body>
</html>
