<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  // รับค่าปีที่ส่งมาผ่าน POST
  include("../../class/class.db.php");

  $selectedYear2 = isset($_POST['year']) ? $_POST['year'] : '2023';;
  // echo $selectedYear2;
  // ดำเนินการดึงข้อมูลหรือประมวลผลตามต้องการ
  // ตัวอย่างเท่านี้จะนับจำนวนเรื่องทั้งหมดในปีที่เลือก
  $total_Jounal42 = 0;

  if ($selectedYear2 != '') {
    // echo "if empty";
    $drow2 = 0;
    $db42 = new Database('nurse');
    $db42->Table = "RS_Journal";
    $db42->Where = "Where JNL_Year = '$selectedYear2' AND JNL_Status = 1 AND JNL_Level = 1 ORDER BY JNL_Year DESC";
    $user42 = $db42->Select();
    $drow2 = count($user42);
    $total_Jounal42 = $drow2;
  }

  // ส่งข้อมูลกลับไปยังเว็บไซต์หลักเป็นผลลัพธ์ที่ต้องการแสดง
  if ($total_Jounal42 == 0) {
    echo '<h2 style="color: #00b24f;font-weight: 900;">' . number_format($total_Jounal42) . ' เรื่อง</h2>';
  } else {
    echo '<a href="Page.php?feed=Res_dasJ&year_j=' . $selectedYear2 . '&lev=2" style="color: #00b24f;font-weight: 900;">' . number_format($total_Jounal42) . ' เรื่อง</a>';
  }
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}