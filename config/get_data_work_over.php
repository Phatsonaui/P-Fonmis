<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  // รับค่าปีที่ส่งมาผ่าน POST
  include("../../class/class.db.php");

  $selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';;

  // ดำเนินการดึงข้อมูลหรือประมวลผลตามต้องการ
  // ตัวอย่างเท่านี้จะนับจำนวนเรื่องทั้งหมดในปีที่เลือก
  $total_over = 0;

  if ($selectedYear != '') {
    // echo "if empty";
    $drow = 0;
    $db3 = new Database('nurse');
    $db3->Table = "WL_fiscalYear";
    $db3->Where = "where fiscal_year='$selectedYear' order by fiscal_year";
    $user3 = $db3->Select();
    foreach ($user3 as $values3 => $data3) {
      $total_over = $data3['fiscal_money'];
    }
  }

  // ส่งข้อมูลกลับไปยังเว็บไซต์หลักเป็นผลลัพธ์ที่ต้องการแสดง
  echo number_format($total_over) . ' บาท';
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}