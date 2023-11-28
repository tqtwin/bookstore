<!DOCTYPE html>
<html>
<head>
  <title>Quản lý Danh mục</title>
</head>
<body>
  <h1>Quản lý Danh mục</h1>

  <div class="table-responsive">          
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Mã danh mục</th>
          <th>Tên danh mục</th>
          <th>Mô tả</th>
          <th>Xử lý</th>
        </tr>
      </thead>
      <tbody>
      <?php
        require("../Database/connect-mysql.php");

        // Kiểm tra nếu dữ liệu đã được gửi từ biểu mẫu thêm danh mục
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
            if ($_POST['action'] == 'add') {
                $categoryname = $_POST['categoryname'];
                $description = $_POST['description'];

                // Thêm danh mục vào cơ sở dữ liệu
                $sql = "INSERT INTO `category` (`categoryname`, `description`) VALUES ('$categoryname', '$description')";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<script>alert("Thêm danh mục thành công!");</script>';
                } else {
                    echo '<script>alert("Lỗi thêm danh mục: ' . mysqli_error($conn) . '");</script>';
                }
            } elseif ($_POST['action'] == 'delete') {
                $categoryid = $_POST['categoryid'];

                // Xóa danh mục từ cơ sở dữ liệu
                $sql = "DELETE FROM `category` WHERE `categoryid` = $categoryid";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    echo '<script>alert("Xóa danh mục thành công!");</script>';
                } else {
                    echo '<script>alert("Lỗi xóa danh mục: ' . mysqli_error($conn) . '");</script>';
                }
            }
        }

        // Truy vấn danh sách danh mục và hiển thị trên bảng
        $sql = "SELECT `categoryid`, `categoryname`, `description` FROM `category`";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          die("Lỗi lấy dữ liệu danh mục, lỗi: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($result)) {
          echo '<tr>';
          echo '<td>' . $row['categoryid'] . '</td>';
          echo '<td>' . $row['categoryname'] . '</td>';
          echo '<td>' . $row['description'] . '</td>';
          echo '<td>';
          echo '<form method="post" action="?Page=category">';
          echo '<input type="hidden" name="action" value="delete">';
          echo '<a href="?Page=category-update&categoryid=' . $row['categoryid'] . '" class="btn btn-primary btn-sm" style="margin-right: 5px;">Sửa</a>';
          echo '<input type="hidden" name="categoryid" value="' . $row['categoryid'] . '">';
          echo '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Bạn có chắc chắn muốn xóa danh mục này?\')">Xóa</button>';
          echo '</form>';
          echo '</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
  <h2>Thêm Danh mục</h2>
  <form method="post" action="?Page=category">
    <input type="hidden" name="action" value="add">
    <label for="categoryname">Tên danh mục:</label>
    <input type="text" name="categoryname" required><br>
    <label for="description">Mô tả:</label>
    <input type="text" name="description" required><br>
    <input type="submit" value="Thêm">
  </form>
</body>
</html>
