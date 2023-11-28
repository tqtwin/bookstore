<script type="text/javascript">
  function thongkesanphambanchay(top,fromdate,todate) {
    window.location="index.php?Page=san-pham-ban-chay&top="+top+"&fromdate="+fromdate+"&todate="+todate;
  }
</script>
  <nav class="navbar navbar-expand-sm bg-light">
    <form>
      <label> Top: </label>
      <select id="top">
          <?php 
          if(isset($_REQUEST['top']))
            echo '<option value='.$_REQUEST['top'].'>'.$_REQUEST['top'].'</option>';
        ?>">
        <option value=5>5</option>
        <option value=10>10</option>
        <option value=20>20</option>
        <option value=30>30</option>
        <option value=40>40</option>
        <option value=50>50</option>
      </select>
      <label> Từ ngày: </label> <input type="date" id="fromdate" value="<?php 
          if(isset($_REQUEST['fromdate']))
            echo  date_format(date_create($_REQUEST['fromdate']),'Y-m-d');
        ?>">
      <label> Đến ngày: </label> <input type="date" id="todate" value="<?php 
          if(isset($_REQUEST['todate']))
            echo date_format(date_create($_REQUEST['todate']),'Y-m-d');
        ?>">
      <input type="button" name="thongke" value="Thống kê" onclick="thongkesanphambanchay(document.getElementById('top').value,document.getElementById('fromdate').value,document.getElementById('todate').value);">
      </form>
  </nav>
	<div class="table-responsive-sm">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Ảnh đại diện</th>
        <th>ĐV tính</th>
        <th>Đơn giá</th>
        <th>Tổng SL bán</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_REQUEST['top']) && isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])){
          $sql = "SELECT od.itemid,i.itemname,i.unit,od.price,image,SUM(od.quatity) `total_quantity` FROM `order` o, `orderdetail` od, `item` i where o.orderid=od.orderid AND od.itemid=i.itemid 
          AND o.orderdate>='".$_REQUEST['fromdate']." 00:00:00' AND o.orderdate<='".$_REQUEST['todate']." 23:59:59' GROUP by od.itemid,i.itemname,i.unit,od.price,image ORDER BY `total_quantity` DESC LIMIT ".$_REQUEST['top'].";";
          include_once("../Database/DBHandle.php");
          $DB = new Database();
          $result = $DB->GetData($sql);
          if($result!=NULL){
            $rows = mysqli_num_rows($result);
            if ($rows) {
              $i=1;
              $tong=0;
              while ($row = mysqli_fetch_array($result))
              { 
                echo"<tr>";
                echo '<td>'.$i++.'</td>';
                echo '<td>'.$row['itemid'].'</td>';
                echo '<td>'.$row['itemname'].'</td>';
                echo '<td><img height="60" width="80" src="../IMG/'.$row['image'].'"></td>';
                echo '<td>'.$row['unit'].'</td>';
                echo '<td align="right"><b>'.number_format($row['price']).'</td>';
                echo '<td align="right"><b>'.number_format($row['total_quantity']).'</td>';
                echo"</tr>";
                $tong+=$row['total_quantity'];
              }
              echo '<tr><td colspan=7 align="right"><b>Tổng số lượng bán: '.number_format($tong).'</td>';
            }
          }
        }
        
      ?>
    </tbody>
  </table>
  </div>