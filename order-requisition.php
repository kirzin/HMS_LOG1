<?php
session_start();
  include './include/config.php';
  include './include/header.php';
  include './include/sidebar.php';
  include './auth/verify.php';

  date_default_timezone_set('Asia/Manila');
  $presentdate = date('M d, Y g:ia')
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
      <h5 class="card-title">List of Order Requisitions</h5>

        <table class="table table-striped datatable">
          <thead>
            <th>#</th>
            <th>Requisition ID</th>
            <th>Requestor</th>
            <th>Department</th>
            <th>Status</th>
            <th>Date</th>
            <th>Action</th>
          </thead>

          <tbody>
            <?php
            $sql = "SELECT * FROM request WHERE Request_Approval = ?;";
            $stmt = mysqli_stmt_init($con);

            if(mysqli_stmt_prepare($stmt, $sql))
            {
              $approved = 1;
              mysqli_stmt_bind_param($stmt, "i", $approved);
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              if($result)
              {
                $num = 0;
                while($row = mysqli_fetch_assoc($result))
                {
                  $num += 1;
                  $itemrequest_id = $row['Request_id'];
                  $request_id = $row['Request_id'];
                  $itemrequestor = $row['Item_Requestor'];
                  $request_date = date('M d, Y',strtotime($row['Request_Date']));
                  $processedby = $row['ProcessedBy'];
                  $request_message = $row['Request_Message'];
                  $request_address = $row['Request_DeliveryAddress'];
                  $request_approval = $row['Request_Approval'];
                  $requestor_department = $row['Requestor_Department'];
                  $dateprocessed = date('M d, Y g:iA', strtotime($row['dateSubmitted']));

                  if($request_approval == 1)
                  {
                    $request_approval = "<span class='badge bg-success'>Approved</span>";
                  }

                  echo 
                  "
                  <tr>
                    <td>$num</td>
                    <td>$request_id</td>
                    <td>$itemrequestor</td>
                    <td>$requestor_department</td>
                    <td>$request_approval</td>
                    <td>Needed: $request_date<br>Submitted: $dateprocessed</td>
                    <td><a href='detailedorder-requisition.php?or_id=$itemrequest_id' class='btn btn-info'>Review</a></td>
                  </tr>
                  ";
                }
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </main>

  <?php
    include './include/footer.php';
  ?>