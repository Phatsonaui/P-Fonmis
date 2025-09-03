<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');
$startYear = date('Y') - 4;
$endYear   = date('Y');
$yearsOut = [];
$recordsPerYearOut = [];
$devicesByYearOut = []; // เก็บ device_ID ของแต่ละปี

for ($yearOut = $startYear; $yearOut <= $endYear; $yearOut++) {
    $recordCountOut = 0;
    $deviceIDsOut   = [];

    $dbOut = new Database('nurse');
    $dbOut->Table = "DV_Data";
    $dbOut->Where = "LEFT JOIN DV_OutStock ON DV_Data.device_ID = DV_OutStock.device_id where YEAR(OutStock_date) = '$yearOut'";
    $rowsOut = $dbOut->Select();

    foreach ($rowsOut as $rowOut) {
        $recordCountOut++;
        $deviceIDsOut[] = $rowOut['device_ID']; // เก็บ device_ID
    }

    $yearsOut[]          = $yearOut + 543;
    $recordsPerYearOut[] = $recordCountOut;
    $devicesByYearOut[$yearOut + 543] = $deviceIDsOut; // ผูกกับปี (พ.ศ.)
}
echo json_encode([
    'yearsOut' => $yearsOut,
    'recordsPerYearOut' => $recordsPerYearOut,
    'devicesByYearOut' => $devicesByYearOut,
    'success' => true
], JSON_UNESCAPED_UNICODE);
