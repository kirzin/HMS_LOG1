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
      <?php
        $sql = "SELECT DATE_FORMAT(pr_dateCreated, '%D') 
                AS Unsettledtoday, 
                COUNT(*) AS unsettledvaluetoday 
                FROM purchase_request 
                EXCEPT request_budgetStatus = ?
                GROUP BY DAY(pr_dateCreated);";
        $stmt = mysqli_stmt_init($con);
        if(mysqli_stmt_prepare($stmt,$sql))
        {
          $status = 0;
          mysqli_stmt_bind_param($stmt,"i",$status);
          mysqli_stmt_execute($stmt);
          $result1 = mysqli_stmt_get_result($stmt);
          if($count = mysqli_num_rows($result1))
          {
            $row = mysqli_fetch_array($result1);
            $unsettled[] = $row['Unsettledtoday'];
            $unsettledvalue[] = $row['unsettledvaluetoday'];

            $json = json_encode($unsettledvalue);
            $json = substr($json, 1, -1);

            echo 
            "
            <div class='col-xxl-4 col-md-4' style='border-left: 8px #ed3c0d solid;'>
            <div class='card info-card sales-card'> 
            <div class='card-block text-center' style='padding-top:10px'>
            <h5 class='card-title m-b-20' style='color:#202020;padding:0;margin:0;line-height:29px;'>Unsettled Budget: &nbsp;&nbsp; Today</h5>
            <hr>
            <h3 class='text-right'>$json</h3>
            </div>
            </div>
            </div>
            ";
          }
          else
          {
            echo 
            "
            <div class='col-xxl-4 col-md-4' style='border-left: 8px #ed3c0d solid;'>
            <div class='card info-card sales-card'> 
            <div class='card-block text-center' style='padding-top:10px'>
            <h5 class='card-title m-b-20' style='color:#202020;padding:0;margin:0;line-height:29px;'>Unsettled Budget: &nbsp;&nbsp; Today</h5>
            <hr>
            <h3 class='text-right'>0</h3>
            </div>
            </div>
            </div>
            ";
          }
        }
        ?>
      </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Budget Request Status</h5>
            <hr>
            <table class="table table-striped datatable">
                <thead>
                <th>#</th>
                <th>PR ID</th>
                <th>Requestor</th>
                <th>Department</th>
                <th>Budget Status</th>
                <th>Date</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM purchase_request 
                        INNER JOIN request ON 
                        purchase_request.Request_id = request.Request_id
                        WHERE purchase_request.request_budgetStatus 
                        BETWEEN 0 AND 3;";

                $stmt = mysqli_stmt_init($con);
                if(mysqli_stmt_prepare($stmt,$sql))
                {
                  mysqli_stmt_execute($stmt);
                  $result = mysqli_stmt_get_result($stmt);

                  if($result)
                  {
                    $num = 0;
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $request_id = $row['Request_id'];
                      $pr_id = $row['pr_id'];
                      $requestor = $row['Item_Requestor'];
                      $department = $row['Requestor_Department'];
                      $reviewedby = $row['pr_reviewedBy'];
                      $status = $row['request_budgetStatus'];
                      $budgetapproval = $row['request_budgetStatus'];
                      $requestdate = date('M d, Y g:iA', strtotime($row['Request_Date']));
                      $datecreated = date('M d, Y g:iA', strtotime($row['pr_dateCreated']));
                      $num += 1;
                      if($status == 0)
                      {
                        $status = "<span class='badge bg-secondary'>Unsettled</span>";
                      }
                      elseif($status == 1)
                      {
                        $status = "<span class='badge bg-info'>Pending</span>";
                      }

                      echo
                      "
                      <tr>
                      <td>$num</td>
                      <td>$pr_id</td>
                      <td>$requestor</td>
                      <td>$department</td>
                      <td>$status</td>
                      <td>Needed: $requestdate<br>Submitted: $datecreated</td>
                      ";
                      if($budgetapproval == 0)
                      {
                        echo
                        "
                        <td>
                        <a href='detailedbudget-request.php?view_id=$pr_id' class='btn btn-info'>Details</a>
                        </td>
                        ";
                      }
                      else
                      {
                        echo
                        "
                        <td></td>
                        ";
                      }
                      
                     
                      echo
                      "
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