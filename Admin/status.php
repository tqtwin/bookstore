<!DOCTYPE html>
<html>
<head>
  <title>Quản lý Trạng thái</title>
</head>
<body>
  <h1>Quản lý Trạng thái</h1>
  
  <div class="table-responsive">          
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Mã trạng thái</th>
          <th>Tên trạng thái</th>
          <th>Xử lý</th>
        </tr>
      </thead>
      <tbody>
      <?php
        require("../Database/connect-mysql.php");
        // Kiểm tra nếu dữ liệu đã được gửi từ biểu mẫu cập nhật trạng thái
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_status'])) {
            $statusid_to_update = $_POST['statusid'];
            $new_statusname = $_POST['new_statusname'];

            // Cập nhật tên trạng thái trong cơ sở dữ liệu
            $sql_update = "UPDATE orderstatus SET statusname = '$new_statusname' WHERE statusid = '$statusid_to_update'";
            $result_update = mysqli_query($conn, $sql_update);
            if ($result_update) {
                echo '<script>alert("Cập nhật tên trạng thái thành công"); window.location.replace("index.php?Page=status");</script>';
                exit();
            } else {
                echo "Lỗi cập nhật trạng thái: " . mysqli_error($conn);
            }
        }

        // Truy vấn danh sách trạng thái và hiển thị trên bảng
        $sql = "SELECT * FROM orderstatus";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
          die("Lỗi lấy dữ liệu danh mục, lỗi: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($result)) {
          echo '<tr>';
          echo '<td>' . $row['statusid'] . '</td>';
          echo '<td>' . $row['statusname'] . '</td>';
          echo '<td>';
          echo '<a href="?Page=category-update&categoryid=' . $row['statusid'] . '" class="btn btn-primary btn-sm" style="margin-right: 5px;">Sửa</a>';
          echo '<form method="post" action="?Page=status" style="display: inline;">
                <input type="hidden" name="delete_status" value="' . $row['statusid'] . '">
                <input type="submit" value="Xóa" class="btn btn-danger btn-sm">
               </form>';
          echo '</td>';
          echo '</tr>';
        }
      ?>
      </tbody>
    </table>
  </div>
  <h2>Thêm Trạng thái</h2>
  <form method="post" action="?Page=status">
    <label for="statusid">Mã trạng thái:</label>
    <input type="text" name="statusid" required><br>
    <label for="statusname">Tên trạng thái:</label>
    <input type="text" name="statusname" required><br>
    <input type="submit" value="Thêm">
  </form>

  <h2>Cập nhật tên trạng thái</h2>
  <form method="post" action="?Page=status">
    <label for="statusid">Mã trạng thái:</label>
    <input type="text" name="statusid" required><br>
    <label for="new_statusname">Tên trạng thái mới:</label>
    <input type="text" name="new_statusname" required><br>
    <input type="submit" name="update_status" value="Cập nhật">
  </form>
</body>
</html>
