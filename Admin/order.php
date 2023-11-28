<?php
  include("order-menubar.php");
  ?>
	<div class="table-responsive-sm">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Số ĐH</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Tên người nhận</th>
        <th>Email</th>
        <th>Điện thoại</th>
        <th>Địa chỉ</th>
        <th>Ghi chú</th>
        <th>Xử lý</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_REQUEST['statusid'])){
          include_once("../Database/DBHandle.php");
          $DB = new Database();
          $sql = "SELECT * FROM `order` where `statusid` = '".$_REQUEST['statusid']."'";
          $result = $DB->GetData($sql);
          if($result!=NULL){
            $rows = mysqli_num_rows($result);
            if ($rows) {
              $stt=1;
              while ($row = mysqli_fetch_array($result))
              { 
                echo'<tr>';
                echo "<td>".$stt."</td>";
                echo "<td>".$row['orderid']."</td>";
                echo "<td>".$row['orderdate']."</td>";
                echo "<td>".$row['total']."</td>";
                echo "<td>".$row['recipientname']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['address']."</td>";
                echo "<td>".$row['note']."</td>";
                echo '<td><a href="?Page=order-detail&statusid='.$_REQUEST['statusid'].'&orderid='.$row['orderid'].'" style="margin-left: 5px;"><button type="button" class="btn btn-primary button"> Chi tiết</button></a></td>';
                echo"</tr>";
              }
            }
          }
        }
      ?>      
    </tbody>
  </table>
  </div>