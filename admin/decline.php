

<?php 
session_start();
include '../include/config.php';

    
    
    if(isset($_POST['submit']))
    {
        if(isset($_GET['view_id']))
        {
            $projid = $_GET['view_id'];
            $note = $_POST['note'];
            $queryNotes = "INSERT INTO rejectionnote 
                        (Project_id,Note_Description) 
                        VALUES ('$projid','$note');";

            $sqlnote = mysqli_query($con,$queryNotes);
            if($sqlnote)
            {
                ?>
                <script>
                    // window.location.href='index.php?status=requestsent!';
                    window.location.href='admin.php';
                </script>
                <?php
            }
            else 
            {
                die(mysqli_error($con));
            }
        }
        else
        {
            $_GET['view_id'] = "";
        }
    }

?> 
<?php
  include './admin-include/header.php';
  include './admin-include/sidebar.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</head>
<style>
    .main{
        width:100wv;
        height:100%;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    .con{
        width: 50%;
    }
</style>
<body>

<div class="main">
<div class="con">
<form action="<?php $_SERVER['PHP_SELF'];?>" method='POST'>
<h1>Decline Notes</h1>
<input type="hidden" name="project_id" value=<?php echo $_GET['view_id'];?>>
<textarea name="note" class="form-control" id="" cols="30" rows="10"></textarea>
<br>
<button type="submit" name="submit" class="btn btn-success">submit</button>
</form>
</div>

</div>

<?php 
 include './admin-include/footer.php';

  ?>
</body>
</html>

