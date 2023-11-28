<?php include("item-menubar.php");?>
	<div class="table-responsive-sm">          
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>#</th>
        <th>Mã sản phẩm</th>
        <th>Tên sản phẩm</th>
        <th>Mô tả</th>
        <th>ĐV tính</th>
        <th>Giá bán</th>
        <th>Ảnh đại diện</th>
        <th>Xử lý</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i=1;//số thứ tự để xuất ra trong table sản phẩm
        $sql = "SELECT * from `item`";
        if(isset($_REQUEST['keysearch']))
          $sql.=" WHERE `itemname` like'%".$_REQUEST['keysearch']."%';";
        else{
          //kiểm tra nếu có chọn mã loại thì lọc theo mã loại
          if(isset($_REQUEST['category'])){
            //category có dạng mã loại-tên loại, cắt chuỗi lấy mã loại
            $categoryid = substr($_REQUEST['category'], 0, stripos($_REQUEST['category'],"-"));
            $sql.=" WHERE `categoryid` = '$categoryid' ";
          }
          //lọc theo trang thứ mấy
          $pageindex=1;
          if(isset($_REQUEST['pageindex']))$pageindex=$_REQUEST['pageindex'];
          $sql.="LIMIT ".(($pageindex-1)*$_SESSION['pagesize']).",".$_SESSION['pagesize'].";";
          $i=($pageindex-1)*$_SESSION['pagesize']+1;
        }
        include_once("../Database/DBHandle.php");
        $DB = new Database();
        $result = $DB->GetData($sql);
        if($result!=NULL){
          $rows = mysqli_num_rows($result);
          if ($rows) {
            while ($row = mysqli_fetch_array($result))
            { 
              echo"<tr>";
              echo '<td>'.$i++.'</td>';
              echo '<td>'.$row['itemid'].'</td>';
              echo '<td>'.$row['itemname'].'</td>';
              echo '<td>'.$row['description'].'</td>';
              echo '<td>'.$row['unit'].'</td>';
              echo '<td>'.number_format($row['price']).'</td>';
              echo '<td><img height="60" width="80" src="../IMG/'.$row['image'].'"></td>';
              echo '<td><a href="?Page=item-edit&itemid='.$row['itemid'].'" style="margin-left: 5px;"><button>Sửa</button></a><a href="?Page=item-delete&itemid='.$row['itemid'].'" style="margin-left: 5px;"><button>Xóa</button></a></td>';
              echo"</tr>";
            }
          }
        }
      ?>
    </tbody>
  </table>
  </div>