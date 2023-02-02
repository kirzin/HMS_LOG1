<?php
session_start();
include './include/config.php';
//additem
if(isset($_POST['add']))
{
    $iname = mysqli_real_escape_string($con, $_POST['iname']);
    $idesc = mysqli_real_escape_string($con, $_POST['idesc']);
    $iquan = mysqli_real_escape_string($con, $_POST['iquan']);

    if(isset($_SESSION['itemlist']))
    {
        $item = array_column($_SESSION['itemlist'],'iname');
        if(!in_array($iname,$item))
        {
            $count = count($_SESSION['itemlist']);
            $_SESSION['itemlist'][$count] = array('iname'=>$iname,
                                                  'idesc'=>$idesc,
                                                  'iquan'=>$iquan);
        }
        else
        {
            echo "item already exists";
        }
    }
    else 
    {
        $_SESSION['itemlist'][0] = array('iname'=>$iname,
                                                  'idesc'=>$idesc,
                                                  'iquan'=>$iquan);    
    }
}
//removeitem
if(isset($_POST['remove']))
                    {
                        if(isset($_SESSION['itemlist']))
                        {
                            foreach($_SESSION['itemlist'] as $key => $values)
                            {
                                if($values['iname'] == $_POST['ditem'])
                                {
                                    $_SESSION['itemlist'] = array_values($_SESSION['itemlist']);
                                    unset($_SESSION['itemlist'][$key]);
                                    ?>
                                    <script>
                                        window.location.href='department-request.php';
                                    </script>
                                    <?php
                                }
                            }
                        }
                    }

//recorditem
if(isset($_POST['submit']))
{
    $requestor = $_POST['requestor'];
    $message = $_POST['message'];

    if(isset($_SESSION['itemlist']))
    {
        $sql = "INSERT INTO request (Item_Requestor,department_id,Request_Message)
                VALUES (?,?,?)";
        $stmt = mysqli_stmt_init($con);
        if(mysqli_stmt_prepare($stmt,$sql))
        {
            $department = 1;
            mysqli_stmt_bind_param($stmt,"sis",$requestor,$department,$message);
            mysqli_stmt_execute($stmt);
            echo "record inserted";

            $newid = mysqli_insert_id($con);

                foreach($_SESSION['itemlist'] as $key => $values)
                {
                    $sql = "INSERT INTO itemrequest (Request_id,ItemRequest_Name,ItemRequest_Description,ItemRequest_Quantity)
                            VALUES(?,?,?,?);";

                    $stmt = mysqli_stmt_init($con);
                    if(mysqli_stmt_prepare($stmt,$sql))
                    {
                        mysqli_stmt_bind_param($stmt,"issi",$newid,$values['iname'],$values['idesc'],$values['iquan']);
                        mysqli_stmt_execute($stmt);

                        
                        ?>
                        <script>
                            window.location.href='index.php';
                        </script>
                        <?php
                        unset($_SESSION['itemlist']);
                        $_SESSION['itemlist'] = array_values($_SESSION['itemlist']);
                    }
                }
            }
        }
        
    }
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

<main class="main" id="main">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Personal Information</h5>
            <form action="department-request.php" method="POST">
                <label for="" class="form-label">Requestor:</label>
                <input type="text" name='requestor' class='form-control' value='JohnDoe'>
                <label for=""  class="form-label">Message:</label>
                <input type="text" name='message' class='form-control'>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Requisition Form</h5>
            <form action="department-request.php" method="POST">
            <input type="text" name="iname">
                <input type="text" name="idesc">
                <input type="number" name="iquan">
                <input type="submit" name='add' value="Add">
            </form>
                
            <table class='table table-striped'>
                <thead>
                    <th>#</th>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php 
                    if(isset($_SESSION['itemlist']))
                    {
                        $num = 0;
                        foreach($_SESSION['itemlist'] as $key => $values)
                        {
                            $num += 1;
                            echo 
                            "
                            <tr>
                            <td>$num</td>
                            <td>$values[iname]</td>
                            <td>$values[idesc]</td>
                            <td>$values[iquan]</td>
                            <td>
                            <form action='department-request.php' method='POST'>
                            <input type='hidden' name='ditem' value='$values[iname]'>
                            <input type='submit' name='remove' value='Remove' class='btn btn-danger'>
                            </form>
                            </td>
                            </tr>
                            ";
                        }
                    }
                    ?>
                </tbody>
            </table>
                
        </div>
    </div>
</main>