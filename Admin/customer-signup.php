<?php
$tentaikhoan = $password = $repassword = $email = $name = $phone = $roleid = $status = "";
$errtentaikhoan= $erremail = $errpassword = $errrepassword = $errname = $errphone = $errroleid = $errstatus = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tentaikhoan = $_POST['tentaikhoan'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $roleid = $_POST['roleid'];
    $status = $_POST['status'];

    if (empty($tentaikhoan) || empty($email) || empty($password) || empty($repassword) || empty($name) || empty($phone) || empty($roleid)) {
        echo '<script>alert("Vui lòng nhập đầy đủ thông tin"); document.location="../Admin/index.php?Page=add-user";</script>';
    } else if ($password != $repassword) {
        echo '<script>alert("Hai mật khẩu không khớp"); document.location="../index.php?Page=add-user";</script>';
    } else {
        include_once("../Database/connect-mysql.php");
        // Kiểm tra email hoặc số điện thoại đã tồn tại trong cơ sở dữ liệu
        $sql = "SELECT * FROM `account` WHERE `username` = '$tentaikhoan' OR `phone` = '$phone' OR `email` = '$email'";
        $result = mysqli_query($conn, $sql);
        if ($result === false) {
            die("Lỗi truy vấn SQL: " . mysqli_error($conn));
        }
            $rows = mysqli_num_rows($result); // Lấy số hàng trả về
        if ($rows) {
        echo '<script>alert("Email hoặc Số điện thoại đã có tài khoản khác");</script>';
        // document.location="index.php?Page=signup";
        mysqli_close($conn);
        exit();
            }
        else{
        $sql = "INSERT INTO `account`(`username`, `password`, `name`, `phone`,`email`, `roleid`, `status`)
        VALUES ('$tentaikhoan',md5('$password'),'$name','$phone','$email','$roleid','$status')";
        // Thực hiện truy vấn SQL
        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Đăng ký thành công!"); document.location="../Admin/index.php?Page=user";</script>';
        } else {
            die("Lỗi đăng ký thất bại, vui lòng thử lại sau ít phút!" . mysqli_error($conn));
        }}
        // Đóng kết nối CSDL
        mysqli_close($conn);
    }
}
?>
