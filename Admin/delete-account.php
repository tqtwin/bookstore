<!DOCTYPE html>
<html>
<head>
    <title>Xóa Tài Khoản</title>
</head>
<body>
    <h1>Xóa Tài Khoản</h1>
    <?php
    // Xử lý việc xóa tài khoản ở đây
    if (isset($_GET['usernmae'])) {
        $account_id = $_GET['username'];
        if ($success) {
            echo "Tài khoản đã được xóa thành công.";
        } else {
            echo "Lỗi: Không thể xóa tài khoản.";
        }
    }
    ?>
    <p><a href="list-accounts.php">Quay lại danh sách tài khoản</a></p>
</body>
</html>
