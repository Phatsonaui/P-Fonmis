<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Untitled Document</title>
</head>

<body>

    <table width="98%" border="0" cellspacing="0" cellpadding="0" class="text">
        <tr>
            <td valign="top">
                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr>
                            <td>
                                <form id="form1" name="form1" method="post" action="">
                                    ปีงบประมาณ
                                    <select name="fsc" id="fsc">
                                        <?php 
											$dbyy1=new Database('nurse');
											$dbyy1->Table = "WL_fiscalYear";	
											$dbyy1->Where = "order by fiscal_year";	
											$useryy1 = $dbyy1->Select();
											foreach($useryy1 as $valuesyy1=>$datayy1){
												$dtyy=$datayy1['fiscal_year']+543;
										?>
                                        <option value="<?php echo $datayy1['fiscal_year'];?>">
                                            <?php echo $dtyy;?>
                                        </option>
                                        <?php }?>

                                    </select>
                                    <input type="submit" name="submit" id="submit" value="Submit"/>
                                </form>
                            </td>
                        </tr>
                        <?php 
						if($_POST['fsc']!=''){ 
						?>
                        <tr>
                            <td>
                                <div><a href="staff_SumDataOnMoney4Print.php?fsc=<?php echo $_POST['fsc'];?>">ส่งออก Excel</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">สรุปภาระงานของคณาจารย์</td>
                        </tr>
                        <tr>
                            <td align="center">
                                <?php 
									$fiscal=$_POST['fsc']+543;
									echo "ประจำปีงบประมาณ ".$fiscal."<br>";
								
									$col=0;	
								
							
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>


                        <tr>
                            <td>
                                <table width="100%" border="0" cellspacing="2" cellpadding="0">
                                    <tbody>
                                        <tr>
                                            <th width="2%" rowspan="3" align="center" bgcolor="#7F8EFF" scope="col">
                                                ที่
                                                <?php $col++;?>
                                            </th>
                                            <th width="15%" rowspan="3" align="center" bgcolor="#7F8EFF" scope="col">
                                                ชื่ออาจารย์
                                                <?php $col++;?>
                                            </th>
                                            <?php 
				  
				  
												$colnum=0;
												$dbTm1=new Database('nurse');
												$dbTm1->Table = "WL_Term";	
												$dbTm1->Where = "where fiscal_year='$_POST[fsc]' order by term_id";	
												$userTm1 = $dbTm1->Select();
												foreach($userTm1 as $valuesTm1=>$dataTm1){
													
												$colnum++;

														$yyyear=$dataTm1['term_year']+543;	
																			
										
											?>
                                            <th colspan="10" align="center" bgcolor="#7F8EFF" scope="col">
                                                <?php echo "ภาคการศึกษาที่ ".$dataTm1['term_no']."/".$yyyear;?>
                                            </th>
                                            <?php }?>
                                            <th width="10%" rowspan="3" align="center" bgcolor="#7F8EFF" scope="col">
                                                รวม<br>ทั้งสิ้น</th>
                                        </tr>
                                        <tr>
                                            <?php 
												for($an1=1;$an1<=$colnum;$an1++)	 {						  	
											?>
                                            <td colspan="3" align="center" bgcolor="#7F8EFF"><strong>ปกติ</strong>
                                            </td>
                                            <td colspan="3" align="center" bgcolor="#7F8EFF"><strong>พิเศษ</strong>
                                            </td>
                                            <td colspan="3" align="center" bgcolor="#7F8EFF"><strong>Inter</strong>
                                            </td>
                                            <td rowspan="2" align="center" bgcolor="#7F8EFF">
                                                <strong>รวม<?php $col++;?></strong>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <tr>
                                            <?php 
												for($an2=1;$an2<=$colnum;$an2++)	 {						  	
											?>
                                            <td align="center" bgcolor="#7F8EFF"><strong>ตรี<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>โท<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>เอก<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>ตรี<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>โท<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>เอก<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>ตรี<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>โท<?php $col++;?></strong>
                                            </td>
                                            <td align="center" bgcolor="#7F8EFF"><strong>เอก<?php $col++;?></strong>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php

                                        $samename = "";
                                        $rowp = 0;
                                        $sum = 0;
                                        $techspacial = 0;

                                        /*  
                                        $dbTm2=new Database('nurse');
                                        $dbTm2->Table = "WL_Term";	
                                        $dbTm2->Where = "where fiscal_year='$_POST[fsc]' order by term_id";	
                                        $userTm2 = $dbTm1->Select();
                                        foreach($userTm2 as $valuesTm2=>$dataTm2){
                                        	
                                        	$dbu1=new Database('nurse');
                                        	$dbu1->Table = "user_data";	
                                        	$dbu1->Where = "where level_u='1' order by ud_id";	
                                        	$useru1 = $dbu1->Select();
                                        	foreach($useru1 as $valuesu1=>$datau1){
                                        */
                                        $db1 = new Database('nurse');
                                        $db1->Table = "WL_LimitUnit";
                                        $db1->Where = "LEFT JOIN user_data ON WL_LimitUnit.user_id = user_data.ud_id where WL_LimitUnit.fiscal_year='$_POST[fsc]' group by WL_LimitUnit.user_id";
                                        $user1 = $db1->Select();
                                        foreach ( $user1 as $values1 => $data1 ) {
                                        	
                                        	$namecorse="";

                                            /*$db1=new Database('nurse');
                                            $db1->Table = "user_data";	
                                            $db1->Where = "where level_u='1' order by ud_id";	
                                            $user1 = $db1->Select();
                                            foreach($user1 as $values1=>$data1){*/
                                            $namecorse = $data1['name_th']."  ".$data1['lname_th'];
                                            $rowp++;
                                            $sumterm = 0;


                                            ?>
                                        <tr>
                                            <th bgcolor="#B0C9F5" scope="row">
                                                <?php echo $rowp; ?>
                                            </th>
                                            <td bgcolor="#B0C9F5">
                                                <?php echo $namecorse; ?>
                                            </td>
                                            <?php 
												$dbTm3=new Database('nurse');
												$dbTm3->Table = "WL_Term";	
												$dbTm3->Where = "where fiscal_year='$_POST[fsc]' order by term_id";	
												$userTm3 = $dbTm3->Select();
												foreach($userTm3 as $valuesTm3=>$dataTm3){
													$term3=$dataTm3['term_no'];
													$year3=$dataTm3['term_year'];
																	
											?>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*ตรี-ปกติ*/
											
											
											$sumunit=0;
											$db6=new Database('nurse');
											$db6->Table = "WL_Data";	
											$db6->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND levels_id='02' AND DT_status='5' order by DT_SubjCode";	
											$user6 = $db6->Select();
											foreach($user6 as $values6=>$data6){
												$sunit=0;$Theory=0;$Lab=0;$Ward=0;$pers2grp=0;$pers2grp2=0;$pers2grp3=0;$Theory1=0;$Lab1=0;$Ward1=0;
													
													$db7=new Database('nurse');
													$db7->Table = "WL_Theory";	
													$db7->Where = "where DT_id='$data6[DT_id]' AND user_id='$data1[ud_id]'";	
													$user7 = $db7->Select();
													foreach($user7 as $values7=>$data7){
														
														$db10=new Database('nurse');
														$db10->Table = "WL_GrpSec";	
														$db10->Where = "where sec_id='$data7[sec_id]' AND DT_id='$data6[DT_id]'";	
														$user10 = $db10->Select();
														foreach($user10 as $values10=>$data10){
															
															$db11=new Database('nurse');
															$db11->Table = "WL_CondHour";	
															$db11->Where = "where levels_id='02' AND CondCourse_id='$data6[CondCourse_id]' AND burden_id ='001'";	
															$user11 = $db11->Select();
															foreach($user11 as $values11=>$data11){
																
																
																if($data10['sec_num']<=$data11['persontoover']){$pers2grp=$data10['sec_num'];}else{$pers2grp=$data11['persontoover'];}
																if($pers2grp<=$data11['persontogrp']){
																	$Theory=$data7['teach_hour']/$data11['moneyhour_unit'];				
																	
																	$Theory1=$Theory1+$Theory;
																}else{
																	$Theory=($data7['teach_hour']/$data11['moneyhour_unit'])+(($pers2grp-$data11['persontogrp'])*($data7['teach_hour']/$data11['moneyhour_unit'])*$data11['person_over']);
																	
																	$Theory1=$Theory1+$Theory;
																}
																
															}
														}
														
													}
												
													$db8=new Database('nurse');
													$db8->Table = "WL_Lab";	
													$db8->Where = "where DT_id='$data6[DT_id]' AND user_id='$data1[ud_id]'";	
													$user8 = $db8->Select();
													foreach($user8 as $values8=>$data8){
														
														$db12=new Database('nurse');
														$db12->Table = "WL_GrpLab";	
														$db12->Where = "where sec_id='$data8[sec_id]' AND DT_id='$data6[DT_id]'";	
														$user12 = $db12->Select();
														foreach($user12 as $values12=>$data12){
															
															$db13=new Database('nurse');
															$db13->Table = "WL_CondHour";	
															$db13->Where = "where levels_id='02' AND CondCourse_id='$data6[CondCourse_id]' AND burden_id ='002'";	
															$user13 = $db13->Select();
															foreach($user13 as $values13=>$data13){
																
																if($data12['GLab_num']<=$data13['persontoover'])											
																{$pers2grp2=$data12['GLab_num'];}else{$pers2grp2=$data13['persontoover'];}
																
																if($pers2grp2<=$data13['persontogrp']){
																	$Lab=$data8['teach_hour']/$data13['moneyhour_unit'];
																	
																	$Lab1=$Lab1+$Lab;
																}else{
																	$Lab=($data8['teach_hour']/$data13['moneyhour_unit'])+(($pers2grp2-$data13['persontogrp'])*($data8['teach_hour']/$data13['moneyhour_unit'])*$data13['person_over']);
																	$Lab1=$Lab1+$Lab;					
																	
																}
															}
														}								
													}
												
													$db9=new Database('nurse');
													$db9->Table = "WL_Ward";	
													$db9->Where = "where DT_id='$data6[DT_id]' AND user_id='$data1[ud_id]'";	
													$user9 = $db9->Select();
													foreach($user9 as $values9=>$data9){
														
														$db14=new Database('nurse');
														$db14->Table = "WL_GrpWard";	
														$db14->Where = "where DT_id='$data6[DT_id]'";	
														$user14 = $db14->Select();
														foreach($user14 as $values14=>$data14){
															
															$db15=new Database('nurse');
															$db15->Table = "WL_CondHour";	
															$db15->Where = "where levels_id='02' AND CondCourse_id='$data6[CondCourse_id]' AND burden_id ='003'";	
															$user15 = $db15->Select();
															foreach($user15 as $values15=>$data15){
																	$f="";					
																
																if($data14['GWard_num']<=$data15['persontoover'])											
																{$pers2grp3=$data14['GWard_num'];}else{$pers2grp3=$data15['persontoover'];}
																
																if($pers2grp3<=$data15['persontogrp']){
																	$Ward=$data9['teach_hour']/$data15['moneyhour_unit'];
																	$Ward1=$Ward1+$Ward;
																	
																}else{
																	$Ward=($data9['teach_hour']/$data15['moneyhour_unit'])+(($pers2grp9-$data15['persontogrp'])*($data9['teach_hour']/$data15['moneyhour_unit'])*$data15['person_over']);
																	$Ward1=$Ward1+$Ward;
																	
																}
															}
														}																
													}
												
												$sunit=$Theory1+$Lab1+$Ward1;
												$sumunit=$sumunit+$sunit;
												
											}if($sumunit>0){echo number_format($sumunit,2);}
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*โท-ปกติ*/
											$sumunit2=0;
											$db62=new Database('nurse');
											$db62->Table = "WL_Data";	
											$db62->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='05'  order by DT_SubjCode";	
											$user62 = $db62->Select();
											foreach($user62 as $values62=>$data62){
												$sunit2=0;$Theory2=0;$Lab2=0;$Ward2=0;$pers2grp2=0;$pers2grp22=0;$pers2grp32=0;$Theory12=0;$Lab12=0;$Ward12=0;
													
													$db72=new Database('nurse');
													$db72->Table = "WL_Theory";	
													$db72->Where = "where DT_id='$data62[DT_id]' AND user_id='$data1[ud_id]'";	
													$user72 = $db72->Select();
													foreach($user72 as $values72=>$data72){
														
														$db102=new Database('nurse');
														$db102->Table = "WL_GrpSec";	
														$db102->Where = "where sec_id='$data72[sec_id]' AND DT_id='$data62[DT_id]'";	
														$user102 = $db102->Select();
														foreach($user102 as $values102=>$data102){
															
															$db112=new Database('nurse');
															$db112->Table = "WL_CondHour";	
															$db112->Where = "where levels_id='05' AND CondCourse_id='$data62[CondCourse_id]' AND burden_id ='001'";	
															$user112 = $db112->Select();
															foreach($user112 as $values112=>$data112){
																
																
																if($data102['sec_num']<=$data112['persontoover']){$pers2grp2=$data102['sec_num'];}else{$pers2grp2=$data112['persontoover'];}
																if($pers2grp2<=$data112['persontogrp']){
																	$Theory2=$data72['teach_hour']/$data112['moneyhour_unit'];				
																	
																	$Theory12=$Theory12+$Theory2;
																}else{
																	$Theory2=($data72['teach_hour']/$data112['moneyhour_unit'])+(($pers2grp2-$data112['persontogrp'])*($data72['teach_hour']/$data112['moneyhour_unit'])*$data112['person_over']);
																	
																	$Theory12=$Theory12+$Theory2;
																}
																
															}
														}
														
													}
												
													$db82=new Database('nurse');
													$db82->Table = "WL_Lab";	
													$db82->Where = "where DT_id='$data62[DT_id]' AND user_id='$data1[ud_id]'";	
													$user82 = $db82->Select();
													foreach($user82 as $values82=>$data82){
														
														$db122=new Database('nurse');
														$db122->Table = "WL_GrpLab";	
														$db122->Where = "where sec_id='$data82[sec_id]' AND DT_id='$data62[DT_id]'";	
														$user122 = $db122->Select();
														foreach($user122 as $values122=>$data122){
															
															$db132=new Database('nurse');
															$db132->Table = "WL_CondHour";	
															$db132->Where = "where levels_id='05' AND CondCourse_id='$data62[CondCourse_id]' AND burden_id ='002'";	
															$user132 = $db132->Select();
															foreach($user132 as $values132=>$data132){
																
																if($data122['GLab_num']<=$data132['persontoover'])											
																{$pers2grp22=$data122['GLab_num'];}else{$pers2grp22=$data132['persontoover'];}
																
																if($pers2grp22<=$data132['persontogrp']){
																	$Lab2=$data82['teach_hour']/$data132['moneyhour_unit'];
																	
																	$Lab12=$Lab12+$Lab2;
																}else{
																	$Lab2=($data82['teach_hour']/$data132['moneyhour_unit'])+(($pers2grp22-$data132['persontogrp'])*($data82['teach_hour']/$data132['moneyhour_unit'])*$data132['person_over']);
																	$Lab12=$Lab12+$Lab2;					
																	
																}
															}
														}								
													}
												
													$db92=new Database('nurse');
													$db92->Table = "WL_Ward";	
													$db92->Where = "where DT_id='$data62[DT_id]' AND user_id='$data1[ud_id]'";	
													$user92 = $db92->Select();
													foreach($user92 as $values92=>$data92){
														
														$db142=new Database('nurse');
														$db142->Table = "WL_GrpWard";	
														$db142->Where = "where DT_id='$data62[DT_id]'";	
														$user142 = $db142->Select();
														foreach($user142 as $values142=>$data142){
															
															$db152=new Database('nurse');
															$db152->Table = "WL_CondHour";	
															$db152->Where = "where levels_id='05' AND CondCourse_id='$data62[CondCourse_id]' AND burden_id ='003'";	
															$user152 = $db152->Select();
															foreach($user152 as $values152=>$data152){
																	$f="";					
																
																if($data142['GWard_num']<=$data152['persontoover'])											
																{$pers2grp32=$data142['GWard_num'];}else{$pers2grp32=$data152['persontoover'];}
																
																if($pers2grp32<=$data152['persontogrp']){
																	$Ward2=$data92['teach_hour']/$data152['moneyhour_unit'];
																	$Ward12=$Ward12+$Ward2;
																	
																}else{
																	$Ward2=($data92['teach_hour']/$data152['moneyhour_unit'])+(($pers2grp92-$data152['persontogrp'])*($data92['teach_hour']/$data152['moneyhour_unit'])*$data152['person_over']);
																	$Ward12=$Ward12+$Ward2;
																	
																}
															}
														}																
													}
												
												$sunit2=$Theory12+$Lab12+$Ward12;
												$sumunit2=$sumunit2+$sunit2;
												
											}if($sumunit2>0){echo number_format($sumunit2,2);}
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*เอก-ปกติ*/
											$sumunit3=0;
											$db63=new Database('nurse');
											$db63->Table = "WL_Data";	
											$db63->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='08' order by DT_SubjCode";	
											$user63 = $db63->Select();
											foreach($user63 as $values63=>$data63){
												$sunit3=0;$Theory3=0;$Lab3=0;$Ward3=0;$pers2grp3=0;$pers2grp23=0;$pers2grp33=0;$Theory13=0;$Lab13=0;$Ward13=0;
													
													$db73=new Database('nurse');
													$db73->Table = "WL_Theory";	
													$db73->Where = "where DT_id='$data63[DT_id]' AND user_id='$data1[ud_id]'";	
													$user73 = $db73->Select();
													foreach($user73 as $values73=>$data73){
														
														$db103=new Database('nurse');
														$db103->Table = "WL_GrpSec";	
														$db103->Where = "where sec_id='$data73[sec_id]' AND DT_id='$data63[DT_id]'";	
														$user103 = $db103->Select();
														foreach($user103 as $values103=>$data103){
															
															$db113=new Database('nurse');
															$db113->Table = "WL_CondHour";	
															$db113->Where = "where levels_id='08' AND CondCourse_id='$data63[CondCourse_id]' AND burden_id ='001'";	
															$user113 = $db113->Select();
															foreach($user113 as $values113=>$data113){
																
																
																if($data103['sec_num']<=$data113['persontoover']){$pers2grp3=$data103['sec_num'];}else{$pers2grp3=$data113['persontoover'];}
																if($pers2grp3<=$data113['persontogrp']){
																	$Theory3=$data73['teach_hour']/$data113['moneyhour_unit'];				
																	
																	$Theory13=$Theory13+$Theory3;
																}else{
																	$Theory3=($data73['teach_hour']/$data113['moneyhour_unit'])+(($pers2grp3-$data113['persontogrp'])*($data73['teach_hour']/$data113['moneyhour_unit'])*$data113['person_over']);
																	
																	$Theory13=$Theory13+$Theory3;
																}
																
															}
														}
														
													}
												
													$db83=new Database('nurse');
													$db83->Table = "WL_Lab";	
													$db83->Where = "where DT_id='$data63[DT_id]' AND user_id='$data1[ud_id]'";	
													$user83 = $db83->Select();
													foreach($user83 as $values83=>$data83){
														
														$db123=new Database('nurse');
														$db123->Table = "WL_GrpLab";	
														$db123->Where = "where sec_id='$data83[sec_id]' AND DT_id='$data63[DT_id]'";	
														$user123 = $db123->Select();
														foreach($user123 as $values123=>$data123){
															
															$db133=new Database('nurse');
															$db133->Table = "WL_CondHour";	
															$db133->Where = "where levels_id='08' AND CondCourse_id='$data63[CondCourse_id]' AND burden_id ='002'";	
															$user133 = $db133->Select();
															foreach($user133 as $values133=>$data133){
																
																if($data123['GLab_num']<=$data133['persontoover'])											
																{$pers2grp23=$data123['GLab_num'];}else{$pers2grp23=$data133['persontoover'];}
																
																if($pers2grp23<=$data133['persontogrp']){
																	$Lab3=$data83['teach_hour']/$data133['moneyhour_unit'];
																	
																	$Lab13=$Lab13+$Lab3;
																}else{
																	$Lab3=($data83['teach_hour']/$data133['moneyhour_unit'])+(($pers2grp23-$data133['persontogrp'])*($data83['teach_hour']/$data133['moneyhour_unit'])*$data133['person_over']);
																	$Lab13=$Lab13+$Lab3;					
																	
																}
															}
														}								
													}
												
													$db93=new Database('nurse');
													$db93->Table = "WL_Ward";	
													$db93->Where = "where DT_id='$data63[DT_id]' AND user_id='$data1[ud_id]'";	
													$user93 = $db93->Select();
													foreach($user93 as $values93=>$data93){
														
														$db143=new Database('nurse');
														$db143->Table = "WL_GrpWard";	
														$db143->Where = "where DT_id='$data63[DT_id]'";	
														$user143 = $db143->Select();
														foreach($user143 as $values143=>$data143){
															
															$db153=new Database('nurse');
															$db153->Table = "WL_CondHour";	
															$db153->Where = "where levels_id='08' AND CondCourse_id='$data63[CondCourse_id]' AND burden_id ='003'";	
															$user153 = $db153->Select();
															foreach($user153 as $values153=>$data153){
																	$f="";					
																
																if($data143['GWard_num']<=$data153['persontoover'])											
																{$pers2grp33=$data143['GWard_num'];}else{$pers2grp33=$data153['persontoover'];}
																
																if($pers2grp33<=$data153['persontogrp']){
																	$Ward3=$data93['teach_hour']/$data153['moneyhour_unit'];
																	$Ward13=$Ward13+$Ward3;
																	
																}else{
																	$Ward3=($data93['teach_hour']/$data153['moneyhour_unit'])+(($pers2grp93-$data153['persontogrp'])*($data93['teach_hour']/$data153['moneyhour_unit'])*$data153['person_over']);
																	$Ward13=$Ward13+$Ward3;
																	
																}
															}
														}																
													}
												
												$sunit3=$Theory13+$Lab13+$Ward13;
												$sumunit3=$sumunit3+$sunit3;
												
											}if($sumunit3>0){echo number_format($sumunit3,2);}
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*ตรี-พิเศษ*/
											$sumunit4=0;
											$db64=new Database('nurse');
											$db64->Table = "WL_Data";	
											$db64->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='03' order by DT_SubjCode";	
											$user64 = $db64->Select();
											foreach($user64 as $values64=>$data64){
												$sunit4=0;$Theory4=0;$Lab4=0;$Ward4=0;$pers2grp4=0;$pers2grp24=0;$pers2grp34=0;$Theory14=0;$Lab14=0;$Ward14=0;
													
													$db74=new Database('nurse');
													$db74->Table = "WL_Theory";	
													$db74->Where = "where DT_id='$data64[DT_id]' AND user_id='$data1[ud_id]'";	
													$user74 = $db74->Select();
													foreach($user74 as $values74=>$data74){
														
														$db104=new Database('nurse');
														$db104->Table = "WL_GrpSec";	
														$db104->Where = "where sec_id='$data74[sec_id]' AND DT_id='$data64[DT_id]'";	
														$user104 = $db104->Select();
														foreach($user104 as $values104=>$data104){
															
															$db114=new Database('nurse');
															$db114->Table = "WL_CondHour";	
															$db114->Where = "where levels_id='03' AND CondCourse_id='$data64[CondCourse_id]' AND burden_id ='001'";	
															$user114 = $db114->Select();
															foreach($user114 as $values114=>$data114){
																
																
																if($data104['sec_num']<=$data114['persontoover']){$pers2grp4=$data104['sec_num'];}else{$pers2grp4=$data114['persontoover'];}
																if($pers2grp4<=$data114['persontogrp']){
																	$Theory4=$data74['teach_hour']/$data114['moneyhour_unit'];				
																	
																	$Theory14=$Theory14+$Theory4;
																}else{
																	$Theory4=($data74['teach_hour']/$data114['moneyhour_unit'])+(($pers2grp4-$data114['persontogrp'])*($data74['teach_hour']/$data114['moneyhour_unit'])*$data114['person_over']);
																	
																	$Theory14=$Theory14+$Theory4;
																}
																
															}
														}
														
													}
												
													$db84=new Database('nurse');
													$db84->Table = "WL_Lab";	
													$db84->Where = "where DT_id='$data64[DT_id]' AND user_id='$data1[ud_id]'";	
													$user84 = $db84->Select();
													foreach($user84 as $values84=>$data84){
														
														$db124=new Database('nurse');
														$db124->Table = "WL_GrpLab";	
														$db124->Where = "where sec_id='$data84[sec_id]' AND DT_id='$data64[DT_id]'";	
														$user124 = $db124->Select();
														foreach($user124 as $values124=>$data124){
															
															$db134=new Database('nurse');
															$db134->Table = "WL_CondHour";	
															$db134->Where = "where levels_id='03' AND CondCourse_id='$data64[CondCourse_id]' AND burden_id ='002'";	
															$user134 = $db134->Select();
															foreach($user134 as $values134=>$data134){
																
																if($data124['GLab_num']<=$data134['persontoover'])											
																{$pers2grp24=$data124['GLab_num'];}else{$pers2grp24=$data134['persontoover'];}
																
																if($pers2grp24<=$data134['persontogrp']){
																	$Lab4=$data84['teach_hour']/$data134['moneyhour_unit'];
																	
																	$Lab14=$Lab14+$Lab4;
																}else{
																	$Lab4=($data84['teach_hour']/$data134['moneyhour_unit'])+(($pers2grp24-$data134['persontogrp'])*($data84['teach_hour']/$data134['moneyhour_unit'])*$data134['person_over']);
																	$Lab14=$Lab14+$Lab4;					
																	
																}
															}
														}								
													}
												
													$db94=new Database('nurse');
													$db94->Table = "WL_Ward";	
													$db94->Where = "where DT_id='$data64[DT_id]' AND user_id='$data1[ud_id]'";	
													$user94 = $db94->Select();
													foreach($user94 as $values94=>$data94){
														
														$db144=new Database('nurse');
														$db144->Table = "WL_GrpWard";	
														$db144->Where = "where DT_id='$data64[DT_id]'";	
														$user144 = $db144->Select();
														foreach($user144 as $values144=>$data144){
															
															$db154=new Database('nurse');
															$db154->Table = "WL_CondHour";	
															$db154->Where = "where levels_id='03' AND CondCourse_id='$data64[CondCourse_id]' AND burden_id ='003'";	
															$user154 = $db154->Select();
															foreach($user154 as $values154=>$data154){
																	$f="";					
																
																if($data144['GWard_num']<=$data154['persontoover'])											
																{$pers2grp34=$data144['GWard_num'];}else{$pers2grp34=$data154['persontoover'];}
																
																if($pers2grp34<=$data154['persontogrp']){
																	$Ward4=$data94['teach_hour']/$data154['moneyhour_unit'];
																	$Ward14=$Ward14+$Ward4;
																	
																}else{
																	$Ward4=($data94['teach_hour']/$data154['moneyhour_unit'])+(($pers2grp94-$data154['persontogrp'])*($data94['teach_hour']/$data154['moneyhour_unit'])*$data154['person_over']);
																	$Ward14=$Ward14+$Ward4;
																	
																}
															}
														}																
													}
												
												$sunit4=$Theory14+$Lab14+$Ward14;
												$sumunit4=$sumunit4+$sunit4;
												
											}if($sumunit4>0){echo number_format($sumunit4,2);}  
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*โท-พิเศษ*/
											$sumunit5=0;
											$db65=new Database('nurse');
											$db65->Table = "WL_Data";	
											$db65->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='06' order by DT_SubjCode";	
											$user65 = $db65->Select();
											foreach($user65 as $values65=>$data65){
												$sunit5=0;$Theory5=0;$Lab5=0;$Ward5=0;$pers2grp5=0;$pers2grp25=0;$pers2grp35=0;$Theory15=0;$Lab15=0;$Ward15=0;
													
													$db75=new Database('nurse');
													$db75->Table = "WL_Theory";	
													$db75->Where = "where DT_id='$data65[DT_id]' AND user_id='$data1[ud_id]'";	
													$user75 = $db75->Select();
													foreach($user75 as $values75=>$data75){
														
														$db105=new Database('nurse');
														$db105->Table = "WL_GrpSec";	
														$db105->Where = "where sec_id='$data75[sec_id]' AND DT_id='$data65[DT_id]'";	
														$user105 = $db105->Select();
														foreach($user105 as $values105=>$data105){
															
															$db115=new Database('nurse');
															$db115->Table = "WL_CondHour";	
															$db115->Where = "where levels_id='06' AND CondCourse_id='$data65[CondCourse_id]' AND burden_id ='001'";	
															$user115 = $db115->Select();
															foreach($user115 as $values115=>$data115){
																
																
																if($data105['sec_num']<=$data115['persontoover']){$pers2grp5=$data105['sec_num'];}else{$pers2grp5=$data115['persontoover'];}
																if($pers2grp5<=$data115['persontogrp']){
																	$Theory5=$data75['teach_hour']/$data115['moneyhour_unit'];				
																	
																	$Theory15=$Theory15+$Theory5;
																}else{
																	$Theory5=($data75['teach_hour']/$data115['moneyhour_unit'])+(($pers2grp5-$data115['persontogrp'])*($data75['teach_hour']/$data115['moneyhour_unit'])*$data115['person_over']);
																	
																	$Theory15=$Theory15+$Theory5;
																}
																
															}
														}
														
													}
												
													$db85=new Database('nurse');
													$db85->Table = "WL_Lab";	
													$db85->Where = "where DT_id='$data65[DT_id]' AND user_id='$data1[ud_id]'";	
													$user85 = $db85->Select();
													foreach($user85 as $values85=>$data85){
														
														$db125=new Database('nurse');
														$db125->Table = "WL_GrpLab";	
														$db125->Where = "where sec_id='$data85[sec_id]' AND DT_id='$data65[DT_id]'";	
														$user125 = $db125->Select();
														foreach($user125 as $values125=>$data125){
															
															$db135=new Database('nurse');
															$db135->Table = "WL_CondHour";	
															$db135->Where = "where levels_id='06' AND CondCourse_id='$data65[CondCourse_id]' AND burden_id ='002'";	
															$user135 = $db135->Select();
															foreach($user135 as $values135=>$data135){
																
																if($data125['GLab_num']<=$data135['persontoover'])											
																{$pers2grp25=$data125['GLab_num'];}else{$pers2grp25=$data135['persontoover'];}
																
																if($pers2grp25<=$data135['persontogrp']){
																	$Lab5=$data85['teach_hour']/$data135['moneyhour_unit'];
																	
																	$Lab15=$Lab15+$Lab5;
																}else{
																	$Lab5=($data85['teach_hour']/$data135['moneyhour_unit'])+(($pers2grp25-$data135['persontogrp'])*($data85['teach_hour']/$data135['moneyhour_unit'])*$data135['person_over']);
																	$Lab15=$Lab15+$Lab5;					
																	
																}
															}
														}								
													}
												
													$db95=new Database('nurse');
													$db95->Table = "WL_Ward";	
													$db95->Where = "where DT_id='$data65[DT_id]' AND user_id='$data1[ud_id]'";	
													$user95 = $db95->Select();
													foreach($user95 as $values95=>$data95){
														
														$db145=new Database('nurse');
														$db145->Table = "WL_GrpWard";	
														$db145->Where = "where DT_id='$data65[DT_id]'";	
														$user145 = $db145->Select();
														foreach($user145 as $values145=>$data145){
															
															$db155=new Database('nurse');
															$db155->Table = "WL_CondHour";	
															$db155->Where = "where levels_id='06' AND CondCourse_id='$data65[CondCourse_id]' AND burden_id ='003'";	
															$user155 = $db155->Select();
															foreach($user155 as $values155=>$data155){
																	$f="";					
																
																if($data145['GWard_num']<=$data155['persontoover'])											
																{$pers2grp35=$data145['GWard_num'];}else{$pers2grp35=$data155['persontoover'];}
																
																if($pers2grp35<=$data155['persontogrp']){
																	$Ward5=$data95['teach_hour']/$data155['moneyhour_unit'];
																	$Ward15=$Ward15+$Ward5;
																	
																}else{
																	$Ward5=($data95['teach_hour']/$data155['moneyhour_unit'])+(($pers2grp95-$data155['persontogrp'])*($data95['teach_hour']/$data155['moneyhour_unit'])*$data155['person_over']);
																	$Ward15=$Ward15+$Ward5;
																	
																}
															}
														}																
													}
												
												$sunit5=$Theory15+$Lab15+$Ward15;
												$sumunit5=$sumunit5+$sunit5;
												
											}if($sumunit5>0){echo number_format($sumunit5,2);}  
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*เอก-พิเศษ*/
											$sumunit6=0;
											$db66=new Database('nurse');
											$db66->Table = "WL_Data";	
											$db66->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='09' order by DT_SubjCode";	
											$user66 = $db66->Select();
											foreach($user66 as $values66=>$data66){
												$sunit6=0;$Theory6=0;$Lab6=0;$Ward6=0;$pers2grp6=0;$pers2grp26=0;$pers2grp36=0;$Theory16=0;$Lab16=0;$Ward16=0;
													
													$db76=new Database('nurse');
													$db76->Table = "WL_Theory";	
													$db76->Where = "where DT_id='$data66[DT_id]' AND user_id='$data1[ud_id]'";	
													$user76 = $db76->Select();
													foreach($user76 as $values76=>$data76){
														
														$db106=new Database('nurse');
														$db106->Table = "WL_GrpSec";	
														$db106->Where = "where sec_id='$data76[sec_id]' AND DT_id='$data66[DT_id]'";	
														$user106 = $db106->Select();
														foreach($user106 as $values106=>$data106){
															
															$db116=new Database('nurse');
															$db116->Table = "WL_CondHour";	
															$db116->Where = "where levels_id='09' AND CondCourse_id='$data66[CondCourse_id]' AND burden_id ='001'";	
															$user116 = $db116->Select();
															foreach($user116 as $values116=>$data116){
																
																
																if($data106['sec_num']<=$data116['persontoover']){$pers2grp6=$data106['sec_num'];}else{$pers2grp6=$data116['persontoover'];}
																if($pers2grp6<=$data116['persontogrp']){
																	$Theory6=$data76['teach_hour']/$data116['moneyhour_unit'];				
																	
																	$Theory16=$Theory16+$Theory6;
																}else{
																	$Theory6=($data76['teach_hour']/$data116['moneyhour_unit'])+(($pers2grp6-$data116['persontogrp'])*($data76['teach_hour']/$data116['moneyhour_unit'])*$data116['person_over']);
																	
																	$Theory16=$Theory16+$Theory6;
																}
																
															}
														}
														
													}
												
													$db86=new Database('nurse');
													$db86->Table = "WL_Lab";	
													$db86->Where = "where DT_id='$data66[DT_id]' AND user_id='$data1[ud_id]'";	
													$user86 = $db86->Select();
													foreach($user86 as $values86=>$data86){
														
														$db126=new Database('nurse');
														$db126->Table = "WL_GrpLab";	
														$db126->Where = "where sec_id='$data86[sec_id]' AND DT_id='$data66[DT_id]'";	
														$user126 = $db126->Select();
														foreach($user126 as $values126=>$data126){
															
															$db136=new Database('nurse');
															$db136->Table = "WL_CondHour";	
															$db136->Where = "where levels_id='09' AND CondCourse_id='$data66[CondCourse_id]' AND burden_id ='002'";	
															$user136 = $db136->Select();
															foreach($user136 as $values136=>$data136){
																
																if($data126['GLab_num']<=$data136['persontoover'])
																{$pers2grp26=$data126['GLab_num'];}else{$pers2grp26=$data136['persontoover'];}
																
																if($pers2grp26<=$data136['persontogrp']){
																	$Lab6=$data86['teach_hour']/$data136['moneyhour_unit'];
																	
																	$Lab16=$Lab16+$Lab6;
																}else{
																	$Lab6=($data86['teach_hour']/$data136['moneyhour_unit'])+(($pers2grp26-$data136['persontogrp'])*($data86['teach_hour']/$data136['moneyhour_unit'])*$data136['person_over']);
																	$Lab16=$Lab16+$Lab6;					
																	
																}
															}
														}								
													}
												
													$db96=new Database('nurse');
													$db96->Table = "WL_Ward";	
													$db96->Where = "where DT_id='$data66[DT_id]' AND user_id='$data1[ud_id]'";	
													$user96 = $db96->Select();
													foreach($user96 as $values96=>$data96){
														
														$db146=new Database('nurse');
														$db146->Table = "WL_GrpWard";	
														$db146->Where = "where DT_id='$data66[DT_id]'";	
														$user146 = $db146->Select();
														foreach($user146 as $values146=>$data146){
															
															$db156=new Database('nurse');
															$db156->Table = "WL_CondHour";	
															$db156->Where = "where levels_id='09' AND CondCourse_id='$data66[CondCourse_id]' AND burden_id ='003'";	
															$user156 = $db156->Select();
															foreach($user156 as $values156=>$data156){
																	$f="";					
																
																if($data146['GWard_num']<=$data156['persontoover'])											
																{$pers2grp36=$data146['GWard_num'];}else{$pers2grp36=$data156['persontoover'];}
																
																if($pers2grp36<=$data156['persontogrp']){
																	$Ward6=$data96['teach_hour']/$data156['moneyhour_unit'];
																	$Ward16=$Ward16+$Ward6;
																	
																}else{
																	$Ward6=($data96['teach_hour']/$data156['moneyhour_unit'])+(($pers2grp96-$data156['persontogrp'])*($data96['teach_hour']/$data156['moneyhour_unit'])*$data156['person_over']);
																	$Ward16=$Ward16+$Ward6;
																	
																}
															}
														}																
													}
												
												$sunit6=$Theory16+$Lab16+$Ward16;
												$sumunit6=$sumunit6+$sunit6;
												
											}if($sumunit6>0){echo number_format($sumunit6,2);}  
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*ตรี-inter*/
											$sumunit7=0;
											$db67=new Database('nurse');
											$db67->Table = "WL_Data";	
											$db67->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='04' order by DT_SubjCode";	
											$user67 = $db67->Select();
											foreach($user67 as $values67=>$data67){
												$sunit7=0;$Theory7=0;$Lab7=0;$Ward7=0;$pers2grp7=0;$pers2grp27=0;$pers2grp37=0;$Theory17=0;$Lab17=0;$Ward17=0;
													
													$db77=new Database('nurse');
													$db77->Table = "WL_Theory";	
													$db77->Where = "where DT_id='$data67[DT_id]' AND user_id='$data1[ud_id]'";	
													$user77 = $db77->Select();
													foreach($user77 as $values77=>$data77){
														
														$db107=new Database('nurse');
														$db107->Table = "WL_GrpSec";	
														$db107->Where = "where sec_id='$data77[sec_id]' AND DT_id='$data67[DT_id]'";	
														$user107 = $db107->Select();
														foreach($user107 as $values107=>$data107){
															
															$db117=new Database('nurse');
															$db117->Table = "WL_CondHour";	
															$db117->Where = "where levels_id='04' AND CondCourse_id='$data67[CondCourse_id]' AND burden_id ='001'";	
															$user117 = $db117->Select();
															foreach($user117 as $values117=>$data117){
																
																
																if($data107['sec_num']<=$data117['persontoover']){$pers2grp7=$data107['sec_num'];}else{$pers2grp7=$data117['persontoover'];}
																if($pers2grp7<=$data117['persontogrp']){
																	$Theory7=$data77['teach_hour']/$data117['moneyhour_unit'];				
																	
																	$Theory17=$Theory17+$Theory7;
																}else{
																	$Theory7=($data77['teach_hour']/$data117['moneyhour_unit'])+(($pers2grp7-$data117['persontogrp'])*($data77['teach_hour']/$data117['moneyhour_unit'])*$data117['person_over']);
																	
																	$Theory17=$Theory17+$Theory7;
																}
																
															}
														}
														
													}
												
													$db87=new Database('nurse');
													$db87->Table = "WL_Lab";	
													$db87->Where = "where DT_id='$data67[DT_id]' AND user_id='$data1[ud_id]'";	
													$user87 = $db87->Select();
													foreach($user87 as $values87=>$data87){
														
														$db127=new Database('nurse');
														$db127->Table = "WL_GrpLab";	
														$db127->Where = "where sec_id='$data87[sec_id]' AND DT_id='$data67[DT_id]'";	
														$user127 = $db127->Select();
														foreach($user127 as $values127=>$data127){
															
															$db137=new Database('nurse');
															$db137->Table = "WL_CondHour";	
															$db137->Where = "where levels_id='04' AND CondCourse_id='$data67[CondCourse_id]' AND burden_id ='002'";	
															$user137 = $db137->Select();
															foreach($user137 as $values137=>$data137){
																
																if($data127['GLab_num']<=$data137['persontoover'])											
																{$pers2grp27=$data127['GLab_num'];}else{$pers2grp27=$data137['persontoover'];}
																
																if($pers2grp27<=$data137['persontogrp']){
																	$Lab7=$data87['teach_hour']/$data137['moneyhour_unit'];
																	
																	$Lab17=$Lab17+$Lab7;
																}else{
																	$Lab7=($data87['teach_hour']/$data137['moneyhour_unit'])+(($pers2grp27-$data137['persontogrp'])*($data87['teach_hour']/$data137['moneyhour_unit'])*$data137['person_over']);
																	$Lab17=$Lab17+$Lab7;					
																	
																}
															}
														}								
													}
												
													$db97=new Database('nurse');
													$db97->Table = "WL_Ward";	
													$db97->Where = "where DT_id='$data67[DT_id]' AND user_id='$data1[ud_id]'";	
													$user97 = $db97->Select();
													foreach($user97 as $values97=>$data97){
														
														$db147=new Database('nurse');
														$db147->Table = "WL_GrpWard";	
														$db147->Where = "where DT_id='$data67[DT_id]'";	
														$user147 = $db147->Select();
														foreach($user147 as $values147=>$data147){
															
															$db157=new Database('nurse');
															$db157->Table = "WL_CondHour";	
															$db157->Where = "where levels_id='04' AND CondCourse_id='$data67[CondCourse_id]' AND burden_id ='003'";	
															$user157 = $db157->Select();
															foreach($user157 as $values157=>$data157){
																	$f="";					
																
																if($data147['GWard_num']<=$data157['persontoover'])											
																{$pers2grp37=$data147['GWard_num'];}else{$pers2grp37=$data157['persontoover'];}
																
																if($pers2grp37<=$data157['persontogrp']){
																	$Ward7=$data97['teach_hour']/$data157['moneyhour_unit'];
																	$Ward17=$Ward17+$Ward7;
																	
																}else{
																	$Ward7=($data97['teach_hour']/$data157['moneyhour_unit'])+(($pers2grp97-$data157['persontogrp'])*($data97['teach_hour']/$data157['moneyhour_unit'])*$data157['person_over']);
																	$Ward17=$Ward17+$Ward7;
																	
																}
															}
														}																
													}
												
												$sunit7=$Theory17+$Lab17+$Ward17;
												$sumunit7=$sumunit7+$sunit7;
												
											}if($sumunit7>0){echo number_format($sumunit7,2);}    
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*โท-inter*/
											$sumunit8=0;
											$db68=new Database('nurse');
											$db68->Table = "WL_Data";	
											$db68->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='07' order by DT_SubjCode";	
											$user68 = $db68->Select();
											foreach($user68 as $values68=>$data68){
												$sunit8=0;$Theory8=0;$Lab8=0;$Ward8=0;$pers2grp8=0;$pers2grp28=0;$pers2grp38=0;$Theory18=0;$Lab18=0;$Ward18=0;
													
													$db78=new Database('nurse');
													$db78->Table = "WL_Theory";	
													$db78->Where = "where DT_id='$data68[DT_id]' AND user_id='$data1[ud_id]'";	
													$user78 = $db78->Select();
													foreach($user78 as $values78=>$data78){
														
														$db108=new Database('nurse');
														$db108->Table = "WL_GrpSec";	
														$db108->Where = "where sec_id='$data78[sec_id]' AND DT_id='$data68[DT_id]'";	
														$user108 = $db108->Select();
														foreach($user108 as $values108=>$data108){
															
															$db118=new Database('nurse');
															$db118->Table = "WL_CondHour";	
															$db118->Where = "where levels_id='07' AND CondCourse_id='$data68[CondCourse_id]' AND burden_id ='001'";	
															$user118 = $db118->Select();
															foreach($user118 as $values118=>$data118){
																
																
																if($data108['sec_num']<=$data118['persontoover']){$pers2grp8=$data108['sec_num'];}else{$pers2grp8=$data118['persontoover'];}
																if($pers2grp8<=$data118['persontogrp']){
																	$Theory8=$data78['teach_hour']/$data118['moneyhour_unit'];				
																	
																	$Theory18=$Theory18+$Theory8;
																}else{
																	$Theory8=($data78['teach_hour']/$data118['moneyhour_unit'])+(($pers2grp8-$data118['persontogrp'])*($data78['teach_hour']/$data118['moneyhour_unit'])*$data118['person_over']);
																	
																	$Theory18=$Theory18+$Theory8;
																}
																
															}
														}
														
													}
												
													$db88=new Database('nurse');
													$db88->Table = "WL_Lab";	
													$db88->Where = "where DT_id='$data68[DT_id]' AND user_id='$data1[ud_id]'";	
													$user88 = $db88->Select();
													foreach($user88 as $values88=>$data88){
														
														$db128=new Database('nurse');
														$db128->Table = "WL_GrpLab";	
														$db128->Where = "where sec_id='$data88[sec_id]' AND DT_id='$data68[DT_id]'";	
														$user128 = $db128->Select();
														foreach($user128 as $values128=>$data128){
															
															$db138=new Database('nurse');
															$db138->Table = "WL_CondHour";	
															$db138->Where = "where levels_id='07' AND CondCourse_id='$data68[CondCourse_id]' AND burden_id ='002'";	
															$user138 = $db138->Select();
															foreach($user138 as $values138=>$data138){
																
																if($data128['GLab_num']<=$data138['persontoover'])											
																{$pers2grp28=$data128['GLab_num'];}else{$pers2grp28=$data138['persontoover'];}
																
																if($pers2grp28<=$data138['persontogrp']){
																	$Lab8=$data88['teach_hour']/$data138['moneyhour_unit'];
																	
																	$Lab18=$Lab18+$Lab8;
																}else{
																	$Lab8=($data88['teach_hour']/$data138['moneyhour_unit'])+(($pers2grp28-$data138['persontogrp'])*($data88['teach_hour']/$data138['moneyhour_unit'])*$data138['person_over']);
																	$Lab18=$Lab18+$Lab8;					
																	
																}
															}
														}								
													}
												
													$db98=new Database('nurse');
													$db98->Table = "WL_Ward";	
													$db98->Where = "where DT_id='$data68[DT_id]' AND user_id='$data1[ud_id]'";	
													$user98 = $db98->Select();
													foreach($user98 as $values98=>$data98){
														
														$db148=new Database('nurse');
														$db148->Table = "WL_GrpWard";	
														$db148->Where = "where DT_id='$data68[DT_id]'";	
														$user148 = $db148->Select();
														foreach($user148 as $values148=>$data148){
															
															$db158=new Database('nurse');
															$db158->Table = "WL_CondHour";	
															$db158->Where = "where levels_id='07' AND CondCourse_id='$data68[CondCourse_id]' AND burden_id ='003'";	
															$user158 = $db158->Select();
															foreach($user158 as $values158=>$data158){
																	$f="";					
																
																if($data148['GWard_num']<=$data158['persontoover'])											
																{$pers2grp38=$data148['GWard_num'];}else{$pers2grp38=$data158['persontoover'];}
																
																if($pers2grp38<=$data158['persontogrp']){
																	$Ward8=$data98['teach_hour']/$data158['moneyhour_unit'];
																	$Ward18=$Ward18+$Ward8;
																	
																}else{
																	$Ward8=($data98['teach_hour']/$data158['moneyhour_unit'])+(($pers2grp98-$data158['persontogrp'])*($data98['teach_hour']/$data158['moneyhour_unit'])*$data158['person_over']);
																	$Ward18=$Ward18+$Ward8;
																	
																}
															}
														}																
													}
												
												$sunit8=$Theory18+$Lab18+$Ward18;
												$sumunit8=$sumunit8+$sunit8;
												
											}if($sumunit8>0){echo number_format($sumunit8,2);}     
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
											/*เอก-inter*/
											$sumunit9=0;
											$db69=new Database('nurse');
											$db69->Table = "WL_Data";	
											$db69->Where = "where DT_eduTerm='$term3' AND  DT_eduYear='$year3' AND DT_status='5' AND levels_id='10' order by DT_SubjCode";	
											$user69 = $db69->Select();
											foreach($user69 as $values69=>$data69){
												$sunit9=0;$Theory9=0;$Lab9=0;$Ward9=0;$pers2grp9=0;$pers2grp29=0;$pers2grp39=0;$Theory19=0;$Lab19=0;$Ward19=0;
													
													$db79=new Database('nurse');
													$db79->Table = "WL_Theory";	
													$db79->Where = "where DT_id='$data69[DT_id]' AND user_id='$data1[ud_id]'";	
													$user79 = $db79->Select();
													foreach($user79 as $values79=>$data79){
														
														$db109=new Database('nurse');
														$db109->Table = "WL_GrpSec";	
														$db109->Where = "where sec_id='$data79[sec_id]' AND DT_id='$data69[DT_id]'";	
														$user109 = $db109->Select();
														foreach($user109 as $values109=>$data109){
															
															$db119=new Database('nurse');
															$db119->Table = "WL_CondHour";	
															$db119->Where = "where levels_id='10' AND CondCourse_id='$data69[CondCourse_id]' AND burden_id ='001'";	
															$user119 = $db119->Select();
															foreach($user119 as $values119=>$data119){
																
																
																if($data109['sec_num']<=$data119['persontoover']){$pers2grp9=$data109['sec_num'];}else{$pers2grp9=$data119['persontoover'];}
																if($pers2grp9<=$data119['persontogrp']){
																	$Theory9=$data79['teach_hour']/$data119['moneyhour_unit'];				
																	
																	$Theory19=$Theory19+$Theory9;
																}else{
																	$Theory9=($data79['teach_hour']/$data119['moneyhour_unit'])+(($pers2grp9-$data119['persontogrp'])*($data79['teach_hour']/$data119['moneyhour_unit'])*$data119['person_over']);
																	
																	$Theory19=$Theory19+$Theory9;
																}
																
															}
														}
														
													}
												
													$db89=new Database('nurse');
													$db89->Table = "WL_Lab";	
													$db89->Where = "where DT_id='$data69[DT_id]' AND user_id='$data1[ud_id]'";	
													$user89 = $db89->Select();
													foreach($user89 as $values89=>$data89){
														
														$db129=new Database('nurse');
														$db129->Table = "WL_GrpLab";	
														$db129->Where = "where sec_id='$data89[sec_id]' AND DT_id='$data69[DT_id]'";	
														$user129 = $db129->Select();
														foreach($user129 as $values129=>$data129){
															
															$db139=new Database('nurse');
															$db139->Table = "WL_CondHour";	
															$db139->Where = "where levels_id='10' AND CondCourse_id='$data69[CondCourse_id]' AND burden_id ='002'";	
															$user139 = $db139->Select();
															foreach($user139 as $values139=>$data139){
																
																if($data129['GLab_num']<=$data139['persontoover'])											
																{$pers2grp29=$data129['GLab_num'];}else{$pers2grp29=$data139['persontoover'];}
																
																if($pers2grp29<=$data139['persontogrp']){
																	$Lab9=$data89['teach_hour']/$data139['moneyhour_unit'];
																	
																	$Lab19=$Lab19+$Lab9;
																}else{
																	$Lab9=($data89['teach_hour']/$data139['moneyhour_unit'])+(($pers2grp29-$data139['persontogrp'])*($data89['teach_hour']/$data139['moneyhour_unit'])*$data139['person_over']);
																	$Lab19=$Lab19+$Lab9;					
																	
																}
															}
														}								
													}
												
													$db99=new Database('nurse');
													$db99->Table = "WL_Ward";	
													$db99->Where = "where DT_id='$data69[DT_id]' AND user_id='$data1[ud_id]'";	
													$user99 = $db99->Select();
													foreach($user99 as $values99=>$data99){
														
														$db149=new Database('nurse');
														$db149->Table = "WL_GrpWard";	
														$db149->Where = "where DT_id='$data69[DT_id]'";	
														$user149 = $db149->Select();
														foreach($user149 as $values149=>$data149){
															
															$db159=new Database('nurse');
															$db159->Table = "WL_CondHour";	
															$db159->Where = "where levels_id='10' AND CondCourse_id='$data69[CondCourse_id]' AND burden_id ='003'";	
															$user159 = $db159->Select();
															foreach($user159 as $values159=>$data159){
																	$f="";					
																
																if($data149['GWard_num']<=$data159['persontoover'])											
																{$pers2grp39=$data149['GWard_num'];}else{$pers2grp39=$data159['persontoover'];}
																
																if($pers2grp39<=$data159['persontogrp']){
																	$Ward9=$data99['teach_hour']/$data159['moneyhour_unit'];
																	$Ward19=$Ward19+$Ward9;
																	
																}else{
																	$Ward9=($data99['teach_hour']/$data159['moneyhour_unit'])+(($pers2grp99-$data159['persontogrp'])*($data99['teach_hour']/$data159['moneyhour_unit'])*$data159['person_over']);
																	$Ward19=$Ward19+$Ward9;
																	
																}
															}
														}																
													}
												
												$sunit9=$Theory19+$Lab19+$Ward19;
												$sumunit9=$sumunit9+$sunit9;
												
											}if($sumunit9>0){echo number_format($sumunit9,2);}   
											?>
                                            </td>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php 
												/*รวม*/
												$sumunit0=$sumunit+$sumunit2+$sumunit3+$sumunit4+$sumunit5+$sumunit6+$sumunit7+$sumunit8+$sumunit9;
												echo number_format($sumunit0,2);
												$sumterm=$sumterm+$sumunit0;
												
												?>
                                            </td>
                                            <?php }?>
                                            <td align="center" bgcolor="#B0C9F5">
                                                <?php
                                                /*รวมทั้งสิ้น*/
                                                echo number_format( $sumterm, 2 );
                                                if ( $data2[ 'teach_status' ] == 2 ) {
                                                    $techspacial = number_format( $sumterm, 2 );
                                                }
                                                $sum = $sum + $sumterm;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <th colspan="<?php echo $col;?>" align="right" bgcolor="#D7E4FB" scope="row">รวม</th>
                                            <th colspan="3" align="center" bgcolor="#D7E4FB">
                                                <?php echo number_format($sum,2);?>
                                            </th>
                                        </tr>
                                        <?php 
				
										$fiscalunit=number_format($sum,2);
										$fiscalmoney=$sumprice;		  
											
										$dbUpd=new Database('nurse');	
										$dbUpd->Table = "WL_fiscalYear";
										$dbUpd->Set  = "`fiscal_unit`='$fiscalunit',`fiscal_money`='$fiscalmoney',`fiscal_money`='$fiscalmoney',`fiscal_techspacial`='$techspacial'";
										$dbUpd->Where = "where fiscal_year='$_POST[fsc]'";
										$insertUpd= $dbUpd->Update();		
									
										?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>

</body>

</html>