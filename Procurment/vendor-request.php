<?php
  session_start();
  include './include/config.php';
  include './include/header.php';
  include './include/sidebar.php';
  include './auth/verify.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Vendor Request - Alegario Cure Hospital</title>
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
          <li class="breadcrumb-item">Purchase Requisitions</a></li>
          <li class="breadcrumb-item active">Assign Vendor</li>
        </ol>
      </nav>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">List of Assign Vendors</h1>
            <hr>

            <table class="table table-striped datatable">
                <thead>
                    <th>#</th>
                    <th>PR ID</th>
                    <th>Requestor</th>
                    <th>Department</th>
                    <th>Vendor Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM purchase_request
                            INNER JOIN Request 
                            ON purchase_request.Request_id = request.request_id
                            WHERE request_budgetStatus = ?";
                    $stmt = mysqli_stmt_init($con);
                    if(mysqli_stmt_prepare($stmt,$sql))
                    {
                        $ba_approved = 4;
                        mysqli_stmt_bind_param($stmt,"i",$ba_approved);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);

                        if($result)
                        {
                            $num = 0;
                            while($row = mysqli_fetch_assoc($result))
                            {
                                $num += 1;
                                //pr-details
                                $pr_id = $row['pr_id'];
                                $vendorstatus = $row['request_vendorStatus'];
                                $pr_date = date('M d, Y g:i A', strtotime($row['pr_dateCreated']));

                                $vendor = $row['request_vendorStatus'];
                                if($vendor == 0)
                                {
                                    $vendor = "<span class='badge bg-secondary'>Unsettled</span>";
                                }
                                //request-details
                                $request_id = $row['Request_id'];
                                $requestor = $row['Item_Requestor'];
                                $department = $row['Requestor_Department'];
                                $needed = date('M d, Y g:i A', strtotime($row['dateSubmitted']));
                                
                                echo
                                "
                                <tr>
                                <td>$num</td>
                                <td>$pr_id</td>
                                <td>$requestor</td>
                                <td>$department</td>
                                <td>$vendor</td>
                                <td>Needed: $needed<br>Submitted: $pr_date</td>
                                <td>
                                <a href='detailedvendor-request.php?pr_id=$pr_id' class='btn btn-info'>View</a>
                                </td>
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