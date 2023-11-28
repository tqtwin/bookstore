<script type="text/javascript">
  function tinhdoanhthu(fromdate,todate) {
    window.location="index.php?Page=doanh-thu&fromdate="+fromdate+"&todate="+todate;
  }
</script>
  <nav class="navbar navbar-expand-sm bg-light">
    <form>
      <label> Từ ngày: </label> <input type="date" id="fromdate" value="<?php 
          if(isset($_REQUEST['fromdate']))
            echo $_REQUEST['fromdate'];
        ?>">
      <label> Đến ngày: </label> <input type="date" id="todate" value="<?php 
          if(isset($_REQUEST['todate']))
            echo $_REQUEST['todate'];
        ?>">
      <input type="button" name="thongke" value="Thống kê" onclick="tinhdoanhthu(document.getElementById('fromdate').value,document.getElementById('todate').value);">
      </form>
  </nav>
	<div class="table-responsive-sm">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Số đơn hàng</th>
        <th>Ngày</th>
        <th>Người mua</th>
        <th>Điện thoại</th>
        <th>Địa chỉ</th>
        <th>Tổng tiền</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])){
          $sql = "SELECT `orderid`,`orderdate`,`total`,`recipientname`,`phone`,`address` FROM `order` 
          WHERE statusid=3 and `orderdate` >= '".$_REQUEST['fromdate']." 00:00:00' and `orderdate` <= '".$_REQUEST['todate']." 23:59:59'";
          include_once("../Database/DBHandle.php");
          $DB = new Database();
          $result = $DB->GetData($sql);
          if($result!=NULL){
            $rows = mysqli_num_rows($result);
            if ($rows) {
              $i=1;
              $tongtien=0;
              while ($row = mysqli_fetch_array($result))
              { 
                echo"<tr>";
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row['orderid'].'</td>';
                echo '<td>'.$row['orderdate'].'</td>';
                echo '<td>'.$row['recipientname'].'</td>';
                echo '<td>'.$row['phone'].'</td>';
                echo '<td>'.$row['address'].'</td>';
                echo '<td align="right"><b>'.number_format($row['total']).'</td>';
                echo"</tr>";
                $tongtien+=$row['total'];
              }
              echo '<tr><td colspan=7 align="right"><b>Tổng doanh thu: '.number_format($tongtien).'</td>';;
            }
          }
        }
      ?>
    </tbody>
  </table>
  </div>