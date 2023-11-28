<?php
  session_start();
  if (!isset($_SESSION['username']) || $_SESSION['roleid'] != '1') {
    echo '<script>alert("Vui lòng đăng nhập để vào trang này!");
        window.location="admin-login.php";
    </script>';
    exit();
  }
?>

<?php
  // Thiết lập các giá trị ban đầu của phân trang gồm: số trang, số sp/1 trang, tổng số sp
  if (!isset($_SESSION['category'])) $_SESSION['category'] = 'Chọn loại sách';
  if (!isset($_SESSION['pagesize'])) $_SESSION['pagesize'] = 10;
  if (!isset($_SESSION['totalbook'])) {
    include_once("../Database/DBHandle.php");
    $DB = new Database();
    $result = $DB->GetData("SELECT `bookid` FROM `book`;");
    if ($result != NULL) {
      $_SESSION['totalbook'] = mysqli_num_rows($result);
    } else $_SESSION['totalbook'] = 0;
  }
  if (isset($_REQUEST['pagesize'])) $_SESSION['pagesize'] = $_REQUEST['pagesize'];
  if (isset($_REQUEST['category'])) $_SESSION['category'] = $_REQUEST['category'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trang quản trị - shop cây cảnh online</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style type="text/css">
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
    }

    .container-fluid {
      margin-top: 20px;
    }

    .col-sm-2 {
      background-color: #f8f9fa;
      border-right: 1px solid #d6d8db;
      padding: 15px;
    }
    .col-sm-2 h6 {
      margin-top: 0;
    }

    .menu-button a {
      text-decoration: none;
      color: #000;
    }

    .menu-button .btn {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }
    .menu-button .btn.selected {
      background-color: yellow;
      color: black;
    }
    .col-sm-10 {
      padding: 15px;
      background-color: #fff;
      border: 1px solid #d6d8db;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <h6>Tài khoản</h6>
        <div class="btn-group-vertical">
          <a href="?Page=user" class="menu-button <?php if($current_page == "user") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Quản lý tài khoản</button>
          </a>
          <a href="../Admin/customer-logout.php" class="menu-button">
            <button type="button" class="btn btn-primary" style="width: 200px;">Đăng xuất</button>
          </a>
          <a href="?Page=change-password" class="menu-button <?php if($current_page == "change-password") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Đổi mật khẩu</button>
          </a>
          <a href="?Page=update-info" class="menu-button <?php if($current_page == "update-info") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Cập nhật thông tin</button>
          </a>
        </div>
        <h6>Danh mục</h6>
        <div class="btn-group-vertical">
          <a href="?Page=category" class="menu-button <?php if($current_page == "category") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Loại cây cảnh</button>
          </a>
          <a href="?Page=item" class="menu-button <?php if($current_page == "item") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Cây cảnh</button>
          </a>
        </div>
        <h6>Bán hàng</h6>
        <div class="btn-group-vertical">
          <a href="?Page=status" class="menu-button <?php if($current_page == "status") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Danh mục trạng thái</button>
          </a>
          <a href="?Page=order" class="menu-button <?php if($current_page == "order") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Xử lý đơn hàng</button>
          </a>
        </div>
        <h6>Thống kê báo cáo</h6>
        <div class="btn-group-vertical">
          <a href="?Page=doanh-thu" class="menu-button <?php if($current_page == "doanh-thu") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Doanh thu</button>
          </a>
          <a href="?Page=san-pham-ban-chay" class="menu-button <?php if($current_page == "san-pham-ban-chay") echo 'selected'; ?>">
            <button type="button" class="btn btn-primary" style="width: 200px;">Sản phẩm bán chạy</button>
          </a>
        </div>
      </div>
      <div class="col-sm-10">
        <?php
           if(isset($_REQUEST['Page'])){
            if($_REQUEST['Page']=="item")
              include("item.php");
            else if($_REQUEST['Page']=="order")
              include("order.php");
            else if($_REQUEST['Page']=="item-add")
              include("item-add.php");
            else if($_REQUEST['Page']=="order-detail")
              include("order-detail.php");
            else if($_REQUEST['Page']=="category")
              include("category.php");
            else if($_REQUEST['Page']=="user")
              include("user.php");
            else if($_REQUEST['Page']=="change-password")
              include("change-password.php");
            else if($_REQUEST['Page']=="item-edit")
              include("item-edit.php");
            else if($_REQUEST['Page']=="add-user")
              include("add-user.php");
              else if($_REQUEST['Page']=="category-update")
              include("category-update.php");
            else if($_REQUEST['Page']=="doanh-thu")
              include("doanh-thu.php");
            else if($_REQUEST['Page']=="san-pham-ban-chay")
              include("san-pham-ban-chay.php");
              else if($_REQUEST['Page']=="status")
              include("status.php");
              else if($_REQUEST['Page']=="update-info")
              include("update-info.php");
          }
        ?>
      </div>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Bắt sự kiện khi một phần được chọn
    $(".menu-button").click(function() {
        // Loại bỏ lớp "selected" từ tất cả các phần khác
        $(".menu-button").removeClass("selected");
        // Thêm lớp "selected" vào phần đang được chọn
        $(this).addClass("selected");
    });
});
</script>
</html>
