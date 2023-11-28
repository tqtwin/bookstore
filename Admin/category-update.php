<!DOCTYPE html>
<html>
<head>
  <title>Sua danh mục</title>
</head>
<body>
  <h1>Sửa danh mục</h1>
  <?php
  require("../Database/connect-mysql.php");
  if (isset($_GET['categoryid'])) {
    $categoryid = $_GET['categoryid'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu từ biểu mẫu và cập nhật trong cơ sở dữ liệu
        $categoryid = $_POST['categoryid'];
        $categoryname = $_POST['categoryname'];
        $description = $_POST['description'];

        $sql = "UPDATE `category` SET `categoryname` = '$categoryname', `description` = '$description' WHERE `categoryid` = $categoryid";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // Thành công, chuyển hướng về trang danh mục bằng JavaScript
            echo '<p>Cập nhật thành công!</p>';
            echo '<script>window.location = "index.php?Page=category";</script>';
            exit();
        } else {
            echo "Lỗi cập nhật danh mục: " . mysqli_error($conn);
        }
    }

    // Truy vấn để lấy thông tin danh mục
    $sql = "SELECT `categoryid`, `categoryname`, `description` FROM `category` WHERE `categoryid` = $categoryid";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
  ?>
    <form method="post" action="">
      <input type="hidden" name="categoryid" value="<?php echo $row['categoryid']; ?>">
      <label for="categoryname">Tên danh mục:</label>
      <input type="text" name="categoryname" value="<?php echo $row['categoryname']; ?>"><br>

      <label for="description">Mô tả:</label>
      <input type="text" name="description" value="<?php echo $row['description']; ?>"><br>

      <input type="submit" value="Cập nhật">
    </form>
  <?php
    }
  }
  ?>
</body>
</html>
