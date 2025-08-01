<?php
include("../../class/class.db.php");
header('Content-Type: application/json');

    $all_pro = [];
    $thum_pro = [];
    $sum_24 = $sum_25 = $SumProject2 = 0;

    $SumPer = $per24_1 = $per24_2 = $per24_3 = $per24_4 = $per24_5 = $per24_6 = $per24_7 = $per24_99 = 0;
    $SumPer = $per25_1 = $per25_2 = $per25_3 = $per25_4 = $per25_5 = $per25_6 = $per25_7 = $per25_99 = 0;

    // p.project_status NOT IN('00','10','12','13','16') 
    //     AND p.project_status = '06'
    $dbSumProject = new Database('nurse');
    $dbSumProject->Table = "proj_list p LEFT JOIN Proj_ProcessProject pp ON p.project_id = pp.project_id";
    $dbSumProject->Where = "
        where p.project_status = '09'
        AND pp.partwork_id = '003'
        AND pp.process_id = '001'
        ORDER BY p.project_id
    ";
    $userSumProject = $dbSumProject->Select();
    $SumProject2 = count($userSumProject);
    foreach($userSumProject as $valuedbSumProject=>$datadbSumProject){ 
        // $thum_pro[] = $datadbSumProject['project_id']; 
        switch ($datadbSumProject['project_Year']) {
            case '2024':
                    $sum_24++;
                break;

            case '2025':
                    $sum_25++;
                break;
                
            default:
                # code...
                break;
        }
        if($datadbSumProject['project_Year'] == "2024"){
            $dbPer = new Database('nurse');
            $dbPer->Table = "proj_GrpGoal";
            $dbPer->Where = "
                WHERE project_id ='$datadbSumProject[project_id]'
                ORDER BY grp_id
            ";
            $userPer = $dbPer->Select();
            $SumPer = count($userPer);
            foreach($userPer as $valuedbPer=>$datadbPer){ 
                switch ($datadbPer['grptype_id']) {
                    case '00000001':
                        $per24_1 += $datadbPer['grp_numberReal'];
                        break;
    
                    case '00000002':
                        $per24_2  += $datadbPer['grp_numberReal'];
                        break;
    
                    case '00000003':
                        $per24_3  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000004':
                        $per24_4  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000005':
                        $per24_5  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000006':
                        $per24_6  += $datadbPer['grp_numberReal'];
                        break;
    
                    case '00000007':
                        $per24_7  += $datadbPer['grp_numberReal'];
                        break;
    
                    default:
                        $per24_99  += $datadbPer['grp_numberReal'];
                        break;
                }
            }
        }else if($datadbSumProject['project_Year'] == "2025"){
            $dbPer = new Database('nurse');
            $dbPer->Table = "proj_GrpGoal";
            $dbPer->Where = "
                WHERE project_id ='$datadbSumProject[project_id]'
                ORDER BY grp_id
            ";
            $userPer = $dbPer->Select();
            $SumPer = count($userPer);
            foreach($userPer as $valuedbPer=>$datadbPer){ 
                switch ($datadbPer['grptype_id']) {
                    case '00000001':
                        $per25_1  += $datadbPer['grp_numberReal'];
                        break;

                    case '00000002':
                        $per25_2  += $datadbPer['grp_numberReal'];
                        break;

                    case '00000003':
                        $per25_3  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000004':
                        $per25_4  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000005':
                        $per25_5  += $datadbPer['grp_numberReal'];
                        break;
                    
                    case '00000006':
                        $per25_6  += $datadbPer['grp_numberReal'];
                        break;

                    case '00000007':
                        $per25_7  += $datadbPer['grp_numberReal'];
                        break;

                    default:
                        $per25_99  += $datadbPer['grp_numberReal'];
                        break;
                }
            }
        }
    }
    
    echo json_encode([
        'Sumproject' => $SumProject2,
        'project_67' => $sum_24,
        'project_68' => $sum_25,
        'SumPers' => $SumPer,
        'Pers24_1' => $per24_1,
        'Pers24_2' => $per24_2,
        'Pers24_3' => $per24_3,
        'Pers24_4' => $per24_4,
        'Pers24_5' => $per24_5,
        'Pers24_6' => $per24_6,
        'Pers24_7' => $per24_7,
        'Pers24_99' => $per24_99,
        'Pers25_1' => $per25_1,
        'Pers25_2' => $per25_2,
        'Pers25_3' => $per25_3,
        'Pers25_4' => $per25_4,
        'Pers25_5' => $per25_5,
        'Pers25_6' => $per25_6,
        'Pers25_7' => $per25_7,
        'Pers25_99' => $per25_99
    ]);
?>
