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
                    <th>รายการรถ</th>
                    <th>ผู้จอง</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody class="Table_body_nu">
                <?php
                $r = 0;
                $dbGrp1 = new Database('nurse');
                $dbGrp1->Table = "car_time";
                $dbGrp1->Where = "where time_date like '$date%' order by mg_status,time_date";
                $userGrp1 = $dbGrp1->Select();
                foreach ($userGrp1 as $valuesGrp1 => $dataGrp1) {
                    $dbpp1=new Database('nurse');
                    $dbpp1->Table = "car_Form";
                    $dbpp1->Where = "where form_id='$dataGrp1[form_id]' AND form_status>'1' AND form_status<'5'";
                    $userpp1 = $dbpp1->Select();
                    foreach($userpp1 as $valuespp1=>$datapp1){$r++;

                    
                    switch ($datapp1['form_status']) {
                        case '1':
                            $text_stats = "บันทึกร่าง";
                            $class_color = "status";
                            break;
                        case '2':
                            $text_stats = "ส่งเรื่อง";
                            $class_color = "status late orange";
                            break;
                        
                        case '3':
                            $text_stats = "รอการอนุมัติ";
                            $class_color = "status late yellow";
                            break;

                        case '4':
                            $text_stats = "อนุมัติ";
                            $class_color = "status current";
                            break;

                        case '5':
                            $text_stats = "ไม่อนุมัติ";
                            $class_color = "status late red";
                            break;
                                             
                    }
                     ?>
                    <tr class="align-middle">
                        <td><?php echo $r; ?></td>
                        <td><?php 
                            $subtime=explode(" ",$dataGrp1['time_date']);
									
                            $strDate=$subtime[0];echo "วันที่ ".DateThai($strDate);
                            $strTime = "เวลา ".substr($subtime[1],0,5)." น."
                        ?></td>
                        <td><?php echo $strTime;?></td>
                        <td>
                            <?php
                                $dbMG=new Database('nurse');
                                $dbMG->Table = "car_MGCar";
                                $dbMG->Where = "where time_id='$dataGrp1[time_id]' AND form_id='$dataGrp1[form_id]' order by MGCar_id";
                                $userMG = $dbMG->Select();
                                    foreach($userMG as $valuesMG=>$dataMG){
                                        $dbMGcar=new Database('nurse');
                                        $dbMGcar->Table = "car_detail";
                                        $dbMGcar->Where = "where car_id='$dataMG[car_id]' order by car_id";
                                        $userMGcar = $dbMGcar->Select();
                                        foreach($userMGcar as $valuesMGcar=>$dataMGcar){
                                            echo $dataMGcar['car_model'].' '.$dataMGcar['car_number'];
                                        }
                                    }
                           ?>
                        </td>
                        <td>
                            <?php
                                $db6=new Database('nurse');
                                $db6->Table = "user_data";
                                $db6->Where = "where ud_id='$datapp1[ud_id]'";
                                $user6 = $db6->Select();
                                foreach($user6 as $values6=>$data6){
                                    echo $data6['name_th']."  ".$data6['lname_th'];
                                }
                            ?>
                        </td>
                        <td>
                            <div class="<?php echo $class_color; ?>"><?php echo $text_stats;?></div>
                        </td>
                    </tr>
                <?php } }?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
