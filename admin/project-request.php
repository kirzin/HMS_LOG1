<?php
  session_start();
  include '../include/config.php';

if(isset($_POST['request'])){
  $project_requestor = mysqli_real_escape_string($con, $_POST['project_requestor']);
  $project_name = mysqli_real_escape_string($con, $_POST['project_name']);
  $project_details = mysqli_real_escape_string($con, $_POST['project_details']);
  $date = mysqli_real_escape_string($con, $_POST['date']);

  $qcreate = "INSERT INTO prequest VALUE(null,'$project_requestor','$project_name','$date','$project_details')";
  $sqlcreate = mysqli_query($con,$qcreate);
  echo '<script>Swal.fire("Succesful")</script></br>';

}
$queryProject = "SELECT * FROM project";
$sqlProject = mysqli_query($con,$queryProject);
?>


<?php
  include './admin-include/header.php';
  include './admin-include/sidebar.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
<!-- sampss -->
  <title>Dashboard - Alegario Cure Hospital</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&family=Poppins&family=Quicksand&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&family=Inter:wght@300;400;600;800&family=Poppins&family=Roboto:wght@100;300;400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- Over ride Css -->


</head>
<style>
  .card-proj{
    display:flex;
    flex-wrap:wrap;
    justify-content:space-evenly;
    padding:10px;
  }
  .prj-summary{
    border-bottom:solid 1px;
    padding:10px;
  }
  h5{
    border-left:solid 5px orange;
  }
  /* .toogle {
  margin:200px;
 border:solid;
} */
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
          
          <form action="project-request.php" method="post">
            <div class="mb-3">
              <label  class="form-label">Project Requestor</label>
              <input type="text" class="form-control" name="project_requestor"  required>

              <label class="form-label">Project Name</label>
              <input type="text" class="form-control" name="project_name" required>
            </div>
            <div class="mb-3">
              <label  class="form-label">Project Details</label>
              <textarea class="form-control" name="project_details" rows="3" required></textarea>

              <label >Date</label>
              <input type="date" id="dates" name="date" class="form-control"required>

            </div>
            <div class="mb-3">
              <input id="alertButton" type="submit" class="btn btn-primary" name="request" value="Submit">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card-proj " >
<?php while($result = mysqli_fetch_array($sqlProject)){?>
  <div class="card mt-2" style="width: 28rem;">
  <div class="card-body"id="card-proj">
    <h1 class="card-title">
    <?php echo $result['Project_Name']; ?>
    </h1>
           <div class="prj-summary">
      <h5>Project Summary:</h5>
      <?php echo $result['Project_Summary'];?>
      <h5>Project Start Date:</h5>
      <?php echo $result['Project_StartDate'];?>
      </div>
     <!-- <button id="toggleBtn">Toggle Text Color</button> -->

    <form action="note.php" class="mt-2">
    <a href="#" class="btn btn-primary">Accept</a>
      <a href="decline.php?view_id=<?php echo $result['Project_id']; ?>" class="btn btn-primary">Decline</a>
    <input type="hidden" name="project_id" value=" <?php echo $result['Project_id'];?> ">
    
  </form>
</div>
</div>

  <?php } ?>
  
</div>



  
      
</main><!-- End #main -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

  
//submitted
 document.getElementById("alertButton").addEventListener("click", function(){
        Swal.fire(
  'Good job!',
  'Submitted',
  'success'
)
    });



  document.getElementById('dates').valueAsDate = new Date();

const toggleBtn = document.getElementById("toggleBtn");
const text = document.getElementById("card-proj");

toggleBtn.addEventListener("click", function() {
  text.classList.toggle("toogle");
});

</script>
<?php
 
  include './admin-include/footer.php';
?>