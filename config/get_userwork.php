<?php
include("../../class/class.db.php");
header('Content-Type: application/json');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

if ($selectedYear != '') {
    // ปีที่เลือก
    $year = (int)$selectedYear;

    // ช่วงเวลาปกติ
    $startDate_normal = "$year-01-01";
    $endDate_normal = "$year-12-31";

    // ช่วงปีงบประมาณ
    $startDate_fiscal = ($year - 1) . "-10-01";
    $endDate_fiscal = "$year-09-30";

    // ช่วงปีการศึกษา
    $startDate_academic = "$year-07-01";
    $endDate_academic = ($year + 1) . "-06-30";

    // ฟังก์ชันคำนวณข้อมูล Turnover Rate
    function calculateTurnoverRate($startDate, $endDate) {
        $count_started = 0;
        $count_left = 0;
        $count_still = 0;
        $count_not_set = 0;

        $dbWorkFac = new Database('nurse');
        $dbWorkFac->Table = "user_WorkFac1";
        $dbWorkFac->Where = "WHERE work_StartDate < '$endDate' AND (work_EndDate >= '$startDate' OR work_EndDate = '0000-00-00')";
        $workFacStart = $dbWorkFac->Select();

        foreach ($workFacStart as $work) {
            if ($work['work_StartDate'] != "0000-00-00") {
                $count_started++;
            }

            if ($work['work_EndDate'] != '0000-00-00') {
                if ($work['work_EndDate'] >= $startDate && $work['work_EndDate'] <= $endDate) {
                    $count_left++;
                } else {
                    $count_still++;
                }
            } elseif ($work['work_StartDate'] == "0000-00-00") {
                $count_not_set++;
            } else {
                $count_still++;
            }
        }

        $a = ($count_started + $count_still) / 2;
        $turnover_rate = $count_started > 0 ? ($count_left / $a) * 100 : 0;

        return [
            'started' => $count_started,
            'left' => $count_left,
            'still' => $count_still,
            'not_set' => $count_not_set,
            'turnover_rate' => round($turnover_rate, 2)
        ];
    }

    // คำนวณ Turnover Rate สำหรับช่วงเวลาทั้ง 3
    $normal = calculateTurnoverRate($startDate_normal, $endDate_normal);
    $fiscal = calculateTurnoverRate($startDate_fiscal, $endDate_fiscal);
    $academic = calculateTurnoverRate($startDate_academic, $endDate_academic);

    // ส่งข้อมูล JSON กลับไป
    echo json_encode([
        'normal' => $normal,
        'fiscal' => $fiscal,
        'academic' => $academic
    ]);
}
?>
