<?php header( 'Content-Type:text/html; charset=utf-8'); ?>
<?php require_once("../chgdatethai.php");
include("../class/class.db.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Collapsible sidebar using Bootstrap 4</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;300&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">  
<script src="
https://cdn.jsdelivr.net/npm/chart.js@4.2.0/dist/chart.umd.min.js
"></script>
<script src="../ckeditor/ckeditor.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.x.x/dist/Chart.min.js"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->
    <!-- Our Custom CSS -->

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    
</head>
<style type="text/css">
.wrapper {
    display: flex;
    align-items: stretch;
}

#sidebar {
    min-width: 250px;
    max-width: 250px;
    min-height: 100vh;
}

#sidebar.active {
    margin-left: -250px;
}
a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}
@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
}
</style>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Bootstrap Sidebar</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Dummy Heading</p>
            <li class="active">
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="#">Home 1</a>
                    </li>
                    <li>
                        <a href="#">Home 2</a>
                    </li>
                    <li>
                        <a href="#">Home 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">About</a>
            </li>
            <li>
                <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
                <ul class="collapse list-unstyled" id="pageSubmenu">
                    <li>
                        <a href="#">Page 1</a>
                    </li>
                    <li>
                        <a href="#">Page 2</a>
                    </li>
                    <li>
                        <a href="#">Page 3</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#">Portfolio</a>
            </li>
            <li>
                <a href="#">Contact</a>
            </li>
        </ul>
    </nav>
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:#ffffff;">
                          <a class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions" type="button">
                            <i class="bi bi-list fs-2" data-bs-toggle="offcanvas" aria-controls="offcanvasWithBothOptions" data-bs-target="#offcanvasWithBothOptions" style="color: #000;"></i>
                          </a>
                          <ul class="nav justify-content-end">
                            <?php 
                            $db99=new Database('nurse');
                            $db99->Table = "user_Fonmis";
                            $db99->Where = "Where ud_id='$_SESSION[ud_id]' order by role_id desc";
                            $user99 = $db99->Select();      
                            foreach($user99 as $values99=>$data99){ 
                                if($data99['role_id'] == '1' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132'){ ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-gear"></i>&nbsp;&nbsp;เพิ่มบุคลากร</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="page.php?feed=per_set">จัดการบุคลากร</a></li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=2&&Uf=1">ผู้บริหาร</a></li>
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                        </ul>
                                    </li>
                                <?php  }
                                else if($data99['role_id'] == '2' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132'){ ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=2&&Uf=1">ผู้บริหาร</a></li>
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                        </ul>
                                    </li>
                                <?php }else if($data99['role_id'] == '3' && $data99['ud_id'] == '00000019' || $data99['ud_id'] == '00000132') { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-video3"></i>&nbsp;&nbsp;เปลี่ยนสถานะ</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=3&&Uf=1">ผู้ใช้งาน</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="config/ctrl_ChgGrp.php?sts=1&&Uf=1">ผู้ดูแลระบบ</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>

                            <?php }?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-person-bounding-box"></i>
                                  <?php     
                                    echo $_SESSION['name']."  ".$_SESSION['lname'];
                                    ?>
                                               
                                  </a>
                                <ul class="dropdown-menu">
                                 
                                  
                                  <li><a class="dropdown-item" href="#">แจ้งปัญหา</a></li>
                                 <li><a class="dropdown-item" href="config/ctrl_logout.php">ออกจากระบบ</a></li>
                                </ul>
                              </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" style="color: #000;"><i class="bi bi-calendar"></i>&nbsp;&nbsp;เลือกปี</a>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="page.php">รวมทุกปี</a></li>
                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2023">2566</a></li>
                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2022">2565</a></li>
                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2021">2564</a></li>
                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2020">2563</a></li>
                                <li><a class="dropdown-item" href="page.php?feed=data_66&year=2019">2562</a></li>
                              </ul>
                            </li>
                          </ul>
                        </nav>
</div> 
</div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>

</html>
<script type="text/javascript">
    $(document).ready(function () {

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });

});
</script>