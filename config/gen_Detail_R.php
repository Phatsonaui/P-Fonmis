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
    $type = $_POST['type_r'];
    $date = $_POST['date_r'];
    $status = $_POST['statu_r'];

    $reservedRoomIds = array();
    $dbRoomRT = new Database('nurse');
    $dbRoomRT->Table = "RM_Reserv";
    $dbRoomRT->Where = "where Rs_startdate='$date' AND RS_status='3' group by room_id";
    $userRoomRT = $dbRoomRT->Select();
    foreach ($userRoomRT as $valuesRoomRT => $dataRoomRT) {
        $reservedRoomIds[] = $dataRoomRT['room_id'];
    }

    $dbRoom = new Database('nurse');
    $dbRoom->Table = "RM_Room";
    $dbRoom->Where = "where room_status='1' AND room_type='$type' order by room_id";
    $userRoom = $dbRoom->Select();
    ?>
    <div class="row">
        <div class="col-md-12 text-center ">
            <?php 
                switch ($type) {
                    case '1':
                        echo  '<h4 class="fw-bold border-bottom border-danger-subtle">ห้องเรียน</h4>';
                        break;
                    
                    case '2':
                        echo  '<h4 class="fw-bold border-bottom border-danger-subtle">ห้องประชุม</h4>';
                        break;
                    
                    case '3':
                        echo  '<h4 class="fw-bold border-bottom border-danger-subtle">ห้องปฏิบัติการ</h4>';
                        break;
                }
            ?>
        </div>
        <div class="project-container">
            <?php
                foreach ($userRoom as $valuesRoom => $dataRoom) {
                    $buttonClass = in_array($dataRoom['room_id'], $reservedRoomIds) ? 'project-card-Approve' : 'project-card';
                    ?>

                    <button type="button" class="<?php echo $buttonClass; ?>" data-bs-toggle="modal" data-bs-target="#room<?php echo $dataRoom['room_id']; ?>">
                        <h2 class="m-0"><?php echo $dataRoom['room_name'] ?></h2>
                    </button>

                    <div class="modal fade" id="room<?php echo $dataRoom['room_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="blue">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 fw-bold" id="exampleModalLabel"><?php echo $dataRoom['room_name'] ?></h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <img class="rounded w-100" src="../../ReservRoom/img/room/<?php echo $dataRoom['room_picture'] ?>" alt="">
                                        </div>
                                        <div class="col-md-4">
                                            <?php
                                            $dbRoomRT = new Database('nurse');
                                            $dbRoomRT->Table = "RM_RoomUsage";
                                            $dbRoomRT->Where = "where room_id = '$dataRoom[room_id]'";
                                            $userRoomRT = $dbRoomRT->Select();
                                            foreach ($userRoomRT as $valuesRoomRT => $dataRoomRT) { ?>
                                                <label for="exampleFormControlInput1" class="form-label"><b>สถานที่</b></label>
                                                <div><?php echo "- ".$dataRoom['room_location'];?></div>
                                                <label for="exampleFormControlInput1" class="form-label"><b>จำนวนคน</b></label>
                                                <div><?php echo "- ".$dataRoomRT['Usage_num'];?></div>
                                                <label for="exampleFormControlInput1" class="form-label"><b>ประเภทห้อง</b></label>
                                                <div><?php echo "- ".$dataRoomRT['Usage_name'];?></div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label"><b>อุปกรณ์</b></label>
                                            <?php
                                            $dbRoomD = new Database('nurse');
                                            $dbRoomD->Table = "RM_RoomDevice";
                                            $dbRoomD->Where = "where room_id = '$dataRoom[room_id]'";
                                            $userRoomD = $dbRoomD->Select();
                                            foreach ($userRoomD as $valuesRoomD => $dataRoomD) { ?>
                                            
                                            <div><?php echo $dataRoomD['Device_name'] . " : " . $dataRoomD['Device_num']; ?></div>
                                            <?php
                                            }
                                            ?>
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
