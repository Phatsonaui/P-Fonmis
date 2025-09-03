<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');
$years = [];
$recordsPerYear = [];
$devicesByYear = []; // เก็บ device_ID ของแต่ละปี

$startYear = date('Y') - 4;
$endYear   = date('Y');

for ($year = $startYear; $year <= $endYear; $year++) {
    $recordCount = 0;
    $deviceIDs   = [];

    $db = new Database('nurse');
    $db->Table = "DV_Data";
    $db->Where = "WHERE YEAR(device_DateInput) = '$year' ORDER BY device_ID DESC";
    $rows = $db->Select();

    foreach ($rows as $row) {
        $recordCount++;
        $deviceIDs[] = $row['device_ID']; // เก็บ device_ID
    }

    $years[]          = $year + 543;
    $recordsPerYear[] = $recordCount;
    $devicesByYear[$year + 543] = $deviceIDs; // ผูกกับปี (พ.ศ.)
}
echo json_encode([
    'years' => $years,
    'recordsPerYear' => $recordsPerYear,
    'devicesByYear' => $devicesByYear,
    'success' => true
], JSON_UNESCAPED_UNICODE);
