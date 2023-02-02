











































<?php
  session_start();
  include './include/config.php';
  include './include/header.php';
  include './include/sidebar.php';
  include './auth/verify.php';

  if(isset($_GET['view_id']))
  {
    $view_id = $_GET['view_id'];
    $sql = "SELECT * FROM purchase_request 
            LEFT JOIN request ON purchase_request.Request_id = request.Request_id
            WHERE purchase_request.pr_id = ?";

    $stmt = mysqli_stmt_init($con);
    if(mysqli_stmt_prepare($stmt,$sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $_GET['view_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            //requestor-details
            $request_id = $row['Request_id'];
            $pr_id = $row['pr_id'];
            $pr_requestor = $row['Item_Requestor'];
            $pr_department = $row['Requestor_Department'];
            $pr_needed = date('M d, Y g:i A', strtotime($row['Request_Date']));
            //br-details
            $br_notes = $row['budgetadditional_notes'];
            $br_status = $row['request_budgetStatus'];
            $br_reviewed = $row['pr_reviewedBy'];
            $br_datecreated = $row['pr_dateCreated'];
            if($br_status == 0)
            {
              $br_status = "Unsettled";
            }

            mysqli_stmt_close($stmt);
        }
    }
  }
  else
  {
    $_GET['view_id'] = "";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Budget Request - Alegario Cure Hospital</title>
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
      <h1>Budget</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Purchase Requisitions</li>
          <li class="breadcrumb-item active">Budget Request</li>
        </ol>
      </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Purchase Request Form</h5>
            <hr>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <h5 class="card-title" style='padding:0;margin:0 0 10px 0;'>Requestor Details</h5>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-label">Purchase Request No:</div>
                    <input type="text" disabled class="form-control" value="<?php echo $pr_id?>" name="pr_id">
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Date Needed:</label>
                    <input type="text" disabled class="form-control" value="<?php echo $pr_needed?>" name="pr_needed">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-label">Requestor:</label>
                    <input type="text" disabled class="form-control" value="<?php echo $pr_requestor?>" name="pr_requestor">
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Department:</label>
                    <input type="text" disabled class="form-control" value="<?php echo $pr_department?>" name="pr_department">
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <h5 class="card-title" style="padding:0;margin:0;line-height:20px;">Item Details</h5>
                </div>
            </div>

            <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Characteristic</th>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM purchaserequest_details
                            WHERE purchaserequest_details.pr_id = ?;";
                    $stmt = mysqli_stmt_init($con);

                    if (mysqli_stmt_prepare($stmt, $sql)) 
                    {
                        mysqli_stmt_bind_param($stmt, "i", $_GET['view_id']);
                        mysqli_stmt_execute($stmt);
                    $result2 = mysqli_stmt_get_result($stmt);

                    if($result2)
                    {
                        $num = 0;
                        while($row = mysqli_fetch_assoc($result2))
                        {
                            $num += 1;
                            $br_itemname = $row['prd_itemName'];
                            $br_itemquan = $row['prd_itemQuantity'];
                            $br_itemdesc = $row['prd_itemDescription'];
                            $br_itemchar = $row['prd_itemCharacteristic'];
                            
                            echo 
                            "
                            <tr>
                            <td>$num</td>
                            <td>$br_itemname</td>
                            <td>$br_itemquan</td>
                            <td>$br_itemdesc</td>
                            <td>$br_itemchar</td>
                            </tr>
                            ";
                        }
                    }
                }
                ?>
            </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-label">Reviewed By:</label>
                    <input type="text" disabled class="form-control" value="<?php echo $br_reviewed?>" name="br_reviewed">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Budget Status:</label>
                    <input type="text" disabled class="form-control" value="<?php echo $br_status?>" name="br_status">
                </div>
            </div>

            <div class="row">
            <div class="col-sm-12">
                    <label class="form-label">Additional Notes: (Optional)</label>
                    <textarea name="br_notes" class="form-control" cols="12" rows="5"></textarea>
            </div>
            </div>

            <hr>
            <div class="text-center" style="margin-top: 25px">
                  <input type="hidden" name="pr_id" value="<?php echo $_GET['view_id'];?>">
                  <a href="./budget-request.php" class='btn btn-secondary' style="margin-right: 20px">Close</a>
                  <input type="submit" name="brSubmit" value="Request Budget" class='btn btn-success'>
            </div>
        </form>
        </div>
    </div>
  </main>

  <?php
    include './include/footer.php';

    if(isset($_POST['brSubmit']))
    {
      $notes = mysqli_real_escape_string($con, $_POST['br_notes']);

      if(!empty($notes))
      {
        $pending = 1;
        $sql = "UPDATE purchase_request SET request_budgetStatus = ?, budgetadditional_notes = ?
                WHERE pr_id =?";
        $stmt = mysqli_stmt_init($con);
        if(mysqli_stmt_prepare($stmt,$sql))
        {
            mysqli_stmt_bind_param($stmt, "isi", $pending, $notes, $view_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($con);

            ?>
            <script>
                window.location.href='budget-request.php?status=updated';
            </script>
            <?php
        }
      }
      else
      {
        $sql = "UPDATE purchase_request SET request_budgetStatus = ?
                WHERE pr_id =?";
        $stmt = mysqli_stmt_init($con);
        if(mysqli_stmt_prepare($stmt,$sql))
        {
            $pending = 1;
            mysqli_stmt_bind_param($stmt, "ii", $pending,$view_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            mysqli_close($con);

            ?>
            <script>
                window.location.href='budget-request.php?status=updated';
            </script>
            <?php
        }
      }
    }
  ?>
