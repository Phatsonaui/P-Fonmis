<?php
include("../class/class.db.php");
$db5=new Database('nurse');
$db5->Table = "RS_JNLInDatabase";
$db5->Where = "Where DB_ID = '03' OR DB_ID = '04' OR DB_ID = '05' OR DB_ID = '06' OR DB_ID = '08' OR DB_ID = '09' OR DB_ID = '10' order by DB_ID";
$user5 = $db5->Select();
$total_records = count($user5); // นับจำนวน record ทั้งหมด

// กำหนดจำนวน record ที่จะแสดงในแต่ละหน้า
$records_per_page = 10;
// คำนวณจำนวนหน้าทั้งหมด
$total_pages = ceil($total_records / $records_per_page);
// กำหนดหน้าปัจจุบัน
$current_page = isset($_POST['page']) ? $_POST['page'] : 1;
// คำนวณ offset ของ record ที่จะแสดงในหน้าปัจจุบัน
$offset = ($current_page - 1) * $records_per_page;

// ดึงข้อมูลจากฐานข้อมูลโดยใช้ offset และ limit ตามหน้าปัจจุบัน
$db4=new Database('nurse');
$db4->Table = "RS_Journal";
$db4->Where = "Where JNL_Year >= '".(date('Y')-4)."' AND JNL_Year <= '".date('Y')."' order by JNL_Year desc LIMIT $offset, $records_per_page";
$user2566_4 = $db4->Select();

// ส่งข้อมูลออกเป็น JSON
$response = array(
'table_data' => '',
'pagination' => ''
);
if ($user2566_4) {
// สร้างตารางแสดงข้อมูล
$table_data = '';
foreach ($user2566_4 as $data2566_4) {
$table_data .= '<tr>';
$table_data .= '<td>' . ++$offset . '</td>';
$table_data .= '<td>' . ($data2566_4['JNL_Year']+543) . '</td>';
$table_data .= '<td class="text-start">' . $data2566_4['JNL_NameTH'] . '</td>';
$table_data .= '<td>' . $data5['DB_NameTH'] . '</td>';
$table_data .= '</tr>';
}
$response['table_data'] = $table_data;
}
$pagination = '';
if ($total_pages > 1) {
    $pagination .= '<ul class="pagination">';
    // ปุ่ม Previous
    if ($current_page > 1) {
        $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page - 1) . '">Previous</a></li>';
    } else {
        $pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>';
    }
    // ปุ่มหน้า
    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $current_page) {
            $pagination .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . $i. '">' . $i . '</a></li>';
}
}
// ปุ่ม Next
if ($current_page < $total_pages) {
$pagination .= '<li class="page-item"><a class="page-link" href="#" data-page="' . ($current_page + 1) . '">Next</a></li>';
} else {
$pagination .= '<li class="page-item disabled"><a class="page-link" href="#">Next</a></li>';
}
$pagination .= '</ul>';
}

echo $output;
echo $pagination;
?>