<?php
require("../Database/DBHandle.php");
$DB = new Database();

if (isset($_GET['itemid'])) {
  $itemid = $_GET['itemid'];

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ biểu mẫu và cập nhật trong cơ sở dữ liệu
    $itemid = $_POST['itemid'];
    $itemname = $_POST['itemname'];
    $description = $_POST['description'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $categoryid = $_POST['categoryid'];
    $image = $_FILES['image'];
    $images = $_FILES['images'];

    $sql = "UPDATE `item` SET `itemname` = '$itemname', `description` = '$description', `unit` = '$unit', `price` = '$price', `categoryid` = '$categoryid' WHERE `itemid` = '$itemid'";
    $result = $DB->ExecuteSQL($sql);

    if ($result) {
      // Thành công, chuyển hướng về trang danh mục bằng JavaScript
      echo '<p>Cập nhật thành công!</p>';
      echo '<script>window.location = "index.php?Page=item";</script>';
      exit();
    } else {
      echo "Lỗi cập nhật danh mục: ";
      echo $sql;
    }
  }

  // Truy vấn để lấy thông tin sản phẩm
  $sql = "SELECT * FROM `item` where `itemid` = $itemid";
  $result = $DB->GetData($sql);
  if ($result != NULL && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
  }

  // Tạo danh sách các phân loại
  $categories = $DB->GetData("SELECT * FROM `category`");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Sửa cây cảnh</title>
</head>
<body>
  <h1>Sửa cây cảnh</h1>

  <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
      <input type="text" class="form-control" value="<?php echo $row['itemname']; ?>" id="itemname" name="itemname" required>
    </div>
    <div class="form-group">
      <textarea class="form-control" id="description" name="description" rows="6"><?php echo $row['description']; ?></textarea>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" value="<?php echo $row['unit']; ?>" id="unit" name="unit">
    </div>
    <div class="form-group">
      <input type="number" class="form-control" value="<?php echo $row['price']; ?>" id="price" name="price">
    </div>
    <div class="form-group">
      <label for="categoryid">Phân loại:</label>
      <select id="categoryid" name="categoryid">
        <option value="-1">Chọn phân loại</option>
        <?php foreach ($categories as $category) : ?>
          <option value="<?php echo $category['categoryid']; ?>" <?php echo ($row['categoryid'] == $category['categoryid']) ? 'selected' : ''; ?>><?php echo $category['categoryname']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="image">Ảnh đại diện:</label>
      <input type="file" class="form-control" value="<?php echo $row['image']; ?>" id="image" name="image" readonly>
    </div>
    <div class="form-group">
      <label for="images">Ảnh chi tiết:</label>
      <input type="file" class="form-control" id="images" name="images[]" title="Chọn các ảnh chi tiết" multiple>
    </div>
    <input type="hidden" name="itemid" value="<?php echo $itemid; ?>">
    <button type="submit" class="btn btn-primary" name="save">Lưu lại</button>
    <button type="reset" class="btn btn-primary" name="cancel" onclick="document.location='index.php?Page=item';">Hủy</button>
  </form>
</body>
</html>
