<?php
	$user = $matkhau = "";
	$user = $_POST['username'];
	$matkhau = $_POST['password'];
		require("../Database/connect-mysql.php");
		//kiểm tra email hoặc phone có khách khác đăng ký chưa
		$sql = "SELECT * FROM `account` WHERE `username`='$user' and `password`=md5('$matkhau')";
		$result = mysqli_query($conn,$sql);
		if (!$result) // Thông báo lỗi nếu thực thi thất bại
    		die("Server đang bị lỗi, vui lòng đăng nhập sau ít phút!"); 
    	$rows = mysqli_num_rows($result); // Lấy số hàng trả về
    	//nếu số dòng>0 nghĩa là đăng nhập thành công
		if ($rows) {
			//lưu các thông tin đăng nhập cần thiết sử dụng cho các trang có liên quan
			while ($row = mysqli_fetch_array($result))
			{
				session_start();
				$_SESSION['username'] = $row['username'];
				$_SESSION['password'] = $row['password'];
				$_SESSION['roleid'] = $row['roleid'];
			}
			if($_SESSION['roleid']=='1')
				header("location:index.php");
			//else if() //kiểm tra tương tự cho bán hàng, kho
		}
		else{
			echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng!");
			window.location="login.php";</script>';
		}
		mysqli_close($conn);
?>