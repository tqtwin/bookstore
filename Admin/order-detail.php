<h5>Chi tiết đơn hàng: <?php echo $_REQUEST['orderid']; ?></h5>
<table class="table">
   	<thead class="thead-light">
  		<tr>
       		<th>Sản phẩm</th>
       		<th>Ảnh đại diện</th>
       		<th>Số lượng</th>
	        <th>Giá bán</th>
	        <th>Thành tiền</th>
   		</tr>
   	</thead>
	<tbody>
	<?php
 		include_once("../Database/DBHandle.php");
        $DB = new Database();
        $sql="SELECT i.itemname, i.image, od.quatity, od.price, od.quatity * od.price amount FROM `orderdetail` od, `item` i WHERE od.itemid=i.itemid AND od.orderid='".$_REQUEST['orderid']."'";
        $result = $DB->GetData($sql);
        if($result!=NULL){
            $rows = mysqli_num_rows($result);
        	if ($rows) {
				while ($row = mysqli_fetch_array($result)) { 
  					echo "<tr>";
					echo '<td>'.$row['itemname'].'</td>';
					echo '<td><img height="70px" width="70px" src="../IMG/'.$row['image'].'"></td>';
					echo '<td align="right">'.$row['quatity'].'</td>';
					echo '<td align="right">'.number_format($row['price']).'</td>';
					echo '<td align="right">'.number_format($row['amount']).'</td>';
					echo "</tr>";
        		}
        	}
        }
    ?>
    <tr>
    	<td colspan="5" align="right">
    		<a onclick="history.back();"><button type="button" class="btn btn-primary button">Quay về</button></a>
    		<?php 
    			//nếu là đơn hàng mới thì xuất ra 2 nút xử lý, hủy
    			if($_REQUEST['statusid'] == 1){
    				echo'<a href="order-update.php?orderid='.$_REQUEST['orderid'].'&statusid=2"><button type="button" class="btn btn-primary button">Đã xử lý</button></a><a href="order-update.php?orderid='.$_REQUEST['orderid'].'&statusid=4"><button type="button" class="btn btn-primary button">Hủy đơn hàng</button></a>';
    			}
    			//nếu là đơn hàng đã xử lý xuất ra 1 nút hoàn tất
    			else if($_REQUEST['statusid'] == 2){
    				echo'<a href="order-update.php?orderid='.$_REQUEST['orderid'].'&statusid=3"><button type="button" class="btn btn-primary button">Đã giao hàng</button></a>';
    			}
    			//nếu là đơn hoàn tất, hủy chỉ được xem và quay về nên không xuất các nút
			?>    		
    	</tr>
    </tr>
    </tbody>
</table>