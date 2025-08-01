<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>วิชาการ</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d")); ?></p>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-4">
			<label for="project_Year" class="form-label"><strong>ปีการศึกษา</strong></label>
			<select id="project_Year" class="form-select" name="project_Year">
				<option selected disabled value="">เลือก</option>

				<option value="2023">2566</option>

			</select>
		</div> -->
		<!-- <div class="col-md-4">
			<label for="project_Year" class="form-label"><strong>ภาคการศึกษา</strong></label>
	    <select id="project_Year" class="form-select" name="project_Year">
	      <option selected disabled value="">เลือก</option>
	      
	      <option value="2023">2566</option>
	      
	    </select>
		</div> -->
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">จำนวนนิสิตทั้งหมดของคณะพยาบาลศาสตร์มหาวิทยาลัยบูรพา</h2>
						</div>
						<?php
							$drow5 = $ba = $ba_1 = $ba_2 = $ba_3 = $ba_4 = $ba_other = $ba_Th = $ba_In = 0;
							$db31 = new Database('nurse');
							$db31->Table = "stud_data";
							$db31->Where = "Where stud_level <> '1' And stud_status = '3'  order by stud_id  desc";
							$user31 = $db31->Select();
							foreach ($user31 as $values31 => $data31) { $drow5++;
								if ($data31['stud_level'] == 2 || $data31['stud_level'] == 3) {
									$ba++;
									if (substr($data31['student_id'], 0, 2) == "66") {
										$ba_1++;
									}else
									if (substr($data31['student_id'], 0, 2) == "65") {
										$ba_2++;
									}else
									if (substr($data31['student_id'], 0, 2) == "64") {
										$ba_3++;
									}else
									if (substr($data31['student_id'], 0, 2) == "63") {
										$ba_4++;
									}else{
										$ba_other++;
									}
									if ($data31['stud_level'] == 2) {
										$ba_Th++;
									}
									if ($data31['stud_level'] == 3) {
										$ba_In++;
									}
								}
								if ($data31['stud_level'] == 4 || $data31['stud_level'] == 5) {
									$mas++;
									if ($data31['stud_majer'] == "66") { //ผดุง
										$ma_++;
									}else
									if ($data31['stud_majer'] == "65") {  //สูงอายุ
										$ma_++;
									}else
									if ($data31['stud_majer'] == "64") {  //เด็ก
										$ma_++;
									}else
									if ($data31['stud_majer'] == "63") {  //ชุมชน
										$ma_++;
									}
									if ($data31['stud_majer'] == "66") {  //ใหญ่และสูง
										$ma_++;
									}else
									if ($data31['stud_majer'] == "65") {  //จิต
										$ma_++;
									}else
									if ($data31['stud_majer'] == "65") {  //นานา
										$ma_++;
									}
									if ($data31['stud_time'] == 1) { //เต็มเวลา
										$mas_time_f++;
									}else if($data31['stud_time'] == 2){ //ไม่เต็มเวลา
										$mas_time_uf++;
									}
								}
								if ($data31['stud_level'] == 7 || $data31['stud_level'] == 8) {
									$doc++;
									if (substr($data31['student_id'], 0, 2) == "66") {
										$doc_1++;
									}else
									if (substr($data31['student_id'], 0, 2) == "65") {
										$doc_2++;
									}else
									if (substr($data31['student_id'], 0, 2) == "64") {
										$doc_3++;
									}else
									if (substr($data31['student_id'], 0, 2) == "63") {
										$doc_4++;
									}else
									if (substr($data31['student_id'], 0, 2) == "62") {
										$doc_5++;
									}else
									if (substr($data31['student_id'], 0, 2) == "61") {
										$doc_6++;
									}
								}
							}
							$stud = $drow5;
						?>

						<div class="col-md-12 p-5 text-center">
							<!-- <a href="Page.php?feed=Aca_perall"> -->
							<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;">1,180 <!-- 823 + ป.โท --> คน</h1> <!-- $stud --> <!-- 1,054 คน -->
							<!-- </a> -->
						</div>
						<div class="col-md-12 p-2">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6 text-center">
									<canvas id="myChart1"></canvas>
								</div>
							</div>

							<script>
								const data_Q = {
									labels: ["ปัจจุบัน"],
									datasets: [{
											label: 'ป.ตรี',
											data: [790], //710
											backgroundColor: ['rgba(76, 120, 168, 1)'],
											borderColor: ['rgba(1, 1, 1, 1)'],
											borderWidth: 1
										},
										{
											label: 'ป.โท',
											data: [357], // 308
											backgroundColor: ['rgba(245, 133, 24, 1)'], 
											borderColor: ['rgba(1, 1, 1, 1)'],
											borderWidth: 1
										}, {
											label: 'ป.เอก',
											data: [33], //36
											backgroundColor: ['rgba(228, 87, 86, 1)'],
											borderColor: ['rgba(1, 1, 1, 1)'],
											borderWidth: 1
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
										const backgroundHeight = 200;
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
										// layout:{
										// 	autoPadding : true,
										// },
										aspectRatio: 0.8,
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

								const myChart1 = new Chart(document.getElementById('myChart1'), config_Q, plugin_Q);
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">ปริญญาตรี</h2>
						</div>

						<div class="col-md-12 p-5 text-center">
							<!-- <a href="Page.php?feed=Aca_Bac"> -->
							<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;">790 คน</h1> <!-- $ba -->
							<!-- </a> -->
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
									<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
										<div class="card-header text-center">
											จำนวนนิสิตแต่ละชั้นปี
										</div>
										<div class="card-body">
											<canvas id="myChart11"></canvas>
											<script>
												// <?php echo $ba_1;?> ปี1
												// <?php echo $ba_2;?> ปี2
												// <?php echo $ba_3;?> ปี3
												// <?php echo $ba_4;?> ปี4
												// <?php echo $ba_other;?> อื่นๆ
												const data_jou = {
													labels: ["ปัจจุบัน", ],
													datasets: [{
															label: 'ชั้นปีที่ 1',
															data: [242], //188
															backgroundColor: ['rgba(76, 120, 168, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														},
														{
															label: 'ชั้นปีที่ 2',
															data: [182], //200
															backgroundColor: ['rgba(245, 133, 24, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														}, {
															label: 'ชั้นปีที่ 3',
															data: [198], //168
															backgroundColor: ['rgba(228, 87, 86, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														}, {
															label: 'ชั้นปีที่ 4',
															data: [166], //174
															backgroundColor: ['rgba(114, 183, 178, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														},
														{
															label: 'อื่นๆ',
															data: [2], //7
															backgroundColor: ['rgb(92, 184, 92)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
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
														aspectRatio: 0.8,
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
													plugins: [plugin_jou],
												};
												const myChart11 = new Chart(document.getElementById('myChart11'), config_jou, plugin_jou);
											</script>
										</div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
										<div class="card-header text-center">
											จำนวนนิสิตในหลักสูตร ไทย/EP
										</div>
										<div class="card-body">
											<canvas id="doughnutChart1"></canvas>
											<script>
												//doughnut
												const data_crous = {
													labels: ["หลักสูตรไทย", "หลักสูตรEP"],
													datasets: [{
														data: [753, 37], // <?php echo $ba_Th;?> <?php echo $ba_In;?> 691, 19
														label: 'จำนวนนิสิต',
														backgroundColor: ["#F7464A", "rgb(92, 184, 92)"],
														hoverBackgroundColor: ["#FF5A5E", "rgb(117, 209, 117)"],
														borderColor: ["#000000", "#000000"],
														hoverBorderColor: ["#fff", "#fff"],
														borderWidth: 1,
													}],
												};

												const plugin_crous = {
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

												const config_crous = {
													type: 'doughnut',
													data: data_crous,
													options: {
														layout: {
															autoPadding: true,
														},
														aspectRatio: 0.8,
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
															// tooltip: {
															// 	mode: 'index',
															// 	intersect: false,
															// 	displayColors: true,
															// },
														},
													},
													plugins: [plugin_crous],
												};
												const doughnutChart1 = new Chart(document.getElementById('doughnutChart1'), config_crous, plugin_crous);
											</script>
										</div>
									</div>
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
						<div class="col-md-12">
							<h2 class="card-title text-center">ปริญญาโท</h2>
						</div>

						<div class="col-md-12 p-5 text-center">
							<!-- <a href="Page.php?feed=Aca_Mas"> -->
							<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;">357 คน</h1> <!-- $mas --> <!-- 308 คน -->
							<!-- </a> -->
						</div>

						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
									<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
										<div class="card-header text-center">
											จำนวนนิสิตแต่ละปี
										</div>
										<div class="card-body">
											<canvas id="myChart12"></canvas>
											<script>
												const data_mas = {
													labels: ["62", "63", "64", "65", "66", "67"], //["61", "62", "63", "64", "65", "66"
													datasets: [{
															label: 'เต็มเวลา',
															data: [3, 13, 20, 22, 12, 19], //[2, 21, 37, 48, 48, 36]
															backgroundColor: ['rgba(76, 120, 168, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														},
														{
															label: 'ไม่เต็มเวลา',
															data: [6, 19, 23, 27, 30, 38], // [3, 10, 23, 25, 28, 27]
															backgroundColor: ['rgba(245, 133, 24, 1)'],
															borderColor: ['rgba(1, 1, 1, 1)'],
															borderWidth: 1
														}
													],
												};

												const plugin_mas = {
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

												const config_mas = {
													type: 'bar',
													data: data_mas,
													options: {
														layout: {
															autoPadding: true,
														},
														aspectRatio: 0.8,
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
													plugins: [plugin_mas],
												};
												const myChart12 = new Chart(document.getElementById('myChart12'), config_mas, plugin_mas);
											</script>
										</div>
									</div>
								</div>
								<div class="col-md-6 text-center">
									<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
										<div class="card-header text-center">
											จำนวนนิสิตแบ่งแยกแต่ละสาขา
										</div>
										<div class="card-body">
											<canvas id="doughnutChart11"></canvas>
											<script>
												//doughnut

												const data_branch = {
													labels: ["สาขาวิชาการผดุงครรภ์", "สาขาการพยาบาลผู้สูงอายุ", "สาขาการพยาบาลเด็ก", "สาขาวิชาการพยาบาลเวชปฏิบัติชุมชน", "สาขาวิชาการพยาบาลผู้ใหญ่และผู้สูงอายุ", "สาขาวิชาการพยาบาลจิตเวชและสุขภาพจิต", "สาขาวิชาการพยาบาลเวชปฏิบัติผู้สูงอายุ", "หลักสูตรนานาชาติ"],
													datasets: [{
														data: [48, 15, 26, 60, 42, 27, 14, 125], // [35, 18, 23, 54, 36, 22, 120]
														label: 'จำนวนนิสิต',
														backgroundColor: ["rgba(228,87,86,1)", "rgba(92, 184, 92, 1)", "rgba(245,133,24,1)", "rgba(0,139,239,1)", "rgba(114,183,178,1)", "rgba(5,0,250,1)" , "rgba(5,0,100,1)", "rgba(103,64,40,1)"],
														hoverBackgroundColor: ["rgba(228,87,86,0.7)", "rgba(117, 209, 117,0.7)", "rgba(245,133,24,0.7)", "rgba(0,139,239,0.7)", "rgba(114,183,178,0.7)", "rgba(5,0,250,0.7)" , "rgba(5,0,100,0.7)", "rgba(103,64,40,0.7)"],
														borderColor: ["#000000", "#000000", "#000000", "#000000", "#000000", "#000000", "#000000", "#000000"],
														hoverBorderColor: ["#fff", "#fff", "#fff", "#fff", "#fff", "#fff", "#fff", "#fff"],
														borderWidth: 1
													}],
												};

												const plugin_branch = {
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

												const config_branch = {
													type: 'doughnut',
													data: data_branch,
													options: {
														layout: {
															autoPadding: true,
														},
														aspectRatio: 0.8,
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
																	padding: 10,
																	color: 'rgba(1,1,1,1)',
																},
															},
															// tooltip: {
															// 	mode: 'index',
															// 	intersect: false,
															// 	displayColors: true,
															// },
														},
													},
													plugins: [plugin_branch],
												};
												const doughnutChart11 = new Chart(document.getElementById('doughnutChart11'), config_branch, plugin_branch);
											</script>
										</div>
									</div>
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
						<div class="col-md-12">
							<h2 class="card-title text-center">ปริญญาเอก</h2>
						</div>
						<div class="col-md-12 p-5 text-center">
							<!-- <a href="Page.php?feed=Aca_Ph"> -->
							<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;">33 คน</h1> <!-- $doc --> <!-- 36 คน -->
							<!-- </a> -->
						</div>
						<div class="col-md-12 p-2">
							<div class="row">
								<div class="col-md-3"></div>
								<div class="col-md-6 text-center">
									<canvas id="myChart10"></canvas>
								</div>
							</div>
							<script>
								// $doc_1 $doc_2 $doc_3 $doc_4 $doc_5 $doc_6
								const data_Ph = {
									labels: ["61", "62", "63", "64", "65", "66", "67"], //  ["61", "62", "63", "64", "65", "66"]
									datasets: [{
										label: 'จำนวนนิสิต',
										data: [1, 7, 3, 8, 3, 11, 0], //[1, 10, 5, 8, 3, 9]
										backgroundColor: ['rgba(76, 120, 168, 1)'],
										borderColor: ['rgba(1, 1, 1, 1)'],
										borderWidth: 1
									}],
								};

								const plugin_Ph = {
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

								const config_Ph = {
									type: 'bar',
									data: data_Ph,
									options: {
										layout: {
											autoPadding: true,
										},
										aspectRatio: 0.8,
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
									plugins: [plugin_Ph],
								};
								const myChart10 = new Chart(document.getElementById('myChart10'), config_Ph, plugin_Ph);
							</script>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- row g-3 -->
</div> <!-- contaniner -->