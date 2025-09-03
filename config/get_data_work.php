<?php
// ปิดการแสดง PHP errors เพื่อไม่ให้ปนกับ JSON
error_reporting(0);
ini_set('display_errors', 0);

include("../../class/class.db.php");
header('Content-Type: application/json');

$selectedYear = isset($_POST['year']) ? $_POST['year'] : '2024';

// ป้องกัน SQL Injection
$selectedYear = intval($selectedYear);

if ($selectedYear <= 0) {
  echo json_encode(['error' => 'Invalid year']);
  exit;
}

// กำหนดค่าเริ่มต้นให้กับตัวแปร
$total_unit = 0;
$total_money = 0;
$sumpeple = 0;

// ดึงข้อมูลปีงบประมาณ
$db3 = new Database('nurse');
$db3->Table = "WL_fiscalYear";
$db3->Where = "where fiscal_year='$selectedYear' order by fiscal_year";
$user3 = $db3->Select();

if ($user3 && count($user3) > 0) {
  foreach ($user3 as $values3 => $data3) {
    $total_unit = $data3['fiscal_unit'];
    $total_money = $data3['fiscal_money'];
  }
}

// นับจำนวนคน
$db1 = new Database('nurse');
$db1->Table = "WL_LimitUnit";
$db1->Where = "LEFT JOIN user_data ON WL_LimitUnit.user_id = user_data.ud_id where WL_LimitUnit.fiscal_year='$selectedYear' group by WL_LimitUnit.user_id";
$user1 = $db1->Select();
$sumpeple = is_array($user1) ? count($user1) : 0;

// คำนวณภาระงานเฉลี่ยต่อคน
$number_without_comma = (float) str_replace(",", "", $total_unit);
$work = ($sumpeple > 0) ? $number_without_comma / $sumpeple : 0;

// จัดรูปแบบข้อมูล
$total_unit_formatted = number_format($number_without_comma) . " หน่วยกิต";
$over_money_formatted = number_format($total_money) . " บาท";
$work_per_formatted = number_format($work, 2) . " หน่วยกิต";

// ส่งข้อมูล JSON
echo json_encode([
  'total_unit' => $total_unit_formatted,
  'work_over' => $over_money_formatted,
  'work_per' => $work_per_formatted,
], JSON_UNESCAPED_UNICODE);
