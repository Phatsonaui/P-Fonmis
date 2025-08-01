<?php
session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  // รับค่าปีที่ส่งมาผ่าน POST
  include("../../class/class.db.php");

  $selectedYear3 = isset($_POST['year']) ? $_POST['year'] : '2023';;
  // echo $selectedYear2;
  // ดำเนินการดึงข้อมูลหรือประมวลผลตามต้องการ
  // ตัวอย่างเท่านี้จะนับจำนวนเรื่องทั้งหมดในปีที่เลือก
  $total_Jounal43 = 0;

  if ($selectedYear3 != '') {
    // echo "if empty";
    $drow3 = 0;
    $db43 = new Database('nurse');
    $db43->Table = "RS_Journal";
    $db43->Where = "Where JNL_Year = '$selectedYear3' AND JNL_Status = 1 AND JNL_Level = 2 ORDER BY JNL_Year DESC";
    $user43 = $db43->Select();
    $drow3 = count($user43);
    $total_Jounal43 = $drow3;
  }
  if ($total_Jounal43 == 0) {
    echo '<h2 style="color: #00b24f;font-weight: 900;">' . number_format($total_Jounal43) . ' เรื่อง</h2>';
  } else {
    // ส่งข้อมูลกลับไปยังเว็บไซต์หลักเป็นผลลัพธ์ที่ต้องการแสดง
    echo '<a href="Page.php?feed=Res_dasJ&year_j=' . $selectedYear3 . '&lev=1" style="color: #00b24f;font-weight: 900;">' . number_format($total_Jounal43) . ' เรื่อง</a>';
  }
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}