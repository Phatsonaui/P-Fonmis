<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');
// เก็บผลลัพธ์
$categories = [];       // เก็บชื่อประเภท เช่น "ครุภัณฑ์การศึกษา"
$categoryCounts = [];   // เก็บจำนวนของแต่ละประเภท
$devicesByCategory = []; // เก็บ device_ID ของแต่ละประเภท

// query ตารางประเภทครุภัณฑ์ (DV_Type)
$dbType = new Database('nurse');
$dbType->Table = "DV_Type";
$dbType->Where = "WHERE Dtype_status = '1' ORDER BY Dtype_id ASC";
$types = $dbType->Select();

// วนลูปทุกประเภท
foreach ($types as $type) {
    $typeID   = $type['Dtype_id'];   // รหัสประเภท
    $typeName = $type['Dtype_name']; // ชื่อประเภท เช่น "ครุภัณฑ์การศึกษา"

    // ดึง device ที่อยู่ในประเภทนี้
    $dbDevice = new Database('nurse');
    $dbDevice->Table = "DV_Data";
    $dbDevice->Where = "WHERE device_type = '$typeID'";
    $devices = $dbDevice->Select();

    $deviceIDs = [];
    foreach ($devices as $device) {
        $deviceIDs[] = $device['device_ID'];
    }

    // เก็บข้อมูลลง array
    $categories[] = $typeName;
    $categoryCounts[] = count($deviceIDs);
    $devicesByCategory[$typeName] = $deviceIDs;
}
echo json_encode([
    'categories' => $categories,
    'categoryCounts' => $categoryCounts,
    'devicesByCategory' => $devicesByCategory,
    'success' => true
], JSON_UNESCAPED_UNICODE);
