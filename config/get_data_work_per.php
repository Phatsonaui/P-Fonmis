<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  // รับค่าปีที่ส่งมาผ่าน POST
  include("../../class/class.db.php");

  $selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';;

  // ดำเนินการดึงข้อมูลหรือประมวลผลตามต้องการ
  // ตัวอย่างเท่านี้จะนับจำนวนเรื่องทั้งหมดในปีที่เลือก
  $work = 0;
  $total_over = 0;

  $db1 = new Database('nurse');
  $db1->Table = "WL_LimitUnit";
  $db1->Where = "LEFT JOIN user_data ON WL_LimitUnit.user_id = user_data.ud_id where WL_LimitUnit.fiscal_year='$selectedYear' group by WL_LimitUnit.user_id";
  $user1 = $db1->Select();
  $sumpeple = count($user1);


  $db3 = new Database('nurse');
  $db3->Table = "WL_fiscalYear";
  $db3->Where = "where fiscal_year='$selectedYear' order by fiscal_year";
  $user3 = $db3->Select();
  foreach ($user3 as $values3 => $data3) {
    $total_over = $data3['fiscal_unit'];
  }
  $number_without_comma = (float) str_replace(",", "", $total_over);
  $work = $number_without_comma / $sumpeple;


  echo number_format($work, 2) . " หน่วยกิต";
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}