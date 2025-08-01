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
    $sumcount_n = 0;
    $sumcount_c = 0;
    $row = 0;
    $sumh = 0;
    $roomUsage_n = [];
    $roomUsage_c = [];
    
    $dbRoom = new Database('nurse');
    $dbRoom->Table = "RM_Room";
    $dbRoom->Where = "where room_status ='1' order by room_id";
    $userRoom = $dbRoom->Select();
    
    foreach ($userRoom as $dataRoom) {
        $row++;
        $sumRoomcount_n = 0;
        $sumRoomcount_c = 0;
        
        $sumRoomhour_n = 0;
        $sumRoomhour_c = 0;

        if ($dataRoom['room_type_location'] == 1) { //นพ
            $dbReserv_n = new Database('nurse');
            $dbReserv_n->Table = "RM_Reserv";
            $dbReserv_n->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
            $userReserv_n = $dbReserv_n->Select();
        
            foreach ($userReserv_n as $dataReserv_n) {
                $starttimeArr_n = explode(".", $dataReserv_n['Rs_startTime']);
                $startMin_n = isset($starttimeArr_n[1]) && $starttimeArr_n[1] === '31' ? '30' : '00';
                $starttime_n = $starttimeArr_n[0] . ":" . $startMin_n;
        
                $endtimeArr_n = explode(".", $dataReserv_n['Rs_endTime']);
                $endtime_n = isset($endtimeArr_n[1]) ? $endtimeArr_n[0] . ":" . $endtimeArr_n[1] : $endtimeArr_n[0] . ":00";
        
                $lowhour_n = (strtotime($endtime_n) - strtotime($starttime_n)) / (60 * 60); // เวลาเป็นชั่วโมง
                $sumRoomhour_n += $lowhour_n;
                $sumRoomcount_n++;
                $sumcount_n++;
            }
            $roomUsage_n[] = [
                'room_id_n' => $dataRoom['room_id'],
                'room_name_n' => $dataRoom['room_name'],
                'usage_count_n' => $sumRoomcount_n,
                'usage_hours_n' => $sumRoomhour_n
            ];
        } else if ($dataRoom['room_type_location'] == 2){ //เฉลิม
            $dbReserv_c = new Database('nurse');
            $dbReserv_c->Table = "RM_Reserv";
            $dbReserv_c->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
            $userReserv_c = $dbReserv_c->Select();
        
            foreach ($userReserv_c as $dataReserv_c) {
                $starttimeArr_c = explode(".", $dataReserv_c['Rs_startTime']);
                $startMin_c = isset($starttimeArr_c[1]) && $starttimeArr_c[1] === '31' ? '30' : '00';
                $starttime_c = $starttimeArr_c[0] . ":" . $startMin_c;
        
                $endtimeArr_c = explode(".", $dataReserv_c['Rs_endTime']);
                $endtime_c = isset($endtimeArr_c[1]) ? $endtimeArr_c[0] . ":" . $endtimeArr_c[1] : $endtimeArr_c[0] . ":00";
        
                $lowhour_c = (strtotime($endtime_c) - strtotime($starttime_c)) / (60 * 60); // เวลาเป็นชั่วโมง
                $sumRoomhour_c += $lowhour_c;
                $sumRoomcount_c++;
                $sumcount_c++;
            }
            $roomUsage_c[] = [
                'room_id_c' => $dataRoom['room_id'],
                'room_name_c' => $dataRoom['room_name'],
                'usage_count_c' => $sumRoomcount_c,
                'usage_hours_c' => $sumRoomhour_c
            ];
        }

        $sumh = $sumRoomhour_n + $sumRoomhour_c;
        $sumcount = $sumcount_n + $sumcount_c;
        
    }
    
    $response = [
        'totalHours' => $sumh, // รวมจำนวนชั่วโมงการใช้งาน
        'totalUsage' => $sumcount, // รวมจำนวนครั้งการใช้งาน
        'roomUsage_n' => $roomUsage_n, // นพ
        'roomUsage_c' => $roomUsage_c // เฉลิม
    ];
    
    // Return the values as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

?>

<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
