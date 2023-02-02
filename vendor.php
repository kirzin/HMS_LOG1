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
  <title>Dashboard - Alegario Cure Hospital</title>
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
      <h1>Procurement</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">List of Vendors</h5>
            <table class='table table-striped datatable'>
                <thead>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Date</th>
                </thead>
                <tbody>

                    <?php 
                    $sql = "SELECT * FROM vendor";
                    $stmt = mysqli_stmt_init($con);
                    if(mysqli_stmt_prepare($stmt,$sql))
                    {
                        mysqli_stmt_execute($stmt);
                        $resultVendor = mysqli_stmt_get_result($stmt);
                    
                        if($resultVendor)
                        {
                            $num = 0;
                            while($rowVendor = mysqli_fetch_assoc($resultVendor))
                            {
                                $num += 1;
                                $vendorID = $rowVendor['Vendor_id'];
                                $vendor_fname = ucfirst($rowVendor['vendor_fname']);
                                $vendor_mname = ucfirst($rowVendor['vendor_mname']);
                                $vendor_lname = ucfirst($rowVendor['vendor_lname']);
                                $vendor_email = $rowVendor['vendor_email'];
                                $vendor_contact = $rowVendor['vendor_contact'];
                                $vendor_address = $rowVendor['vendor_address'];
                                $vendor_status = $rowVendor['vendor_status'];
                                $vendor_added = date('M ,d Y g:i A',strtotime($rowVendor['vendor_dateAdded']));
                    
                                $vendor_name = $vendor_fname . ' ' . $vendor_mname . ' ' . $vendor_lname;
                                if($vendor_status == 1)
                                {
                                    $vendor_status = "<span class='badge bg-success'>Active</span>";
                                }
                                echo
                                "
                                <tr>
                                    <td>$num</td>
                                    <td>$vendor_name</td>
                                    <td>$vendor_email</td>
                                    <td>$vendor_contact</td>
                                    <td>$vendor_address</td>
                                    <td>$vendor_status</td>
                                    <td>$vendor_added</td>
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
  </main>

  <?php
    include './include/footer.php';
  ?>