<?php
include ('db.php');

$pid = $_GET['project_id'];
// select * from project left join rejectionnote on project.Project_id = rejectionnote.Note_id where project.Project_id = 46;


$querypid = "SELECT * FROM rejectionnote RIGHT JOIN project ON rejectionnote.Note_id = project.Project_id WHERE project.Project_id = '" . $pid . "'";
$sqlpid = mysqli_query($conn,$querypid);

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
    <title>note</title>
</head>
<body>
<?php if($spid) { ?>
        <h1>
        <?php echo $spid['Project_Name']; ?>
        <?php echo $spid['Note_id']; ?>
        </h1>
    <?php } ?>
    
</body>
</html>