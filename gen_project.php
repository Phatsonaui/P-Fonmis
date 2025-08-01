<?php session_start();
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");
    require_once("../../class/chgdatethai.php");

    $date = $_POST['date'];
    $posi = $_POST['position'];
    $pro_ar = array();
?>
    <?php

    if ($date == 1) {
        $dbGrpabo = new Database('nurse');
        $dbGrpabo->Table = "proj_list";
        $dbGrpabo->Where = "where project_year = '$year' AND project_status <> '00' AND project_id <> '14'"; //14 เป็น project_test 
        $userGrpabo = $dbGrpabo->Select();
        $cou_pro = count($userGrpabo);
        foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) {
            $pro = $dataGrpabo['project_id'];
            $pro_ar[] = $pro;
        }
    }
    if ($date == 2) {
        $dbGrpabo = new Database('nurse');
        $dbGrpabo->Table = "proj_list";
        $dbGrpabo->Where = "where project_year = '$year' AND project_status IN ('06', '07', '08', '11', '14') AND project_id <> '14'"; //14 เป็น project_test
        $userGrpabo = $dbGrpabo->Select();
        $cou_pro = count($userGrpabo);
        foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) {
            $pro = $dataGrpabo['project_id'];
            $pro_ar[] = $pro;
        }
    }
    if ($date == 3) {
        $dbGrpabo = new Database('nurse');
        $dbGrpabo->Table = "proj_list";
        $dbGrpabo->Where = "where project_year = '$year' AND project_status IN ('09')  AND project_id <> '14'"; //14 เป็น project_test
        $userGrpabo = $dbGrpabo->Select();
        $cou_pro = count($userGrpabo);
        foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) {
            $pro = $dataGrpabo['project_id'];
            $pro_ar[] = $pro;
        }
    }
    if ($date == 4) {
        $dbGrpabo = new Database('nurse');
        $dbGrpabo->Table = "proj_list";
        $dbGrpabo->Where = "where project_year = '$year' AND project_status IN ('12', '16')  AND project_id <> '14'"; //14 เป็น project_test
        $userGrpabo = $dbGrpabo->Select();
        $cou_pro = count($userGrpabo);
        foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) {
            $pro = $dataGrpabo['project_id'];
            $pro_ar[] = $pro;
        }
    }
    ?>
    <div class="col-md-12">
        <table class="table" id="dtBasicExample">
            <thead class="Table_header_nu">
                <tr>
                    <th>#</th>
                    <th>เลขที่รับ</th>
                    <th width="35%">ชื่อโปรเจค</th>
                    <th width="10%">รายชื่อ</th>
                    <?php
                    if ($posi == "03" || $posi == "05") { ?>
                        <th width="10%">งบประมาณ</th>
                    <?php }
                    ?>
                </tr>
            </thead>
            <tbody class="Table_body_nu">
                <?php
                $r = 0;
                $status_reports = array(6, 7, 8, 9, 11, 14);
                $dbGrp1 = new Database('nurse');
                $dbGrp1->Table = "proj_list";
                $dbGrp1->Where = "where project_id IN ('" . implode("','", $pro_ar) . "') ORDER BY project_dateofyear DESC";
                $userGrp1 = $dbGrp1->Select();
                foreach ($userGrp1 as $valuesGrp1 => $dataGrp1) {
                    $year_r = strtotime($dataGrp1['project_ReceiptDate']);
                    $year_re = date('Y', $year_r) + 543;
                    $r++; ?>
                    <tr>
                        <td class="text-center"><?php echo $r; ?></td>
                        <td class="text-center">
                            <?php if ($dataGrp1['project_ReceiptNo'] == "") {
                                echo "<p class='text-break'>-</p>";
                            } else {
                                echo $dataGrp1['project_ReceiptNo'] . "/" . $year_re;
                            } ?>
                        </td>
                        <td><span><?php echo $dataGrp1['project_name']; ?></span><br><span style="font-size: 10px;" class="text-secondary"><?php echo "สร้างเมื่อ : " . DateThai($dataGrp1['project_dateofyear']) ?></span></td>
                        <td style="font-size: 10px;">
                            <?php
                            $manager = 0;
                            $dbGrp12 = new Database('nurse');
                            $dbGrp12->Table = "proj_userProject";
                            $dbGrp12->Where = "where project_id = '$dataGrp1[project_id]' AND (userProj_status = '1' OR userProj_status = '2') ORDER BY userProj_status DESC";
                            $userGrp12 = $dbGrp12->Select();
                            foreach ($userGrp12 as $valuesGrp12 => $dataGrp12) {
                                $dbGrp2 = new Database('nurse');
                                $dbGrp2->Table = "user_data";
                                $dbGrp2->Where = "where ud_id='$dataGrp12[ud_id]' order by ud_id";
                                $userGrp2 = $dbGrp2->Select();
                                foreach ($userGrp2 as $valuesGrp2 => $dataGrp2) {
                                    $dbtitle11 = new Database('nurse');
                                    $dbtitle11->Table = "front_title";
                                    $dbtitle11->Where = "where front_id='$dataGrp2[title]'";
                                    $usertitle11 = $dbtitle11->Select();
                                    foreach ($usertitle11 as $valuestitle11 => $datatitle11) {
                                        if ($dataGrp12['userProj_status'] == 2 && $_SESSION['ud_id'] == $dataGrp12['ud_id']) {
                                            $manager = 1;
                                        }

                                        switch ($dataGrp12['userProj_status']) {
                                            case '1':
                                                echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ผู้บันทึกข้อมูล<br>";
                                                break;

                                            case '2':
                                                echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ประธาน<br>";

                                                break;
                                        }
                                    }
                                }
                            } ?>
                        </td>
                        <?php
                        if ($posi == "03" || $posi == "05") {
                            $in = 0;
                            $dbMoneyIN31 = new Database('nurse');
                            $dbMoneyIN31->Table = "Proj_MoneyIN";
                            $dbMoneyIN31->Where = "where project_id='$dataGrp1[project_id]'";
                            $userMoneyIN31 = $dbMoneyIN31->Select();
                            foreach ($userMoneyIN31 as $valuesMoneyIN31 => $dataMoneyIN31) {
                                $in++;
                                $sumMoneyIN1 += $dataMoneyIN31['moneyIN_Money'];
                            } ?>
                            <?php if ($in == 0) {
                                $sumMoneyIN1 = 0;
                            } ?>
                            <?php
                            $dbMoneyOut31 = new Database('nurse');
                            $dbMoneyOut31->Table = "proj_MoneyOut";
                            $dbMoneyOut31->Where = "where project_id='$dataGrp1[project_id]' ";
                            $userMoneyOut31 = $dbMoneyOut31->Select();
                            foreach ($userMoneyOut31 as $valuesMoneyOut31 => $dataMoneyOut31) {
                                $sumMoneyProject1 += $dataMoneyOut31['moneyOut_MoneyProject'];
                            } ?>
                            <td style="font-size: 10px;">
                                <?php echo "รายรับ : " . number_format($sumMoneyIN1) . " บาท<br>"; ?>
                                <?php echo "รายจ่าย : " . number_format($sumMoneyProject1) . " บาท"; ?>
                            </td>
                        <?php
                            $sumMoneyIN1 = 0;
                            $sumMoneyProject1 = 0;
                        }
                        ?>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
<?php
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
