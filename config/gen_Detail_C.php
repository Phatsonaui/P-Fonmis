<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");
    require_once("../../class/chgdatethai.php");
?>
    <style>
        .project-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
        }

        .project-card {
            background-color: #2b821d;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            border: 2px solid darkgreen;
            color: #fff;
        }

        .project-card-Approve {
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            background-color: #c12e34;
            color: #000;
            border: 2px solid darkred;
        }
        .form-label{
            margin-bottom: 0;
        }
    </style>
    <?php
    $type = $_POST['type_c'];
    $date = $_POST['date_c'];
    
    switch ($type) {
        case '1':
            $title_c = '<h4 class="fw-bold border-bottom border-danger-subtle">รถบัส</h4>';
            $type_c = array('001', '002', '003');
            break;
        
        case '2':
            $title_c = '<h4 class="fw-bold border-bottom border-danger-subtle">รถตู้</h4>';
            $type_c = '004';
            break;
        
        case '3':
            $title_c = '<h4 class="fw-bold border-bottom border-danger-subtle">รถเก๋ง</h4>';
            $type_c = '005';
            break;
        
        case '4':
            $title_c = '<h4 class="fw-bold border-bottom border-danger-subtle">รถกระบะ</h4>';
            $type_c = '006';
            break;
    }

    $reservedRoomIds = array();
    $dbRoomRT = new Database('nurse');
    $dbRoomRT->Table = "car_time";
    $dbRoomRT->Where = "where time_date LIKE '$date%' AND form_status='4' group by car_id";
    $userRoomRT = $dbRoomRT->Select();
    foreach ($userRoomRT as $valuesRoomRT => $dataRoomRT) {
        $reservedRoomIds[] = $dataRoomRT['car_id'];
    }

    $dbRoom = new Database('nurse');
    $dbRoom->Table = "car_detail";
    if (is_array($type_c)) {
        $type_c_str = implode("','", $type_c); // จะแปลง array เป็น '001','002','003'
        $dbRoom->Where = "where car_status='1' AND car_type IN ('$type_c_str') order by car_id";
    } else {
        $dbRoom->Where = "where car_status='1' AND car_type = '$type_c' order by car_id";
    }
    $userRoom = $dbRoom->Select();
    ?>
    <div class="row">
        <div class="col-md-12 text-center ">
            <?php 
                echo $title_c;
            ?>
        </div>
        <div class="project-container">
            <?php
                foreach ($userRoom as $valuesRoom => $dataRoom) {
                    $buttonClass = in_array($dataRoom['car_id'], $reservedRoomIds) ? 'project-card-Approve' : 'project-card';
                    ?>

                    <button type="button" class="<?php echo $buttonClass; ?>" data-bs-toggle="modal" data-bs-target="#room<?php echo $dataRoom['car_id']; ?>">
                        <h2 class="m-0"><?php echo $dataRoom['car_model'] ?></h2>
                    </button>

                    <div class="modal fade" id="room<?php echo $dataRoom['car_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="blue">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"><?php echo $dataRoom['car_model'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row justify-content-center">
                                        <div class="col-md-4 d-flex align-items-center">
                                        <?php 
                                                $carImagePath = "../img/Car/" . $dataRoom['car_pict'];
                                                $defaultImagePath = "";

                                                // ตรวจสอบประเภทของรถและกำหนดรูปภาพเริ่มต้น
                                                switch ($dataRoom['car_type']) {
                                                    case '001': case '002': case '003':
                                                        $defaultImagePath = "img/Car/bus.png";
                                                        break;
                                                    case '004':
                                                        $defaultImagePath = "img/Car/van.png";
                                                        break;
                                                    case '005':
                                                        $defaultImagePath = "img/Car/sedan.png";
                                                        break;
                                                    case '006':
                                                        $defaultImagePath = "img/Car/pickup.png";
                                                        break;
                                                }

                                                // เช็คว่ารูปภาพมีอยู่หรือไม่ ถ้าไม่ให้ใช้รูป default
                                                if($dataRoom['car_pict'] == ""){
                                                    $imagePathToDisplay = $defaultImagePath;
                                                }else{
                                                    $imagePathToDisplay = $carImagePath;
                                                }
                                                // $imagePathToDisplay = file_exists($carImagePath) ? $carImagePath : $defaultImagePath;
                                            ?>
                                            <img class="rounded w-100" src="<?php echo $imagePathToDisplay; ?>" alt="">
                                        </div>
                                        <div class="col-md-auto d-flex align-items-center">
                                            <div>
                                                <label for="exampleFormControlInput1" class="form-label"><b>ป้ายทะเบียนรถ</b></label>
                                                <div><?php echo "- ".$dataRoom['car_number'];?></div>
                                                <label for="exampleFormControlInput1" class="form-label"><b>จำนวนคน</b></label>
                                                <div><?php echo "- ".$dataRoom['car_size'];?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
             ?>
        </div>
    </div>
<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
