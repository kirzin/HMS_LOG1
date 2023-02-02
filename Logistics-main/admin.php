<?php
require('db.php');

if(isset($_POST['request'])){
  $project_requestor = $_POST['project_requestor'];
  $project_name = $_POST['project_name'];
  $project_details = $_POST['project_details'];
  $date = $_POST['date'];

  $qcreate = "INSERT INTO prequest VALUE(null,'$project_requestor','$project_name','$date','$project_details')";
  $sqlcreate =mysqli_query($conn,$qcreate);
  echo '<script>alert("Succesful")</script></br>';

}
$queryProject = "SELECT * FROM project";
$sqlProject = mysqli_query($conn,$queryProject);
?>
<?php
include 'header.php';
include 'sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Alegario Cure Hospital</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poppins&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Over ride Css -->


</head>
<style>
  .card-proj{
    display:flex;
    flex-wrap:wrap;
    justify-content:space-around;
    padding:10px;
  }
</style>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div>
  <h1>Admin</h1>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#request_modal">
    Create Request
  </button>

  <!-- Modal -->
  <div class="modal fade" id="request_modal" tabindex="-1" aria-labelledby="request_modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="request_modal">Request Form</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="index.php" method="post">
            <div class="mb-3">
              <label for="" class="form-label">Project Requestor</label>
              <input type="text" class="form-control" name="project_requestor" required>

              <label for="exampleFormControlInput1" class="form-label">Project Name</label>
              <input type="text" class="form-control" name="project_name" required>
            </div>
            <div class="mb-3">
              <label for="exampleFormControlTextarea1" class="form-label">Project Details</label>
              <textarea class="form-control" name="project_details" rows="3" required></textarea>

              <label for="date">Date</label>
              <input type="date" id="dates" name="date" class="form-control"required>

            </div>
            <div class="mb-3">
              <input type="submit" class="btn btn-primary" name="request" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card-proj">
<?php while($result = mysqli_fetch_array($sqlProject)){?>
  <div class="card mt-2" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">
    <?php echo $result['Project_Name']; ?>
    </h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <form action="note.php">
    <input type="submit" class="btn btn-primary" value="Accept">
      <input type="submit" class="btn btn-secondary" value = "Decline">
    <input type="hidden" name="project_id" value="
    <?php echo $result['Project_id'];?>
    ">
    
  </form>
</div>
</div>

  <?php } ?>
  
</div>



      
</main><!-- End #main -->

<script>
  document.getElementById('dates').valueAsDate = new Date();
</script>
<?php
include 'footer.php';
?>