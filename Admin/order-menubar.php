<nav class="navbar navbar-expand-sm bg-light">
	<ul class="navbar-nav">
      <?php
        include("../Database/DBHandle.php");
        $DB = new Database();
        $sql = "SELECT * FROM `orderstatus`";
        $result = $DB->GetData($sql);
        if($result!=NULL){
          $rows = mysqli_num_rows($result);
          if ($rows) {
            while ($row = mysqli_fetch_array($result))
            { 
              echo'<li class="nav-item">';
              echo'<a class="nav-link" href="?Page=order&statusid='.$row['statusid'].'">'.$row['statusname'].'</a>';
              echo'</li>';
            }
          }
        }
      ?>      
  </ul>
</nav>