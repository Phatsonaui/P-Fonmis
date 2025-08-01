<script type="text/javascript">
	function createChart(chartData) {
		chartData.forEach(data => {
			const {
				id,
				labels,
				datas,
				con_data,
				con_fig,
				plugin
			} = data;
			const pl_in = {
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
			const ctx = document.getElementById(id).getContext('2d');
			const myChart = new Chart(ctx, {
				type: 'bar',
				data: {
					labels: JSON.parse(labels),
					datasets: [{
						label: con_data,
						data: JSON.parse(datas),
						backgroundColor: [
							'rgba(240,113,103,1)'
						],
						borderColor: [
							'rgba(1,1,1,1)'
						],
						borderWidth: 2,
						borderRadius: 10
					}]
				},
				options: {

					layout: {
						autoPadding: true,
					},
					aspectRatio: 0.9,
					maintainAspectRatio: false,
					responsive: true,
					plugins: {
						legend: {
							position: 'top',
							labels: {
								pointStyle: 'circle',
								usePointStyle: true,
								padding: 20,
								color: 'rgba(1,1,1,1)',
							},
						},
						scales: {
							y: {
								beginAtZero: true,
							},
						},
						customCanvasBackgroundColor: {
							color: '#f2f2f2',
						},
					}
				},
				plugins: [pl_in],
			});
		});
	}
</script>
<div class="container-fluid pb-4">
	<div class="row g-3 p-3 mt-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>วิจัย</h3>
				</div>
			</div>
		</div>
		<div class="col-md-8 text-end">
			<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d")); ?></p>
		</div>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12 text-center">
							<h1 style="font-weight: 900;">Research Publications</h1>
						</div>
						<div class="col-md-6">
							<div class="row g-3" style="background-color: #f8f9fa;margin: 10px;padding: 10px 40px 20px 60px;;border-radius: 50px;">
								<div class="col-md-6"></div>
								<div class="col-md-2 text-end">
									<label for="year-section" class="col-form-label">ปี พ.ศ.</label>
								</div>
								<div class="col-md-4 text-end" style="font-weight: 900;">
									<select class="form-select select-sm" name="year-section" id="year-section">
										<!-- สร้างตัวเลือกปีปัจจุบันและย้อนหลัง 5 ปี -->
										<?php
										$currentYear = date('Y');
										for ($i = 0; $i < 5; $i++) {
											$year = $currentYear - $i;
											$buddhistYear = $year + 543;
											$selected = ($i === 0) ? 'selected' : '';
											echo "<option value=\"$year\" $selected>$buddhistYear</option>";
										}
										?>
									</select>
								</div>
								<div class="col-md-12">
									<span style="color: #848688;font-weight: 900;">จำนวนตีพิมทั้งหมด</span>
								</div>
								<div class="col-md-12 text-center" id="result">
									<div class="row">
										<div class="col-md-6 text-end">
											<a id="number_j_link" href="#" style="color: #fa600b; font-weight: 900;">
												<h1 style="font-weight: 700;" id="number_j"></h1>
											</a>
										</div>
										<div class="col-md-6 text-start">
											<a id="totalJournals" href="#" style="color: #fa600b; font-weight: 900;">
												<h1 style="font-weight: 700;">เรื่อง</h1>
											</a>
										</div>
									</div>
								</div>
								<div class="col-md-12"></div>
								<div class="col-md-6 text-center" id="national_section">
									<p style="color: #848688;font-weight: 900;">จำนวนที่ตีพิมพ์ในระดับชาติ</p>
									<div class="row">
										<div class="col-md-6 text-end">
											<a id="number_n_link" href="#" style="color: #00b24f; font-weight: 900;">
												<h2 style="font-weight: 700;" id="number_n"></h2>
											</a>
										</div>
										<div class="col-md-6 text-start">
											<a id="totaln" href="#" style="color: #00b24f; font-weight: 900;">
												<h2 style="font-weight: 700;">เรื่อง</h2>
											</a>
										</div>
									</div>
								</div>
								<div class="col-md-6 text-center" id="inter_section">
									<p style="color: #848688;font-weight: 900;">จำนวนที่ตีพิมพ์ในระดับนานาชาติ</p>
									<div class="row">
										<div class="col-md-6 text-end">
											<a id="number_i_link" href="#" style="color: #00b24f; font-weight: 900;">
												<h2 style="font-weight: 700;" id="number_i"></h2>
											</a>
										</div>
										<div class="col-md-6 text-start">
											<a id="totali" href="#" style="color: #00b24f; font-weight: 900;">
												<h2 style="font-weight: 700;">เรื่อง</h2>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="row g-3" style="background-color: #f8f9fa;margin: 10px;padding: 10px 40px 20px 60px;;border-radius: 50px;">

								<div class="col-md-10 ">
									<h3 class="text-end" style="color: #848688;font-weight: 900;">งานวิจัยที่ตีพิมพ์ย้อนหลัง 5 ปี</h3>

								</div>
								<div class="col-md-2 text-end">
									<h4><a href='Page.php?feed=Res_Jour'><i class="bi bi-search" style="color: #848688;"></i></a></h4>
								</div>
								<div class="col-md-12"></div>
								<div class="col-md-12"></div>
								<div class="col-md-12 text-center">
									<?php
									$drow5 = $drow51 = $drow52 = 0;
									$db31 = new Database('nurse');
									$db31->Table = "RS_Journal";
									$db31->Where = "Where JNL_Year >= '" . (date('Y') - 4) . "' AND JNL_Year <= '" . date('Y') . "' AND JNL_Status=1 AND (JNL_Level ='1' OR JNL_Level = '2')  order by JNL_Year desc";
									$user31 = $db31->Select();
									foreach ($user31 as $values31 => $data31) {
										$drow5++;
										if ($data31['JNL_Level'] == 2) {
											$drow51++;
										}
										if ($data31['JNL_Level'] == 1) {
											$drow52++;
										}
										$total_Jounal31 = $drow5;
									} ?>
									<div class="row">
										<div class="col-md-6 text-end">
											<input type="hidden" id="J31" value="<?php echo $total_Jounal31; ?>">
											<h1 id="numJ31" style="color: #7474ca;font-weight: 900;"></h1>
										</div>
										<div class="col-md-6 text-start">
											<h1 style="color: #848688;font-weight: 900;">เรื่อง</h1>
										</div>
									</div>
								</div>
								<div class="col-md-12"></div>

								<div class="col-md-6 text-center">
									<h2 style="color: #ed5d90;font-weight: 900;">ระดับชาติ</h2>
									<div class="row">
										<div class="col-md-6 text-end">
											<input type="hidden" id="J52" value="<?php echo $drow52; ?>">
											<h2 id="numJ52" style="color: #ed5d90;font-weight: 900;"></h2>
										</div>
										<div class="col-md-6 text-start">
											<h2 style="color: #848688;font-weight: 900;">เรื่อง</h2>
										</div>
									</div>
								</div>

								<div class="col-md-6 text-center">
									<h2 style="color: #01aef0;font-weight: 900;">ระดับนานาชาติ</h2>
									<div class="row">
										<div class="col-md-6 text-end">
											<input type="hidden" id="J51" value="<?php echo $drow51; ?>">
											<h2 id="numJ51" style="color: #01aef0;font-weight: 900;"></h2>
										</div>
										<div class="col-md-6 text-start">
											<h2 style="color: #848688;font-weight: 900;">เรื่อง</h2>
										</div>
									</div>

								</div>
							</div>
						</div>
						<?php include "Re_target.php"; ?>

						<?php $datesave = array();
						$J_total = array();
						$J_total_en = array();
						$T_total = array();
						$ptotal = array();
						$J_all = array();
						$befdate = date('Y') - 4;
						for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
							$row = 0;
							$J_to = 0;
							$r = 0;
							$db4 = new Database('nurse');
							$db4->Table = "RS_Journal";
							$db4->Where = "Where JNL_Year='$toyear' AND JNL_Status=1 And JNL_Level = 1 order by JNL_Year desc";
							$user4 = $db4->Select();
							foreach ($user4 as $values4 => $data4) {
								$row++;

								$J_to = +$row;
							}
							$db3 = new Database('nurse');
							$db3->Table = "RS_Journal";
							$db3->Where = "Where JNL_Year='$toyear' AND JNL_Status=1 And JNL_Level = 2 order by JNL_Year desc";
							$user3 = $db3->Select();
							foreach ($user3 as $values3 => $data3) {
								$r++;
							}
							$datesave[] = $toyear + 543;
							$ptotal[] = $row;
							$J_all[] = $row + $r;
							$T_total[] = $r;
						}
						$J_total[] = $ptotal[0] + $ptotal[1] + $ptotal[2] + $ptotal[3] + $ptotal[4];
						$J_total_en = $T_total[0] + $T_total[1] + $T_total[2] + $T_total[3] + $T_total[4];
						$datesave = implode(",", $datesave);
						$ptotal = implode(",", $ptotal);
						$J_all = implode(",", $J_all);
						$J_total = implode(",", $J_total);
						$T_total = implode(",", $T_total);
						$Tot = $J_total + $J_total_en;
						?>
						<div class="col-md-6">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
								<div class="card-header text-center">
									Journal
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="myChart"></canvas>
										<script>
											const data_jou = {
												labels: [<?php echo $datesave; ?>],
												datasets: [{
														type: 'line',
														label: 'จำนวน Journal ระดับชาติ ',
														data: [<?php echo $ptotal; ?>],
														borderColor: 'rgba(224,122,95,1)',
														pointBorderColor: 'rgba(1, 1, 1, 1)',
														pointBorderWidth: 1,
														borderWidth: 3,
														pointBackgroundColor: 'rgba(224,122,95,1)',
														pointRadius: 5,
														pointHoverRadius: 7
													},
													{
														type: 'line',
														label: 'จำนวน Journal ระดับนานาชาติ',
														data: [<?php echo $T_total; ?>],
														borderColor: 'rgba(61,64,91,1)',
														pointBorderColor: '#ffff',
														pointBorderWidth: 1,
														borderWidth: 3,
														pointBackgroundColor: 'rgba(61,64,91,1)',
														pointRadius: 5,
														pointHoverRadius: 7
													},
													{
														label: 'ผลรวม Journal',
														data: [<?php echo $J_all; ?>],
														backgroundColor: 'rgba(244,241,222,1)',
														borderColor: 'rgba(1, 1, 1, 1)',
														borderWidth: 1,
														borderRadius: 10,
														pointStyle: 'rect'
													}
												],
											};

											const plugin_jou = {
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

											const config_jou = {
												type: 'bar',
												data: data_jou,
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
															stacked: false,
															beginAtZero: true,
														},
													},
												},
												plugins: [plugin_jou],
											};
											const myChart = new Chart(document.getElementById('myChart'), config_jou, plugin_jou);
										</script>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 text-center">
							<a href="Page.php?feed=Res_data">
								<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
									<div class="card-header text-center">
										ฐานข้อมูลที่ปรากฏ
									</div>
									<div class="card-body">
										<?php $datesave = array();
										$da_base01 = array();
										$da_base02 = array();
										$da_base03 = array();
										$da_base04 = array();
										$da_base05 = array();
										$da_base06 = array();
										$da_base07 = array();
										$da_base08 = array();
										$da_base09 = array();
										$da_base10 = array();
										$da_base11 = array();
										$da_base12 = array();
										$da_base13 = array();
										$da_other = array();

										$befdate = date('Y') - 4;
										for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
											$da_1 = 0;
											$da_2 = 0;
											$da_3 = 0;
											$da_4 = 0;
											$da_5 = 0;
											$da_6 = 0;
											$da_7 = 0;
											$da_8 = 0;
											$da_9 = 0;
											$da_10 = 0;
											$da_11 = 0;
											$da_12 = 0;
											$da_o = 0;
											// $da_13 = 0;

											$db1 = new Database('nurse');
											$db1->Table = "RS_Journal";
											$db1->Where = "Where JNL_Year='$toyear' AND JNL_Status= '1' order by JNL_ID";
											$user1 = $db1->Select();
											foreach ($user1 as $values1 => $data1) {
												$has_main_db = false;
												$db2566_1 = new Database('nurse');
												$db2566_1->Table = "RS_JNLInDatabase";
												$db2566_1->Where = "Where JNL_ID='$data1[JNL_id]' order by DB_ID";
												$user2566_1 = $db2566_1->Select();
												foreach ($user2566_1 as $values2566_1 => $data2566_1) {
													$db2566_2 = new Database('nurse');
													$db2566_2->Table = "RS_Database";
													$db2566_2->Where = "Where DB_ID='$data2566_1[DB_ID]' order by DB_ID";
													$user2566_2 = $db2566_2->Select();
													foreach ($user2566_2 as $values2566_2 => $data2566_2) {
														// echo $data2566_1['JNL_ID']." - ".$data2566_2['DB_ID']." / ";
														//echo $data1['JNL_id']." / ";
														if (in_array($data2566_2['DB_ID'], ['03', '04', '05', '06', '08', '09', '10'])) {
															$has_main_db = true;
															if ($data2566_2['DB_ID'] == '03') $da_3++;
															else if ($data2566_2['DB_ID'] == '04') $da_4++;
															else if ($data2566_2['DB_ID'] == '05') $da_5++;
															else if ($data2566_2['DB_ID'] == '06') $da_6++;
															else if (in_array($data2566_2['DB_ID'], ['08', '09', '10'])) $da_8++;
														}
													}
												}
												if (!$has_main_db) {
													$da_o++;
												}
											}
											$datesave[] = $toyear + 543;
											$da_base03[] = $da_3;
											$da_base04[] = $da_4;
											$da_base05[] = $da_5;
											$da_base06[] = $da_6;
											$da_base07[] = $da_8;
											$da_other[] = $da_o;
										}
										$datesave = implode(",", $datesave);
										$da_base03 = implode(",", $da_base03);
										$da_base04 = implode(",", $da_base04);
										$da_base05 = implode(",", $da_base05);
										$da_base06 = implode(",", $da_base06);
										$da_base07 = implode(",", $da_base07);
										$da_other = implode(",", $da_other);
										?>
										<div class="chart-container">
											<canvas id="myChart1"></canvas>
											<script>
												const data_Q = {
													labels: [<?php echo $datesave; ?>],
													datasets: [{
															label: 'Q1',
															data: [<?php echo $da_base03; ?>],
															backgroundColor: ['rgba(246,189,96,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														},
														{
															label: 'Q2',
															data: [<?php echo $da_base04; ?>],
															backgroundColor: ['rgba(247,237,226,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														}, {
															label: 'Q3',
															data: [<?php echo $da_base05; ?>],
															backgroundColor: ['rgba(245,202,195,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														}, {
															label: 'Q4',
															data: [<?php echo $da_base06; ?>],
															backgroundColor: ['rgba(132,165,157,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														},
														{
															label: 'TCI',
															data: [<?php echo $da_base07; ?>],
															backgroundColor: ['rgba(242,132,130,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														},
														{
															label: 'Other',
															data: [<?php echo $da_other; ?>],
															backgroundColor: ['rgba(180,180,180,1)'],
															borderColor: 'rgba(1,1,1,1);',
															borderWidth: 1,
															borderRadius: 5,
														}
													],
												};

												const plugin_Q = {
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

												const config_Q = {
													type: 'bar',
													data: data_Q,
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
																callbacks: {
																	afterBody: function(context) {
																		// context[0].dataIndex คือ index ของปีที่ชี้อยู่
																		let idx = context[0].dataIndex;
																		let sum = 0;
																		context[0].chart.data.datasets.forEach(ds => {
																			sum += ds.data[idx] ? Number(ds.data[idx]) : 0;
																		});
																		return 'รวมทั้งหมด: ' + sum + ' เรื่อง';
																	}
																}
															},
														},
														scales: {
															y: {
																beginAtZero: true,
															},
														},
													},
													plugins: [plugin_Q],
												};

												const myChart1 = new Chart(document.getElementById('myChart1'), config_Q, plugin_Q);
											</script>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-md-6 text-center" style="display: none;">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
								<div class="card-header text-center">
									สัดส่วนต่ออาจารย์
								</div>
								<div class="card-body">
									<canvas id="doughnutChart1" class="mt-4"></canvas>
									<script>
										<?php
										$datetoday = date('Y-m-d');
										$use_st = 0;
										$num = 0;
										$do_per = 0;
										$no_per = 0;
										$j = 0;
										$db7 = new Database('nurse');
										$db7->Table = "user_data NATURAL JOIN user_typeTime";
										$db7->Where = "where user_data.ud_id = user_typeTime.ud_id And user_typeTime.user_type = '1' And user_typeTime.user_status ='1'";
										$user7 = $db7->Select();
										foreach ($user7 as $values7 => $data7) {
											$num++;

											$dbJ = new Database('nurse');
											$dbJ->Table = "RS_LsNameJNL ";
											$dbJ->Where = "left join RS_Journal ON RS_LsNameJNL.JNL_ID = RS_Journal.JNL_id where RS_LsNameJNL.LN_Name = '$data7[ud_id]' And RS_Journal.JNL_Year = '2023'  group by 'LN_Name'";
											$userJ = $dbJ->Select();
											foreach ($userJ as $valuesJ => $dataJ) {
												$j = 1;
											} ?>
											<?php if ($j == 0) {
												$no_per++;
											} else {
												$do_per++;
											}
											$j = 0; ?>

											<?php
											$dbu = new Database('nurse');
											$dbu->Table = "user_study ";
											$dbu->Where = "where ud_id = '$data7[ud_id]' AND stu_start<='$datetoday' AND (stu_stop>='$datetoday' OR stu_stop='0000-00-00')";
											$useru = $dbu->Select();
											foreach ($useru as $valuesu => $datau) {
												$use_st++;
											} ?>

										<?php }

										$num_per = $num;
										$total_no_per = $no_per -  $use_st;
										$total_do_per = $do_per;
										$num_total = $num_per - $total_do_per;
										$percent_no = $total_no_per * 100 / $num_per;
										$percent_do = $total_do_per * 100 / $num_per;
										?>
										//doughnut
										var ctxD = document.getElementById("doughnutChart1").getContext('2d');
										var myLineChart = new Chart(ctxD, {
											type: 'pie',
											data: {
												labels: ["ไม่มีผลงาน", "มีผลงาน"],
												datasets: [{
													data: [<?php echo $total_no_per; ?>, <?php echo $total_do_per; ?>],
													label: 'งบประมาณเงินรายได้',
													backgroundColor: ["#F7464A", "rgb(92, 184, 92)"],
													hoverBackgroundColor: ["#FF5A5E", "rgb(117, 209, 117)"],
													borderColor: ["#fff", "#fff"],
													hoverBorderColor: ["#000000", "#000000"],
												}]
											},
											options: {
												legend: {
													position: 'top',
													backgroundColor: '#222222',
													labels: {
														boxWidth: 20,
														padding: 20,
														usePointStyle: true,
														fontSize: 14,
														fontColor: '#000000'
													}
												},
												responsive: true
											}
										});

										var canvas = document.getElementById("doughnutChart1");
										var chart = myLineChart;
										canvas.onclick = function(evt) {
											var activePoints = chart.getElementsAtEvent(evt);
											if (activePoints[0]) {
												var label = chart.data.labels[activePoints[0]._index];
												showModal(label);
											}
										};

										function showModal(label) {
											// Your code to open the modal with the content related to the clicked label
											console.log("Label: ", label)
										}
									</script>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">

						<?php $datesave1 = array();
						$J_total = array();
						$J_total_en = array();
						$T_total = array();
						$ptotal1 = array();
						$befdate = date('Y') - 4;
						for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
							$row1 = 0;
							$J_to = 0;
							$r = 0;
							$db4 = new Database('nurse');
							$db4->Table = "RS_Project";
							$db4->Where = "Where PJ_Year='$toyear1' order by PJ_Year desc";
							$user4 = $db4->Select();
							foreach ($user4 as $values4 => $data4) {
								$row1++;

								$J_to = +$row;
							}
							$datesave1[] = $toyear1 + 543;
							$ptotal1[] = $row1;
							$T_total[] = $r;
						}
						$J_total[] = $ptotal1[0] + $ptotal1[1] + $ptotal1[2] + $ptotal1[3] + $ptotal1[4];
						$J_total_en = $T_total[0] + $T_total[1] + $T_total[2] + $T_total[3] + $T_total[4];
						$datesave1 = implode(",", $datesave1);
						$ptotal1 = implode(",", $ptotal1);
						$J_total = implode(",", $J_total);
						$T_total = implode(",", $T_total);
						?>
						<div class="col-md-6">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									โครงการวิจัย
								</div>

								<div class="card-body">
									<div class="col-md-12 p-3 text-center">
										<a href="Page.php?feed=Res_pro">
											<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"><?php echo number_format($J_total) ?> เรื่อง</h1>
										</a>
									</div>
									<canvas id="myChart4"></canvas>

									<script>
										const data_prj = {
											labels: [<?php echo $datesave1; ?>],
											datasets: [{
												label: 'จำนวน Project',
												data: [<?php echo $ptotal1; ?>],
												backgroundColor: [
													'rgba(240,113,103,1)'
												],
												borderColor: [
													'rgba(1,1,1,1)'
												],
												borderWidth: 2,
												borderRadius: 10,
											}],
										};

										const plugin_prj = {
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

										const config_prj = {
											type: 'bar',
											data: data_prj,
											options: {
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
													y: {
														beginAtZero: true,
													},
												},
											},
											plugins: [plugin_prj],
										};
										const myChart4 = new Chart(document.getElementById('myChart4'), config_prj, plugin_prj);
									</script>
								</div><!-- card body -->
							</div><!-- card -->
						</div><!-- col-md-6 -->
						<div class="col-md-6">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									Proceeding
								</div>

								<div class="card-body">
									<?php $datesave1 = array();
									$P_total = array();
									$J_total_en = array();
									$T_total = array();
									$ptotal1 = array();
									$befdate = date('Y') - 4;
									for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
										$row1 = 0;
										$J_to = 0;
										$r = 0;
										$db4 = new Database('nurse');
										$db4->Table = "RS_Proceeding";
										$db4->Where = "Where PCD_Year='$toyear1' AND PCD_status = '1' And PCD_Level = '1' order by PCD_Year desc";
										$user4 = $db4->Select();
										foreach ($user4 as $values4 => $data4) {
											$row1++;

											$J_to = +$row;
										}
										$db3 = new Database('nurse');
										$db3->Table = "RS_Proceeding";
										$db3->Where = "Where PCD_Year='$toyear1' AND PCD_Status=1 And PCD_Level = 2 order by PCD_Year desc";
										$user3 = $db3->Select();
										foreach ($user3 as $values3 => $data3) {
											$r++;
										}
										$datesave1[] = $toyear1 + 543;
										$ptotal1[] = $row1;
										$T_total[] = $r;
									}
									$P_total[] = $ptotal1[0] + $ptotal1[1] + $ptotal1[2] + $ptotal1[3] + $ptotal1[4];
									$J_total_en = $T_total[0] + $T_total[1] + $T_total[2] + $T_total[3] + $T_total[4];
									$datesave1 = implode(",", $datesave1);
									$ptotal1 = implode(",", $ptotal1);
									$P_total = implode(",", $P_total);
									$T_total = implode(",", $T_total);
									?>
									<div class="col-md-12 p-3 text-center">
										<a href="Page.php?feed=Res_proce">
											<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"><?php echo number_format($P_total + $J_total_en) ?> เรื่อง</h1>
										</a>
									</div>
									<canvas id="myChart5"></canvas>
									<script>
										const data_prc = {
											labels: [<?php echo $datesave1; ?>],
											datasets: [{
												label: 'จำนวน Proceeding',
												data: [<?php echo $ptotal1; ?>],
												backgroundColor: ['rgba(8,65,92,1)'],
												borderColor: ['rgba(1,1,1,1)'],
												borderWidth: 1,
												borderRadius: 10,
											}, {
												label: 'จำนวน Proceeding EN',
												data: [<?php echo $T_total; ?>],
												backgroundColor: ['rgba(204,41,54,1)'],
												borderColor: ['rgba(1,1,1,1)'],
												borderWidth: 1,
												borderRadius: 10,
											}],
										};

										const plugin_prc = {
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

										const config_prc = {
											type: 'bar',
											data: data_prc,
											options: {
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
													y: {
														beginAtZero: true,
													},
												},
											},
											plugins: [plugin_prc],
										};
										const myChart5 = new Chart(document.getElementById('myChart5'), config_prc, plugin_prc);
									</script>
								</div><!-- card body sub -->
							</div><!-- card sub -->
						</div><!-- col-md-6 -->
					</div><!-- row g-3 -->
				</div><!-- card body -->
			</div><!-- card -->
		</div><!-- col-md-12 -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">

						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ผลงานวิจัยที่มีความร่วมมือกับเครือข่ายนานาชาติ</h5>
								</div>

								<div class="card-body">
									<?php
									$total_Jounal3123 = array();
									for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
										$drow522 = 0;
										$db3125 = new Database('nurse');
										$db3125->Table = "RS_LsNameJNL";
										$db3125->Where = "Left Join RS_Journal ON RS_LsNameJNL.JNL_id = RS_Journal.JNL_id  Where JNL_Year = '$toyear1' AND RS_LsNameJNL.LN_typeOrg = '2' AND LN_Location <> '00000000000' order by JNL_Year desc";
										$user3125 = $db3125->Select();
										foreach ($user3125 as $values3125 => $data3125) {

											$db3122 = new Database('nurse');
											$db3122->Table = "RS_OutOrganize";
											$db3122->Where = "Where OOrganize_id = '$data3125[LN_Location]' AND OOrganize_level = '3' ";
											$user3122 = $db3122->Select();
											foreach ($user3122 as $values3122 => $data3122) {
												$drow522++;
											}
										}
										$total_Jounal3123[] = $drow522;
									}
									$total_Jounal3123 = implode(",", $total_Jounal3123);
									// echo "no : ".$total_Jounal3123."<br>";
									?>
									<p align="center">
										<canvas id="myChart_jou_in"></canvas>
										<script>
											const chartData = [{
													id: 'myChart_jou_in',
													labels: '[<?php echo $datesave1; ?>]',
													datas: '[<?php echo $total_Jounal3123; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(chartData);
										</script>
									</p>

								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ร้อยละงานวิจัยที่แล้วเสร็จตามกรอบเวลาของแหล่งทุน</h5>
								</div>
								<?php

								$dis = array();
								$Jsum_all = 0;
								$Jr_all = array();
								for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
									$Jr_a = 0;
									$dbJr_s = new Database('nurse');
									$dbJr_s->Table = "RS_Project";
									$dbJr_s->Where = "Where PJ_Year = '" . $toyear1 . "' AND PJ_StatusProject = '4'  order by PJ_Year desc";
									// AND (PJ_DateStop <= PJ_DateStopReal)
									$userJr_s = $dbJr_s->Select();
									$sumJr = count($userJr_s);
									foreach ($userJr_s as $valuesJr_s => $dataJr_s) {
										$Jr_a++;
									}
									$Jsum_all += $sumJr;
									$Jr_all[] = $Jr_a;
								}
								$Jr_all = implode(",", $Jr_all);
								// echo "no : ".$Jr_all."<br>";
								// echo "sum : ".$Jsum_all;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_jrs"></canvas>
										<script>
											const myChart_jrs = [{
													id: 'myChart_jrs',
													labels: '[<?php echo $datesave1; ?>]',
													datas: '[<?php echo $Jr_all; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_jrs);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>วิจัยที่ถูกยกเลิก/ระงับการดำเนินการจากแหล่งทุน</h5>
								</div>
								<?php

								$dis = array();
								for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
									$y_pyj = 0;
									$db312 = new Database('nurse');
									$db312->Table = "RS_Project";
									$db312->Where = "Where PJ_Year = '" . $toyear1 . "' AND PJ_StatusProject IN ('5','6') order by PJ_Year desc";
									$user312 = $db312->Select();
									foreach ($user312 as $values312 => $data312) {
										$y_pyj++;
									}
									$dis[] = $y_pyj;
								}
								$dis = implode(",", $dis);
								// echo "no : ".$dis;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart45"></canvas>
										<script>
											const myChart45 = [{
													id: 'myChart45',
													labels: '[<?php echo $datesave1; ?>]',
													datas: '[<?php echo $dis; ?>]',
													con_data: 'จำนวน Project',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart45);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ร้อยละของอาจารย์ที่มีสรรถนะด้านการวิจัย</h5>
								</div>

								<div class="card-body">
									<?php
									$H_per = array();
									$H_year = array();
									$ALL_H_person = array();
									$H_person = array();
									$dbPillar = new Database('nurse');
									$dbPillar->Table = "RS_HIndexYear";
									$dbPillar->Where = "order by hiy_year ";
									$userPillar = $dbPillar->Select();
									$row1 = count($userPillar);
									foreach ($userPillar as $valuesPillar => $dataPillar) {

										$personHIndex = 0;
										$dbhiy = new Database('nurse');
										$dbhiy->Table = "RS_HIndexPerson";
										$dbhiy->Where = "where hiy_id='{$dataPillar['hiy_id']}' ";
										$userhiy = $dbhiy->Select();
										foreach ($userhiy as $valueshiy => $datahiy) {
											$personHIndex++;
										}

										$h_pe = 0;
										$dbh = new Database('nurse');
										$dbh->Table = "RS_HIndexPerson";
										$dbh->Where = "Where hiy_id = '{$dataPillar['hiy_id']}' ";
										$userh = $dbh->Select();
										foreach ($userh as $valuesh => $datah) {
											if ($datah['HIndex_Value'] > 0) {
												$h_pe++;
											}
										}

										if ($personHIndex > 0) {
											$percentage = ($h_pe / $personHIndex) * 100;
										} else {
											$percentage = 0; // กรณีที่ไม่มี personHIndex
										}

										$H_per[] = $percentage;
										$ALL_H_person[] = $personHIndex;
										$H_person[] = $h_pe;
										$H_year[] = $dataPillar['hiy_year'] + 543;
									}

									$H_year = implode(",", $H_year);
									$H_person = implode(",", $H_person);
									$ALL_H_person = implode(",", $ALL_H_person);
									$H_per = implode(",", $H_per);

									?>
									<p align="center">
										<canvas id="myChartHindex"></canvas>
										<script>
											const data_mo1 = {
												labels: [<?php echo $H_year; ?>],
												datasets: [{
														label: 'จำนวนอาจารย์ทั้งหมด',
														data: [<?php echo $ALL_H_person; ?>],
														backgroundColor: 'rgba(240,113,103,1)',
														borderColor: 'rgba(1,1,1,1)',
														borderWidth: 1,
														borderRadius: 5,
														categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
														barPercentage: 0.8, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
														stack: 'Stack 1', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
														anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
													},
													{
														label: 'จำนวนอ.ที่มี H-index',
														data: [<?php echo $H_person; ?>],
														backgroundColor: 'rgba(240,113,103,0.8)',
														borderColor: 'rgba(1,1,1,1)',
														borderWidth: 1,
														borderRadius: 5,
														categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
														barPercentage: 0.8, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
														stack: 'Stack 2', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
														anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
													},
													{
														label: 'ร้อยละ',
														data: [<?php echo $H_per; ?>],
														backgroundColor: 'rgba(240,113,103,0.4)',
														borderColor: 'rgba(1,1,1,1)',
														borderWidth: 1,
														borderRadius: 5,
														categoryPercentage: 1, // กำหนดให้ Dataset มีความกว้างเต็มของ Label (แกน x)
														barPercentage: 0.8, // กำหนดความกว้างของแต่ละ Bar เท่ากับ 40% ของความกว้างของ Label
														stack: 'Stack 3', // กำหนด stack เพื่อระบุว่า Sub-dataset นี้อยู่ใน stack ใด
														anchor: 'center', // กำหนดให้ Bar อยู่กึงกลาง
													}

												],
											};
											const plugin123 = {
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
											const config_mo1 = {
												type: 'bar',
												data: data_mo1,
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
															stacked: false,
															beginAtZero: true,
														},
													},
												},
												plugins: [plugin123],
											};
											const myChartHindex = new Chart(document.getElementById('myChartHindex'), config_mo1, plugin123);
											// const myChartHindex = [{
											// 		id: 'myChartHindex',
											// 		labels: '[<?php echo $H_year; ?>]',
											// 		datas: '[<?php echo $H_per; ?>]',
											// 		con_data: 'จำนวนคนที่มีค่า H-index',
											// 		con_fig: null,
											// 		plugin: null,
											// 	},
											// 	// เพิ่มอีกตามความต้องการ
											// ];

											// createChart(myChartHindex);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>เงินทุนวิจัยจากแหล่งทุนภายนอก</h5>
								</div>

								<div class="card-body">
									<?php
									$m_all = array();
									$person_a = array();
									$person_s = array();
									$p_m = array();
									$avg_p = array();
									$pe_a = 0;
									$av_p = 0;
									foreach ($userPillar as $valuesPillar => $dataPillar) {
										$pe_a = $dataPillar['hiy_countPerson'];
										$pe_s = $dataPillar['hiy_SumIndex'];
										$av_p = $dataPillar['hiy_AvgIndex'];
										$m_pyj = 0;
										$db3121 = new Database('nurse');
										$db3121->Table = "RS_Project";
										$db3121->Where = "Where PJ_Year = '" . $dataPillar['hiy_year'] . "' AND PJ_TypeFunds NOT IN ('00','03') order by PJ_Year desc";
										$user3121 = $db3121->Select();
										foreach ($user3121 as $values3121 => $data3121) {
											$m_pyj += $data3121['PJ_SumMoney'];
										}
										$m_all[] = $m_pyj;
										$person_a[] = $pe_a;
										$person_s[] = $pe_s;
										$p_m[] = $m_pyj / $pe_a;
										$avg_p[] = $av_p;
									}
									$m_all = implode(",", $m_all);
									$person_a = implode(",", $person_a);
									$person_s = implode(",", $person_s);
									$avg_p = implode(",", $avg_p);

									// echo "money : ".$m_all."<br>";
									// echo "person : ".$person_a."<br>";
									// echo "sum : ";
									// foreach ($p_m as $value) {
									//     echo number_format($value,2) . ",";
									// }
									$p_m = implode(",", $p_m);
									?>
									<p align="center">
										<canvas id="myChartmoney"></canvas>
										<script>
											const myChartmoney = [{
													id: 'myChartmoney',
													labels: '[<?php echo $H_year; ?>]',
													datas: '[<?php echo $m_all; ?>]',
													con_data: 'จำนวนเงิน',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChartmoney);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนกิจกรรมภาษาอังกฤษที่สอดคล้องกับ SDG</h5>
								</div>
								<?php
								$SDG_all = array();
								for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
									$sdg_n = 0;
									$dbSdg = new Database('nurse');
									$dbSdg->Table = "RS_Journal";
									$dbSdg->Where = "Where JNL_Year='$toyear1' AND JNL_Status= '1' AND JNL_typeLanguge  = '2' order by JNL_ID";
									$userSdg = $dbSdg->Select();
									foreach ($userSdg as $valuesSdg => $dataSdg) {

										$dbSdg1 = new Database('nurse');
										$dbSdg1->Table = "RS_JNLInSDGs";
										$dbSdg1->Where = "Where JNL_ID='$dataSdg[JNL_id]'";
										$userSdg1 = $dbSdg1->Select();
										foreach ($userSdg1 as $valuesSdg1 => $dataSdg1) {
											$sdg_n++;
										}
									}
									$SDG_all[] = $sdg_n;
								}
								$SDG_all = implode(",", $SDG_all);
								// echo "no : ".$SDG_all;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_SDG"></canvas>
										<script>
											const myChart_SDG = [{
													id: 'myChart_SDG',
													labels: '[<?php echo $datesave1; ?>]',
													datas: '[<?php echo $SDG_all; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_SDG);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>เงินทุนวิจัยจากแหล่งทุนภายนอกต่ออาจารย์ประจำ</h5>
								</div>

								<div class="card-body">
									<p align="center">
										<canvas id="myChartmoney_per"></canvas>
										<script>
											const myChartmoney_per = [{
													id: 'myChartmoney_per',
													labels: '[<?php echo $H_year; ?>]',
													datas: '[<?php echo $p_m; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChartmoney_per);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>วารสารระดับนานาชาติ(Q1/Q2/Q3/Q4)</h5>
								</div>

								<div class="card-body">
									<?php $datesave11 = array();
									$da_base011 = array();
									$da_base021 = array();
									$da_base031 = array();
									$da_base041 = array();

									$befdate = date('Y') - 4;
									for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
										$da_11 = 0;
										$da_21 = 0;
										$da_31 = 0;
										$da_41 = 0;

										$db11 = new Database('nurse');
										$db11->Table = "RS_Journal";
										$db11->Where = "Where JNL_Year='$toyear' AND JNL_Status= '1' AND JNL_Level = '2' order by JNL_ID";
										$user11 = $db11->Select();
										foreach ($user11 as $values11 => $data11) {

											$db2566_11 = new Database('nurse');
											$db2566_11->Table = "RS_JNLInDatabase";
											$db2566_11->Where = "Where JNL_ID='$data11[JNL_id]' order by DB_ID";
											$user2566_11 = $db2566_11->Select();
											foreach ($user2566_11 as $values2566_11 => $data2566_11) {
												$db2566_21 = new Database('nurse');
												$db2566_21->Table = "RS_Database";
												$db2566_21->Where = "Where DB_ID='$data2566_11[DB_ID]' order by DB_ID";
												$user2566_21 = $db2566_21->Select();
												foreach ($user2566_21 as $values2566_21 => $data2566_21) {
													// echo $data2566_1['JNL_ID']." - ".$data2566_2['DB_ID']." / ";
													//echo $data1['JNL_id']." / ";
													if ($data2566_21['DB_ID'] == '03') {
														$da_11++;
													} else if ($data2566_21['DB_ID'] == '04') {
														$da_21++;
													} else if ($data2566_21['DB_ID'] == '05') {
														$da_31++;
													} else if ($data2566_21['DB_ID'] == '06') {
														$da_41++;
													}
												}
											}
										}

										$datesave11[] = $toyear + 543;
										$da_base011[] = $da_11;
										$da_base021[] = $da_21;
										$da_base031[] = $da_31;
										$da_base041[] = $da_41;
									}
									$datesave11 = implode(",", $datesave11);
									$da_base011 = implode(",", $da_base011);
									$da_base021 = implode(",", $da_base021);
									$da_base031 = implode(",", $da_base031);
									$da_base041 = implode(",", $da_base041);
									// echo "Q1 : ".$da_base011." / ";
									// echo "Q2 : ".$da_base021."<br>";
									// echo "Q3 : ".$da_base031." / ";
									// echo "Q4 : ".$da_base041."<br>";
									?>
									<div class="chart-container">
										<canvas id="myChartQ"></canvas>
										<script>
											const data_Q1 = {
												labels: [<?php echo $datesave11; ?>],
												datasets: [{
														label: 'Q1',
														data: [<?php echo $da_base011; ?>],
														backgroundColor: ['rgba(246,189,96,1)'],
														borderColor: 'rgba(1,1,1,1);',
														borderWidth: 1,
														borderRadius: 5,
													},
													{
														label: 'Q2',
														data: [<?php echo $da_base021; ?>],
														backgroundColor: ['rgba(247,237,226,1)'],
														borderColor: 'rgba(1,1,1,1);',
														borderWidth: 1,
														borderRadius: 5,
													}, {
														label: 'Q3',
														data: [<?php echo $da_base031; ?>],
														backgroundColor: ['rgba(245,202,195,1)'],
														borderColor: 'rgba(1,1,1,1);',
														borderWidth: 1,
														borderRadius: 5,
													}, {
														label: 'Q4',
														data: [<?php echo $da_base041; ?>],
														backgroundColor: ['rgba(132,165,157,1)'],
														borderColor: 'rgba(1,1,1,1);',
														borderWidth: 1,
														borderRadius: 5,
													}
												],
											};

											const plugin_Q1 = {
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

											const config_Q1 = {
												type: 'bar',
												data: data_Q1,
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
														y: {
															beginAtZero: true,
														},
													},
												},
												plugins: [plugin_Q],
											};

											const myChartQ = new Chart(document.getElementById('myChartQ'), config_Q1, plugin_Q1);
										</script>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>วิจัย/นวัตกรรม/ผลงานทางวิชาการนำไปใช้ประโยชน์ลิดผลกระทบต่อชุมชน/สังคม</h5>
								</div>
								<?php
								$Res_a = array();

								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$R_a = 0;
									$dbres = new Database('nurse');
									$dbres->Table = "RS_Jour_Result";
									$dbres->Where = "Where JRs_Year='$toyear'";
									$userres = $dbres->Select();
									foreach ($userres as $valuesres => $datares) {
										$R_a++;
									}
									$Res_a[] = $R_a;
								}
								$Res_a = implode(",", $Res_a);
								// echo "Rs : ".$Res_a;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Jr"></canvas>
										<script>
											const myChart_Jr = [{
													id: 'myChart_Jr',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Res_a; ?>]',
													con_data: 'จำนวน J_result',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Jr);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ผลงานวิจัยที่มีการอ้างอิง(Citations)</h5>
								</div>
								<?php

								$h_J_sum = array();
								$cpf_sum = array();
								$cpf = 0;
								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$J_s = 0;
									$dbhJ = new Database('nurse');
									$dbhJ->Table = "RS_CitationCount";
									$dbhJ->Where = "Where citc_year = '$toyear' ";
									$userhJ = $dbhJ->Select();
									// $h_J_sum = count($userhJ);
									foreach ($userhJ as $valueshJ => $datahJ) {
										$J_s++;
									}
									$h_J_sum[] = $J_s;
									// $cpf = $J_s / $dataPillar['hiy_countPerson'];
									// $cpf_sum[] = $cpf;
								}
								$h_J_sum = implode(",", $h_J_sum);
								// echo "no : ".$cpf_sum;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Cita"></canvas>
										<script>
											const myChart_Cita = [{
													id: 'myChart_Cita',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $h_J_sum; ?>]',
													con_data: 'Citations',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Cita);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>วิจัย/นวัตกรรมนำไปใช้ประโยชน์และต่อยอดเชิงนโยบาย/พานิชย์</h5>
								</div>
								<?php
								$Res_a2 = array();

								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$R_a2 = 0;
									$dbres2 = new Database('nurse');
									$dbres2->Table = "RS_Jour_Result";
									$dbres2->Where = "Where JRs_Year='$toyear' AND JRs_Type = '2'";
									$userres2 = $dbres2->Select();
									foreach ($userres2 as $valuesres2 => $datares2) {
										$R_a2++;
									}
									$Res_a2[] = $R_a2;
								}
								$Res_a2 = implode(",", $Res_a2);
								// echo "Rs2 : ".$Res_a2;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Jr2"></canvas>
										<script>
											const myChart_Jr2 = [{
													id: 'myChart_Jr2',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Res_a2; ?>]',
													con_data: 'จำนวน J_result',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Jr2);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ค่าเฉลี่ย H-index ต่ออาจารย์ (H-index per Faculty)</h5>
								</div>

								<div class="card-body">
									<p align="center">
										<canvas id="myChartH_avgper"></canvas>
										<script>
											const myChartH_avgper = [{
													id: 'myChartH_avgper',
													labels: '[<?php echo $H_year; ?>]',
													datas: '[<?php echo $person_s; ?>]',
													con_data: 'H-index per Faculty',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChartH_avgper);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ร้อยละของแหล่งทุนวิจัยที่ให้ทุนซ้ำ/ต่อเนื่อง</h5>
								</div>
								<?php
								// $SDG12_all = array();
								// $organizeIds = array();
								// $dbOut = new Database('nurse');
								// $dbOut->Table = "RS_OutOrganize";
								// $dbOut->Where = "WHERE OOrganize_Source = 1";
								// $userOut = $dbOut->Select();
								// foreach ($userOut as $valuesOut => $dataOut) {
								//     $organizeIds[] = $dataOut['OOrganize_id'];
								// }
								// สร้างอาร์เรย์เพื่อเก็บผลรวมของโครงการในแต่ละปี
								// $projectCounts = array();

								// // วนลูปผ่านแต่ละปีตั้งแต่ปีปัจจุบันไปยังปีเริ่มต้น
								// for ($year = date('Y'); $year >= $befdate; $year--) {
								//     // สร้างอาร์เรย์เพื่อเก็บจำนวนโครงการในแต่ละปี
								//     $projectsInYear = array();

								//     // วนลูปผ่านแต่ละ organizeIds
								//     foreach ($organizeIds as $organizeId) {
								//         // สร้างคำสั่ง SQL เพื่อเช็คว่ามีโครงการในปีนั้นๆ หรือไม่
								//         $dbCheck = new Database('nurse');
								//         $dbCheck->Table = "RS_Project";
								//         $dbCheck->Where = "WHERE PJ_Year = '$year' AND PJ_Funds = $organizeId";
								//         $checkResult = $dbCheck->Select();

								//         // เช็คว่าในปีนั้นๆ มีโครงการหรือไม่
								//         if (count($checkResult) > 0) {
								//             // เช็คปีที่ต่ำกว่าปีปัจจุบัน และนับจำนวนโครงการที่มีในปีนั้น
								//             for ($prevYear = $year - 1; $prevYear >= $befdate; $prevYear--) {
								//                 $dbPrevCheck = new Database('nurse');
								//                 $dbPrevCheck->Table = "RS_Project";
								//                 $dbPrevCheck->Where = "WHERE PJ_Year = '$prevYear' AND PJ_Funds = $organizeId";
								//                 $prevCheckResult = $dbPrevCheck->Select();
								//                 if (count($prevCheckResult) > 0) {
								//                     // เพิ่มจำนวนโครงการที่มีในปีที่ต่ำกว่าปีปัจจุบันลงในอาร์เรย์
								//                     $projectsInYear[] = 1;
								//                 }
								//             }
								//         }
								//     }

								//     // นับจำนวนปีที่ซ้ำกันแล้วเก็บลงในอาร์เรย์ผลลัพธ์
								//     $projectCounts[$year] = array_sum($projectsInYear);
								// }

								// // แสดงผลลัพธ์
								// foreach ($projectCounts as $year => $count) {
								//     echo "$year: $count <br>";
								// }

								// สร้างอาร์เรย์เพื่อเก็บจำนวนโครงการในแต่ละ organizeIds ตามปี
								//  $projectCounts = array();

								// // วนลูปผ่านแต่ละ organizeIds
								// foreach ($organizeIds as $organizeId) {
								//     // สร้างอาร์เรย์เพื่อเก็บจำนวนโครงการในแต่ละปีสำหรับ organizeId นั้นๆ
								//     $projectsInOrganize = array();

								//     // วนลูปผ่านแต่ละปี
								//     for ($year = date('Y'); $year >= $befdate; $year--) {
								//         // สร้างคำสั่ง SQL เพื่อเช็คว่ามีโครงการในปีนั้นๆ หรือไม่
								//         $dbCheck = new Database('nurse');
								//         $dbCheck->Table = "RS_Project";
								//         $dbCheck->Where = "WHERE PJ_Year = '$year' AND PJ_Funds = $organizeId";
								//         $checkResult = $dbCheck->Select();

								//         // เช็คว่ามีโครงการในปีก่อนหน้าหรือไม่ ถ้ามีให้นับเพิ่มขึ้น 1
								//         if ($year < date('Y')) {
								//             $nextYear = $year + 1;
								//             $dbNextCheck = new Database('nurse');
								//             $dbNextCheck->Table = "RS_Project";
								//             $dbNextCheck->Where = "WHERE PJ_Year = '$nextYear' AND PJ_Funds = $organizeId";
								//             $nextCheckResult = $dbNextCheck->Select();
								//             if (count($nextCheckResult) > 0) {
								//                 $projectsInOrganize[$year] = $projectsInOrganize[$nextYear] + 1;
								//             } else {
								//                 $projectsInOrganize[$year] = 0;
								//             }
								//         } else {
								//             $projectsInOrganize[$year] = count($checkResult);
								//         }
								//     }

								//     // เพิ่มอาร์เรย์ที่เก็บจำนวนโครงการในแต่ละปีของ organizeId นี้เข้าไปในอาร์เรย์หลัก
								//     $projectCounts[$organizeId] = $projectsInOrganize;
								// }

								// // แสดงผลลัพธ์
								// foreach ($projectCounts as $organizeId => $projectsInOrganize) {
								//     echo "OrganizeId: $organizeId <br>";
								//     foreach ($projectsInOrganize as $year => $count) {
								//         echo "Year $year: $count projects <br>";
								//     }
								//     echo "<br>";
								// }   
								$Re = array();
								$re_y = array();
								$toyearnow = date('Y');
								$yearbe = date('Y') - 4;
								// echo $toyearnow." / ".$yearbe;
								for ($toyear = $toyearnow; $toyear >= $yearbe; $toyear--) {
									$R_a2 = 0;
									$dbres23 = new Database('nurse');
									$dbres23->Table = "RS_Project";
									$dbres23->Where = "Where PJ_Year ='$toyear' order by PJ_Funds";
									$userres23 = $dbres23->Select();
									foreach ($userres23 as $valuesres23 => $datares23) {
										$R_a2++;

										$R_a21 = 0;
										$dbres21 = new Database('nurse');
										$dbres21->Table = "RS_Project";
										$dbres21->Where = "Where PJ_Year < '$toyear' AND PJ_TypeFunds IN ('2', '4') AND PJ_Funds <> '' AND PJ_Funds = '$datares23[PJ_Funds]' order by PJ_id";
										$userres21 = $dbres21->Select();
										foreach ($userres21 as $valuesres21 => $datares21) {
											$R_a21++;
										}
									}
									$p = ($R_a21 / $R_a2) * 100;
									$Re[] = $p;
									$re_y[] = $toyear;
								}
								$Re = implode(",", $Re);
								$re_y = implode(" / ", $re_y);
								// echo "ปี : ".$re_y."<br>";
								// echo $Re."<br>";
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_chain"></canvas>
										<script>
											const myChart_chain = [{
													id: 'myChart_chain',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Re; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_chain);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนกิจกรรมที่นำองค์ความรู้และนวัตกรรมไปใช้ในการพัฒนาพื้นที่ (ภาคตะวันออก)</h5>
								</div>
								<?php
								$Res_a5 = array();

								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$R_a5 = 0;
									$dbres5 = new Database('nurse');
									$dbres5->Table = "RS_Jour_Result";
									$dbres5->Where = "Where JRs_Year='$toyear' AND JRs_Type = '5'";
									$userres5 = $dbres5->Select();
									foreach ($userres5 as $valuesres5 => $datares5) {
										$R_a5++;
									}
									$Res_a5[] = $R_a5;
								}
								$Res_a5 = implode(",", $Res_a5);
								// echo "Rs5 : ".$Res_a5;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Jr5"></canvas>
										<script>
											const myChart_Jr5 = [{
													id: 'myChart_Jr5',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Res_a5; ?>]',
													con_data: 'จำนวน J_result',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Jr5);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนงานวิจัย/งานสร้างสรรค์ที่ก่อให้เกิดผลกระทบการพัฒนาอย่างยั่งยืน (SDG related)</h5>
								</div>
								<?php
								$SDG1_all = array();
								for ($toyear1 = $befdate; $toyear1 <= date('Y'); $toyear1++) {
									$sdg_n1 = 0;
									$dbSdg2 = new Database('nurse');
									$dbSdg2->Table = "RS_Journal";
									$dbSdg2->Where = "Where JNL_Year='$toyear1' AND JNL_Status= '1' order by JNL_ID";
									$userSdg2 = $dbSdg2->Select();
									foreach ($userSdg2 as $valuesSdg2 => $dataSdg2) {

										$dbSdg12 = new Database('nurse');
										$dbSdg12->Table = "RS_JNLInSDGs";
										$dbSdg12->Where = "Where JNL_ID='$dataSdg[JNL_id]'";
										$userSdg12 = $dbSdg12->Select();
										foreach ($userSdg12 as $valuesSdg12 => $dataSdg12) {
											$sdg_n1++;
										}
									}
									$SDG1_all[] = $sdg_n1;
								}
								$SDG1_all = implode(",", $SDG1_all);
								// echo "no : ".$SDG1_all;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_SDG1"></canvas>
										<script>
											const myChart_SDG1 = [{
													id: 'myChart_SDG1',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $SDG1_all; ?>]',
													con_data: 'จำนวน Journal',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_SDG1);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนผลงานวิจัยที่เผยแพร่ในฐานข้อมูล Scopus/ISI ควอไทล์ 1-4 ร่วมกับเครื่อข่ายนานาชาติ</h5>
								</div>
								<?php
								$da_base0111 = array();
								$befdate = date('Y') - 4;
								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$da_111 = 0;
									$db112 = new Database('nurse');
									$db112->Table = "RS_Journal";
									$db112->Where = "Where JNL_Year='$toyear' AND JNL_Status= '1' AND JNL_Level = '2' order by JNL_ID";
									$user112 = $db112->Select();
									foreach ($user112 as $values112 => $data112) {

										$db2566_111 = new Database('nurse');
										$db2566_111->Table = "RS_JNLInDatabase";
										$db2566_111->Where = "Where JNL_ID='$data112[JNL_id]' AND DB_ID = '07'";
										$user2566_111 = $db2566_111->Select();

										foreach ($user2566_111 as $values2566_111 => $data2566_111) {

											$db2566_1112 = new Database('nurse');
											$db2566_1112->Table = "RS_JNLInDatabase";
											$db2566_1112->Where = "Where JNL_ID='$data2566_111[JNL_ID]' AND (DB_ID IN ('03','04','05','06')) order by DB_ID";
											$user2566_1112 = $db2566_1112->Select();
											foreach ($user2566_1112 as $values2566_1112 => $data2566_1112) {
												$da_111++;
											}
										}
									}
									$da_base0111[] = $da_111;
								}
								$da_base0111 = implode(",", $da_base0111);
								// echo "Sc : ".$da_base0111;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_scopus"></canvas>
										<script>
											const myChart_scopus = [{
													id: 'myChart_scopus',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $da_base0111; ?>]',
													con_data: 'จำนวน Project',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_scopus);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนนวัตกรรมกระบวนการที่ถูกสร้างและปรับปรุงเพื่อพัฒนาการดำเนินงาน (สะสม)</h5>
								</div>
								<?php
								$Pat_a = array();
								$P_t = 0;
								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$dbpt = new Database('nurse');
									$dbpt->Table = "RS_Patent";
									$dbpt->Where = "Where PAT_year='$toyear' AND PAT_type= '2'";
									$userpt = $dbpt->Select();
									foreach ($userpt as $valuespt => $datapt) {
										$P_t++;
									}
									$Pat_a[] = $P_t;
								}
								$Pat_a = implode(",", $Pat_a);
								// echo "Pt : ".$Pat_a;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Patent"></canvas>
										<script>
											const myChart_Patent = [{
													id: 'myChart_Patent',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Pat_a; ?>]',
													con_data: 'จำนวน Patent',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Patent);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>ผลงานวิจัยและผลงานวิชาการที่ตีพิมพ์เผยแพร่ต่ออาจารย์ประจำทั้งหมด</h5>
								</div>
								<?php
								$h_pe_sum = array();
								$h_J_sum1 = array();
								$h_P_sum = array();
								$all_sum = array();
								$h_p_s = 0;

								foreach ($userPillar as $valuesPillar => $dataPillar) {
									$h_pe_sum[] = $dataPillar['hiy_countPerson'];
									$J_s = 0;
									$dbhJ = new Database('nurse');
									$dbhJ->Table = "RS_Journal";
									$dbhJ->Where = "Where JNL_Year = '$dataPillar[hiy_year]' AND JNL_Status = '1' ";
									$userhJ = $dbhJ->Select();
									// $h_J_sum1 = count($userhJ);
									foreach ($userhJ as $valueshJ => $datahJ) {
										$J_s++;
									}
									$h_J_sum1[] = $J_s;
									$P_s = 0;
									$dbhP = new Database('nurse');
									$dbhP->Table = "RS_Proceeding";
									$dbhP->Where = "Where PCD_Year = '$dataPillar[hiy_year]' AND PCD_status = '1' ";
									$userhP = $dbhP->Select();
									// $h_P_sum = count($userhP);

									foreach ($userhP as $valueshP => $datahP) {
										$P_s++;
									}
									$h_P_sum[] = $P_s;
									$h_p_s = ($J_s + $P_s) / $dataPillar['hiy_countPerson'];
									$all_sum[] = $h_p_s;
								}
								// $H_per[] = $h_pe_sum;
								// $H_year[] = $dataPillar[hiy_year]+543;

								$h_pe_sum = implode(",", $h_pe_sum);
								$h_J_sum1 = implode(",", $h_J_sum1);
								$h_P_sum = implode(",", $h_P_sum);
								$all_sum = implode(",", $all_sum);

								// $a_p = ($J_s+$P_s)/$h_pe_sum;
								// echo "<br>teacher : ".$h_pe_sum." / <br>Journal : ".$h_J_sum." / <br>Proceeding : ".$h_P_sum." / <br>ava : ".$all_sum;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_H_P"></canvas>
										<script>
											const data_H_P = {
												labels: [<?php echo $H_year; ?>],
												datasets: [{
													label: 'จำนวนเรื่อง ต่อ 1 คน',
													data: [<?php echo $all_sum; ?>],
													backgroundColor: [
														'rgba(240,113,103,1)'
													],
													borderColor: [
														'rgba(1,1,1,1)'
													],
													borderWidth: 2,
													// pointBorderWidth : 5,
												}],
											};

											const plugin_H_P = {
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

											const config_H_P = {
												type: 'line',
												data: data_H_P,
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
														y: {
															beginAtZero: true,
														},
													},
												},
												plugins: [plugin_H_P],
											};
											const myChart_H_P = new Chart(document.getElementById('myChart_H_P'), config_H_P, plugin_H_P);
										</script>
									</p>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
								<div class="card-header text-center">
									<h5>จำนวนทรัพย์สินทางปัญญา (ลิขสิทธิ สิทธิบัตรและอนุสิทธิบัตร)</h5>
								</div>
								<?php
								$Pat_a1 = array();

								for ($toyear = $befdate; $toyear <= date('Y'); $toyear++) {
									$P_t1 = 0;
									$dbpt1 = new Database('nurse');
									$dbpt1->Table = "RS_Patent";
									$dbpt1->Where = "Where PAT_year='$toyear' AND PAT_type= '1'";
									$userpt1 = $dbpt1->Select();
									foreach ($userpt1 as $valuespt1 => $datapt1) {
										$P_t1++;
									}
									$Pat_a1[] = $P_t1;
								}
								$Pat_a1 = implode(",", $Pat_a1);
								// echo "Pt1 : ".$Pat_a1;
								?>
								<div class="card-body">
									<p align="center">
										<canvas id="myChart_Patent1"></canvas>
										<script>
											const myChart_Patent1 = [{
													id: 'myChart_Patent1',
													labels: '[<?php echo $datesave11; ?>]',
													datas: '[<?php echo $Pat_a1; ?>]',
													con_data: 'จำนวน Patent',
													con_fig: null,
													plugin: null,
												},
												// เพิ่มอีกตามความต้องการ
											];
											createChart(myChart_Patent1);
										</script>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><!-- row g-3 -->
</div> <!-- container -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	// JavaScript
	$(document).ready(function() {
		function animateNumber(element, start, end, duration) {
			if (end === 0) {
				$(element).text("0");
			} else {
				var range = end - start;
				var increment = end > start ? 1 : 0;
				var stepTime = Math.abs(Math.floor(duration / Math.max(range, 1)));

				var current = start;
				var timer = setInterval(function() {
					current += increment;
					$(element).text(current);
					if (current >= end) {
						clearInterval(timer);
					}
				}, stepTime);
			}
		}
		var j31 = $("#J31").val();
		var j51 = $("#J51").val();
		var j52 = $("#J52").val();
		animateNumber('#numJ31', 0, j31, 2000);
		animateNumber('#numJ51', 0, j51, 2000);
		animateNumber('#numJ52', 0, j52, 2000);
		$('#year-section').change(function() {
			var selectedYear = $(this).val();
			if (selectedYear !== '') {
				fetchData(selectedYear);
			} else {
				$('#result #number_j').empty();
			}
		});

		function fetchData(year) {
			$.ajax({
				url: 'config/get_data.php',
				method: 'POST',
				data: {
					year: year
				},
				dataType: 'json', // กำหนดประเภทข้อมูลที่คาดหวังกลับมา
				success: function(data) {
					var totalAll = data.all || 0;
					var totalNation = data.nation || 0;
					var totalInter = data.inter || 0;

					// var total = parseInt(data.pro1); // แปลงค่าเป็นตัวเลข
					animateNumber('#result #number_j', 0, totalAll, 2000);
					animateNumber('#national_section #number_n', 0, totalNation, 2000);
					animateNumber('#inter_section #number_i', 0, totalInter, 2000);

					var UrlJ = 'Page.php?feed=Res_Jour&year_j=' + year;
					$('#number_j_link').attr('href', UrlJ);
					$('#totalJournals').attr('href', UrlJ);

					var UrlN = 'Page.php?feed=Res_dasJ&year_j=' + year + '&lev=1';
					$('#number_n_link').attr('href', UrlN);
					$('#totaln').attr('href', UrlN);

					var UrlI = 'Page.php?feed=Res_dasJ&year_j=' + year + '&lev=2';
					$('#number_i_link').attr('href', UrlI);
					$('#totali').attr('href', UrlI);
				},
				error: function() {
					console.log("Error fetching data.");
				}
			});

			// $.ajax({
			// 	url: 'config/get_data_national.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
			// 	method: 'POST',
			// 	data: {
			// 		year: year
			// 	},
			// 	success: function(data) {
			// 		$('#national_section h2').html(data);
			// 	}
			// });

			// $.ajax({
			// 	url: 'config/get_data_inter.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
			// 	method: 'POST',
			// 	data: {
			// 		year: year
			// 	},
			// 	success: function(data) {
			// 		$('#inter_section h2').html(data);
			// 	}
			// });
		}

		var initialYear = new Date().getFullYear().toString();
		fetchData(initialYear);
	});
</script>