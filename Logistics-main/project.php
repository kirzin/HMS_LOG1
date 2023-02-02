<?php
require('db.php');

$queryPrequest = "SELECT * FROM prequest";
$sqlPrequest = mysqli_query($conn,$queryPrequest);

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
.container{
  display:flex;
  flex-wrap:wrap;
  padding:10px;
}
.card-body{
  display:flex;
  flex-direction:column;
  justify-content:flex-end;
}
.disabled {
  pointer-events: none;
  opacity: 0.5;
  color:red;
}
</style>
<body>

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
  <h1>Requested Projects</h1>
  <div class="container">
  <?php while($result = mysqli_fetch_array($sqlPrequest)){?>
<div class="card m-2" id="cards" style="width: 18rem;">
  <!-- <img src="..." class="card-img-top" alt="..."> -->
  <div class="card-body">
    <h5 class="card-title">
      <span>Project Name:</span>
      <?php echo $result['Project_Name'];?>
    </h5>
      <span>Request Date:</span>
      <?php echo $result['Request_Date'];?>
    <p class="card-text">
      <span>Request Details:</span>
      <?php echo $result['Request_Details']?>
    </p>
    <form action="propose.php">
      <input type="submit" class="btn btn-secondary" value = "Propose">
    <input type="hidden" name="propose_id" value="
    <?php echo $result['Prequest_id'];?>
    ">
    </div>
  </form>
  </div>

    <?php }?>

  </div>
  </div>
  
</main><!-- End #main -->




<!-- 
<script>
function disable(x){
let reject = document.querySelector('#reject');
reject.classList.add("disabled");
}

// var button = document.getElementById("reject");
// button.addEventListener("click", function() {
//   var button1 = document.getElementById("button1");
//   button1.classList.add("disabled");
// });
</script> -->
  </body>
  </html>

<?php
include 'footer.php';
?>