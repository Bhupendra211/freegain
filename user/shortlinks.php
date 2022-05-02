<?php
session_start();

// If user is not register and try to Dashboard  page
if(isset($_SESSION["login"])!=true){
    header("location:../login.php");
    exit();
}

else{


    $myuser= $_SESSION['username'];

    include('../dbconnection.php');

    $sql= "SELECT * FROM shortlinks";
    $query= mysqli_query($con,$sql);

    // check user is on the table or not
    $usershort= mysqli_query($con,"SELECT * FROM user_shortlinks WHERE username='$myuser'");

    if(mysqli_num_rows($usershort)==0){
        $newquery= mysqli_query($con,"INSERT INTO `user_shortlinks` (`username`, `link1`, `link2`, `link3`, `link4`, `link5`, `link6`, `link7`, `link8`, `link9`, `link10`, `date`) 
        VALUES ('$myuser', '2', '2', '2', '2', '2', '2', '2', '2', '2', '2', current_timestamp());");
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

        <div class="pagetit
        le">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Shortlink</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

         <!-- Displaying The Details on head -->
         <div class="container">
            <div class="row mb-5">

                <div class="col-lg-4 col-md-4 col-12 mt-5">
                    <div class="shadow-sm p-3 mb-1 bg-white rounded">
                        <p class="fs-5 text-center">
                            <i class='bx bxs-component text-primary '></i>
                            <span>Total Links: 30</span>
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12 mt-5">
                    <div class="shadow-sm p-3 mb-1 bg-white rounded">
                        <p class="fs-5 text-center">
                            <i class='bx bxs-component text-primary '></i>
                            <span>Total Points: 300000 FG</span>
                        </p>
                    </div>
                </div>


                <div class="col-lg-4 col-md-4 col-12 mt-5">
                    <div class="shadow-sm p-3 mb-1 bg-white rounded">
                        <p class="fs-5 text-center">
                            <i class='bx bxs-component text-primary '></i>
                            <span>Total Energy: 3000</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Head details-->

        <!-- List of Links -->
        <div class="container">

        <?php while($row2=mysqli_fetch_assoc($usershort)){?>

        <?php while($row=mysqli_fetch_assoc($query)){?>
            
            <div class="row shadow-sm p-3 mb-4 bg-white rounded text-center">

                <div class="col-lg-2 col-md-2 col-12">
                    <i class='bx bx-link bx-md text-warning'></i>
                </div>

                <div class="col-lg-2 col-md-2 col-12">
                    <p class="text-primary fs-5"><strong> <?php echo $row['site_name'];?></strong></p>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <p class="fs-5"><strong>Points:</strong> <?php echo $row['points'];?> FG </p>
                </div>

                <div class="col-lg-2 col-md-2 col-12 mb-4">
                    <span class="p-2 fs-5"
                        style="border:1px solid black; border-radius: 50px;">
                        
                        <?php echo $row2[('link_'.$row['id'])];?>/
                        <?php echo $row['total'];?>
                    </span>
                </div>

                <div class="col-lg-2 col-md-2 col-12">
                    <a href="<?php echo $row['url'];?>" target="_blank" class="btn btn-primary px-3 shadow">Go</a>
                </div>
            </div>

            <?php }}?>
            <?php }?>


            <!-- End of List of link -->
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

</html>