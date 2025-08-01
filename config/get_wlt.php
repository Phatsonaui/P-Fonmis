<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  include("../../class/class.db.php");

  $selectedYear = isset($_POST['year']) ? $_POST['year'] : '2024';

  $total_over = 0;

  if ($selectedYear != '') {
    $sumunit = 0;

    // ดึงข้อมูล WL_Term
    $dbTm3 = new Database('nurse');
    $dbTm3->Table = "WL_Term";
    $dbTm3->Where = "where fiscal_year='$selectedYear' order by term_id";
    $userTm3 = $dbTm3->Select();

    foreach ($userTm3 as $valuesTm3 => $dataTm3) {
      $term_no = $dataTm3['term_no'];
      $term_year = $dataTm3['term_year'];


      // ดึงข้อมูล WL_LimitUnit และเชื่อมต่อกับ user_data
      $db1 = new Database('nurse');
      $db1->Table = "WL_LimitUnit LEFT JOIN user_data ON WL_LimitUnit.user_id = user_data.ud_id";
      $db1->Where = "where WL_LimitUnit.fiscal_year='$selectedYear' group by WL_LimitUnit.user_id";
      $user1 = $db1->Select();

      foreach ($user1 as $values1 => $data1) {

        $db6 = new Database('nurse');
        $db6->Table = "WL_Data";
        $db6->Where = "where DT_eduTerm='$term_no' AND DT_eduYear='$term_year' AND levels_id IN ('04') AND DT_status='5' order by DT_SubjCode";
        $user6 = $db6->Select();

        foreach ($user6 as $values6 => $data6) {
          $sunit = 0;
          $Theory1 = 0;
          $Lab1 = 0;
          $Ward1 = 0;

          // Process WL_Theory
          $db7 = new Database('nurse');
          $db7->Table = "WL_Theory";
          $db7->Where = "where DT_id='{$data6['DT_id']}' AND user_id='{$data1['ud_id']}'";
          $user7 = $db7->Select();

          foreach ($user7 as $values7 => $data7) {
            $db10 = new Database('nurse');
            $db10->Table = "WL_GrpSec";
            $db10->Where = "where sec_id='{$data7['sec_id']}' AND DT_id='{$data6['DT_id']}'";
            $user10 = $db10->Select();

            foreach ($user10 as $values10 => $data10) {
              $db11 = new Database('nurse');
              $db11->Table = "WL_CondHour";
              $db11->Where = "where levels_id IN ('04') AND CondCourse_id='{$data6['CondCourse_id']}' AND burden_id ='001'";
              $user11 = $db11->Select();

              foreach ($user11 as $values11 => $data11) {
                $pers2grp = ($data10['sec_num'] <= $data11['persontoover']) ? $data10['sec_num'] : $data11['persontoover'];

                if ($pers2grp <= $data11['persontogrp']) {
                  $Theory = $data7['teach_hour'] / $data11['moneyhour_unit'];
                  $Theory1 += $Theory;
                } else {
                  $Theory = ($data7['teach_hour'] / $data11['moneyhour_unit']) + (($pers2grp - $data11['persontogrp']) * ($data7['teach_hour'] / $data11['moneyhour_unit']) * $data11['person_over']);
                  $Theory1 += $Theory;
                }
              }
            }
          }

          // Process WL_Lab
          $db8 = new Database('nurse');
          $db8->Table = "WL_Lab";
          $db8->Where = "where DT_id='{$data6['DT_id']}' AND user_id='{$data1['ud_id']}'";
          $user8 = $db8->Select();

          foreach ($user8 as $values8 => $data8) {
            $db12 = new Database('nurse');
            $db12->Table = "WL_GrpLab";
            $db12->Where = "where sec_id='{$data8['sec_id']}' AND DT_id='{$data6['DT_id']}'";
            $user12 = $db12->Select();

            foreach ($user12 as $values12 => $data12) {
              $db13 = new Database('nurse');
              $db13->Table = "WL_CondHour";
              $db13->Where = "where levels_id IN ('04') AND CondCourse_id='{$data6['CondCourse_id']}' AND burden_id ='002'";
              $user13 = $db13->Select();

              foreach ($user13 as $values13 => $data13) {
                $pers2grp2 = ($data12['GLab_num'] <= $data13['persontoover']) ? $data12['GLab_num'] : $data13['persontoover'];

                if ($pers2grp2 <= $data13['persontogrp']) {
                  $Lab = $data8['teach_hour'] / $data13['moneyhour_unit'];
                  $Lab1 += $Lab;
                } else {
                  $Lab = ($data8['teach_hour'] / $data13['moneyhour_unit']) + (($pers2grp2 - $data13['persontogrp']) * ($data8['teach_hour'] / $data13['moneyhour_unit']) * $data13['person_over']);
                  $Lab1 += $Lab;
                }
              }
            }
          }

          // Process WL_Ward
          $db9 = new Database('nurse');
          $db9->Table = "WL_Ward";
          $db9->Where = "where DT_id='{$data6['DT_id']}' AND user_id='{$data1['ud_id']}'";
          $user9 = $db9->Select();

          foreach ($user9 as $values9 => $data9) {
            $db14 = new Database('nurse');
            $db14->Table = "WL_GrpWard";
            $db14->Where = "where DT_id='{$data6['DT_id']}'";
            $user14 = $db14->Select();

            foreach ($user14 as $values14 => $data14) {
              $db15 = new Database('nurse');
              $db15->Table = "WL_CondHour";
              $db15->Where = "where levels_id IN ('04') AND CondCourse_id='{$data6['CondCourse_id']}' AND burden_id ='003'";
              $user15 = $db15->Select();

              foreach ($user15 as $values15 => $data15) {
                $pers2grp3 = ($data14['GWard_num'] <= $data15['persontoover']) ? $data14['GWard_num'] : $data15['persontoover'];

                if ($pers2grp3 <= $data15['persontogrp']) {
                  $Ward = $data9['teach_hour'] / $data15['moneyhour_unit'];
                  $Ward1 += $Ward;
                } else {
                  $Ward = ($data9['teach_hour'] / $data15['moneyhour_unit']) + (($pers2grp9 - $data15['persontogrp']) * ($data9['teach_hour'] / $data15['moneyhour_unit']) * $data15['person_over']);
                  $Ward1 += $Ward;
                }
              }
            }
          }

          $sunit = $Theory1 + $Lab1 + $Ward1;
          $sumunit += $sunit;
        }
      }
    }
  }

  echo $sumunit;
} else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}