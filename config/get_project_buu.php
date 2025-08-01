<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
    include("../../class/class.db.php");

    $selectedYear = isset($_POST['year']) ? $_POST['year'] : '2023';

    if ($selectedYear != '') {
        $no_approve = 0;
        $approve = 0;
        $approve_re = 0;
        $being = 0;
        $pro1 = 0;
        $not_year = 0;
        $being_re = 0;
        $dbGrp1 = new Database('nurse');
        $dbGrp1->Table = "proj_list";
        $dbGrp1->Where = "where project_Year = '$selectedYear' OR project_year = '' AND project_status <> '00' AND project_id <> '14' ";
        $userGrp1 = $dbGrp1->Select();
        foreach ($userGrp1 as $valuesGrp1 => $dataProject1) {
            if (in_array($dataProject1['project_status'], ['12', '16'])) {
                $no_approve++;
            } else if ($dataProject1['project_status'] == "06") {
                $approve++;
                $being_re++;
            } else if (!in_array($dataProject1['project_status'], ["06", "07", "08", "09", "11", "12", "00", "13", "14"]) && $dataProject1['project_Year'] != "") {
                $being++;
            } else if (in_array($dataProject1['project_status'], ['06', '07', '08', '11', '14']) && $dataProject1['project_Year'] != "") {
                $being_re++;
                $approve++;
            }
            if ($dataProject1['project_status'] == "09") {
                $approve_re++;
                // $approve++;
            }
            if ($dataProject1['project_Year'] == "") {
                $not_year++;
            }
            if ($dataProject1['project_status'] != "00") {
                $pro1++;
            }
        }

        // Create an array with the updated values
        $response = array(
            'pro1' => $pro1,
            'approve' => $approve,
            'approve_re' => $approve_re,
            'being' => $being,
            'being_re' => $being_re,
            'no_approve' => $no_approve,
            'not_year' => $not_year,
            'selectedYear' => $selectedYear
        );

        // Return the values as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
}
