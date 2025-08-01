<?php
include("../../class/class.db.php");
require_once("../../class/chgdatethai.php");

$project_ids_string = implode("','", $_POST['pro_id']);
?>

<div class="col-md-12">
    <table class="table" id="dtBasicExample">
        <thead class="Table_header_nu">
            <tr>
                <th>#</th>
                <th>เลขที่รับ</th>
                <th width="60%">ชื่อโปรเจค</th>
                <th width="15%">รายชื่อ</th>
            </tr>
        </thead>
        <tbody class="Table_body_nu">
            <?php
            $r = 0;
            $db6 = new Database('nurse');
            $db6->Table = "proj_list";
            $db6->Where = "where project_id IN('$project_ids_string')  order by project_id";
            $user6 = $db6->Select();

            foreach ($user6 as $values6 => $data6) {
                $r++;
                $dbdate1 = new Database('nurse');
                $dbdate1->Table = "proj_date";
                $dbdate1->Where = "where project_id = '$data6[project_id]' ORDER by project_id ASC Limit 1";
                $userdate1 = $dbdate1->Select();
                foreach ($userdate1 as $valuesdate1 => $datadate1) {
                    $date_cre = $datadate1['prodate_start'];
                }
            ?>
                <tr>
                    <td class="text-center"><?php echo $r; ?></td>
                    <?php
                    if ($data6['project_ReceiptNo'] == "") {
                        echo "<td class='text-center'>-</td>";
                    } else {
                        $year_r = strtotime($data6['project_ReceiptDate']);
                        $year_re = date('Y', $year_r) + 543; ?>
                        <td><?php echo $data6['project_ReceiptNo'] . "/" . $year_re; ?></td>
                    <?php } ?>
                    <td><span><?php echo $data6['project_name']; ?></span><br><span style="font-size: 10px;" class="text-secondary"><?php echo "จัดทำโครงการ : " . DateThai($date_cre) ?></span> </td>

                    <td style="font-size: 10px;">
                        <?php
                        $manager = 0;
                        $dbGrp12 = new Database('nurse');
                        $dbGrp12->Table = "proj_userProject";
                        $dbGrp12->Where = "where project_id = '$data6[project_id]' AND (userProj_status = '1' OR userProj_status = '2') ORDER BY userProj_status DESC";
                        $userGrp12 = $dbGrp12->Select();
                        foreach ($userGrp12 as $valuesGrp12 => $dataGrp12) {
                            $dbGrp2 = new Database('nurse');
                            $dbGrp2->Table = "user_data";
                            $dbGrp2->Where = "where ud_id='$dataGrp12[ud_id]' ";
                            $userGrp2 = $dbGrp2->Select();
                            foreach ($userGrp2 as $valuesGrp2 => $dataGrp2) {
                                $dbtitle11 = new Database('nurse');
                                $dbtitle11->Table = "front_title";
                                $dbtitle11->Where = "where front_id='$dataGrp2[title]'";
                                $usertitle11 = $dbtitle11->Select();
                                foreach ($usertitle11 as $valuestitle11 => $datatitle11) {
                                    if ($dataGrp12['userProj_status'] == 2 && $_SESSION['ud_id_fon'] == $dataGrp12['ud_id']) {
                                        $manager = 1;
                                    }

                                    switch ($dataGrp12['userProj_status']) {
                                        case '1':
                                            echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ผู้จัดทำ<br>";
                                            break;

                                        case '2':
                                            echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ประธาน<br>";

                                            break;
                                    }
                                }
                            }
                        } ?>
                    </td>
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
</div>