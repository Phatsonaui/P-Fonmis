<?php
include("../../class/class.db.php");
header('Content-Type: application/json');
$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

if ($selectedYear != '') {
    $sumMoneyReal_in = 0;
    $sumMoneyReal = 0;
    $Roi = 0;

    $dbGrp1 = new Database('nurse');
    $dbGrp1->Table = "proj_list";
    $dbGrp1->Where = "where project_Year = '$selectedYear' AND project_status IN('09') AND project_id <> '14' AND project_type = '2'";
    $userGrp1 = $dbGrp1->Select();
    foreach ($userGrp1 as $valuesproject => $dataproject) {
            
            $dbmoney = new Database('nurse');
            $dbmoney->Table = "Proj_MoneyIN";
            $dbmoney->Where = "where project_id = '$dataproject[project_id]' ";
            $usermoney = $dbmoney->Select();

            $dbmoney_out = new Database('nurse');
            $dbmoney_out->Table = "proj_MoneyOut";
            $dbmoney_out->Where = "where project_id = '$dataproject[project_id]' ";
            $usermoney_out = $dbmoney_out->Select();

            foreach ($usermoney_out as $valuesmoney_out => $datamoney_out) {
                $sumMoneyReal += $datamoney_out['moneyOut_MoneyReal'];
            }

            foreach ($usermoney as $valuesmoney => $datamoney) {
                $sumMoneyReal_in += $datamoney['moneyIN_Report'];
            }

            // $Roi = $sumMoneyReal;
            if ($sumMoneyReal_in > 0 && $sumMoneyReal > 0) { // ตรวจสอบว่า sumMoneyReal_in ไม่เป็นศูนย์ก่อนคำนวณ
                $Roi = (($sumMoneyReal_in - $sumMoneyReal) / $sumMoneyReal_in) * 100;
            }else{
                $Roi = 0;
            }

    }
    
    echo json_encode([
        'Roi' => $Roi,
        'sumMoneyReal_in' => $sumMoneyReal_in,
        'sumMoneyReal' => $sumMoneyReal
    ]);
}
?>
