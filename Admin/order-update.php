<?php
	include_once("../Database/DBHandle.php");
	$DB = new Database();
    $sql="UPDATE `order` SET `statusid`='".$_REQUEST['statusid']."' WHERE `orderid`='".$_REQUEST['orderid']."'";
    $result = $DB->ExecuteSQL($sql);
    echo '<script>alert("Đã cập nhật trạng thái đơn hàng!");
		history.go(-2);</script>';
?>