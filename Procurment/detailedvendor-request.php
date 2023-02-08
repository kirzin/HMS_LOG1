

























<?php
  session_start();
  include './include/config.php';
  include './include/header.php';
  include './include/sidebar.php';
  include './auth/verify.php';

  if(isset($_GET['pr_id']))
  {
    $pr_id = $_GET['pr_id'];
    $sql = "SELECT * FROM purchase_request 
            LEFT JOIN request 
            ON purchase_request.Request_id = request.Request_id
            WHERE purchase_request.pr_id = ?";
    $stmt = mysqli_stmt_init($con);
    if(mysqli_stmt_prepare($stmt,$sql))
    {
      mysqli_stmt_bind_param($stmt, "i", $pr_id);
      mysqli_stmt_execute($stmt);
      $resultPR = mysqli_stmt_get_result($stmt);

      if($resultPR)
      {
        $rowPR = mysqli_fetch_assoc($resultPR);
        $requestor = $rowPR['Item_Requestor'];
        $needed = $rowPR['Request_Date'];
        $department = $rowPR['Requestor_Department'];
      }
      else
      {
        die(mysqli_error($con));
      }
    }

    
  }
  else
  {
  $_GET['view_id'] = '';
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Assign Vendor - Alegario Cure Hospital</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poppins&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Vendor</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item"><a href="index.php">Purchase Requiisitions</a></li>
          <li class="breadcrumb-item active">Assign Vendor</li>
        </ol>
      </nav>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Purchase Request Form</h5>
        <hr>
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
          <h5 class="card-title" style='padding:0;margin:0 0 10px 0;'>Requestor Details</h5>
          <div class="row">
            <div class="col-sm-6">
              <label for="" class="form-label">Purchase Requisition No:</label>
              <input type="text" value='<?php echo $_GET['pr_id'];?>' class='form-control' disabled>
            </div>

            <div class="col-sm-6">
              <label for="" class="form-label">Date Needed:</label>
              <input type="text" value='<?php echo $needed;?>' class='form-control' disabled>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <label for="" class="form-label">Requestor:</label>
              <input type="text" value='<?php echo $requestor;?>' class='form-control' disabled>
            </div>

            <div class="col-sm-6">
              <label for="" class="form-label">Department:</label>
              <input type="text" value='<?php echo $department?>' class='form-control' disabled>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-sm-12">
              <h5 class="card-title" style='padding:0;margin:0 0 10px 0;'>Item Details</h5>
              <table class='table table-striped'>
                <thead>
                  <th>#</th>
                  <th>Item Name</th>
                  <th>Quantity</th>
                  <th>Description</th>
                  <th>Characteristic</th>
                  <th>Budget Per Unit</th>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM purchaserequest_details WHERE pr_id = ?;";
                  $stmt = mysqli_stmt_init($con);

                  if(mysqli_stmt_prepare($stmt,$sql))
                  {
                    mysqli_stmt_bind_param($stmt, "i", $_GET['pr_id']);
                    mysqli_stmt_execute($stmt);
                    $resultPRD = mysqli_stmt_get_result($stmt);

                    if($resultPRD)
                    {
                      $totalbudget = 0;
                      $num = 0;
                      while($rowPRD = mysqli_fetch_assoc($resultPRD))
                      {
                        $num += 1;
                        $itemname = $rowPRD['prd_itemName'];
                        $itemquan = $rowPRD['prd_itemQuantity'];
                        $itemdesc = $rowPRD['prd_itemDescription'];
                        $itemchar = $rowPRD['prd_itemCharacteristic'];
                        $itembudget = $rowPRD['prd_itemBudget'];
                        $itemcost = $itembudget * $itemquan;
                        $totalbudget = $totalbudget + $itemcost;

                        echo
                        "
                        <tr>
                        <td>$num</td>
                        <td>$itemname</td>
                        <td>$itemquan</td>
                        <td>$itemdesc</td>
                        <td>$itemchar</td>
                        <td>₱ $itembudget</td>
                        </tr>
                        ";
                      }
                    }
                    else
                    {
                      die(mysqli_error($con));
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <hr>

          <div class="row">
            <div class="col-sm-6">
              <label for="" class="form-label">Estimated Budget Total:</label>
              <input type="text" value='₱ <?php echo $totalbudget;?>' class='form-control' disabled>
            </div>

            <div class="col-sm-6">
            <label for="" class="form-label">Submitted to:</label>
              <select name="selectvendor" class="form-select" required>
                <option>-Vendor Selection-</option>
                <?php 
                    $sql = "SELECT * FROM vendor";
                    $stmt = mysqli_stmt_init($con);
                    if(mysqli_stmt_prepare($stmt,$sql))
                    {
                      mysqli_stmt_execute($stmt);
                      $resultVendor = mysqli_stmt_get_result($stmt);
                
                      if($resultVendor)
                      {
                        while ($rowVendor = mysqli_fetch_assoc($resultVendor))
                        {
                          $vendor_id = $rowVendor['Vendor_id'];
                          $vendor_fname = $rowVendor['vendor_fname'];
                          $vendor_mname = $rowVendor['vendor_mname'];
                          $vendor_lname = $rowVendor['vendor_lname'];
                          $vendor_name = $vendor_fname . ' ' . $vendor_mname . ' ' . $vendor_lname;
                          
                          
                        echo
                        "
                        <option value='$vendor_id'>$vendor_name</option>
                        ";
                        }
                      }
                      else
                      {
                        die(mysqli_error($con));
                      }
                    }
                ?>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <label for="" class="form-label">Additional Message: (Optional)</label>
              <textarea name="notes" id="" cols="12" rows="5" class="form-control"></textarea>
            </div>  
          </div>

          <hr>
          <div class="row">
            <div class="text-center">
              <input type="hidden" name='pr_id' value='<?php $_GET['pr_id'];?>'>
              <a href="vendor-request.php" class='btn btn-secondary'>Close</a>
              <input type="submit" name='send' class='btn btn-success' value='Send'>
            </div>
          </div>
        </form>
        </div>
      </div>
    </div>
  </main>

  <?php
    include './include/footer.php';

  if (isset($_POST['send'])) {
    $vendorID = mysqli_real_escape_string($con, $_POST['selectvendor']);
    $notes = mysqli_real_escape_string($con, $_POST['notes']);
    if (!empty($notes)) {
      $sql = "UPDATE purchase_request SET Vendor_id = ?, vendoradditional_notes = ?
              WHERE pr_id =?";
      $stmt = mysqli_stmt_init($con);
      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "isi", $vendorID, $notes, $_GET['pr_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($con);

        ?>
        <script>
            window.location.href='vendor-request.php?status=sentsuccessfully';
        </script>
        <?php
      }
    } else {
      $sql = "UPDATE purchase_request 
                SET Vendor_id = ?
                WHERE pr_id =?";
      $stmt = mysqli_stmt_init($con);
      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "ii", $vendorID, $_GET['pr_id']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($con);
        ?>
          <script>
              window.location.href='vendor-request.php?status=sentsuccessfully';
          </script>
          <?php
      }
    }
  }
  ?>