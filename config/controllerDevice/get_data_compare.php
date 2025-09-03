<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');

$years = [];
$recordsPerYear = [];
$devicesByYear = [];
$cumulativeData = []; // ข้อมูลสะสมจริง (รวมทั้งหมดจนถึงปีนั้นๆ)
$yearlyIncrease = []; // ข้อมูลเพิ่มขึ้นรายปี

$startYear = date('Y') - 4;
$endYear   = date('Y');

// ดึงข้อมูลครุภัณฑ์รายปีตาม query เดิม
for ($year = $startYear; $year <= $endYear; $year++) {
    $recordCount = 0;
    $deviceIDs   = [];

    $db = new Database('nurse');
    $db->Table = "DV_Data";
    $db->Where = "WHERE YEAR(device_DateInput) = '$year' ORDER BY device_ID DESC";
    $rows = $db->Select();

    foreach ($rows as $row) {
        $recordCount++;
        $deviceIDs[] = $row['device_ID'];
    }

    $years[] = $year + 543;
    $recordsPerYear[] = $recordCount;
    $devicesByYear[$year + 543] = $deviceIDs;
}

// คำนวณข้อมูลสะสมจริง (รวมทั้งหมดจนถึงปีนั้นๆ)
foreach ($years as $index => $thaiYear) {
    $currentYear = $startYear + $index; // แปลงกลับเป็น ค.ศ.

    // ดึงจำนวนครุภัณฑ์ทั้งหมดจนถึงปีปัจจุบัน
    $db = new Database('nurse');
    $db->Table = "DV_Data";
    $db->Where = "WHERE YEAR(device_DateInput) <= '$currentYear' AND device_DateInput != '0000-00-00' AND YEAR(device_DateInput) > 0";
    $rows = $db->Select();
    $totalCount = count($rows);

    $cumulativeData[] = $totalCount;

    // คำนวณจำนวนที่เพิ่มขึ้นในปีนี้
    if ($index === 0) {
        // สำหรับปีแรก: หาจำนวนสะสมก่อนปีเริ่มต้น
        $db->Where = "WHERE YEAR(device_DateInput) < '$currentYear' AND device_DateInput != '0000-00-00' AND YEAR(device_DateInput) > 0";
        $prevRows = $db->Select();
        $prevCount = count($prevRows);
        $yearlyIncrease[] = $totalCount - $prevCount;
    } else {
        $yearlyIncrease[] = $recordsPerYear[$index];
    }
}

echo json_encode([
    'years' => $years,
    'recordsPerYear' => $recordsPerYear,
    'devicesByYear' => $devicesByYear,
    'cumulativeData' => $cumulativeData,
    'yearlyIncrease' => $yearlyIncrease,
    'success' => true
], JSON_UNESCAPED_UNICODE);
