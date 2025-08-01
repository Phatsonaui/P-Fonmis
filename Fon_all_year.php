<div class="container-fluid">
	<div class="row card-group">
		<div class="col-md-12 mt-3">
			<div class="card">
				<div class="card-header d-flex" style="justify-content: space-between;">
					<div class="justify-content-start">
						<h2>แผนกลยุทธ์</h2>
					</div>
					<div class="justify-content-end">
						<select class="form-select select-sm" name="year-section" id="year-section">
							<?php
							$dbstg = new Database('nurse');
							$dbstg->Table = "stg_strategic";
							$dbstg->Where = "order by strategic_year DESC ";
							$userstg = $dbstg->Select();
							foreach ($userstg as $valuesstg => $datastg) {
								$yeae = $datastg['strategic_year'] + 543;
								echo "<option value=\"$datastg[strategic_year]\">$yeae</option>";
							}
							?>
						</select>
					</div>
				</div>

				<div class="row g-3 card-body mt-2">
					<div id="data_kpi" class="row">

					</div>
				</div>
			</div>
		</div>
		<?php //include "Re_target.php"; ?>
		<?php include "t_roi.php"; ?>
		<div class="col-md-6 mt-3 d-none">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					Project
				</div>
				<div class="card-body">
					<?php
					$list_year_Pro = array();
					$Sum_Pro = array();
					$list_Pro = array();
					$Current_Pro = date('Y') - 4;
					for ($Year_Pro = $Current_Pro; $Year_Pro <= date('Y'); $Year_Pro++) {
						$value_Pro = 0;
						$db_Pro = new Database('nurse');
						$db_Pro->Table = "RS_Project";
						$db_Pro->Where = "Where PJ_Year='$Year_Pro' order by PJ_Year desc";
						$user_Pro = $db_Pro->Select();
						foreach ($user_Pro as $values_Pro => $data_Pro) {
							$value_Pro++;
						}
						$list_year_Pro[] = $Year_Pro + 543;
						$list_Pro[] = $value_Pro;
					}
					$Sum_Pro[] = $list_Pro[0] + $list_Pro[1] + $list_Pro[2] + $list_Pro[3] + $list_Pro[4];
					$list_year_Pro = implode(",", $list_year_Pro);
					$list_Pro = implode(",", $list_Pro);
					$Sum_Pro = implode(",", $Sum_Pro);
					?>
					<p align="center">
						<canvas id="Chart_Pro"></canvas>
						<script>
							const data_prj = {
								labels: [<?php echo $list_year_Pro; ?>],
								datasets: [{
									label: 'จำนวน Project',
									data: [<?php echo $list_Pro; ?>],
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
								plugins: [plugin_prj],
							};
							const Chart_Pro = new Chart(document.getElementById('Chart_Pro'), config_prj, plugin_prj);
						</script>
					</p>
					<p>
						<?php echo "<div class='container-fluid mt-3'>
															<div class='row'>
																<div class='col-md-9'>
																	จำนวน Project ย้อนหลัง 5 ปี มีทั้งหมด
																</div>
																<div class='col-md-3'> 
																	<b style='color:rgba(255,99,132,1);'>" . number_format($Sum_Pro) . " </b>   เรื่อง
																</div>
																
															</div>
														</div>"
						?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 mt-3 d-none">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					Proceeding
				</div>
				<div class="card-body">
					<?php
					$list_yesr_Pcd = array();
					$sum_PcdTh = array();
					$sum_PcdEn = array();
					$list_PcdEn = array();
					$list_PcdTh = array();
					$Current_Pcd = date('Y') - 4;
					for ($Year_Pcd = $Current_Pcd; $Year_Pcd <= date('Y'); $Year_Pcd++) {
						$Value_PcdTh = 0;
						$Value_PcdEn = 0;
						$dbPcdTh = new Database('nurse');
						$dbPcdTh->Table = "RS_Proceeding";
						$dbPcdTh->Where = "Where PCD_Year='$Year_Pcd' AND PCD_status = '1' And PCD_Level = '1' order by PCD_Year desc";
						$userPcdTh = $dbPcdTh->Select();
						foreach ($userPcdTh as $valuesPcdTh => $dataPcdTh) {
							$Value_PcdTh++;
						}
						$dbPcdEn = new Database('nurse');
						$dbPcdEn->Table = "RS_Proceeding";
						$dbPcdEn->Where = "Where PCD_Year='$Year_Pcd' AND PCD_Status=1 And PCD_Level = 2 order by PCD_Year desc";
						$userPcdEn = $dbPcdEn->Select();
						foreach ($userPcdEn as $valuesPcdEn => $dataPcdEn) {
							$Value_PcdEn++;
						}
						$list_yesr_Pcd[] = $Year_Pcd + 543;
						$list_PcdTh[] = $Value_PcdTh;
						$list_PcdEn[] = $Value_PcdEn;
					}
					$sum_PcdTh[] = $list_PcdTh[0] + $list_PcdTh[1] + $list_PcdTh[2] + $list_PcdTh[3] + $list_PcdTh[4];
					$sum_PcdEn = $list_PcdEn[0] + $list_PcdEn[1] + $list_PcdEn[2] + $list_PcdEn[3] + $list_PcdEn[4];
					$list_yesr_Pcd = implode(",", $list_yesr_Pcd);
					$list_PcdTh = implode(",", $list_PcdTh);
					$sum_PcdTh = implode(",", $sum_PcdTh);
					$list_PcdEn = implode(",", $list_PcdEn);
					?>
					<p align="center">
						<canvas id="Chart_Pcd"></canvas>
						<script>
							const data_prc = {
								labels: [<?php echo $list_yesr_Pcd; ?>],
								datasets: [{
									label: 'จำนวน Proceeding',
									data: [<?php echo $list_PcdTh; ?>],
									backgroundColor: ['rgba(8,65,92,1)'],
									borderColor: ['rgba(1,1,1,1)'],
									borderWidth: 1,
									borderRadius: 10,
								}, {
									label: 'จำนวน Proceeding EN',
									data: [<?php echo $list_PcdEn; ?>],
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
								plugins: [plugin_prc],
							};
							const Chart_Pcd = new Chart(document.getElementById('Chart_Pcd'), config_prc, plugin_prc);
						</script>
					</p>
					<p>
					<div class='container-fluid mt-3'>
						<div class='row'>
							<div class='col-md-9'>
								จำนวน <b style='color:rgba(8,65,92,1)'>Proceeding TH</b> ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(8,65,92,1)'><?php echo number_format($sum_PcdTh); ?> </b> เรื่อง
							</div>
							<div class='col-md-9'>
								จำนวน <b style='color:rgba(204,41,54,1);'>Proceeding EN</b> ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(204,41,54,1);'><?php echo number_format($sum_PcdEn); ?> </b> เรื่อง
							</div>
							<div class='col-md-9 text-end'>รวมเป็น</div>
							<div class='col-md-3'>
								<b><?php echo number_format($sum_PcdTh + $sum_PcdEn); ?> </b> เรื่อง
							</div>
						</div>
					</div>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 mt-3 mb-3 d-none">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					Journal
				</div>
				<div class="card-body">
					<?php
					$list_Year_Jour = array();
					$sum_Jour_nat = array();
					$sum_Jour_in = array();
					$list_Jour_in = array();
					$list_Jour_nat = array();
					$sum_Jour = array();
					$Current_Jour = date('Y') - 4;
					for ($Year_Jour = $Current_Jour; $Year_Jour <= date('Y'); $Year_Jour++) {
						$Value_Jour_nat = 0;
						$Value_Jour_in = 0;
						$dbJour_na = new Database('nurse');
						$dbJour_na->Table = "RS_Journal";
						$dbJour_na->Where = "Where JNL_Year='$Year_Jour' AND JNL_Status=1 And JNL_Level = 1 order by JNL_Year desc";
						$userJour_na = $dbJour_na->Select();
						foreach ($userJour_na as $valuesJour_na => $dataJour_na) {
							$Value_Jour_nat++;
						}
						$dbJour_in = new Database('nurse');
						$dbJour_in->Table = "RS_Journal";
						$dbJour_in->Where = "Where JNL_Year='$Year_Jour' AND JNL_Status=1 And JNL_Level = 2 order by JNL_Year desc";
						$userJour_in = $dbJour_in->Select();
						foreach ($userJour_in as $valuesJour_in => $dataJour_in) {
							$Value_Jour_in++;
						}
						$list_Year_Jour[] = $Year_Jour + 543;
						$list_Jour_nat[] = $Value_Jour_nat;
						$sum_Jour[] = $Value_Jour_nat + $Value_Jour_in;
						$list_Jour_in[] = $Value_Jour_in;
					}
					$sum_Jour_nat[] = $list_Jour_nat[0] + $list_Jour_nat[1] + $list_Jour_nat[2] + $list_Jour_nat[3] + $list_Jour_nat[4];
					$sum_Jour_in = $list_Jour_in[0] + $list_Jour_in[1] + $list_Jour_in[2] + $list_Jour_in[3] + $list_Jour_in[4];
					$list_Year_Jour = implode(",", $list_Year_Jour);
					$list_Jour_nat = implode(",", $list_Jour_nat);
					$sum_Jour = implode(",", $sum_Jour);
					$sum_Jour_nat = implode(",", $sum_Jour_nat);
					$list_Jour_in = implode(",", $list_Jour_in);
					?>
					<p align="center">
						<!-- <div class="card chart-container"> -->
						<canvas id="Chart_Jour"></canvas>
						<!-- </div> -->
						<script>
							const data_jou = {
								labels: [<?php echo $list_Year_Jour; ?>],
								datasets: [{
										type: 'line',
										label: 'จำนวน Journal ระดับชาติ ',
										data: [<?php echo $list_Jour_nat; ?>],
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
										data: [<?php echo $list_Jour_in; ?>],
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
										data: [<?php echo $sum_Jour; ?>],
										backgroundColor: 'rgba(244,241,222,1)',
										borderColor: 'rgba(1, 1, 1, 1)',
										borderWidth: 1,
										pointStyle: 'rect',
										borderRadius: 10,
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
							const Chart_Jour = new Chart(document.getElementById('Chart_Jour'), config_jou, plugin_jou);
						</script>
					</p>
					<p>
					<div class='container-fluid mt-3'>
						<div class='row'>
							<div class='col-md-9'>
								จำนวน Journal <b style='color:rgba(224,122,95,1);'> ระดับชาติ </b>ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(224,122,95,1);'><?php echo number_format($sum_Jour_nat); ?> </b> เรื่อง
							</div>
							<div class='col-md-9'>
								จำนวน Journal <b style='color:rgba(61,64,91,1);'> ระดับนานาชาติ </b>ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(61,64,91,1);'><?php echo number_format($sum_Jour_in); ?> </b> เรื่อง
							</div>
							<div class='col-md-9 text-end'>รวมเป็น</div>
							<div class='col-md-3'>
								<b><?php echo number_format($sum_Jour_nat + $sum_Jour_in); ?> </b> เรื่อง
							</div>
						</div>
					</div>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 mt-3 mb-3 d-none">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					สิทธิบัตร/นวัตกรรม
				</div>
				<div class="card-body">
					<?php
					$list_year_Pat = array();
					$sum_Pat_Pate = array();
					$sum_Pat_Inno = array();
					$list_Pat_Inno = array();
					$list_Pat_Pate = array();
					$Current_Pat = date('Y') - 4;
					for ($Year_Pat = $Current_Pat; $Year_Pat <= date('Y'); $Year_Pat++) {
						$Value_Pat_Pate = 0;
						$Value_Pat_Inno = 0;
						$dbPate = new Database('nurse');
						$dbPate->Table = "RS_Patent";
						$dbPate->Where = "Where PAT_year='$Year_Pat' AND PAT_type = 1 order by PAT_year desc";
						$userPate = $dbPate->Select();
						foreach ($userPate as $valuesPate => $dataPate) {
							$Value_Pat_Pate++;
						}
						$dbInno = new Database('nurse');
						$dbInno->Table = "RS_Patent";
						$dbInno->Where = "Where PAT_year='$Year_Pat' AND PAT_type = 2 order by PAT_year desc";
						$userInno = $dbInno->Select();
						foreach ($userInno as $valuesInno => $dataInno) {
							$Value_Pat_Inno++;
						}
						$list_year_Pat[] = $Year_Pat + 543;
						$list_Pat_Pate[] = $Value_Pat_Pate;
						$list_Pat_Inno[] = $Value_Pat_Inno;
					}
					$sum_Pat_Pate[] = $list_Pat_Pate[0] + $list_Pat_Pate[1] + $list_Pat_Pate[2] + $list_Pat_Pate[3] + $list_Pat_Pate[4];
					$sum_Pat_Inno = $list_Pat_Inno[0] + $list_Pat_Inno[1] + $list_Pat_Inno[2] + $list_Pat_Inno[3] + $list_Pat_Inno[4];
					$list_year_Pat = implode(",", $list_year_Pat);
					$list_Pat_Pate = implode(",", $list_Pat_Pate);
					$sum_Pat_Pate = implode(",", $sum_Pat_Pate);
					$list_Pat_Inno = implode(",", $list_Pat_Inno);
					?>
					<p align="center">
						<!-- <div class="card chart-container"> -->
						<canvas id="Chart_Pat"></canvas>
						<!-- </div> -->
						<script>
							const data_pat = {
								labels: [<?php echo $list_year_Pat; ?>],
								datasets: [{
									label: 'จำนวน สิทธิบัตร',
									data: [<?php echo $list_Pat_Pate; ?>],
									backgroundColor: ['rgba(16,37,66,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								}, {
									label: 'จำนวน นวัตกรรม',
									data: [<?php echo $list_Pat_Inno; ?>],
									backgroundColor: ['rgba(248,112,96,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								}],
							};

							const plugin_pat = {
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

							const config_pat = {
								type: 'bar',
								data: data_pat,
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
								plugins: [plugin_pat],
							};
							const Chart_Pat = new Chart(document.getElementById('Chart_Pat'), config_pat, plugin_pat);
						</script>
					</p>
					<p>
					<div class='container-fluid mt-3'>
						<div class='row'>
							<div class='col-md-9'>
								จำนวน <b style='color:rgba(16,37,66,1);'>สิทธิบัตร</b> ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(16,37,66,1);'><?php echo number_format($sum_Pat_Pate); ?> </b> เรื่อง
							</div>
							<div class='col-md-9'>
								จำนวน <b style='color:rgba(248,112,96,1);'>นวัตกรรม</b> ย้อนหลัง 5 ปี มีทั้งหมด
							</div>
							<div class='col-md-3'>
								<b style='color:rgba(248,112,96,1);'><?php echo number_format($sum_Pat_Inno); ?> </b> เรื่อง
							</div>
							<div class='col-md-9 text-end'>รวมเป็น</div>
							<div class='col-md-3'>
								<b><?php echo number_format($sum_Pat_Pate + $sum_Pat_Inno); ?> </b> เรื่อง
							</div>
						</div>
					</div>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-6 mt-3 mb-3 d-none">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;height:100%">
				<div class="card-header text-center">
					ฐานข้อมูลที่ปรากฏ
				</div>
				<div class="card-body">
					<?php $list_year_Db = array();
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

					$Current_Db = date('Y') - 4;
					for ($Year_Db = $Current_Db; $Year_Db <= date('Y'); $Year_Db++) {
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
						$da_13 = 0;


						$db1 = new Database('nurse');
						$db1->Table = "RS_Journal";
						$db1->Where = "Where JNL_Year='$Year_Db' AND JNL_Status= '1' order by JNL_ID";
						$user1 = $db1->Select();
						foreach ($user1 as $values1 => $data1) {

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
									if ($data2566_2['DB_ID'] == '01') {
										$da_1++;
									} else if ($data2566_2['DB_ID'] == '02') {
										$da_2++;
									} else if ($data2566_2['DB_ID'] == '03') {
										$da_3++;
									} else if ($data2566_2['DB_ID'] == '04') {
										$da_3++;
									} else if ($data2566_2['DB_ID'] == '05') {
										$da_3++;
									} else if ($data2566_2['DB_ID'] == '06') {
										$da_3++;
									} else if ($data2566_2['DB_ID'] == '07') {
										$da_7++;
									} else if ($data2566_2['DB_ID'] == '08') {
										$da_8++;
									} else if ($data2566_2['DB_ID'] == '09') {
										$da_8++;
									} else if ($data2566_2['DB_ID'] == '10') {
										$da_8++;
									} else if ($data2566_2['DB_ID'] == '11') {
										$da_11++;
									} else if ($data2566_2['DB_ID'] == '12') {
										$da_3++;
									} else if ($data2566_2['DB_ID'] == '13') {
										$da_13++;
									}
								}
							}
						}




						$list_year_Db[] = $Year_Db + 543;
						$da_base01[] = $da_1;
						$da_base02[] = $da_2;
						$da_base03[] = $da_3;
						$da_base04[] = $da_4;
						$da_base05[] = $da_5;
						$da_base06[] = $da_6;
						$da_base08[] = $da_7;
						$da_base07[] = $da_8;
						$da_base10[] = $da_9;
						$da_base09[] = $da_10;
						$da_base11[] = $da_11;
						$da_base12[] = $da_12;
						$da_base13[] = $da_13;
					}
					$list_year_Db = implode(",", $list_year_Db);
					$da_base01 = implode(",", $da_base01);
					$da_base02 = implode(",", $da_base02);
					$da_base03 = implode(",", $da_base03);
					$da_base04 = implode(",", $da_base04);
					$da_base05 = implode(",", $da_base05);
					$da_base06 = implode(",", $da_base06);
					$da_base07 = implode(",", $da_base07);
					$da_base08 = implode(",", $da_base08);
					$da_base09 = implode(",", $da_base09);
					$da_base10 = implode(",", $da_base10);
					$da_base11 = implode(",", $da_base11);
					$da_base12 = implode(",", $da_base12);
					$da_base13 = implode(",", $da_base13);
					?>
					<p align="center">
					<div class="chart-container">
						<canvas id="Chart_Db"></canvas>
					</div>
					<script>
						const data_is = {
							labels: [<?php echo $list_year_Db; ?>],
							datasets: [{
									label: 'ISI',
									data: [<?php echo $da_base01; ?>],
									backgroundColor: ['rgba(13,48,130,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								}, {
									label: 'Pubmed',
									data: [<?php echo $da_base02; ?>],
									backgroundColor: ['rgba(136,218,231,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								}, {
									label: 'SJR',
									data: [<?php echo $da_base03; ?>],
									backgroundColor: ['rgba(118,205,101,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								},
								// {
								// 	label : 'SJR Q2',
								// 	data: [<?php echo $da_base04; ?>],
								// 	backgroundColor: ['rgba(255, 0, 0, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, {
								// 	label : 'SJR Q3',
								// 	data: [<?php echo $da_base05; ?>],
								// 	backgroundColor: ['rgba(0, 205, 255, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, {
								// 	label : 'SJR Q4',
								// 	data: [<?php echo $da_base06; ?>],
								// 	backgroundColor: ['rgba(255, 141, 0, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, 
								{
									label: 'TCI',
									data: [<?php echo $da_base07; ?>],
									backgroundColor: ['rgba(255,194,71,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								}, {
									label: 'Scopus',
									data: [<?php echo $da_base08; ?>],
									backgroundColor: ['rgba(255,129,51,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,
								},
								// {
								// 	label : 'TCI 2',
								// 	data: [<?php echo $da_base09; ?>],
								// 	backgroundColor: ['rgba(255, 247, 0, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, {
								// 	label : 'TCI 3',
								// 	data: [<?php echo $da_base10; ?>],
								// 	backgroundColor: ['rgba(0, 255, 146, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, 
								// {
								// 	label : 'สกอ.',
								// 	data: [<?php echo $da_base11; ?>],
								// 	backgroundColor: ['rgba(0, 93, 255, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, 
								// {
								// 	label : 'SJR สมศ.',
								// 	data: [<?php echo $da_base12; ?>],
								// 	backgroundColor: ['rgba(100, 19, 64, 1)'],
								// 	borderColor: ['rgba(1, 1, 1, 1)'],
								// 	borderWidth: 2
								// }, 
								{
									label: 'Google Scholars',
									data: [<?php echo $da_base13; ?>],
									backgroundColor: ['rgba(235,81,51,1)'],
									borderColor: ['rgba(1, 1, 1, 1)'],
									borderWidth: 1,
									borderRadius: 10,

								}
							],
						};

						const plugin_is = {
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

						const config_is = {
							type: 'bar',
							data: data_is,
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
							plugins: [plugin_is],
						};

						const Chart_Db = new Chart(document.getElementById('Chart_Db'), config_is, plugin_is);
					</script>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-12 mb-3 d-none">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-header text-center">สถานะห้องรายวัน</h2>
						</div>
						<?php $room = 0;
						$roomtoday = date('Y-m-d');
						$roomRT = 0;
						$dbRoom = new Database('nurse');
						$dbRoom->Table = "RM_Room";
						$dbRoom->Where = "where room_status='1' AND room_type='1' order by room_id";
						$userRoom = $dbRoom->Select();
						foreach ($userRoom as $valuesRoom => $dataRoom) {
							$room++;
							$dbRoomRT = new Database('nurse');
							$dbRoomRT->Table = "RM_Reserv";
							$dbRoomRT->Where = "where room_id='$dataRoom[room_id]' AND Rs_startdate='$roomtoday' AND RS_status='3' group by room_id";
							$userRoomRT = $dbRoomRT->Select();
							foreach ($userRoomRT as $valuesRoomRT => $dataRoomRT) {
								$roomRT++;
							}
						}
						echo "<script> var class_r = $room; var class_r_use = $roomRT;</script>";

						$room1 = $roomRT1 = 0;
						$dbRoom1 = new Database('nurse');
						$dbRoom1->Table = "RM_Room";
						$dbRoom1->Where = "where room_status='1' AND room_type='2' order by room_id";
						$userRoom1 = $dbRoom1->Select();
						foreach ($userRoom1 as $valuesRoom1 => $dataRoom1) {
							$room1++;
							$dbRoomRT1 = new Database('nurse');
							$dbRoomRT1->Table = "RM_Reserv";
							$dbRoomRT1->Where = "where room_id='$dataRoom1[room_id]' AND Rs_startdate='$roomtoday' AND RS_status='3' group by room_id";
							$userRoomRT1 = $dbRoomRT1->Select();
							foreach ($userRoomRT1 as $valuesRoomRT1 => $dataRoomRT1) {
								$roomRT1++;
							}
						}
						echo "<script> var meet_r = $room1; var meet_r_use = $roomRT1; </script>";

						$room2 = $roomRT2 = 0;
						$dbRoom2 = new Database('nurse');
						$dbRoom2->Table = "RM_Room";
						$dbRoom2->Where = "where room_status='1' AND room_type='3' order by room_id";
						$userRoom2 = $dbRoom2->Select();
						foreach ($userRoom2 as $valuesRoom2 => $dataRoom2) {
							$room2++;
							$dbRoomRT2 = new Database('nurse');
							$dbRoomRT2->Table = "RM_Reserv";
							$dbRoomRT2->Where = "where room_id='$dataRoom2[room_id]' AND Rs_startdate='$roomtoday' AND RS_status='3' group by room_id";
							$userRoomRT2 = $dbRoomRT2->Select();
							foreach ($userRoomRT2 as $valuesRoomRT2 => $dataRoomRT2) {
								$roomRT2++;
							}
						}
						echo "<script> var act_r = $room2; var act_r_use = $roomRT2; </script>";
						// echo $room." / ".$roomRT." / ".$room1." / ".$roomRT1." / ".$room2." / ".$roomRT2;
						?>
						<!-- <div class="col-md-3 mt-3"></div> -->
						<div class="col-md-6 d-flex align-items-center mt-3">
							<div class="card w-100 text-end border-0">
								<i style="font-size: 12px;" class="text-danger fw-bold">*** สามารถคลิ๊กที่แท่งกราฟเพื่อดูข้อมูลห้องได้ ***</i>
								<div id="roomStatusChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
							</div>
						</div>
						<div id="detail_r" class="col-md-6 mt-3 d-none"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var today = new Date().toISOString().slice(0, 10);
		var currentDate = new Date();
		// var initialYear = currentDate.getFullYear().toString(); //ปีปัจจุ บัน
		var initialYear = 2024;
		fetchData(initialYear);

		$('#year-section').change(function() {
			selectedYear = $(this).val();

			fetchData(selectedYear);
		});

		function fetchData(year) {
			$.ajax({
				url: 'config/get_data_kpi_graph.php',
				method: 'POST',
				data: {
					year: year
				},
				success: function(data) {
					$('#data_kpi').html(data);
				}
			});
		}

		var chartDom_Room = document.getElementById('roomStatusChart');
		var Chart_Room = echarts.init(chartDom_Room, 'vintage');
		var Option_Room;

		Option_Room = {
			backgroundColor: 'rgba(254,248,239,1)',
			legend: {},
			tooltip: {
				trigger: 'axis', // ทำให้ tooltip ปรากฏเมื่อชี้ที่แกน x
				axisPointer: {
					type: 'shadow' // ทำให้เป็นแบบกราฟแท่ง
				},
				formatter: function(params) {
					let content = `<b style="color:#000">${params[0].value.Room}</b><br/>`; // ใช้ชื่อห้องเป็นชื่อหลัก

					params.forEach((param) => {
						content += `<span style="color:${param.color}">${param.seriesName}</span>: ${param.data[param.seriesName]}<br/>`; // แสดงชื่อข้อมูล (จำนวนทั้งหมด, กำลังใช้งาน, ว่าง) และค่าของมัน
					});
					return content;
				}
			},
			dataset: {
				dimensions: ['Room', 'จำนวนทั้งหมด', 'กำลังใช้งาน', 'ว่าง'],
				source: [{
						Room: 'ห้องเรียน',
						'จำนวนทั้งหมด': class_r,
						'กำลังใช้งาน': class_r_use,
						'ว่าง': class_r - class_r_use
					},
					{
						Room: 'ห้องประชุม',
						'จำนวนทั้งหมด': meet_r,
						'กำลังใช้งาน': meet_r_use,
						'ว่าง': meet_r - meet_r_use
					},
					{
						Room: 'ห้องปฏิบัติการ',
						'จำนวนทั้งหมด': act_r,
						'กำลังใช้งาน': act_r_use,
						'ว่าง': act_r - act_r_use
					},
				]
			},
			xAxis: {
				type: 'category'
			},
			yAxis: {},
			series: [{
					type: 'bar',
					name: 'จำนวนทั้งหมด',
					color: "#61a0a8",
					itemStyle: {
						borderColor: '#61a0a8', // สีเส้นขอบ
						borderWidth: 2,
						borderRadius: [5, 5, 0, 0]
					}
				},
				{
					type: 'bar',
					name: 'กำลังใช้งาน',
					color: "#d87c7c",
					itemStyle: {
						borderColor: '#d87c7c', // สีเส้นขอบ
						borderWidth: 2,
						borderRadius: [5, 5, 0, 0]
					}
				},
				{
					type: 'bar',
					name: 'ว่าง',
					color: "#919e8b",
					itemStyle: {
						borderColor: '#919e8b', // สีเส้นขอบ
						borderWidth: 2,
						borderRadius: [5, 5, 0, 0]
					}
				}
			]
		};

		Chart_Room.setOption(Option_Room);

		Chart_Room.on('click', function(params) {
			// ตรวจสอบว่าเป็นการคลิกที่ label หรือไม่
			if (params.componentType === 'series') {
				// คำสั่งที่ทำเมื่อคลิกที่กราฟแท่ง หรือ label
				let a, b;

				// ตรวจสอบห้องที่คลิก
				if (params.data.Room === 'ห้องเรียน') {
					a = 1;
				} else if (params.data.Room === 'ห้องประชุม') {
					a = 2;
				} else if (params.data.Room === 'ห้องปฏิบัติการ') {
					a = 3;
				}

				// ตรวจสอบประเภทของข้อมูลที่คลิก
				if (params.seriesName === 'จำนวนทั้งหมด') {
					b = 1;
				} else if (params.seriesName === 'กำลังใช้งาน') {
					b = 2;
				} else if (params.seriesName === 'ว่าง') {
					b = 3;
				}

				// ส่งคำขอ AJAX เมื่อคลิก
				$.ajax({
					url: 'config/gen_Detail_R.php',
					method: 'POST',
					data: {
						date_r: today,
						type_r: a,
						statu_r: b
					},
					success: function(data) {
						$('#detail_r').removeClass('d-none');
						$('#detail_r').html(data);
					}
				});
			}
		});

		window.addEventListener('resize', function() {
			Chart_Room.resize();
			Chart_Db.resize();
		});
	});
</script>