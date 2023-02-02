<?php
  include './include/config.php';

if(isset($_POST['confirm'])){
 $prequestid = $_POST['prequestid'];
 $projectname = $_POST['projectname'];
 $category = $_POST['category'];
 $date_added = $_POST['dateadded'];
 $project_summary = $_POST['project_summary'];
 $project_desire = $_POST['project_desire'];
 $project_additional = $_POST['project_additional'];
 $project_budget = $_POST['project_budget'];
 $contractor = $_POST['contractor'];
 $project_action = $_POST['project_action'];
 $project_benefits = $_POST['project_benefits'];


$Project = "INSERT INTO project VALUE(null,$prequestid,$category,'$projectname',' ',' ',' ','$date_added','$project_summary','$project_desire','$project_action','$project_benefits',$project_budget,'$project_additional',0,'pending',$contractor)";

$sqlProject = mysqli_query($con,$Project);

echo '<script>alert("Succesful")</script></br>';
echo '<script>window.location.href = "index.php"</script>';
}



?>