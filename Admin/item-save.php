<?php
//khai báo các biến để lưu lại các giá trị nhập trên form
	$itemid = $itemname = $description = $unit = $price = $image = $images = $categoryid = "";
	$itemid = $_POST['itemid'];
	$itemname = $_POST['itemname'];
	$description = $_POST['description'];
	$unit = $_POST['unit'];
	$price = $_POST['price'];
	$categoryid = $_POST['categoryid'];

	$image = $_FILES['image']['name'];

	if(isset($_FILES['images'])){
		$images = tao_mang_image();
	}
	
		//xử lý thêm
		include_once ("../Database/DBHandle.php");
		$DB = new Database();
		$sql="INSERT INTO `item`(`itemid`, `itemname`, `description`, `unit`, `price`, `image`, `images`, `categoryid`) VALUES ('".$itemid."','".$itemname."','".$description."','".$unit."',";
		if($price) $sql.=$price;
		else $sql.="null";
		$sql.=",'".$image."','".$images."',";
		if($categoryid!="-1")$sql.="'".$categoryid."'";
		else $sql.="null";
		$sql.=")";
		//echo $sql;
		$ok = $DB->ExecuteSQL($sql);
		if($ok>0)//nếu thêm thành công
		{
			if($image) up_hinhdaidien();
			if($images) up_hinhchitiet();
			echo '<script>alert("Đã thêm sản phẩm");history.go(-2)</script>';
		}
		else//thêm thất bại
		{
			echo '<script>alert("Thêm sản phẩm bị lỗi, vui lòng xem lại dữ liệu");</script>';
		}
	
	function up_hinhdaidien()
	{
		//lấy tên thư mục up hình lên
		$thu_muc_luu_hinh = "../IMG/";
		//tạo ra tên đường dẫn file
		$ten_file_luu = $thu_muc_luu_hinh . basename($_FILES['image']['name']);
		//lấy đuôi mở rộng của file được up lên và chuyển thành chữ thường
		$OK=1;//giả sử là úp hình ok
		if(file_exists($ten_file_luu)){
			//echo "File này đã tồn tại trên server!";
			$OK=0;
		}
		//kiểm tra độ lớn nếu cần
		if($_FILES['image']['size']>(5*1024*1024)){
			//echo "Chỉ cho phép up file <= 5MB";
			$OK=0;
		}
		//kiểm tra đuôi mở rộng nếu cần
		$duoi_mo_rong = strtolower(pathinfo($ten_file_luu,PATHINFO_EXTENSION));
		if($duoi_mo_rong !="jpg" && $duoi_mo_rong !="png" && $duoi_mo_rong !="gif"){
			//echo "Chỉ cho phép up file .jpg|.png|.gif";
			$OK=0;
		}
		if($OK){
			//copy hoặc move file lên thư mục IMG trên server
			move_uploaded_file($_FILES['image']['tmp_name'], $ten_file_luu);	
		}
		return $OK;
	}
	function up_hinhchitiet(){
		$files = $_FILES['images'];
		$file_count = count($files['name']);
		$thu_muc_luu_hinh = "../IMG/";
		for ($i = 0; $i < $file_count; $i++) {
		    $filename = $files['name'][$i];
		    $ten_file_luu = $thu_muc_luu_hinh . basename($files['name'][$i]);
		    move_uploaded_file($files['tmp_name'][$i], $ten_file_luu);
		}
	}
	function tao_mang_image(){
		$files = $_FILES['images'];
		$file_count = count($files['name']);
		$filename = "";
		for ($i = 0; $i < $file_count; $i++) {
		    $filename .= $files['name'][$i] .";";
		}
		return $filename;
	}
?>