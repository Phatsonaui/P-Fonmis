<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");
    require_once("../../class/chgdatethai.php");

    if (isset($_POST['year']) && !empty($_POST['year'])) {
        $fstartyear = $_POST['year'] . "-01-01";
        $flastyear = $_POST['year'] . "-12-31";
    } else {
        $fstartyear = date('Y') . "-01-01";
        $flastyear = date('Y') . "-12-31";
    }
    
    $sumcount = 0;
    $row = 0;
    $sumh = 0;
    $roomUsage = [];
    
    $dbRoom = new Database('nurse');
    $dbRoom->Table = "RM_Room";
    $dbRoom->Where = "where room_status ='1' order by room_id";
    $userRoom = $dbRoom->Select();
    
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
        }

        $sumh += $sumRoomhour;
    
        // เก็บจำนวนการใช้งานแต่ละห้อง
        $roomUsage[] = [
            'room_id' => $dataRoom['room_id'],
            'room_name' => $dataRoom['room_name'],
            'usage_count' => $sumRoomcount,
            'usage_hours' => $sumRoomhour
        ];
    }
    
    // สร้าง response
    $response = [
        'totalHours' => $sumh, // รวมจำนวนชั่วโมงการใช้งาน
        'totalUsage' => $sumcount, // รวมจำนวนครั้งการใช้งาน
        'roomUsage' => $roomUsage // ข้อมูลการใช้งานแต่ละห้อง
    ];
    
    // Return the values as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
    
    
?>

<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
