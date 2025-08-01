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

    $sumcount_std = 0;
    $roomUsage_std = [];

    $sumcount_meet = 0;
    $roomUsage_meet = [];

    $sumcount_lab = 0;
    $roomUsage_lab = [];

    $row = 0;
    $sumh = 0;
    
    $dbRoom = new Database('nurse');
    $dbRoom->Table = "RM_Room";
    $dbRoom->Where = "where room_status ='1' order by room_id";
    $userRoom = $dbRoom->Select();
    
    foreach ($userRoom as $dataRoom) {
        $row++;
        $sumRoomcount_std = 0;
        $sumRoomhour_std = 0;

        $sumRoomcount_meet = 0;
        $sumRoomhour_meet = 0;

        $sumRoomcount_lab = 0;
        $sumRoomhour_lab = 0;

        if ($dataRoom['room_type'] == 1) { //ห้องเรียน
            $dbReserv_std = new Database('nurse');
            $dbReserv_std->Table = "RM_Reserv";
            $dbReserv_std->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
            $userReserv_std = $dbReserv_std->Select();
        
            foreach ($userReserv_std as $dataReserv_std) {
                $starttimeArr_std = explode(".", $dataReserv_std['Rs_startTime']);
                $startMin_std = isset($starttimeArr_std[1]) && $starttimeArr_std[1] === '31' ? '30' : '00';
                $starttime_std = $starttimeArr_std[0] . ":" . $startMin_std;
        
                $endtimeArr_std = explode(".", $dataReserv_std['Rs_endTime']);
                $endtime_std = isset($endtimeArr_std[1]) ? $endtimeArr_std[0] . ":" . $endtimeArr_std[1] : $endtimeArr_std[0] . ":00";
        
                $lowhour_std = (strtotime($endtime_std) - strtotime($starttime_std)) / (60 * 60); // เวลาเป็นชั่วโมง
                $sumRoomhour_std += $lowhour_std;
                $sumRoomcount_std++;
                $sumcount_std++;
            }
            $roomUsage_std[] = [
                'room_id_std' => $dataRoom['room_id'],
                'room_name_std' => $dataRoom['room_name'],
                'usage_count_std' => $sumRoomcount_std,
                'usage_hours_std' => $sumRoomhour_std
            ];
        } else if ($dataRoom['room_type'] == 2){ //ห้องประชุม
            $dbReserv_meet = new Database('nurse');
            $dbReserv_meet->Table = "RM_Reserv";
            $dbReserv_meet->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
            $userReserv_meet = $dbReserv_meet->Select();
        
            foreach ($userReserv_meet as $dataReserv_meet) {
                $starttimeArr_meet = explode(".", $dataReserv_meet['Rs_startTime']);
                $startMin_meet = isset($starttimeArr_meet[1]) && $starttimeArr_meet[1] === '31' ? '30' : '00';
                $starttime_meet = $starttimeArr_meet[0] . ":" . $startMin_meet;
        
                $endtimeArr_meet = explode(".", $dataReserv_meet['Rs_endTime']);
                $endtime_meet = isset($endtimeArr_meet[1]) ? $endtimeArr_meet[0] . ":" . $endtimeArr_meet[1] : $endtimeArr_meet[0] . ":00";
        
                $lowhour_meet = (strtotime($endtime_meet) - strtotime($starttime_meet)) / (60 * 60); // เวลาเป็นชั่วโมง
                $sumRoomhour_meet += $lowhour_meet;
                $sumRoomcount_meet++;
                $sumcount_meet++;
            }
            $roomUsage_meet[] = [
                'room_id_meet' => $dataRoom['room_id'],
                'room_name_meet' => $dataRoom['room_name'],
                'usage_count_meet' => $sumRoomcount_meet,
                'usage_hours_meet' => $sumRoomhour_meet
            ];
        } else if ($dataRoom['room_type'] == 3){ //ห้องแลป
            $dbReserv_lab = new Database('nurse');
            $dbReserv_lab->Table = "RM_Reserv";
            $dbReserv_lab->Where = "where room_id='{$dataRoom['room_id']}' AND Rs_startdate BETWEEN '$fstartyear' AND '$flastyear' order by room_id";
            $userReserv_lab = $dbReserv_lab->Select();
        
            foreach ($userReserv_lab as $dataReserv_lab) {
                $starttimeArr_lab = explode(".", $dataReserv_lab['Rs_startTime']);
                $startMin_lab = isset($starttimeArr_lab[1]) && $starttimeArr_lab[1] === '31' ? '30' : '00';
                $starttime_lab = $starttimeArr_lab[0] . ":" . $startMin_lab;
        
                $endtimeArr_lab = explode(".", $dataReserv_lab['Rs_endTime']);
                $endtime_lab = isset($endtimeArr_lab[1]) ? $endtimeArr_lab[0] . ":" . $endtimeArr_lab[1] : $endtimeArr_lab[0] . ":00";
        
                $lowhour_lab = (strtotime($endtime_lab) - strtotime($starttime_lab)) / (60 * 60); // เวลาเป็นชั่วโมง
                $sumRoomhour_lab += $lowhour_lab;
                $sumRoomcount_lab++;
                $sumcount_lab++;
            }
            $roomUsage_lab[] = [
                'room_id_lab' => $dataRoom['room_id'],
                'room_name_lab' => $dataRoom['room_name'],
                'usage_count_lab' => $sumRoomcount_lab,
                'usage_hours_lab' => $sumRoomhour_lab
            ];
        }

        $sumh = $sumRoomhour_std + $sumRoomhour_meet;
        $sumcount = $sumcount_std + $sumcount_meet;
        
    } 
    
    $response = [
        // 'totalHours' => $sumh, // รวมจำนวนชั่วโมงการใช้งาน
        // 'totalUsage' => $sumcount, // รวมจำนวนครั้งการใช้งาน
        'roomUsage_std' => $roomUsage_std, // นพ
        'roomUsage_meet' => $roomUsage_meet, // เฉลิม
        'roomUsage_lab' => $roomUsage_lab // เฉลิม
    ];
    
    // Return the values as JSON
    header('Content-Type: application/json');
    echo json_encode($response);

?>

<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}