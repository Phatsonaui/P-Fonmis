<?php header('Content-Type:text/html; charset=utf-8'); ?>
<?php session_start();
include_once("function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../class/class.db.php");
    require_once("../chgdatethai.php"); ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta http-equiv="Content-Type" content="text/html;" charset="utf-8" />
        <title>FONMIS</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script> -->
        <script src="https://nurse.buu.ac.th/2021/js1/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://nurse.buu.ac.th/2021/css1/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
        <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js"></script> -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.3.2/chart.umd.js" integrity="sha512-KIq/d78rZMlPa/mMe2W/QkRgg+l0/GAAu4mGBacU0OQyPV/7EPoGQChDb269GigVoPQit5CqbNRFbgTjXHHrQg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.2/dist/chart.umd.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- <script src="../ckeditor/ckeditor.js"></script>  -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.x.x/dist/Chart.min.js"></script> -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.semanticui.min.css">
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
        <!-- <script src="cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script> -->
        <!-- <script src="path/to/chartjs-plugin-doughnutlabel.min.js"></script> -->

    </head>
    <style type="text/css">
        main {
            display: flex;
            flex-wrap: nowrap;
            height: 100vh;
            height: -webkit-fill-available;
            max-height: 100vh;
            overflow-x: auto;
            overflow-y: hidden;
        }

        a {
            text-decoration: none;
            color: black;
        }

        .nav-link {
            display: block;
            padding: 0.5rem 1rem;
            color: black;
            text-decoration: none;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
        }

        .offcanvas-start {
            top: 0;
            left: 0;
            width: 280px;
            border-right: 1px solid rgba(0, 0, 0, .2);
            transform: translateX(-100%);
        }

        @media only screen and (max-width: 600px) {
            .offcanvas-start {
                top: 0;
                left: 0;
                width: 190px;
                border-right: 1px solid rgba(0, 0, 0, .2);
                transform: translateX(-100%);
            }
        }

        .dropdown-menu {
            position: absolute;
            z-index: 1000;
            display: none;
            min-width: 7rem;
            padding: 0.5rem 0;
            margin: 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, .15);
            border-radius: 0.25rem;
        }

        @media screen and (max-width: 1024px) {
            #myChart {
                display: block;
                box-sizing: border-box;
                height: 347px;
                width: 694px;
            }
        }

        #myChart {
            display: block;
            box-sizing: border-box;
            height: 347px;
            width: 694px;
        }

        .card-header {
            padding: 0.5rem 1rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            font-size: x-large;
            font-weight: 900;
        }

        .chart-container {
            width: 100%;
            /*    height: 500px;*/
        }

        @media only screen and (max-width: 767px) {
            .chart-container {
                height: 300px;
            }
        }

        .btn_ac {
            background-color: #EF6400;
            color: black !important;
        }

        ul li a {
            color: #fff;
            text-decoration: none;
        }

        #activet {
            color: #EF6400;
            font-weight: 800;
        }

        .gridd {
            grid-template-columns: repeat(5, 1fr);
            display: grid;
            justify-content: center;
            flex: none;
            grid-gap: 30px;
        }

        .gridd_budd {
            grid-template-columns: repeat(3, 1fr);
            display: grid;
            justify-content: center;
            flex: none;
            grid-gap: 30px;
        }

        @media all and (max-width: 1000px) {
            .gridd_budd {
                display: flex;
                justify-content: center;
                align-items: center;
                grid-gap: 30px;
                flex-wrap: wrap;
            }

            .budd {
                border-radius: 15px;
                width: 300px !important;
                height: 40px;
                /*        margin-bottom: 10px;*/
            }
        }

        .budd {
            border-radius: 15px;
            width: 100%;
            height: 40px;
            /*    margin-right: 50px; */
            /* width and height can be anything, as long as they're equal */
        }

        .relation {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
        }

        .circle {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            /*    margin-right: 50px; */
            /* width and height can be anything, as long as they're equal */
        }

        .Check_budd {
            position: absolute;
            flex-wrap: wrap;
            display: flex;
            z-index: 10;
            width: 20px;
            height: 2em;
            align-items: center;
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            margin-top: 6px;
            -moz-appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            cursor: pointer;
        }

        .Check_c {
            position: absolute;
            z-index: 10;
            width: 2em;
            margin-right: 0.25rem !important;
            margin-left: -16px;
            height: 2em;
            /* align-items: center; */
            margin-top: 4px;
            /* text-align-last: end; */
            vertical-align: top;
            /* background-color: #fff; */
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            /* border: 1px solid rgba(0,0,0,.25); */
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
            cursor: pointer;
        }

        .Check_c[type=checkbox] {
            border-radius: 0.25em;
        }

        .Check_c:checked[type=checkbox] {
            background-image: url(img/check-lg.svg);
        }

        .Check_c:checked {
            /* background-color: #0d6efd; */
            /* border-color: #0d6efd; */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: inherit !important;
            border: 1px solid transparent;
            border-radius: 2px;
            background: transparent;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: inherit !important;
            border: 1px solid rgba(0, 0, 0, 0.3);
            background-color: #EF6400;
            /*    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, rgba(230, 230, 230, 0.1)), color-stop(100%, rgba(0, 0, 0, 0.1)));*/
            background: -webkit-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -moz-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -ms-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: -o-linear-gradient(top, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
            background: linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            color: white !important;
            border: 1px solid #0d6efd;
            background: linear-gradient(to bottom, #0d6efd 0%, #0d6efd 100%);
        }

        .input-group-append button {
            border: none;
            background-color: transparent;
            padding: 10px;
            color: #555;
        }

        .select-items select {
            width: auto;
            display: inline-block;
        }

        .select-items label {
            font-weight: 600;
            font-size: 14px;
        }

        .dataTables_wrapper .dataTables_length .form-select:focus,
        .dataTables_wrapper .dataTables_length .form-select:hover {
            background-color: #fff;
            color: #007bff;
            border-color: #007bff;
        }

        .dataTables_wrapper .dataTables_length .form-select option:hover,
        .dataTables_wrapper .dataTables_length .form-select option:focus {
            background-color: #007bff;
            color: #fff;
        }

        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc:after {
            content: '';
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0.5;
        }

        table.dataTable thead .sorting:before {
            content: '\2191';
            /* ลูกศรขึ้น */
        }

        table.dataTable thead .sorting:after {
            content: '\2193';
            /* ลูกศรลง */
        }

        table.dataTable thead th {
            text-align: center;
        }

        .disabled {
            opacity: 0.6;
        }
    </style>

    <body style="font-family: 'Prompt', sans-serif;">
        <div class="container-fluid" style="background-color:rgb(180, 180, 180);">
            <?php
            $count_a = 0;
            $db99 = new Database('nurse');
            $db99->Table = "user_Fonmis";
            $db99->Where = "Where ud_id='$_SESSION[ud_id_fon]' order by role_id desc";
            $user99 = $db99->Select();
            $count_a = count($user99);
            if ($count_a != "") { ?>

                <div class="row">
                    <div class="offcanvas offcanvas-start bg-dark" style="padding:0;opacity: 0.9;font-weight: 700; font-size: larger;" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel" style="background-color: #d9d9d9d9;">
                        <div class="offcanvas-header" style="color: #ffff;">
                            <a href="Page.php">
                                <h2 class="offcanvas-title d-none d-sm-block" id="offcanvasWithBothOptionsLabel">Menu</h2>
                            </a>

                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body px-0">
                            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center " id="menu" style="background-color: #d9d9d9d9;">
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Das") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php" class="nav-link text-truncate text-center">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "Das") { ?> style="color: #ffffff;" <?php } ?>>Dashboard</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Res" || $_GET["feed"] == "Res_data" || $_GET["feed"] == "Res_pro" || $_GET["feed"] == "Res_proce" || $_GET["feed"] == "Res_Jour") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=Res" class="nav-link text-truncate text-center">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "Res" || $_GET["feed"] == "Res_data" || $_GET["feed"] == "Res_pro" || $_GET["feed"] == "Res_proce" || $_GET["feed"] == "Res_Jour") { ?> style="color: #ffffff;" <?php } ?>>วิจัย</span></a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "KPI") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=KPI" class="nav-link text-truncate text-center">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "KPI") { ?> style="color: #ffffff;" <?php } ?>>KPI</span> </a>
                                </li>
                                <li style="display: none; border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Ser" || $_GET['feed'] == "Ser_rev" || $_GET['feed'] == "Ser_pro") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=Ser" class="nav-link text-truncate text-center disabled">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "Ser" || $_GET['feed'] == "Ser_rev" || $_GET['feed'] == "Ser_pro") { ?> style="color: #ffffff;" <?php } ?>>บริการวิชาการ</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;"
                                    <?php if ($_GET["feed"] == "workl" || $_GET["feed"] == "Cred" || $_GET["feed"] == "Stand") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=workl" class="nav-link text-trunca text-center ">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "workl" || $_GET["feed"] == "Cred" || $_GET["feed"] == "Stand") { ?> style="color: #ffffff;" <?php } ?>>ภาระงาน</span></a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Aca" || $_GET["feed"] == "Aca_perall" || $_GET["feed"] == "Aca_Bac" || $_GET["feed"] == "Aca_Mas" || $_GET["feed"] == "Aca_Ph") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=Aca" class="nav-link text-truncate text-center ">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "Aca" || $_GET["feed"] == "Aca_perall" || $_GET["feed"] == "Aca_Bac" || $_GET["feed"] == "Aca_Mas" || $_GET["feed"] == "Aca_Ph") { ?> style="color: #ffffff;" <?php } ?>>วิชาการ</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Bud") { ?> class="btn_ac" <?php } ?>>
                                    <a href="https://burapha-my.sharepoint.com/:x:/g/personal/warapornra_buu_ac_th/Eavg0Z_x_v5IhcHzXc3kc9IBN_w_WU1GkN3FUgExkARXvQ?e=iBKKai" class="nav-link text-truncate text-center">
                                        <span class="ms-1 d-none d-sm-inline">งบประมาณ</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "Per") { ?> class="btn_ac" <?php } ?>>
                                    <a href="https://hrd.buu.ac.th" class="nav-link text-truncate text-center" target="_blank">
                                        <span class="ms-1 d-none d-sm-inline">งานบุคคล</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "car") { ?> class="btn_ac" <?php } ?>>
                                    <a href="Page.php?feed=car" class="nav-link text-truncate text-center ">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "car") { ?> style="color: #ffffff;" <?php } ?>>ยานพหนะ</span> </a>
                                </li>
                                <li style="border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "") { ?> <?php } ?>>
                                    <a href="Page.php?feed=rm" class="nav-link text-truncate text-center">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "") { ?> style="color: #000;" <?php } ?>>ห้องเรียน</span> </a>
                                </li>
                                <li style="display: none; border: 1px solid black;width: 100%;" <?php if ($_GET["feed"] == "") { ?> <?php } ?>>
                                    <a href="Page.php?feed=Bud" class="nav-link text-truncate text-center disabled">
                                        <span class="ms-1 d-none d-sm-inline" <?php if ($_GET["feed"] == "") { ?> style="color: #000;" <?php } ?>>ครุภัณฑ์ / พัสดุ</span> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col min-vh-100" style="padding: 0 0 0 0;">
                                <div style="background-color:#C6C6C6;">
                                    <nav class="navbar navbar-expand-lg navbar-light justify-content-between" style="background-color:#ffffff;">
                                        <a class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" type="button">
                                            <i class="bi bi-list fs-2" data-bs-toggle="offcanvas" aria-controls="offcanvasWithBothOptions" data-bs-target="#offcanvasWithBothOptions" style="color: #000;"></i>
                                        </a>
                                        <ul class="nav justify-content-end">
                                            <?php

                                            foreach ($user99 as $values99 => $data99) {
                                                if ($data99['role_id'] == '1' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132') { ?>
                                                    <!-- <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-gear"></i>&nbsp;&nbsp;เพิ่มบุคลากร</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="page.php?feed=per_set">จัดการบุคลากร</a></li>
                                                    </ul>
                                                </li> -->
                                                    <!--  <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=2&&Uf=1">ผู้บริหาร</a></li>
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                                    </ul>
                                                </li> -->
                                                <?php  } else if ($data99['role_id'] == '2' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132') { ?>
                                                    <!-- <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=2&&Uf=1">ผู้บริหาร</a></li>
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                                    </ul>
                                                </li> -->
                                                <?php } else if ($data99['role_id'] == '3' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132') { ?>
                                                    <!-- <li class="nav-item dropdown">
                                                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                                    </ul>
                                                </li> -->
                                                <?php } ?>

                                            <?php } ?>
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-bounding-box"></i>
                                                    <?php
                                                    echo $_SESSION['name_fon'] . "  " . $_SESSION['lname_fon'];
                                                    ?>
                                                </a>
                                                <ul class="dropdown-menu" style="right: 0;left: unset;">
                                                    <!-- <li><a class="dropdown-item" href="#">แจ้งปัญหา</a></li> -->
                                                    <li><a class="dropdown-item" href="config/ctrl_logout.php">ออกจากระบบ</a></li>
                                                </ul>
                                            </li>
                                            <!-- <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-calendar"></i>&nbsp;&nbsp;เลือกปี</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="page.php">รวมทุกปี</a></li>
                                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2023">2566</a></li>
                                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2022">2565</a></li>
                                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2021">2564</a></li>
                                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2020">2563</a></li>
                                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2019">2562</a></li>
                                            </ul>
                                            </li> -->
                                        </ul>
                                    </nav>

                                    <?php
                                    // if(isset($_SESSION[level_u])){
                                    switch ($_GET["feed"]) {
                                        case 'data_66': {
                                                include_once("Fon_2566.php");
                                                break;
                                            }
                                        case 'Das': {
                                                include_once("Dashboard.php");
                                                break;
                                            }

                                        case 'workl': {
                                                include_once("Workload.php");
                                                break;
                                            }
                                        case 'Cred': {
                                                include_once("Wo_Credit.php");
                                                break;
                                            }
                                        case 'Stand': {
                                                include_once("Wo_Standard.php");
                                                break;
                                            }

                                        case 'Res': {
                                                include_once("Research.php");
                                                break;
                                            }
                                        case 'Res_Jour': {
                                                include_once("Re_Journal.php");
                                                break;
                                            }
                                        case 'Res_data': {
                                                include_once("Re_database.php");
                                                break;
                                            }
                                        case 'Res_pro': {
                                                include_once("Re_project.php");
                                                break;
                                            }
                                        case 'Res_proce': {
                                                include_once("Re_proceed.php");
                                                break;
                                            }
                                        case 'Res_bud': {
                                                include_once("Re_budget.php");
                                                break;
                                            }
                                        case 'Res_Q': {
                                                include_once("Re_tar_Q.php");
                                                break;
                                            }
                                        case 'Res_dasJ': {
                                                include_once("re_dasjournal.php");
                                                break;
                                            }

                                        case 'Aca': {
                                                include_once("Academic.php");
                                                break;
                                            }
                                        case 'Aca_perall': {
                                                include_once("Aca_std_all.php");
                                                break;
                                            }
                                        case 'Aca_Bac': {
                                                include_once("Aca_Bachelor.php");
                                                break;
                                            }
                                        case 'Aca_Mas': {
                                                include_once("Aca_Master.php");
                                                break;
                                            }
                                        case 'Aca_Ph': {
                                                include_once("Aca_PHD.php");
                                                break;
                                            }

                                        case 'te': {
                                                include_once("test.php");
                                                break;
                                            }

                                        case 'Ser': {
                                                include_once("Service.php");
                                                break;
                                            }
                                        case 'Ser_rev': {
                                                include_once("Ser_Revenue.php");
                                                break;
                                            }
                                        case 'Ser_pro': {
                                                include_once("Ser_Project.php");
                                                break;
                                            }

                                        case 'Bud': {
                                                include_once("Budget.php");
                                                break;
                                            }
                                        case 'rm': {
                                                include_once("room.php");
                                                break;
                                            }
                                        case 'KPI': {
                                                include_once("KPI.php");
                                                break;
                                            }
                                        case 'Per': {
                                                include_once("Personnel.php");
                                                break;
                                            }

                                        case 'car': {
                                                include_once("Car.php");
                                                break;
                                            }

                                        case 'wlt': {
                                                include_once("workl_test.php");
                                                break;
                                            }

                                        case 'test': {
                                                include_once("test_re.php");
                                                break;
                                            }

                                        default: {
                                                include_once("Fon_all_year.php");
                                                break;
                                            }
                                    }

                                    // }else{echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=index.php\">";}
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } else {
                echo '<META HTTP-EQUIV="Refresh" CONTENT="2;URL=https://sites.google.com/go.buu.ac.th/sqd">';
            }
            ?>
        </div>
    </body>
    <?php include_once("footer.php"); ?>

    </html>
<?php } else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=config/ctrl_logout.php\">";
} ?>