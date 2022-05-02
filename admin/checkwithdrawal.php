<?php
session_start();

// If user is not register and try to Dashboard  page
if(isset($_SESSION["login"])!=true){
    header("location:../login.php");
    exit();
}

else{

    include("../dbconnection.php");

    $myusername=  $_SESSION["username"];

    $sql= "SELECT * FROM `widthdrawal`";

    $query= mysqli_query($con,$sql);


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

        <table class="table table-primary">
            <thead>
                <tr>
                    <th scope="col text-center">id</th>
                    <th scope="col text-center">Username</th>
                    <th scope="col text-center">Payment Method</th>
                    <th scope="col text-center">Payment Number</th>
                    <th scope="col text-center">Payment Amount</th>
                    <th scope="col text-center">Date and Time</th>
                    <th scope="col text-center">Action</th>
                </tr>
            </thead>
            <tbody>

                <?php while($row=mysqli_fetch_assoc($query)){?>
                
                <tr>
                    <th scope="row text-center">1</th>
                    <td class="text-center"><?php echo $row['username'];?></td>
                    <td class="text-center"><?php echo $row['payment_method'];?></td>
                    <td class="text-center"><?php echo $row['payment_number'];?></td>
                    <td class="text-center"><?php echo $row['payment_amount'];?></td>
                    <td class="text-center"><?php echo $row['date'];?></td>
                    <td class="text-center"><a class="btn btn-primary">Proced</a></td>
                </tr>
                <?php }?>
            </tbody>
        </table>


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

</html>