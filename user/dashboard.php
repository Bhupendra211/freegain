<?php
session_start();

// If user is not register and try to Dashboard  page
if(isset($_SESSION["login"])!=true){
    header("location:../login.php");
    exit();
}

else{

    include("../dbconnection.php");

    $username=  $_SESSION["username"];

    $earning= mysqli_query($con,"SELECT * FROM user_earning WHERE username='$username'");

    if(mysqli_num_rows($earning)==0){
        $insert= mysqli_query($con,"INSERT INTO `user_earning` (`username`, `total_earning`) VALUES ( '$username', '0');");

     $earning= mysqli_query($con,"SELECT * FROM user_earning WHERE username='$username'");

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

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">

            <div class="container manager mb-5">
                <?php while($row=mysqli_fetch_assoc($earning)){?>
                    <div class="row">
                
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="box1 py-2 shadow p-3 mb-5 bg-info " style="border:1px solid white; border-radius: 20px;">

                                <p class="text-center">
                                    <i class="fa-solid fa-database fa-2x text-primary"></i>
                                    <span class="fs-5 fw-bold text-light">Today Earning</span>
                                </p>

                                <p class="text-center fs-5"><b><?php echo $row['total_earning']?> FG</b></p>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-12">
                        <div class="box1 py-2 shadow p-3 mb-5 bg-info " style="border:1px solid white; border-radius: 20px;">

                                <p class="text-center">
                                    <i class="fa-solid fa-network-wired fa-2x text-primary"></i>
                                    <span class="fs-5 fw-bold text-light">Referral Earning</span>
                                </p>

                                <p class="text-center fs-5"><b><?php echo $row['total_earning']?> FG</b></p>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-4 col-12">
                        <div class="box1 py-2 shadow p-3 mb-5 bg-info " style="border:1px solid white; border-radius: 20px;">

                                <p class="text-center">
                                    <i class="fa-solid fa-database fa-2x text-primary"></i>
                                    <span class="fs-5 fw-bold text-light">Total Earning</span>
                                </p>

                                <p class="text-center fs-5"><b><?php echo $row['total_earning']?> FG</b></p>
                            </div>
                        </div>


                    </div>
               
            </div>

            <!-- Adding Payment System -->
            <div class="container manager mb-5">
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-12 ">
                        <div class="shadow-sm p-3 mb-5 bg-white rounded">
                            <p class="text-center fs-5 fw-bold">Withdraw</p>

                            <p class="text-center">Total Earning: <?php echo $row['total_earning']?> FG</p>

                            <p class="text-center">
                                <span><a href="withdrawal.php" class="btn btn-primary">Withdraw</a></span>
                                <span><a href="widthdrawalhistory.php" class="btn btn-warning">Withdraw History</a></span>
                            </p>

                            <p class="bg-info rounded ps-3">New Features are coming Soon..</p>
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-4 col-12 ">
                        <div class="shadow-sm p-3 mb-5 bg-white rounded pb-5">
                            <p class="text-center pb-4 fs-5 fw-bold">Account Details</p>
                            <p class="text-center pb-5">Comming Soon....</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 ">
                        <div class="shadow-sm p-3 mb-5 bg-white rounded pb-5">
                            <p class="text-center pb-4 fs-5 fw-bold">Add Fund</p>
                            <p class="text-center pb-5">Comming Soon....</p>
                        </div>
                    </div>
                </div>
            </div>


            <?php }?>
            <!--  -->

            <script>
            document.addEventListener("DOMContentLoaded", () => {
                var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                        data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                        // shape: 'circle',
                        indicator: [{
                                name: 'Sales',
                                max: 6500
                            },
                            {
                                name: 'Administration',
                                max: 16000
                            },
                            {
                                name: 'Information Technology',
                                max: 30000
                            },
                            {
                                name: 'Customer Support',
                                max: 38000
                            },
                            {
                                name: 'Development',
                                max: 52000
                            },
                            {
                                name: 'Marketing',
                                max: 25000
                            }
                        ]
                    },
                    series: [{
                        name: 'Budget vs spending',
                        type: 'radar',
                        data: [{
                                value: [4200, 3000, 20000, 35000, 50000, 18000],
                                name: 'Allocated Budget'
                            },
                            {
                                value: [5000, 14000, 28000, 26000, 42000, 21000],
                                name: 'Actual Spending'
                            }
                        ]
                    }]
                });
            });
            </script>

            </div>
            </div><!-- End Budget Report -->







            </div><!-- End Right side columns -->

            </div>
        </section>

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