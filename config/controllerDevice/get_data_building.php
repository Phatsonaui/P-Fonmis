<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');

// JOIN ตารางทั้งหมดใน query เดียว
$dbDevice = new Database('nurse');
$dbDevice->Table = "DV_Data";
$dbDevice->Where = "LEFT JOIN DV_Check ON DV_Data.device_ID = DV_Check.device_id
    LEFT JOIN DV_Room ON DV_Check.check_room = DV_Room.room_id
    LEFT JOIN DV_Building ON DV_Room.room_building = DV_Building.building_id
    WHERE DV_Building.building_status = '1' ORDER BY DV_Building.building_id ASC";
$devices = $dbDevice->Select();

// ประมวลผลข้อมูล
$buildingNames = [];
$deviceCountsByBuilding = [];
$devicesByBuilding = [];

foreach ($devices as $device) {
    $buildingName = $device['building_name'];
    if (!$buildingName) continue; // ข้ามถ้าไม่มีชื่ออาคาร

    if (!isset($devicesByBuilding[$buildingName])) {
        $devicesByBuilding[$buildingName] = [];
    }
    $devicesByBuilding[$buildingName][] = $device['device_ID'];
}

// แยกชื่ออาคาร และจำนวนอุปกรณ์ต่ออาคาร
foreach ($devicesByBuilding as $buildingName => $deviceIDs) {
    $buildingNames[] = $buildingName;
    $deviceCountsByBuilding[] = count($deviceIDs);
}

// ส่งข้อมูลทั้งหมดที่ต้องการสำหรับ chart
echo json_encode([
    'buildingNames' => $buildingNames,
    'deviceCountsByBuilding' => $deviceCountsByBuilding,
    'devicesByBuilding' => $devicesByBuilding,
    'success' => true
], JSON_UNESCAPED_UNICODE);
