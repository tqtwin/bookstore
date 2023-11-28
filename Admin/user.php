<a href="?Page=add-user" style="margin-left: 5px;"><button>Thêm tài khoản</button></a>
<?php
if (!isset($_SESSION['username'])) {
    // Người dùng chưa đăng nhập, chuyển họ đến trang đăng nhập
    header("Location: admin-login.php");
    exit();
}
include_once("../Database/DBHandle.php");
$DB = new Database();
// Truy vấn để lấy thông tin tất cả người dùng
$sql = "SELECT a.username, a.name, a.email, a.phone, r.rolename, a.status 
        FROM `account` AS a 
        INNER JOIN `role` AS r ON a.roleid = r.roleid";
$result = $DB->GetData($sql);
if ($result != NULL) {
    echo "<div class='table-responsive-sm'>";
    echo "<table class='table table-bordered'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Username</th>";
    echo "<th>Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Rolename</th>";
    echo "<th>Status</th>";
    echo "<th>Xử lý</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $count = 1; // Biến đếm dòng

    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $count . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['rolename'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>";
        echo "<a href='?Page='lock-account' style='margin-left: 5px;'><button>Khóa tài khoản</button></a>";
        echo "</td>";
        echo "</tr>";
        $count++; // Tăng biến đếm dòng
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}
?>