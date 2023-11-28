<h4>Thêm cây cảnh</h4>
<form action="item-save.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="itemid">Mã cây cảnh:</label>
    <input type="text" class="form-control" id="itemid" name="itemid" required>
  </div>
  <div class="form-group">
    <label for="itemname">Tên cây cảnh:</label>
    <input type="text" class="form-control" id="itemname" name="itemname" required>
  </div>
  <div class="form-group">
    <label for="description">Mô tả chi tiết:</label>
    <textarea class="form-control" id="description" name="description" rows="6"></textarea>
  </div>
  <div class="form-group">
    <label for="unit">Đơn vị tính:</label>
    <input type="text" class="form-control" id="unit" name="unit">
  </div>
  <div class="form-group">
    <label for="price">Giá bán:</label>
    <input type="number" class="form-control" id="price" name="price">
  </div>
  <div class="form-group">
    <label for="categoryid">Phân loại:</label>
    <select class="form-control" id="categoryid" name="categoryid">
      <option value="-1">Chọn phân loại</option>
      <?php
      include_once("../Database/DBHandle.php");
      $DB = new Database();
      $sql = "SELECT * FROM `category`";
      $result = $DB->GetData($sql);
      if($result!=NULL){
        $rows = mysqli_num_rows($result);
        if ($rows) {
          while ($row = mysqli_fetch_array($result))
          { 
            echo '<option value="'.$row['categoryid'].'">'.$row['categoryname'].'</option>';
          }
        }
      }
      ?>      
    </select>
  </div>
  <div class="form-group">
    <label for="image">Ảnh đại diện:</label>
    <input type="file" class="form-control" id="image" name="image" title="Chọn ảnh đại diện">
  </div>
  <div class="form-group">
    <label for="images">Các ảnh chi tiết:</label>
    <input type="file" class="form-control" id="images" name="images[]" title="Chọn các ảnh chi tiết" multiple>
  </div>
  <button type="submit" class="btn btn-success" name="save">Lưu lại</button>
  <button type="reset" class="btn btn-secondary" name="cancel" onclick="document.location='index.php?Page=item';">Bỏ qua</button>
</form>
