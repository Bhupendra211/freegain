<?php
session_start();

// If user is not register and try to Dashboard  page
if(isset($_SESSION["login"])!=true){
    header("location:../login.php");
    exit();
}

else{

    include("../dbconnection.php");

    $myuser=  $_SESSION["username"];

    $show= false;

    // Getting Daily pole details from database
    $daily= mysqli_query($con,"SELECT * FROM `daily_survey`");


// Searching user is already attemped before daily pole
    $checkuser= mysqli_query($con,"SELECT * FROM user_daily_pole WHERE username='$myuser'");

    if(mysqli_num_rows($checkuser)==0){
        $status= mysqli_query($con,"INSERT INTO `user_daily_pole` ( `username`, `status`) VALUES ('$myuser', 'panding');");
    }


    $row=mysqli_fetch_assoc($checkuser);

    if($row['status']=="panding"){
        $show=true;
    }

    
    if($_SERVER['REQUEST_METHOD']=="POST" && $show){
        if(!empty($_POST['option1'])){
            $option= $_POST["option1"];
            $points= $_POST["points"];
            
            $update= mysqli_query($con,"UPDATE user_daily_pole SET status='completed' WHERE username='$myuser'");

            $updateEarning= mysqli_query($con,"SELECT * FROM user_earning where username='$myuser'");
            $row= mysqli_fetch_assoc($updateEarning);
            $earn= $row['total_earning'];
            $earn+=$points;

            $updateuser= mysqli_query($con,"UPDATE user_earning SET total_earning=$earn WHERE username='$myuser'");
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>FreeGain- Dashboard</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <?php include('sidenav.php');?>

    <main id="main" class="main">

        <div class="pt-4">
            <h3 class="text-center ">Daily Survay Pole</h3>
            <p>Answer the survey and claim your daily reward.You can claim only one time in a day </p>

            <?php if($show){?>
                <?php while($row=mysqli_fetch_assoc($daily)){?>

                <p><strong>Q. <?php echo $row['question']?> </strong></p>

                <form action="survey.php" method="POST">

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="check1" name="option1" value="<?php echo $row['option1']?>">
                        <label class="form-check-label"><?php echo $row['option1']?></label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="check1" name="option1" value="<?php echo $row['option2']?>">
                        <label class="form-check-label"><?php echo $row['option2']?></label>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="check1" name="option1" value="<?php echo $row['option3']?>">
                        <label class="form-check-label"><?php echo $row['option3']?></label>
                    </div>

                    <input type="hidden" name="points" value="<?php echo $row['points']?>">
                    <br>
                    <div class="text-center">
                        <input type="submit" value="Submit" class="btn btn-primary">
                    </div>

                </form>

                <?php }}else{?>
                    <h4>You are completed today's daily survey</h4>
            <?php }?>
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span><a href="http://freegain.xyz/">FreeGain</a></span></strong>. All Rights
            Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/chart.js/chart.min.js"></script>
    <script src="../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../assets/vendor/quill/quill.min.js"></script>
    <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>

</body>
<?php }?>
</html>