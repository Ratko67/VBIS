<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: adminLogin.php");
    exit();
}
?>

<!DOCTYPE html>

<html lang="en">
<head><base href="">
    <meta charset="utf-8" />
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/scripts.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        html{
            width:100%;
        }

        .submenu a {
            display: block;
            padding: 8px 12px;
            text-decoration: none;
            color: #333;
        }
        .submenu a:hover {
            background-color: #f0f0f0;
        }
        .ikona :hover{
            color: red;
        }
        label{
            font-weight: bold;
            font-size: 20px;

        }
        .main{
            display: flex;
        }

    </style>
</head>

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">
<div id="kt_aside" class="aside aside-extended bg-white" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_toggle">

    <div class="aside-primary d-flex flex-column align-items-lg-center flex-row-auto">


        <div class="aside-nav d-flex flex-column flex-lg-center flex-column-fluid w-100 pt-5 pt-lg-0" id="kt_aside_nav">

            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
                <div class="menu-item py-2">

                    <a class="menu-link active menu-center" href="adminLogged.php" title="Home" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0 ikona" style="color: black;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                              </svg>
                        </span>
                    </a>
                </div>




            </div>

            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="dashboard.php" title="Edit concerts" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                        <span class="menu-icon me-0 ikona" style="color: black;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                              </svg>

                        </span>
                    </a>
                </div>




            </div>
            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="adminReservations.php" title="Concert reservations" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon me-0 ikona" style="color: black;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-ticket" viewBox="0 0 16 16">
                                    <path d="M0 4.5A1.5 1.5 0 0 1 1.5 3h13A1.5 1.5 0 0 1 16 4.5V6a.5.5 0 0 1-.5.5 1.5 1.5 0 0 0 0 3 .5.5 0 0 1 .5.5v1.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 11.5V10a.5.5 0 0 1 .5-.5 1.5 1.5 0 1 0 0-3A.5.5 0 0 1 0 6zM1.5 4a.5.5 0 0 0-.5.5v1.05a2.5 2.5 0 0 1 0 4.9v1.05a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-1.05a2.5 2.5 0 0 1 0-4.9V4.5a.5.5 0 0 0-.5-.5z"/>
                                  </svg>

                            </span>
                    </a>
                </div>




            </div>
            <div id="kt_aside_menu" class="menu menu-column menu-title-gray-600 menu-icon-gray-400 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-bold fs-5" data-kt-menu="true">
                <div class="menu-item py-2">
                    <a class="menu-link active menu-center" href="adminNewUsers.php" title="User info" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right">
                            <span class="menu-icon me-0 ikona" style="color: black;">

                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                                  </svg>

                            </span>
                    </a>
                </div>
            </div>

        </div>

        <div class="aside-footer d-flex flex-column align-items-center flex-column-auto" id="kt_aside_footer">
            <div class="mb-7">
                <a href="adminLogged.php?logout=true">
                    <i class="bi bi-box-arrow-left" style="font-size: 20px; color: red;"></i>
                </a>
            </div>
        </div>
    </div>

</div>

<section class="main">
    <div class="dashboard-item">
        <div class="dashboard-card">
            <span class="badge badge-light-success"><label>ACTIVE CONCERTS</label></span>
            <?php include('adminTable.php'); ?>
            <a href="dashboard.php" class="btn btn-light-dark">VIEW ALL</a>
        </div>
    </div>


    <div class="dashboard-item">
        <div class="dashboard-card" >
            <span class="badge badge-light-dark"><label>New Users stats</label></span>
            <?php include('adminUsersInfo.php'); ?>
            <a href="adminNewUsers.php" class="btn btn-light-dark">VIEW ALL</a>
        </div>
    </div>

    <div class="dashboard-item">
        <div class="dashboard-card">
            <span class="badge badge-light-dark"><label>MOST EXPENSIVE CONCERTS</label></span>
            <?php include('MEConcerts.php'); ?>
        </div>
    </div>



</section>

<style>
    .main {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;
        margin-left: 6%;
        margin-top: -10px;
    }
    .dashboard-item {
        width: 40%;
        margin-left: 30px;
        margin-top: 20px;
    }

    .dashboard-card {
        padding: 20px;

        border: 1px solid rgb(241, 241, 241);
        border-radius: 20px;
        background-color: white;
        box-shadow: 5px 5px 10px #eae9e9, -5px -5px 10px #e7e7e7;
    }
</style>

</body>
</html>h
