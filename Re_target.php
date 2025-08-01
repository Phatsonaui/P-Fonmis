
		<!-- <div class="col-md-6 text-center mt-3">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					เงินที่ใช้ไปแต่ละงบ
				</div>
				<div class="card-body">
					<?php
					$datesave = array();
					$da_base01 = array();
					$da_base02 = array();
					$da_base03 = array();
					$da_base04 = array();

					$get_data_unive = array();
					$get_data_wor = array();
					$get_data_uniout = array();

					$befdate = date('Y') - 4;
					for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
						$da_1 = 0;
						$da_2 = 0;
						$da_3 = 0;
						$da_4 = 0;


						$db1 = new Database('nurse');
						$db1->Table = "RS_Project";
						$db1->Where = "Where PJ_Year='$toyear' AND PJ_Status = '1' order by PJ_id";
						$user1 = $db1->Select();
						foreach ($user1 as $values1 => $data1) {

							if ($data1['PJ_TypeFunds'] == '02') {
								$da_1 += $data1['PJ_SumMoney'];
								
							}
							if ($data1['PJ_TypeFunds'] == '03') {
								$da_2 += $data1['PJ_SumMoney'];
								
							}
							if ($data1['PJ_TypeFunds'] == '04' || $data1['PJ_TypeFunds'] == '01') {
								$da_3 += $data1['PJ_SumMoney'];
								
							}
							// 	}
							// }

						}
							$get_data_unive[] = $da_1;
							$get_data_wor[] = $da_2;
							$get_data_uniout[] = $da_3;
						


						$datesave[] = $toyear + 543;
						$da_base01[] = $da_1;
						$da_base02[] = $da_2;
						$da_base03[] = $da_3;
						$da_base04[] = $da_4;
					}
					$datesave = implode(",", $datesave);
					$da_base01 = implode(",", $da_base01);
					$da_base02 = implode(",", $da_base02);
					$da_base03 = implode(",", $da_base03);
					$da_base04 = implode(",", $da_base04);
					?>
					<p align="center">
					<div class="chart-container" align="center">
						<canvas id="Money_pas"></canvas>
					</div>
					<script>
						const data_pas = {
							labels: [<?php echo $datesave; ?>],
							datasets: [
									{
										label: 'เงินรายได้มหาวิทยาลัย',
										data: [<?php echo $da_base01; ?>],
										backgroundColor: ['rgba(219,43,57,0.8)'],
										borderColor: ['rgba(1, 1, 1, 1)'],
										borderWidth: 1,
									}, {
										label: 'เงินรายได้ส่วนงาน',
										data: [<?php echo $da_base02; ?>],
										backgroundColor: ['rgba(41,51,92,0.8)'],
										borderColor: ['rgba(1, 1, 1, 1)'],
										borderWidth: 1,
									}, {
										label: 'แหล่งทุนภายนอกมหาวิทยาลัย',
										data: [<?php echo $da_base03; ?>],
										backgroundColor: ['rgba(243,167,18,0.8)'],
										borderColor: ['rgba(1, 1, 1, 1)'],
										borderWidth: 1,
									}
								],
							};

						const pluginpas = {
						    id: 'custom',
						    beforeDraw: (chart, args, options) => {
						        const { ctx } = chart;
						        ctx.save();
						        ctx.globalCompositeOperation = 'destination-over';
						        ctx.fillStyle = options.color || '#99ffff';
						        ctx.fillRect(0, 0, chart.width, chart.height);
						        ctx.restore();
						    }
						};
						const configpas = {
							type: 'bar',
							data: data_pas,
							options: {
								responsive: true,
								plugins: {
									custom: {
										color: '#f2f2f2',
									},
									legend: {
										position: 'top',
										labels: {
											pointStyle: 'circle',
											usePointStyle: true,
											padding: 20,
											color: 'rgba(1,1,1,1)',
										},
									},
									tooltip: {
										mode: 'index',
										intersect: false,
										displayColors: true,
									},
								},
								scales: {
									y: {
										
										beginAtZero: true,
									},
								},
							},
								plugins: [pluginpas],
						};


						const Money_pas = new Chart(document.getElementById('Money_pas'), configpas, pluginpas);
					</script>
					</p>
				</div>
			</div>
		</div> -->
		<div class="col-md-6 mt-3">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					เป้าหมายงบประมาณวิจัย
				</div>
				<div class="card-body">
					<?php
					$year_re = array();
					$da_11 = array();
					$da_21 = array();
					$da_31 = array();
					$da_41 = array();

					

					$befdate1 = date('Y') - 4;
					for ($toyear1 = $befdate1; $toyear1 <= date('Y'); $toyear1++) {
						$da_011 = 0;
						$da_021 = 0;
						$da_031 = 0;
						$da_041 = 0;


						$db11 = new Database('nurse');
						$db11->Table = "RS_YearMoney";
						$db11->Where = "Where YM_year='$toyear1' order by YM_id ";
						$user11 = $db11->Select();
						foreach ($user11 as $values11 => $data11) {

							if ($data11['YM_typeFund'] == '2') {
								$da_011 += $data11['YM_Money'];
							}
							if ($data11['YM_typeFund'] == '3') {
								$da_021 += $data11['YM_Money'];
							}
							if ($data11['YM_typeFund'] == '4') {
								$da_031 += $data11['YM_Money'];
							}
							// 	}
							// }
						}

						// $get_data_unive[] = $da_011;
						// $get_data_wor[] = $da_021;
						// $get_data_uniout[] = $da_031;

						$year_re[] = $toyear1 + 543;
						$da_11[] = $da_011;
						$da_21[] = $da_021;
						$da_31[] = $da_031;
						$da_41[] = $da_041;
					}
					$year_re = implode(",", $year_re);
					$da_11 = implode(",", $da_11);
					$da_21 = implode(",", $da_21);
					$da_31 = implode(",", $da_31);
					$da_41 = implode(",", $da_41);
					?>
					<div class="chart-container" align="center">
						<canvas id="stackedBar"></canvas>
					</div>
					<script>
						const data_mo = {
							labels: [<?php echo $year_re; ?>],
							datasets: [

								{
									label: 'เงินรายได้ส่วนงาน',
									data: [<?php echo $da_base02; ?>],
									backgroundColor: 'rgba(106,153,78,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.5, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 1', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								},
								{
									label: 'เป้ารายได้ส่วนงาน',
									data: [<?php echo $da_21; ?>],
									backgroundColor: 'rgba(56,102,65,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.9, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 1', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								},
								{
									label: 'ได้รับทุนภายนอก',
									data: [<?php echo $da_base03; ?>],
									backgroundColor: 'rgba(253,247,214,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 5,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.5, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 2', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								},
								{
									label: 'เป้าแหล่งทุนภายนอก',
									data: [<?php echo $da_31; ?>],
									backgroundColor: 'rgba(167,201,87,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.9, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 2', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								},
								{
									label: 'เงินรายได้มหาวิทยาลัย',
									data: [<?php echo $da_base01; ?>],
									backgroundColor: 'rgba(222,101,96,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 5,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.5, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 3', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								},
								{
									label: 'เป้าเงินรายได้มหาวิทยาลัย',
									data: [<?php echo $da_11; ?>],
									backgroundColor: 'rgba(202,61,63,0.8)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
									barPercentage: 0.9, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
									stack: 'Stack 3', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
									anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
								}
							],
						};
						const plugin = {
							id: 'customCanvasBackgroundColor',
						    beforeDraw: (chart, args, options) => {
						        const {
						            ctx
						        } = chart;
						        ctx.save();

						        // กำหนดขนาดของรัศมี
						        const radius = 20;

						        // กำหนดพิกัดของจุดเริ่มต้น และขนาดของรูปร่าง
						        const x = 0;
						        const y = 0;
						        const width = chart.width;
						        const height = chart.height;

						        // เริ่มเส้นรูปร่าง
						        ctx.beginPath();
						        ctx.moveTo(x + radius, y);
						        ctx.lineTo(x + width - radius, y);
						        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
						        ctx.lineTo(x + width, y + height - radius);
						        ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
						        ctx.lineTo(x + radius, y + height);
						        ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
						        ctx.lineTo(x, y + radius);
						        ctx.quadraticCurveTo(x, y, x + radius, y);
						        ctx.closePath();
						        
						        // กำหนดสีรูปร่างและลักษณะการวาด
						        ctx.globalCompositeOperation = 'destination-over';
						        ctx.fillStyle = options.color || '#99ffff';
						        ctx.fill();

						        ctx.restore();
						    }
						};
						const config_mo = {
							type: 'bar',
							data: data_mo,
							options: {
								layout: {
									autoPadding: true,
								},
								aspectRatio: 0.9,
								maintainAspectRatio: false,
								responsive: true,
								plugins: {
									customCanvasBackgroundColor: {
										color: '#f2f2f2',
									},
									legend: {
										position: 'top',
										labels: {
											pointStyle: 'circle',
											usePointStyle: true,
											padding: 20,
											color: 'rgba(1,1,1,1)',
										},
									},
									tooltip: {
										mode: 'index',
										intersect: false,
										displayColors: true,
									},
								},
								scales: {
									x: {
									// 	title: {
									// 		display: true,
									// 		text: 'Year',
									// 		color: '#911',
									// 		font: {
									// 			family: 'Comic Sans MS',
									// 			size: 20,
									// 			weight: 'bold',
									// 			lineHeight: 1.2,
									// 		},
									// 		padding: {
									// 			top: 20,
									// 			left: 0,
									// 			right: 0,
									// 			bottom: 0
									// 		}
									// 	},
										stacked: true,
									},
									y: {
										// display: true,
										// title: {
										// 	display: true,
										// 	text: 'Money',
										// 	color: '#191',
										// 	font: {
										// 		family: 'Times',
										// 		size: 20,
										// 		style: 'normal',
										// 		lineHeight: 1.2
										// 	},
										// 	padding: {
										// 		top: 30,
										// 		left: 0,
										// 		right: 0,
										// 		bottom: 0
										// 	}
										// },
										stacked: false,
										beginAtZero: true,
									},
								},
							},
							plugins: [plugin],
						};

						const stackedBar = new Chart(document.getElementById('stackedBar'), config_mo, plugin);
					</script>
					<table class="table mt-2" id="dtBasicExample">
					    <thead class="Table_header_nu">
					        <tr class="text-center">
					            <th>ปี พ.ศ.</th>
					            <th>เงินรายได้ส่วนงาน</th>
					            <th>ได้รับทุนภายนอก</th>
					            <th>เงินรายได้มหาวิทยาลัย</th>
					        </tr>
					    </thead>
					    <tbody class="Table_body_nu">
					        <?php
					        // สร้างข้อมูลตารางจากปีปัจจุบันและย้อนหลัง 5 ปี
					        
					        for ($i = 4, $l = 0; $i >= 0; $i--, $l++) {
							    $yearIndex = date('Y') - $i;
							    $get_data_index = $l;
							    $buddhistYear = $yearIndex + 543;
							    echo "<tr class=\"text-center\">";
							    echo "<th>$buddhistYear</th>";
							    echo "<td>" . number_format($get_data_wor[$get_data_index]) . "</td>";
							    echo "<td>" . number_format($get_data_uniout[$get_data_index]) . "</td>";
							    echo "<td>" . number_format($get_data_unive[$get_data_index]) . "</td>";
							    echo "<td class=\"text-center\" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>";
							    echo "<a class=\"btn-primary btn-sm\" href=\"Page.php?feed=Res_bud&&Year=" . ($yearIndex) . "\">";
							    echo "<i class=\"bi bi-eye-fill\"></i>";
							    echo "</a>";
							    echo "</td>";
							    echo "</tr>";
					        }
					        ?>
					    </tbody>
					</table>

					<!-- <table class="table mt-2 " id="dtBasicExample">
						<thead class="Table_header_nu">
							<tr class="text-center">
								<th>ปี พ.ศ.</th>
								<th>เงินรายได้ส่วนงาน</th>
								<th>ได้รับทุนภายนอก</th>
								<th>เงินรายได้มหาวิทยาลัย</th>
							</tr>
						</thead>
						<tbody class="Table_body_nu">
							<tr class="text-center">
								<th>2562</th>
								<td><?php echo number_format($get_data_wor[0]);?></td>
								<td><?php echo number_format($get_data_uniout[0]);?></td>
								<td><?php echo number_format($get_data_unive[0]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_bud&&Year=2019">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2563</th>
								<td><?php echo number_format($get_data_wor[1]);?></td>
								<td><?php echo number_format($get_data_uniout[1]);?></td>
								<td><?php echo number_format($get_data_unive[1]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_bud&&Year=2020">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2564</th>
								<td><?php echo number_format($get_data_wor[2]);?></td>
								<td><?php echo number_format($get_data_uniout[2]);?></td>
								<td><?php echo number_format($get_data_unive[2]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_bud&&Year=2021">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2565</th>
								<td><?php echo number_format($get_data_wor[3]);?></td>
								<td><?php echo number_format($get_data_uniout[3]);?></td>
								<td><?php echo number_format($get_data_unive[3]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_bud&&Year=2022">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2566</th>
								<td><?php echo number_format($get_data_wor[4]);?></td>
								<td><?php echo number_format($get_data_uniout[4]);?></td>
								<td><?php echo number_format($get_data_unive[4]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_bud&&Year=2023">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
						</tbody>
					</table> -->
				</div>
			</div>
		</div>

		<div class="col-md-6 mt-3">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					เป้าหมายวิจัย
				</div>
				
				<div class="card-body">
				<?php
					$year_re1 = array();
					$da_111 = array();
					$da_211 = array();
					$da_311 = array();
					$da_411 = array();

					$Jn_01 = array();
					$Jn_02 = array();
					$Jn_03 = array();
					$Jn_04 = array();

					$befdate11 = date('Y') - 4;
					for ($toyear11 = $befdate11; $toyear11 <= date('Y'); $toyear11++) {
						$da_0111 = 0;
						$da_0211 = 0;
						$da_0311 = 0;
						$da_0411 = 0;

						$Jn_1 = 0;
						$Jn_2 = 0;
						$Jn_3 = 0;
						$Jn_4 = 0;

								$dbJn=new Database('nurse');
								$dbJn->Table = "RS_Journal";	
								$dbJn->Where = "Where JNL_Year='$toyear11' AND JNL_Status= '1' order by JNL_ID";
								$userJn= $dbJn->Select();
								foreach($userJn as $valuesJn=>$dataJn){

									$db2566_1=new Database('nurse');
									$db2566_1->Table = "RS_JNLInDatabase";
									$db2566_1->Where = "Where JNL_ID='$dataJn[JNL_id]' order by DB_ID";	
									$user2566_1= $db2566_1->Select();
									foreach($user2566_1 as $values2566_1=>$data2566_1){
										$db2566_2=new Database('nurse');
										$db2566_2->Table = "RS_Database";
										$db2566_2->Where = "Where DB_ID='$data2566_1[DB_ID]' order by DB_ID";	
										$user2566_2= $db2566_2->Select();
										foreach($user2566_2 as $values2566_2=>$data2566_2){
											if($data2566_2['DB_ID'] == '03'){
												$Jn_1++;
											}
											if($data2566_2['DB_ID'] == '04'){
												$Jn_2++;
											}
											if($data2566_2['DB_ID'] == '05'){
												$Jn_3++;
											}
											if($data2566_2['DB_ID'] == '06'){
												$Jn_4++;
											}
										}
									}
								}

								$get_Q1[] = $Jn_1;
								$get_Q2[] = $Jn_2;
								$get_Q3[] = $Jn_3;
								$get_Q4[] = $Jn_4;

								$Jn_01[] = $Jn_1;
								$Jn_02[] = $Jn_2;
								$Jn_03[] = $Jn_3;
								$Jn_04[] = $Jn_4;

						$db111 = new Database('nurse');
						$db111->Table = "RS_Target";
						$db111->Where = "Where target_year='$toyear11' order by target_id  ";
						$user111 = $db111->Select();
						foreach ($user111 as $values111 => $data111) {

							if ($data111['DB_ID'] == 'Q1Q2') {
								$da_0111 += $data111['target_value'];
							}
							if ($data111['DB_ID'] == 'Q3Q4') {
								$da_0211 += $data111['target_value'];
							}

							// if ($data111['DB_ID'] == '03') {
							// 	$da_0111 += $data111['target_value'];
							// }
							// if ($data111['DB_ID'] == '04') {
							// 	$da_0211 += $data111['target_value'];
							// }
							// if ($data111['DB_ID'] == '05') {
							// 	$da_0311 += $data111['target_value'];
							// }
							// if ($data111['DB_ID'] == '06') {
							// 	$da_0411 += $data111['target_value'];
							// }
						}


						$year_re1[] = $toyear11 + 543;
						$da_111[] = $da_0111;
						$da_211[] = $da_0211;
						$da_311[] = $da_0311;
						$da_411[] = $da_0411;
					}
					$year_re1 = implode(",", $year_re1);
					$Jn_01 = implode(",", $Jn_01);
					$Jn_02 = implode(",", $Jn_02);
					$Jn_03 = implode(",", $Jn_03);
					$Jn_04 = implode(",", $Jn_04);

					$da_111 = implode(",", $da_111);
					$da_211 = implode(",", $da_211);
					$da_311 = implode(",", $da_311);
					$da_411 = implode(",", $da_411);

				?>

					<div class="chart-container" align="center">
						<canvas id="Goal" ></canvas>
					</div>
					<script>
						const dataJNL = {
							labels: [<?php echo $year_re1; ?>],
							datasets: [
								{
									label: 'เป้าหมาย Q1,Q2',
									data: [<?php echo $da_111; ?>],
									backgroundColor: '#09225e',
									borderColor: '#09225e',
									borderWidth: 3,
									categoryPercentage: 1,
									barPercentage: 0.9, 
									stack: 'Stack_Q1',
									anchor: 'center', 
									tension: 0.4,
									type: 'line',
									spanGaps: true,
									fill: false
								},
								{
									label: 'เป้าหมาย Q3,Q4',
									data: [<?php echo $da_211; ?>],
									backgroundColor: '#730a0a',
									borderColor: '#730a0a',
									borderWidth: 3,
									categoryPercentage: 1, 
									barPercentage: 0.9, 
									stack: 'Stack_Q2', 
									anchor: 'center',
									tension: 0.4,
									type: 'line', // กำหนดให้เป็นกราฟเส้น
									spanGaps: true,
									fill: false
								},
								{
									label: 'Q1',
									data: [<?php echo $Jn_01 ?>],
									backgroundColor: 'rgba(50,104,122,1)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									categoryPercentage: 1,
									barPercentage: 0.9,
									stack: 'Stack 1',
									anchor: 'center', 
									z: 1,
									type: 'bar' // กำหนดเป็นกราฟแท่ง
								},
								{
									label: 'Q2',
									data: [<?php echo $Jn_02; ?>],
									backgroundColor: 'rgba(226,175,71,1)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, 
									barPercentage: 0.9, 
									stack: 'Stack 1',
									anchor: 'center',
									z: 1,
									type: 'bar' // กำหนดเป็นกราฟแท่ง
								},
								{
									label: 'Q3',
									data: [<?php echo $Jn_03; ?>],
									backgroundColor: 'rgba(71,51,53,1)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									categoryPercentage: 1, 
									barPercentage: 0.9, 
									stack: 'Stack 2', 
									anchor: 'center',
									z: 1,
									type: 'bar' // กำหนดเป็นกราฟแท่ง
								},
								{
									label: 'Q4',
									data: [<?php echo $Jn_04; ?>],
									backgroundColor: 'rgba(176,65,62,1)',
									borderColor: 'rgba(1,1,1,1)',
									borderWidth: 1,
									borderRadius: 10,
									categoryPercentage: 1, 
									barPercentage: 0.9, 
									stack: 'Stack 2', 
									anchor: 'center',
									z: 1,
									type: 'bar' // กำหนดเป็นกราฟแท่ง
								},
								// }
							],
							// datasets: [

							// 	{
							// 		label: 'Q1',
							// 		data: [<?php echo $Jn_01; ?>],
							// 		backgroundColor: 'rgba(50,104,122,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1,
							// 		barPercentage: 0.5,
							// 		stack: 'Stack 1',
							// 		anchor: 'center', 
							// 	},
							// 	{
							// 		label: 'เป้าหมาย  Q1',
							// 		data: [<?php echo $da_111; ?>],
							// 		backgroundColor: 'rgba(107,180,177,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1,
							// 		barPercentage: 0.9, 
							// 		stack: 'Stack 1',
							// 		anchor: 'center', 
							// 	},
							// 	{
							// 		label: 'Q2',
							// 		data: [<?php echo $Jn_02; ?>],
							// 		backgroundColor: 'rgba(226,175,71,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1, 
							// 		barPercentage: 0.5, 
							// 		stack: 'Stack 2',
							// 		anchor: 'center', 
							// 	},
							// 	{
							// 		label: 'เป้าหมาย  Q2',
							// 		data: [<?php echo $da_211; ?>],
							// 		backgroundColor: 'rgba(233,214,175,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1, 
							// 		barPercentage: 0.9, 
							// 		stack: 'Stack 2', 
							// 		anchor: 'center',
							// 	},
							// 	{
							// 		label: 'Q3',
							// 		data: [<?php echo $Jn_03; ?>],
							// 		backgroundColor: 'rgba(200,70,57,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1, 
							// 		barPercentage: 0.5, 
							// 		stack: 'Stack 3', 
							// 		anchor: 'center',
							// 	},
							// 	{
							// 		label: 'เป้าหมาย  Q3',
							// 		data: [<?php echo $da_311; ?>],
							// 		backgroundColor: 'rgba(206,118,59,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1,
							// 		barPercentage: 0.9, 
							// 		stack: 'Stack 3',
							// 		anchor: 'center',
							// 	},
							// 	{
							// 		label: 'Q4',
							// 		data: [<?php echo $Jn_04; ?>],
							// 		backgroundColor: 'rgba(176,65,62,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1, 
							// 		barPercentage: 0.5, 
							// 		stack: 'Stack 4', 
							// 		anchor: 'center', 
							// 	},
							// 	{
							// 		label: 'เป้าหมาย  Q4',
							// 		data: [<?php echo $da_411; ?>],
							// 		backgroundColor: 'rgba(71,51,53,0.8)',
							// 		borderColor: 'rgba(1,1,1,1)',
							// 		borderWidth: 1,
							// 		categoryPercentage: 1, 
							// 		barPercentage: 0.9,
							// 		stack: 'Stack 4',
							// 		anchor: 'center',
							// 	}
							// ],
						};
						const pluginJNL = {
							id: 'customCanvasBackgroundColor',
						    beforeDraw: (chart, args, options) => {
						        const {
						            ctx
						        } = chart;
						        ctx.save();

						        // กำหนดขนาดของรัศมี
						        const radius = 20;

						        // กำหนดพิกัดของจุดเริ่มต้น และขนาดของรูปร่าง
						        const x = 0;
						        const y = 0;
						        const width = chart.width;
						        const height = chart.height;

						        // เริ่มเส้นรูปร่าง
						        ctx.beginPath();
						        ctx.moveTo(x + radius, y);
						        ctx.lineTo(x + width - radius, y);
						        ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
						        ctx.lineTo(x + width, y + height - radius);
						        ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
						        ctx.lineTo(x + radius, y + height);
						        ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
						        ctx.lineTo(x, y + radius);
						        ctx.quadraticCurveTo(x, y, x + radius, y);
						        ctx.closePath();
						        
						        // กำหนดสีรูปร่างและลักษณะการวาด
						        ctx.globalCompositeOperation = 'destination-over';
						        ctx.fillStyle = options.color || '#99ffff';
						        ctx.fill();

						        ctx.restore();
						    }
						};
						const configJNL = {
							type: 'bar',
							data: dataJNL,
							options: {
								layout: {
									autoPadding: true,
								},
								aspectRatio: 0.9,
								maintainAspectRatio: false,
								responsive: true,
								plugins: {
									customCanvasBackgroundColor: {
										color: '#f2f2f2',
									},
									legend: {
										position: 'top',
										labels: {
											pointStyle: 'circle',
											usePointStyle: true,
											padding: 20,
											color: 'rgba(1,1,1,1)',
										},
									},
									tooltip: {
										mode: 'index',
										intersect: false,
										displayColors: true,
									},
								},
								scales: {
									x: {
										stacked: true,
									},
									y: {
										max : 50,
										stacked: true,
										beginAtZero: true,
									},
								},
							},
							plugins: [pluginJNL],
						};
						const Goal = new Chart(document.getElementById('Goal'), configJNL, pluginJNL);
					</script>
					<table class="table mt-2 " id="dtBasicExample">
						<thead class="Table_header_nu">
							<tr class="text-center">
								<th>ปี พ.ศ.</th>
								<th>Q1</th>
								<th>Q2</th>
								<th>Q3</th>
								<th>Q4</th>
							</tr>
						</thead>
						<tbody class="Table_body_nu">
							<?php
					        // สร้างข้อมูลตารางจากปีปัจจุบันและย้อนหลัง 5 ปี
					        
					        for ($m = 4, $n = 0; $m >= 0; $m--, $n++) {
							    $yearIndex1 = date('Y') - $m;
							    $get_data_index1 = $n;
							    $buddhistYear1 = $yearIndex1 + 543;
							    echo "<tr class=\"text-center\">";
							    echo "<th>$buddhistYear1</th>";
							    echo "<td>" . number_format($get_Q1[$get_data_index1]) . "</td>";
							    echo "<td>" . number_format($get_Q2[$get_data_index1]) . "</td>";
							    echo "<td>" . number_format($get_Q3[$get_data_index1]) . "</td>";
							    echo "<td>" . number_format($get_Q4[$get_data_index1]) . "</td>";
							    echo "<td class=\"text-center\" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>";
							    echo "<a class=\"btn-primary btn-sm\" href=\"Page.php?feed=Res_Q&&Year=" . ($yearIndex1) . "\">";
							    echo "<i class=\"bi bi-eye-fill\"></i>";
							    echo "</a>";
							    echo "</td>";
							    echo "</tr>";
					        }
					        ?>
							<!-- <tr class="text-center">
								<th>2562</th>
								<td><?php echo number_format($get_Q1[0]);?></td>
								<td><?php echo number_format($get_Q2[0]);?></td>
								<td><?php echo number_format($get_Q3[0]);?></td>
								<td><?php echo number_format($get_Q4[0]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_Q&&Year=2019">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2563</th>
								<td><?php echo number_format($get_Q1[1]);?></td>
								<td><?php echo number_format($get_Q2[1]);?></td>
								<td><?php echo number_format($get_Q3[1]);?></td>
								<td><?php echo number_format($get_Q4[1]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_Q&&Year=2020">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2564</th>
								<td><?php echo number_format($get_Q1[2]);?></td>
								<td><?php echo number_format($get_Q2[2]);?></td>
								<td><?php echo number_format($get_Q3[2]);?></td>
								<td><?php echo number_format($get_Q4[2]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_Q&&Year=2021">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2565</th>
								<td><?php echo number_format($get_Q1[3]);?></td>
								<td><?php echo number_format($get_Q2[3]);?></td>
								<td><?php echo number_format($get_Q3[3]);?></td>
								<td><?php echo number_format($get_Q4[3]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_Q&&Year=2022">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr>
							<tr class="text-center">
								<th>2566</th>
								<td><?php echo number_format($get_Q1[4]);?></td>
								<td><?php echo number_format($get_Q2[4]);?></td>
								<td><?php echo number_format($get_Q3[4]);?></td>
								<td><?php echo number_format($get_Q4[4]);?></td>
								<td class="text-center" data-bs-toggle='tooltip' data-bs-placement='top' title='ดูรายละเอียด'>
									<a class="btn-primary btn-sm" href="Page.php?feed=Res_Q&&Year=2023">
									<i class="bi bi-eye-fill"></i>
								</a>
								</td>
							</tr> -->
						</tbody>
					</table>
				</div>
			</div>
		</div>