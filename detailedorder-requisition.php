<?php
session_start();
include './include/config.php';
include './include/header.php';
include './include/sidebar.php';
include './auth/verify.php';

date_default_timezone_set('Asia/Manila');
$presentdate = date('y-m-d g:i:s');

if(isset($_GET['or_id']))
{
    $or_id = $_GET['or_id'];
    $sql = "SELECT * FROM request WHERE Request_id =?";
    $stmt = mysqli_stmt_init($con);

    if(mysqli_stmt_prepare($stmt,$sql))
    {
        mysqli_stmt_bind_param($stmt, "i", $_GET['or_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $requestor = $row['Item_Requestor'];
            $dateneeded = date('M d, Y g:ia',strtotime($row['Request_Date']));
            $deliveryaddress = $row['Request_DeliveryAddress'];
            $requestmessage = $row['Request_Message'];
            $processedby = $row['ProcessedBy'];
            $datesubmitted = date('M d, Y g:i A',strtotime($row['dateSubmitted']));
            $department = $row['Requestor_Department'];

            mysqli_stmt_close($stmt);
        }
    }
}
else
{
    $_GET['or_id'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Order Requisitions - Alegario Cure Hospital</title>
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
        <h1>Order Requisitions</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active">Order Requisitions</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Requisition Form</h5>
            <hr>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <h5 class="card-title" style='padding:0;margin:0 0 10px 0;'>Requestor Details</h5>
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-label">Requisition No:</label>
                    <input type="text" disabled name="prid" class="form-control" value="<?php echo $_GET['or_id'];?>">
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Date Needed:</label>
                    <input type="text" disabled name="dateneeded" class="form-control" value="<?php echo $dateneeded;?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <label class="form-label">Requestor:</label>
                    <input type="text" disabled name="itemrequestor" class="form-control" value="<?php echo $requestor;?>">
                </div>

                <div class="col-sm-6">
                    <label class="form-label">Department:</label>
                    <input type="text" disabled name="itemrequestor" class="form-control" value="<?php echo $department;?>">
                </div>
            </div>  

                <div class="row">
                    <div class="col-sm-12">
                    <label class="form-label">Delivery Address:</label>
                    <input type="text" disabled name="deliveryaddress" class="form-control" value="<?php echo $deliveryaddress;?>" style="height:50px;">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <label class="form-label">Notes:</label>
                        <textarea disabled name="message" class="form-control" style="height:80px;"><?php echo $requestmessage;?></textarea>

                    </div>
                </div>

                <hr>
                <h5 class="card-title" style='padding:0;margin:0 0 10px 0;'>Item Details</h5>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <thead>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Characteristic</th>
                            </thead>

                            <tbody>
                            <?php 
                            $sql = "SELECT * FROM itemrequest
                                    WHERE request_id = ?;";
                            $stmt = mysqli_stmt_init($con);
                            if (mysqli_stmt_prepare($stmt, $sql)) 
                            {
                                mysqli_stmt_bind_param($stmt, "i", $_GET['or_id']);
                                mysqli_stmt_execute($stmt);

                                $result = mysqli_stmt_get_result($stmt);
                                if($result)
                                {
                                    $num = 0;
                                    while($row = mysqli_fetch_assoc($result))
                                    {
                                        $num += 1;
                                        $itemName            = $row['ItemRequest_Name'];
                                        $itemQuantity        = $row['ItemRequest_Quantity'];
                                        $itemDescription     = $row['ItemRequest_Description'];
                                        $itemCharacteristic  = $row['ItemRequest_Characteristic'];

                                        echo
                                        "
                                        <tr scope='row'>
                                          <td>$num</td>
                                          <td>$itemName</td>
                                          <td>$itemQuantity</td>
                                          <td>$itemDescription</td>
                                          <td>$itemCharacteristic</td>
                                        </tr>
                                        ";
                  
                                        echo
                                        "
                                        <input type='hidden' name='reqid[]' value='$or_id'>
                                        <input type='hidden' name='iname[]' value='$itemName'>
                                        <input type='hidden' name='iquan[]' value='$itemQuantity'>
                                        <input type='hidden' name='ichar[]' value='$itemCharacteristic'>
                                        ";
                                    }

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
                        <label class="form-label">Processed By:</label>
                        <input type="text" disabled name="processedby" class="form-control" value="<?php echo $processedby;?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Date Submitted:</label>
                        <input type="text" disabled name="dateprocessed" class="form-control" value="<?php echo $datesubmitted;?>">
                    </div>
                </div>

                <div class="text-center" style="margin-top: 25px">
                  <input type="hidden" name="requestid" value="<?php echo $_GET['or_id'];?>">
                  <a href="./order-requisition.php" class='btn btn-secondary' style="margin-right: 20px">Close</a>
                  <input type="submit" name="prSubmit" value="Accept" class='btn btn-success'>
                </div>

            </form>
        </div>
    </div>
  </main>
  <?php
    include './include/footer.php';
  ?>

  <?php
  if(isset($_POST['prSubmit']))
{  
    $sql1 = "UPDATE request
            SET Request_Approval = ?
            WHERE Request_id = ?;";
    $stmt1 = mysqli_stmt_init($con);
    if(mysqli_stmt_prepare($stmt1,$sql1))
    {
        $accepted = 4;
        mysqli_stmt_bind_param($stmt1,"ii",$accepted,$or_id);
        $exec1 = mysqli_stmt_execute($stmt1);

        if($exec1)
        {
            $sql = "INSERT INTO purchase_request
                    (Request_id,
                    pr_reviewedBy,
                    pr_dateCreated)
                    VALUES (?,?,?);";
            $stmt = mysqli_stmt_init($con);
            if(mysqli_stmt_prepare($stmt,$sql))
            {
                $reviewedby = "Vaun Barcelo";
                mysqli_stmt_bind_param($stmt,"iss",$_GET['or_id'],$reviewedby,$presentdate);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_get_result($stmt);
                if($result)
                {
                        $newid = mysqli_insert_id($con);
                        $count = count($_POST['reqid']);
                        for($i = 0; $i < $count ; $i++)
                        {
                            $sql = "INSERT INTO 
                            purchaserequest_details (pr_id,
                                                   prd_itemName,
                                                   prd_itemQuantity,
                                                   prd_itemCharacteristic)
                            VALUES (?,?,?,?)";
        
                            $stmt = mysqli_stmt_init($con);
                            if (mysqli_stmt_prepare($stmt, $sql)) 
                            {
                                mysqli_stmt_bind_param($stmt, "isis",$newid,  $_POST['iname'][$i], $_POST['iquan'][$i],$_POST['ichar'][$i]);
                                mysqli_stmt_execute($stmt);

                                ?>
                                <script>
                                window.location.href='order-requisition.php';
                                </script>
                                <?php 
                            }
                        }
                    }
                }
            }
        }
    }
  ?>