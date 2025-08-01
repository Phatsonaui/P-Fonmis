<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");
    require_once("../../class/chgdatethai.php");

    if (isset($_POST['year_r']) && !empty($_POST['year_r'])) {
        $fstartyear = $_POST['year_r'] . "-01-01";
        $flastyear = $_POST['year_r'] . "-12-31";
    } else {
        $fstartyear = date('Y') . "-01-01";
        $flastyear = date('Y') . "-12-31";
    }
    
?>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
    }

    td {
        padding: 10px !important;
        text-align: center !important;
        border-bottom: 1px solid #ddd !important;
    }

    .status {
        padding: 10px 10px !important;
        border-radius: 15px !important;
        color: white;
        font-weight: bold !important;
        display: inline-block !important;
        font-size: 0.9em !important;
    }

    .current {
        background-color: #a8e6cf !important;
        color: darkgreen !important;
    }

    .late.yellow {
        background-color: #fadca1 !important;
        color: darkorange !important;
    }

    .late.red {
        background-color: #ef9a9a !important;
        color: #d32f2f !important;
    }

    .late.orange {
        background-color: #ffe0b2 !important;
        color: #f57c00 !important;
    }

</style>
<?php
    $row = $sumcount = $sumhour = $r = 0;
    $dbRoom = new Database('nurse');
    $dbRoom->Table = "RM_Room";
    $dbRoom->Where = "where room_status ='1' order by room_id";
    $userRoom = $dbRoom->Select();
?>
    <div class="col-md-12">
        <table class="table table-striped table-hover" id="dtBasicExample">
            <thead class="Table_header_nu">
                <tr>
                    <th>ลำดับ</th>
                    <th>ห้อง</th>
                    <th>ความถี่ (ครั้ง)</th>
                    <th>จำนวนชั่วโมง</th>
                    <th>เฉลี่ยชั่วโมงต่อครั้ง</th>
                </tr>
            </thead>
            <tbody class="Table_body_nu">
                <?php
                foreach ($userRoom as $dataRoom) {
                    $row++;
                    $sumRoomcount = 0;
                    $sumRoomhour = 0;
                
                    $dbReserv = new Database('nurse');
                    $dbReserv->Table = "RM_Reserv";
                    $dbReserv->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
                    $userReserv = $dbReserv->Select();
                
                    foreach ($userReserv as $dataReserv) {
                        $starttimeArr = explode(".", $dataReserv['Rs_startTime']);
                        $startMin = isset($starttimeArr[1]) && $starttimeArr[1] === '31' ? '30' : '00';
                        $starttime = $starttimeArr[0] . ":" . $startMin;
                
                        $endtimeArr = explode(".", $dataReserv['Rs_endTime']);
                        $endtime = isset($endtimeArr[1]) ? $endtimeArr[0] . ":" . $endtimeArr[1] : $endtimeArr[0] . ":00";
                
                        $lowhour = (strtotime($endtime) - strtotime($starttime)) / (60 * 60); // เวลาเป็นชั่วโมง
                        $sumRoomhour += $lowhour;
                        $sumRoomcount++;
                        $sumcount++;
                        $sumhour += $lowhour;
                        if ($sumRoomcount > 0) {
                            $avg_r = $sumRoomhour / $sumRoomcount;
                        } else {
                            $avg_r = 0; // กรณีที่ไม่มีการจอง
                        }
                    }

                    // switch ($dataGrp1['RS_status']) {
                    //     case '1':
                    //         $text_stats = "ยกเลิกการใช้ห้อง";
                    //         $class_color = "status late orange";
                    //         break;
                    //     case '2':
                    //         $text_stats = "รอการอนุมัติใช้ห้อง";
                    //         $class_color = "status late yellow";
                    //         break;
                        
                    //     case '3':
                    //         $text_stats = "อนุมัติการใช้ห้อง";
                    //         $class_color = "status current";
                    //         break;

                    //     case '4':
                    //         $text_stats = "ไม่อนุมัติการใช้ห้อง";
                    //         $class_color = "status late red";
                    //         break;

                    //     case '5':
                    //         $text_stats = "ยกเลิกการใช้ห้อง";
                    //         $class_color = "status late orange";
                    //         break;
                                             
                    // }
                    $r++; ?>
                    <tr class="align-middle">
                        <td><?php echo $row; ?></td>
                        <td><?php echo $dataRoom['room_name']; ?></td>
                        <td><?php echo $sumRoomcount;?></td>
                        <td><?php echo $sumRoomhour;?></td>
                        <td><?php echo number_format($avg_r, 2);?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
