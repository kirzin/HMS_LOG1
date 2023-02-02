<?php
include('db.php');

$queryItem = "SELECT * FROM warehouseitem LEFT JOIN itemcategory ON warehouseitem.WarehouseItem_id = itemcategory.ItemCategory_id LEFT JOIN locations ON itemcategory.ItemCategory_id = locations.Location_id ORDER BY locations.Location_id;";

$sqlItem = mysqli_query($conn,$queryItem);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse</title>
</head>
<body>


    <table class="table">
    
  <thead>
    <tr>
      <th scope="col">
     Location
      </th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  <?php while($result = mysqli_fetch_array($sqlItem)){?>
    <tr>
      <th scope="row"><?php echo $result['Location_Name']?></th>
      <td><?php echo $result['Location_Name']?></td>
      <td><?php echo $result['Item_Name']?></td>
      <td>@mdo</td>
    </tr>
    <?php }?>
   
  </tbody>
  
</table>
    
    
</body>
</html>