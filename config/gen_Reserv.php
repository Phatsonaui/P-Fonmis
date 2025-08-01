<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");
    require_once("../../class/chgdatethai.php");

    $date = $_POST['date'];
    
?>
<style>
    table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 10px !important;
    text-align: center !important;
    border-bottom: 1px solid #ddd !important;
}

.status {
    padding: 10px 10px !important;
    border-radius: 15px !important;
    color: white;
    font-weight: bold !important;
    display: inline-block !important;
    font-size: 0.9em !important;
}

.current {
    background-color: #a8e6cf !important;
    color: darkgreen !important;
}

.late.yellow {
    background-color: #fadca1 !important;
    color: darkorange !important;
}

.late.red {
    background-color: #ef9a9a !important;
    color: #d32f2f !important;
}

.late.orange {
    background-color: #ffe0b2 !important;
    color: #f57c00 !important;
}

</style>
    <div class="col-md-12">
        <table class="table table-striped table-hover" id="dtBasicExample">
            <thead class="Table_header_nu">
                <tr>
                    <th>ลำดับ</th>
                    <th>วันที่จอง</th>
                    <th>เวลาที่จอง</th>
                    <th>รายการห้อง</th>
                    <th>ผู้จอง</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody class="Table_body_nu">
                <?php
                $r = 0;
                $dbGrp1 = new Database('nurse');
                $dbGrp1->Table = "RM_Reserv";
                $dbGrp1->Where = "where Rs_startdate = '$date' ORDER BY Rs_startTime DESC";
                $userGrp1 = $dbGrp1->Select();
                foreach ($userGrp1 as $valuesGrp1 => $dataGrp1) {

                    switch ($dataGrp1['RS_status']) {
                        case '1':
                            $text_stats = "ยกเลิกการใช้ห้อง";
                            $class_color = "status late orange";
                            break;
                        case '2':
                            $text_stats = "รอการอนุมัติใช้ห้อง";
                            $class_color = "status late yellow";
                            break;
                        
                        case '3':
                            $text_stats = "อนุมัติการใช้ห้อง";
                            $class_color = "status current";
                            break;

                        case '4':
                            $text_stats = "ไม่อนุมัติการใช้ห้อง";
                            $class_color = "status late red";
                            break;

                        case '5':
                            $text_stats = "ยกเลิกการใช้ห้อง";
                            $class_color = "status late orange";
                            break;
                                             
                    }
                    $r++; ?>
                    <tr class="align-middle">
                        <td><?php echo $r; ?></td>
                        <td><?php echo DateThai($date); ?></td>
                        <td><?php echo $dataGrp1['Rs_startTime']." - ".$dataGrp1['Rs_endTime']." น.";?></td>
                        <td>
                            <?php
                                $db1=new Database('nurse');
                                $db1->Table = "RM_Room";	
                                $db1->Where = "where room_id='$dataGrp1[room_id]' order by room_id";		
                                $user1 = $db1->Select();
                                foreach($user1 as $values1=>$data1){
                                    echo $data1['room_name'];
                                } 
                           ?>
                        </td>
                        <td>
                            <?php
                                $db2=new Database('nurse');
                                $db2->Table = "user_data";	
                                $db2->Where = "where ud_id='$dataGrp1[user_id]'";		
                                $user2 = $db2->Select();
                                foreach($user2 as $values2=>$data2){
                                    echo $data2['name_th']."  ".$data2['lname_th'];
                                }
                            ?>
                        </td>
                        <td>
                            <div class="<?php echo $class_color; ?>"><?php echo $text_stats;?></div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
