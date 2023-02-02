<?php
include './include/config.php';
if(isset($_SESSION['active']))
{
    if(isset($_SESSION['sessiontime']))
    {
        if((time()-$_SESSION['sessiontime']) > 500)
        {
            ?>
            <script>
                window.location.href='./auth/login.php?sessiontimeout';
            </script>
            <?php
        } 
        else 
        {
            $_SESSION['sessiontime'] = time();

            $sql = "SELECT * FROM user WHERE user_username = ?;";
            $stmt = mysqli_stmt_init($con);
            if (mysqli_stmt_prepare($stmt, $sql)) 
            {
                mysqli_stmt_bind_param($stmt, "s", $_SESSION['active']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result) 
                {
                    $row = mysqli_fetch_assoc($result);
                    $role = $row['userRole_id'];
                    if ($role != 4) 
                    {
                        ?>
                    <script>
                        window.location.href='./auth/login.php?restrictedaccess';
                    </script>
                    <?php
                    }
                }
            }
        }
    }
    else
    {
        $_SESSION['sessiontime'] = "nossession";
    }
}
else
{
    $_SESSION['active'] = "";
}
?>