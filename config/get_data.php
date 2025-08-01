<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  // รับค่าปีที่ส่งมาผ่าน POST
  include("../../class/class.db.php");

  $selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';;

  // ดำเนินการดึงข้อมูลหรือประมวลผลตามต้องการ
  // ตัวอย่างเท่านี้จะนับจำนวนเรื่องทั้งหมดในปีที่เลือก
  

  if ($selectedYear != '') {
    // echo "if empty";
    $total_Jounal41 = 0;
    $total_Jounal42 = 0;
    $total_Jounal43 = 0;

    $db41 = new Database('nurse');
    $db41->Table = "RS_Journal";
    $db41->Where = "Where JNL_Year = '$selectedYear' AND JNL_Status = 1 AND (JNL_Level ='1' OR JNL_Level = '2') ORDER BY JNL_Year DESC";
    $user41 = $db41->Select();
    $total_Jounal41 = count($user41);

    $db42 = new Database('nurse');
    $db42->Table = "RS_Journal";
    $db42->Where = "Where JNL_Year = '$selectedYear' AND JNL_Status = 1 AND JNL_Level = 1 ORDER BY JNL_Year DESC";
    $user42 = $db42->Select();
    $total_Jounal42 = count($user42);

    $db43 = new Database('nurse');
    $db43->Table = "RS_Journal";
    $db43->Where = "Where JNL_Year = '$selectedYear' AND JNL_Status = 1 AND JNL_Level = 2 ORDER BY JNL_Year DESC";
    $user43 = $db43->Select();
    $total_Jounal43 = count($user43);

  }

  // ส่งข้อมูลกลับไปยังเว็บไซต์หลักเป็นผลลัพธ์ที่ต้องการแสดง
  // if ($total_Jounal41 == 0) {
    // $response = array('pro1' => $total_Jounal41,'approve' => $approve,);
    // echo '<h1 style="color: #fa600b;font-weight: 900;">' . number_format($total_Jounal41) . ' เรื่อง</h1>';
    // echo json_encode($response);
  // } else {
    $response = array('all' => $total_Jounal41,'nation' => $total_Jounal42,'inter' => $total_Jounal43);
    // echo '<a href="Page.php?feed=Res_Jour&year_j=' . $selectedYear . '" style="color: #fa600b;font-weight: 900;">' . number_format($total_Jounal41) . ' เรื่อง</a>';
    header('Content-Type: application/json');
    echo json_encode($response);
  // }
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}