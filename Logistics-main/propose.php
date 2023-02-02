<?php
require('db.php');

$pid = $_GET['propose_id'];
$querypid = "SELECT * FROM prequest WHERE Prequest_id = '" . $pid . "'";
$sqlpid = mysqli_query($conn,$querypid);
//category
$qcategory = "SELECT * FROM ccategory";
$sqlcategory = mysqli_query($conn,$qcategory);
//contractors
$qcontractors = "SELECT * FROM contractors";
$sqlcontractors = mysqli_query($conn,$qcontractors);
//
$project = "SELECT * FROM project";
$sproject = mysqli_query($conn,$project);

if ($sqlpid && mysqli_num_rows($sqlpid) > 0) {
    $spid = mysqli_fetch_array($sqlpid);
} else {
    echo "No rows returned";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  <link href="assets/css/propose.css" rel="stylesheet">

    <title>Proposal Form</title>
</head>
<body>
    <div class="main-container p-5 shadow-lg rounded">
    <form action="proposeCreate.php" method="post" class="row g-3">
    <div class="col-12">
    <?php if($spid) { ?>
    <h4>Project Requestor:
      
      <?php echo $spid['Project_Requestor']; ?>
    </h4>
    <input type="hidden" name="prequestid" value =" <?php echo $spid['Prequest_id'];?> 
    ">
    
    
  </div>
  <div class="col-md-6">
    <label class="form-label">Project Name</label>
    <input type="text" name="projectname" class="form-control" value = <?php echo $spid['Project_Name']; ?>>
  </div>
  <div class="col-md-6">
   
  <label class="form-label">Date Added</label>
    <input type="text" name="dateadded" class="form-control" require value = <?php echo $spid['Request_Date']; ?>>
  </div>
  <?php } ?>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Project Action to Completion</label>
    <textarea name="project_action" required class="form-control"></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Project Benefits</label>
    <textarea name="project_benefits" class="form-control"></textarea>
  </div>

  <div class="col-md-4">
    <label for="inputAddress" class="form-label">Project Budget</label>
    <input type="number" name="project_budget" class="form-control">
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Category</label>
    <select id="inputState" class="form-select" name="category">
    <?php while($category = mysqli_fetch_array($sqlcategory)){?>
      <option value = "<?php echo $category['Ccategory_id']; ?>">
      <?php echo $category['Category_Name']; ?>
      </option>
      <?php }?>
    </select>
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Contractor</label>
    <select id="inputState" class="form-select" name="contractor">
    <?php while($contractors = mysqli_fetch_array($sqlcontractors)){?>
      <option value="<?php echo $contractors['Contractor_id']; ?>">
        <?php echo $contractors['Contractor_Personnel']; ?>
      </option>
      <?php }?>
    </select>
  </div>

  <div class="col-md-12">
    <label for="inputCity" class="form-label">Project Additional Info</label>
    <textarea name="project_additional" class="form-control" ></textarea>
  </div>

  <div class="col-md-12">
    <label for="inputCity" class="form-label">Project Summary</label>
    <textarea name="project_summary" class="form-control"></textarea>
  </div>
  
  <div class="col-md-12">
    <label for="inputCity" class="form-label">Project Desire Outcome</label>
    <textarea name="project_desire" class="form-control"></textarea>
  </div>

  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="confirm">Confirm</button>
    <button type="reset" class="btn btn-primary">Reset</button>
  </div>
</form>
   
    </div>
    
</body>
<?php
include 'footer.php';
?>
</html>