<?php
session_start(); // Khởi đầu phiên làm việc
$matkhaucu = $matkhaumoi = $matkhaumoi2= "";
$matkhaucu = $_POST['password'];
$matkhaumoi = $_POST['newpassword'];
$matkhaumoi2 = $_POST['confirmpassword'];
if(!$matkhaucu || !$matkhaumoi ||!$matkhaumoi2)
{
    echo '<script>alert("Vui lòng nhập đầy đủ các mật khẩu");document.location="../Admin/index.php?Page=change-password";</script>';
}
else if (md5($matkhaucu) != $_SESSION['password'])
{
    echo '<script>alert("Mật khẩu cũ không đúng"); 
    document.location="../Admin/index.php?Page=change-password";</script>';
}
else if($matkhaumoi != $matkhaumoi2)
{ 
    echo '<script>alert("Xác nhận mật khẩu không chính xác");document.location="../Admin/index.php?Page=change-password";</script>';
}
else
{ include_once("../Database/connect-mysql.php");
    // Kiểm tra email hoặc số điện thoại có khách hàng đăng ký chưa
    $sql = "UPDATE `account` SET `password` = md5('$matkhaumoi') WHERE `username` = '" . $_SESSION['username'] . "'";
    $result = mysqli_query($conn, $sql);
    if (!$result) 
    die("Lỗi cơ sở dữ liệu: " . mysqli_error($conn));
    // Thông báo lỗi nếu thực thi thất bại
        $_SESSION['password'] = $matkhaumoi;
        echo '<script>alert("doi mk thanh cong"); document.location="../Admin/index.php?Page=change-password";</script>';
        mysqli_close($conn); 
}

?>