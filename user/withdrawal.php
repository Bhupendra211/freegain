<?php
session_start();

// If user is not register and try to Dashboard  page
if (isset($_SESSION["login"]) != true) {
    header("location:../login.php");
    exit();
} else {

    $myusername = $_SESSION['username'];


    global $userearning;

    include("../dbconnection.php");

    // Getting User total earning
    $earning = mysqli_query($con, "SELECT * FROM `user_earning` WHERE username='$myusername' ");

    while ($row = mysqli_fetch_assoc($earning)) {
        
        $userearning= $row['total_earning'];
        
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $method = $_POST['payment'];
        $number = $_POST['number'];
        $amount = $_POST['amount'];

        if($userearning>$amount){

        $sql = "INSERT INTO `widthdrawal` ( `username`, `payment_method`, `payment_number`, `payment_amount`, `date`) VALUES 
        ('$myusername', '$method', $number, $amount, current_timestamp());";

        $query = mysqli_query($con, $sql);

        $save= $userearning-$amount;
        
        $updateEarning= mysqli_query($con,"UPDATE user_earning SET total_earning=$save WHERE username='$myusername'");

    }

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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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

    <!-- Font Awesome Link Cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


</head>

<body>

    <?php include('sidenav.php'); ?>

    <main id="main" class="main">



        <!-- Display Header Details -->
        <div class="container manager mb-5">

            <div class="row">

                <div class="col-lg-3 col-md-3">

                </div>

                <div class="col-lg-6 col-md-6 col-12 text-center">
                    <div class="shadow-sm p-3 mb-5 bg-white rounded">

                        <form action="withdrawal.php" method="POST">

                            <h3 class="fs-4 text-secondary mb-4">Select Redeem Method</h3>

                            <label id="m1" for="payment" class="fs-5 pe-5">Select Redeem Method</label>

                            <select name="payment" class="payment mb-4" style="border:none;">
                                <option selected value="Paytm">Paytm</option>
                                <option value="GooglePay">Google Pay</option>
                                <option value="AmazonPay">Amazon Pay</option>
                            </select>

                            <div id="details"></div>


                            <input id="submit" type="submit" value="Submit" class="submit btn btn-primary">


                        </form>

                    </div>
                </div>

                <div class="col-lg-3 col-md-3"></div>
            </div>


        </div>


        <?php

            if ($userearning >= 1000) {
                echo '
              <script>
                let btn= document.getElementById("submit");
                btn.disabled=false;
              </script>
              ';
            } else {
                echo '
                <script>
                  let btn= document.getElementById("submit");
                  btn.disabled=true

                </script>
                ';
            }

        ?>




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






    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span><a href="http://freegain.xyz/">FreeGain</a></span></strong>. All Rights
            Reserved
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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


    <!-- This Section for selecting Payment method -->
    <script>
        $(document).ready(function() {

            $("#details").html(
                '<label for="paytm">Enter Paytm Number: &nbsp; &nbsp;</label><input id="paytm" type="number" name="number" placeholder="Paytm Number" class="px-1" style="border:1px solid black;"> <br><br><label for="paytm2">Enter Redeem Amount: &nbsp; &nbsp;</label><input id="paytm2" type="number" name="amount" placeholder="Enter withdrawal amount" class="px-1" style="border:1px solid black;"> <br><br>'
            );

            $("select.payment").change(function() {
                var payoption = $(this).children("option:selected").val();

                if (payoption == "Paytm") {

                    $("#details").html(
                        '<label for="paytm">Enter Paytm Number: &nbsp; &nbsp;</label><input id="paytm" type="number" name="number" placeholder="Patym Number" class="px-1" style="border:1px solid black;"> <br><br><label for="paytm2">Enter Redeem Amount: &nbsp; &nbsp;</label><input id="paytm2" type="number" name="amount" placeholder="Enter withdrawal amount" class="px-1" style="border:1px solid black;"> <br><br>'
                    );
                }

                if (payoption == "GooglePay") {

                    $("#details").html(
                        '<label for="googlepay">Enter Google Pay Number: &nbsp; &nbsp;</label><input id="googlepay" type="number" name="number" placeholder="Google Pay Number" class="px-1" style="border:1px solid black;"> <br><br><label for="googlepay2">Enter Redeem Amount: &nbsp; &nbsp;</label><input id="googlepay2" type="number" name="amount" placeholder="Enter withdrawal amount" class="px-1" style="border:1px solid black;"> <br><br>'
                    );
                }

                if (payoption == "AmazonPay") {
                    $("#details").html(
                        '<label for="amazonpay">Enter Amazon Pay Number: &nbsp; &nbsp;</label><input id="amazonpay" type="number" name="number" placeholder="Amazon Pay Number" class="px-1" style="border:1px solid black;"><br><br><label for="amazonpay2">Enter Redeem Amount: &nbsp; &nbsp;</label><input id="amazonpay2" type="number" name="amount" placeholder="Enter withdrawal amount" class="px-1" style="border:1px solid black;"> <br><br>'
                    );
                }
            });
        });
    </script>

</body>

</html>