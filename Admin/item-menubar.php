<nav class="navbar navbar-expand-sm bg-light">
  <!--Xuất dropdown loại cây cảnh-->
	<h6 style="margin-top: 7px; margin-right:10px;">Lọc theo loại:</h6>
      <select id="category" onchange="gocategory(this.value);">
        <?php
        include_once("../Database/DBHandle.php");
        $DB = new Database();
        $sql = "SELECT * FROM `category`";
        $result = $DB->GetData($sql);
        if($result!=NULL){
          $rows = mysqli_num_rows($result);
          if ($rows) {
            echo '<option value=0>'.$_SESSION['category'].'</option>';
            while ($row = mysqli_fetch_array($result))
            { 
             echo '<option value="'.$row['categoryid'].'-'.$row['categoryname'].'">'.$row['categoryid'].'-'.$row['categoryname'].'</option>';
            }
          }
        }
      ?>      
      </select>
	<h6 style="margin:0px 10px 0px 10px">Hiển thị:</h6>
    <?php
      $pageindex=1;
      if(isset($_REQUEST['pageindex']))$pageindex=$_REQUEST['pageindex'];
    ?>
    <select id="pagesize" onchange="gopage(<?php echo $pageindex; ?>,this.value);">
      <option value=<?php echo $_SESSION['pagesize']; ?>><?php echo $_SESSION['pagesize'];?></option>
    	<option value=5>5</option>
      <option value=10>10</option>
      <option value=15>15</option>
      <option value=20>20</option>
      <option value=25>25</option>
    </select>
	<h6 style="margin:0px 10px 0px 5px">Sản phẩm/Trang</h6>
  <!--Xuất các bút trang 1,2,...-->
  <?php
    $total = $_SESSION['totalitem'];
    $pageindex=1;
    while($total>0){
      echo '<button onclick="gopage('.$pageindex.','.$_SESSION['pagesize'].');">'.$pageindex.'</button>';
      $total-=$_SESSION['pagesize'];
      $pageindex++;
    }
  ?>
  <input type="text" name="txtkey" placeholder="Tìm nhanh theo từ khóa" onchange="gosearch(this.value);">
    <a href="?Page=item-add" style="margin-left: 5px;"><button>Thêm sản phẩm</button></a>
</nav>
<script type="text/javascript">
  function gosearch(key){
    document.location="index.php?Page=item&keysearch="+key;
  }
  function gopagesize(page,size){
    document.location="index.php?Page=item&pagesize="+size;
  }
  function gocategory(category){
    document.location="index.php?Page=item&category="+category;
  }
  function gopage(page,size){
    document.location="index.php?Page=item&pageindex="+page+"&pagesize="+size; 
  }
</script>