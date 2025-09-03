<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');

$currentYear = date("Y");

// กำหนดช่วงอายุ
$ageGroups = [
    '>= 15 ปี' => [],
    '10-14 ปี' => [],
    '5-9 ปี'   => [],
    '< 5 ปี'   => [],
];

// ดึงประเภทครุภัณฑ์
$dbType = new Database('nurse');
$dbType->Table = "DV_Type";
$dbType->Where = "WHERE Dtype_status = '1' ORDER BY Dtype_id ASC";
$types = $dbType->Select();
$typeNames = [];
foreach ($types as $t) {
    $typeNames[$t['Dtype_id']] = $t['Dtype_name'];
}

// ดึงอุปกรณ์
$dbDeAge = new Database('nurse');
$dbDeAge->Table = "DV_Data";
$dbDeAge->Where = "WHERE device_DateInput <> '0000-00-00' AND device_DateInput IS NOT NULL ORDER BY device_DateInput ASC";
$devices = $dbDeAge->Select();

// จัดกลุ่มอายุ + ประเภท
foreach ($devices as $device) {
    // ตรวจสอบว่ามีข้อมูลวันที่หรือไม่
    if (empty($device['device_DateInput']) || $device['device_DateInput'] == '0000-00-00') {
        continue;
    }

    $yearInput = date("Y", strtotime($device['device_DateInput']));
    $age = $currentYear - $yearInput;

    // หาว่าอยู่ช่วงอายุไหน
    if ($age >= 15) {
        $group = '>= 15 ปี';
    } elseif ($age >= 10) {
        $group = '10-14 ปี';
    } elseif ($age >= 5) {
        $group = '5-9 ปี';
    } else {
        $group = '< 5 ปี';
    }

    $typeID = $device['device_type'];
    $typeName = isset($typeNames[$typeID]) ? $typeNames[$typeID] : "ไม่ทราบประเภท";

    // เก็บ device ตามประเภทในช่วงอายุ
    if (!isset($ageGroups[$group][$typeName])) {
        $ageGroups[$group][$typeName] = [
            'count' => 0,
            'devices' => []
        ];
    }

    $ageGroups[$group][$typeName]['count']++;
    $ageGroups[$group][$typeName]['devices'][] = $device['device_ID'];
}

// เตรียมข้อมูลสำหรับกราฟ
$ageCategories = array_keys($ageGroups);
$ageCounts = []; // จำนวนรวมต่อช่วง
$tooltipDetails = []; // เอาไว้ใช้ tooltip แสดงรายละเอียด
$devicesByGroup = [];

foreach ($ageGroups as $group => $types) {
    $sum = 0;
    $detailText = "";

    // ตรวจสอบว่ามีข้อมูลหรือไม่
    if (empty($types)) {
        $devicesByGroup[$group] = [];
    } else {
        $devicesByGroup[$group] = [];
        foreach ($types as $typeName => $data) {
            $count = intval($data['count']); // แปลงเป็น integer
            $devices = $data['devices'];

            $sum += $count;
            $detailText .= $typeName . ": <b>" . $count . " ชิ้น</b><br/>";

            // เก็บข้อมูลแบบชัดเจน
            $devicesByGroup[$group][$typeName] = [
                'count' => $count,
                'devices' => $devices
            ];
        }
    }

    $ageCounts[] = $sum;
    $tooltipDetails[] = $detailText;
}

// Debug: แสดงข้อมูลก่อนส่ง
error_log("Age Groups Data: " . print_r($devicesByGroup, true));

// ส่งออกเป็น JSON
echo json_encode([
    'ageCategories'   => $ageCategories,
    'ageCounts'       => $ageCounts,
    'tooltipDetails'  => $tooltipDetails,
    'devicesByGroup'  => $devicesByGroup,
    'success'         => true,
    'debug_info'      => [
        'total_devices' => count($devices),
        'current_year' => $currentYear,
        'type_names' => $typeNames
    ]
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
