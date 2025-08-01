<?php
	function calculateAge($birthdate)
	{
		// ตรวจสอบถ้าวันที่เป็น 0000-00-00 หรือว่างเปล่า
		if ($birthdate === '0000-00-00' || empty($birthdate)) {
			return 0;
		}

		// แปลงวันเกิดเป็น DateTime object
		$birthDate = new DateTime($birthdate);
		$currentDate = new DateTime(); // วันที่ปัจจุบัน

		// คำนวณความแตกต่างระหว่างวันเกิดกับวันปัจจุบัน
		$age = $birthDate->diff($currentDate);

		// ส่งคืนอายุในรูปแบบปี
		return $age->y;
	}
	function calculateAverageAge($totalAge, $totalPeople)
	{
		if ($totalPeople <= 0) {
			return 0; // ป้องกันการหารด้วยศูนย์
		}
		return $totalAge / $totalPeople;
	}
	function calculateGeneration($birthdate)
	{
		// ตรวจสอบว่าวันเกิดเป็น "0000-00-00" หรือไม่
		if ($birthdate == "0000-00-00") {
			return "Unknown";
		}

		// แปลงวันเกิดเป็นปี
		$birthYear = (int)date('Y', strtotime($birthdate));

		// ตรวจสอบช่วงปีเกิดเพื่อหา Generation
		if ($birthYear >= 1946 && $birthYear <= 1964) {
			return "Baby Boomer";
		} elseif ($birthYear >= 1965 && $birthYear <= 1980) {
			return "Gen X";
		} elseif ($birthYear >= 1981 && $birthYear <= 1996) {
			return "Gen Y";
		} elseif ($birthYear >= 1997) {
			return "Gen Z";
		} else {
			return "Unknown";
		}
	}
	function countGenerations($birthdates)
	{
		$generationCounts = [
			"Gen X" => 0,
			"Gen Y" => 0,
			"Gen Z" => 0,
			"Baby Boomer" => 0,
			"Unknown" => 0
		];

		foreach ($birthdates as $birthdate) {
			$gen = calculateGeneration($birthdate);
			$generationCounts[$gen]++;
		}

		return $generationCounts;
	}
	function countEmployees($startDate, $endDate)
	{
		$count_started = 0;
		$count_left = 0;
		$count_still = 0;
		$count_not_set = 0;

		$dbWorkFac = new Database('nurse');
		$dbWorkFac->Table = "user_WorkFac1";
		$dbWorkFac->Where = "WHERE work_StartDate < '$endDate' AND (work_EndDate >= '$startDate' OR work_EndDate = '0000-00-00')";
		$workFacStart = $dbWorkFac->Select();
		foreach ($workFacStart as $work) {
			if ($work['work_StartDate'] != "0000-00-00") {
				$count_started++;
			}

			if ($work['work_EndDate'] != '0000-00-00') {
				if ($work['work_EndDate'] >= $startDate && $work['work_EndDate'] <= $endDate) {
					$count_left++; // นับคนที่ลาออกในช่วงเวลา
				} else {
					$count_still++; // คนที่ยังทำงานอยู่ (work_EndDate ไม่อยู่ในช่วง)
				}
			} elseif ($work['work_StartDate'] == "0000-00-00") {
				$count_not_set++; // ข้อมูลยังไม่สมบูรณ์ (ทั้ง Start และ End เป็น 0000-00-00)
			} else {
				$count_still++; // คนที่ยังทำงานอยู่ (work_EndDate = '0000-00-00')
			}
		}

		$a = ($count_started + $count_still) / 2;
		$turnover_rate = $count_started > 0 ? ($count_left / $a) * 100 : 0;

		return [
			'started' => $count_started,
			'left' => $count_left,
			'still' => $count_still,
			'not_set' => $count_not_set,
			'turnover_rate' => round($turnover_rate, 2)
		];
	}
?>
<style>
	.col-md-6{
		border-right: 1px solid;
	}
</style>
<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>งานบุคคล</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d")); ?></p>
				</div>
			</div>
		</div>
		<div class="row g-3">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="row g-3">
							<div class="col-md-12">
								<!-- 1. -->
								<h3>จำนวน</h3>
								<?php $row = $female_tec = $tec = $age_ar = $palsor = $thro_a = $none_gend_tec = $aor = $lowsor = $Director = $male_tec = $tree_a = $sor = $ake_a = $pers = 0;
								$patum_a = $mutthathon_a = $mutthaplai_a = $pwsor_a = $pwsos_a = $patum_p = $mutthathon_p = $mutthaplai_p = $pwsor_p = $pwsos_p = $tree_p = $thro_p = $ake_p = 0;
								$wut = $chane = $chum_s = $chum = $Pkran = $age_per = $male_per = $female_per = $none_gend_per = 0;
								$gen = array();
								$dbPerson = new Database('nurse');
								$dbPerson->Table = "user_data1";
								$dbPerson->Where = "where user_Status = '1' order by user_Status";
								$userPerson = $dbPerson->Select();
								foreach ($userPerson as $valuesPerson => $dataPerson) {

									$dbAcadamicHis = new Database('nurse');
									$dbAcadamicHis->Table = "user_PositionAcademicHistory1";
									$dbAcadamicHis->Where = "where ud_id='$dataPerson[ud_id]' AND aph_status='1' order by aph_id";
									$userAcadamicHis = $dbAcadamicHis->Select();
									foreach ($userAcadamicHis as $valuesAcadamicHis => $dataAcadamicHis) {

										$dbAcadamic = new Database('nurse');
										$dbAcadamic->Table = "user_PositionAcademic1";
										$dbAcadamic->Where = "where ap_id='$dataAcadamicHis[ap_id]' AND ap_status = '1'";
										$userAcadamic = $dbAcadamic->Select();
										foreach ($userAcadamic as $valuesAcadamic => $dataAcadamic) {
											$gen[] = $dataPerson['user_BirthDay'];
											$dbEducation = new Database('nurse');
											$dbEducation->Table = "user_education1";
											$dbEducation->Where = "where edu_user = $dataPerson[ud_id] order by edu_level DESC LIMIT 1 ";
											$userEducation = $dbEducation->Select();

											$dbEducationM = new Database('nurse');
											$dbEducationM->Table = "user_PositionEducationManageHistory1";
											$dbEducationM->Where = "where ud_id = $dataPerson[ud_id] order by pemh_id LIMIT 1 ";
											$userEducationM = $dbEducationM->Select();

											if ($dataAcadamic['ap_type'] == 1) {
												switch ($dataPerson['user_Gender']) {
													case '1':
														$gender_tec = "ชาย";
														$male_tec++;
														break;
													case '2':
														$gender_tec = "หญิง";
														$female_tec++;
														break;

													default:
														$gender_tec = "ไม่ได้ระบุ";
														$none_gend_tec++;
														break;
												}

												$tec++;
												$age_ar += calculateAge($dataPerson['user_BirthDay']);
												$age_r = calculateAge($dataPerson['user_BirthDay']);
												$gen_r = calculateGeneration($dataPerson['user_BirthDay']);

												// echo "<div class='row'>";
												// echo "<div class='col-md-4'>";
												// echo $tec . " . ชื่อ: " . $dataPerson['user_FNameTH'] . " / " . $dataPerson['user_LNameTH'];
												// echo "</div>";
												// echo "<div class='col-md-2'>";
												// echo "Gender : " . $gender_tec;
												// echo "</div>";
												// echo "<div class='col-md-4'>";
												// echo "วันเกิด: " . ($dataPerson['user_BirthDay'] == "0000-00-00" ? "<b class='text-danger'>ไม่ระบุ</b>" : $dataPerson['user_BirthDay']) . " อายุ: " . ($age_r == 0 ? "<b class='text-danger'>ไม่ระบุ</b>" : $age_r . " ปี");
												// echo "</div>";
												// echo "<div class='col-md-2'>";
												// echo "Gen : " . $gen_r;
												// echo "</div>";
												// echo "</div>";
												switch ($dataAcadamic['ap_id']) {
													case '1': {
															$sor++;
															break;
														}
													case '2': {
															$lowsor++;
															break;
														}
													case '3': {
															$palsor++;
															break;
														}
													case '4': {
															$aor++;
															break;
														}
												}
												foreach ($userEducation as $valuesEducation => $dataEducation) {
													switch ($dataEducation['edu_level']) {
														case '1': {
																$patum_a++;
																break;
															}
														case '2': {
																$mutthathon_a++;
																break;
															}
														case '3': {
																$mutthaplai_a++;
																break;
															}
														case '4': {
																$pwsor_a++;
																break;
															}
														case '5': {
																$pwsos_a++;
																break;
															}
														case '6': {
																$tree_a++;
																break;
															}
														case '7': {
																$thro_a++;
																break;
															}
														case '8': {
																$ake_a++;
																break;
															}
													}
												}
												foreach ($userEducationM as $valuesEducationM => $dataEducationM) {
													switch ($dataEducationM['pem_id']) {
														case '15':
															$Director++;
															break;

														case '48':
															$Tec_cur++;
															break;

														case '49':
															$Tec_Cou++;
															break;

														case '52':
															$Teacher++;
															break;
													}
												}
											}
											if ($dataAcadamic['ap_type'] == 2) {
												switch ($dataPerson['user_Gender']) {
													case '1':
														$gender = "ชาย";
														$male_per++;
														break;
													case '2':
														$gender = "หญิง";
														$female_per++;
														break;

													default:
														$gernder = "ไม่ได้ระบุ";
														$none_gend_per++;
														break;
												}
												$pers++;
												$age_per += calculateAge($dataPerson['user_BirthDay']);
												switch ($dataAcadamic['ap_id']) {
													case '5': {
															$wut++;
															break;
														}
													case '6': {
															$chane++;
															break;
														}
													case '7': {
															$chum_s++;
															break;
														}
													case '8': {
															$chum++;
															break;
														}
													case '9': {
															$Pkran++;
															break;
														}
												}
												foreach ($userEducation as $valuesEducation => $dataEducation) {
													switch ($dataEducation['edu_level']) {
														case '1': {
																$patum_p++;
																break;
															}
														case '2': {
																$mutthathon_p++;
																break;
															}
														case '3': {
																$mutthaplai_p++;
																break;
															}
														case '4': {
																$pwsor_p++;
																break;
															}
														case '5': {
																$pwsos_p++;
																break;
															}
														case '6': {
																$tree_p++;
																break;
															}
														case '7': {
																$thro_p++;
																break;
															}
														case '8': {
																$ake_p++;
																break;
															}
													}
												}
											}
										}
									}
								}

								$age_ar_aver = calculateAverageAge($age_ar, $tec);
								echo "<hr>";
								echo "อาจารย์ : <b>" . $tec . "</b> คน<br>บุคลากร : <b>" . $pers . "</b> คน";
								?>
							</div>
							<hr>
							<div class="col-md-12">
								<!-- 2. -->
								<h3>วุฒิการศึกษา</h3>
							</div>
							<div class="col-md-6">
								
								<?php
								echo "<b>อาจารย์</b> <br> ประถม : <b>" . $patum_a . "</b> คน<br>มัธยมต้น : <b>" . $mutthathon_a . "</b> คน<br>มัธยมปลาย : <b>" . $mutthaplai_a . "</b> คน<br>ปวช : <b>" . $pwsor_a . "</b> คน<br>ปวส : <b>" . $pwsos_a . "</b> คน<br>ปริญญาตรี : <b>" . $tree_a . "</b> คน<br>ปริญญาโท : <b>" . $thro_a . "</b> คน<br>ปริญญาเอก : <b>" . $ake_a . "</b> คน <br>";
								?>
							</div>
							<div class="col-md-6">

								<?php
								echo "<b>บุคลากร</b> <br> ประถม : " . $patum_p . " คน<br>มัธยมต้น : " . $mutthathon_p . " คน<br>มัธยมปลาย : " . $mutthaplai_p . " คน<br>ปวช : " . $pwsor_p . " คน<br>ปวส : " . $pwsos_p . " คน<br>ปริญญาตรี : " . $tree_p . " คน<br>ปริญญาโท : " . $thro_p . " คน<br>ปริญญาเอก : " . $ake_p . " คน";
								?>
							</div>
							<hr>
							<div class="col-md-6">
								<!-- 3. -->
								<h3>ตำแหน่งวิชาการ</h3>
								<?php
								echo "<b>อาจารย์</b> <br> ศาสตราจารย์ : " . $sor . " คน<br>รองศาสตราจารย์ : " . $lowsor . " คน<br>ผู้ช่วยศาสตราจารย์ : " . $palsor . " คน<br>อาจารย์ : " . $aor . " คน<br>";
								?>
								<input type="hidden" id="sor" value="<?php echo $sor; ?>">
								<input type="hidden" id="lowsor" value="<?php echo $lowsor; ?>">
								<input type="hidden" id="palsor" value="<?php echo $palsor; ?>">
								<input type="hidden" id="aor" value="<?php echo $aor; ?>">
								<div id="Academic" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
								<script>
									var sor = $("#sor").val();
									var lowsor = $("#lowsor").val();
									var palsor = $("#palsor").val();
									var aor = $("#aor").val();

									var chartDom = document.getElementById('Academic');
									var AcademicChart = echarts.init(chartDom, 'vintage');
									var optionAcademic;

									optionAcademic = {
										backgroundColor: 'rgba(254,248,239,1)',
										title: {
											text: 'แยก Academic',
											left: 'center',
											top: '5%',
											textStyle: {
												color: '#d7ab82'
											}
										},
										tooltip: {
											trigger: 'item',
											formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, จำนวน, และอัตราร้อยละใน tooltip
										},
										legend: {
											top: '15%',
											left: 'center'
										},
										series: [{
											top: '60',
											name: 'Access From',
											type: 'pie',
											radius: ['40%', '70%'],
											avoidLabelOverlap: false,
											padAngle: 5,
											itemStyle: {
												borderRadius: 10
											},
											label: {
												show: false,
												position: 'center'
											},
											emphasis: {
												label: {
													show: true,
													fontSize: 20,
													fontWeight: 'bold',
													formatter: function(params) {
														return `${params.name}\n${params.percent}%`;
													},
													color: '#000' // ปรับสีข้อความให้ชัดเจน
												}
											},
											labelLine: {
												show: false
											},
											data: [{
													value: sor,
													name: "ศาสตราจารย์",

													itemStyle: {
														color: "#787464",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: lowsor,
													name: "รองศาสตราจารย์",

													itemStyle: {
														color: "#cc7e63",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: palsor,
													name: "ผู้ช่วยศาสตราจารย์",

													itemStyle: {
														color: "#724e58",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: aor,
													name: "อาจารย์",

													itemStyle: {
														color: "#4b565b",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												}
											]
										}]
									};


									optionAcademic && AcademicChart.setOption(optionAcademic);
									window.addEventListener('resize', function() {
										AcademicChart.resize();
									});
								</script>
							</div>
							<div class="col-md-6">
								<?php
								echo "<b>บุคลากร</b> <br> ผู้ทรงคุณวุฒิ : " . $wut . " คน<br>ผู้เชี่ยวชาญ : " . $chane . " คน<br>ชำนาญการพิเศษ : " . $chum_s . " คน<br>ชำนาญการ : " . $chum . " คน<br>ปฏิบัติการ : " . $Pkran . " คน<br>";
								?>
							</div>
							<hr>
							<div class="col-md-12">
								<!-- 7. -->
								<h3>อายุเฉลี่ย</h3>
								<div class="row">
									<div class="col-md-6">
										<b>อาจารย์</b>
										<p><?php echo number_format($age_ar_aver); ?></p>
									</div>
									<div class="col-md-6">
										<b>บุคลากร</b>
										<p><?php
											if ($age_per == 0) {
												echo "ไม่มี";
											} else {
												echo $age_per;
											}
											?></p>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-md-12">
								<!-- 8. -->
								<h3>แยก Gen</h3>
								<?php
								$result = countGenerations($gen);

								foreach ($result as $generation => $count) {
									echo "<p>$generation: $count คน </p>";
								}
									// echo "<p>".$result['generationCounts']."</p>";
									$genX = $result['Gen X'];
									$genY = $result['Gen Y'];
									$genZ = $result['Gen Z'];
									$babyBoomer = $result['Baby Boomer'];
									$unknown = $result['Unknown'];
								
								echo $genX . ' / ' . $genY . ' / ' . $genZ . ' / ' . $babyBoomer . ' / ' . $unknown;
								?>
								<input type="hidden" id="genX" value="<?php echo $genX; ?>">
								<input type="hidden" id="genY" value="<?php echo $genY; ?>">
								<input type="hidden" id="genZ" value="<?php echo $genZ; ?>">
								<input type="hidden" id="babyBoomer" value="<?php echo $babyBoomer; ?>">
								<input type="hidden" id="unknown" value="<?php echo $unknown; ?>">
								<div id="Generation" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
								<script>
									var genX = $("#genX").val();
									var genY = $("#genY").val();
									var genZ = $("#genZ").val();
									var babyBoomer = $("#babyBoomer").val();
									var unknown = $("#unknown").val();

									var chartDom = document.getElementById('Generation');
									var GenerationChart = echarts.init(chartDom, 'vintage');
									var optionGeneration;

									optionGeneration = {
										backgroundColor: 'rgba(254,248,239,1)',
										title: {
											text: 'แยก Generation',
											left: 'center',
											top: '5%',
											textStyle: {
												color: '#d7ab82'
											}
										},
										tooltip: {
											trigger: 'item',
											formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, จำนวน, และอัตราร้อยละใน tooltip
										},
										legend: {
											top: '15%',
											left: 'center'

										},
										series: [{
											top: '60',
											name: 'Access From',
											type: 'pie',
											radius: ['40%', '70%'],
											avoidLabelOverlap: false,
											padAngle: 5,
											itemStyle: {
												borderRadius: 10
											},
											label: {
												show: false,
												position: 'center'
											},
											emphasis: {
												label: {
													show: true,
													fontSize: 20,
													fontWeight: 'bold',
													formatter: function(params) {
														return `${params.name}\n${params.percent}%`;
													},
													color: '#000' // ปรับสีข้อความให้ชัดเจน
												}
											},
											labelLine: {
												show: false
											},
											data: [{
													value: genX,
													name: "Gen X",

													itemStyle: {
														color: "#787464",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: genY,
													name: "Gen Y",

													itemStyle: {
														color: "#cc7e63",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: genZ,
													name: "Gen Z",

													itemStyle: {
														color: "#724e58",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: babyBoomer,
													name: "babyBoomer",

													itemStyle: {
														color: "#4b565b",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												},
												{
													value: unknown,
													name: "unknown",

													itemStyle: {
														color: "#dddddd",
														borderColor: '#6e7074', // สีเส้นขอบ
														borderWidth: 1 // ความหนาของเส้นขอบ
													}
												}
											]
										}]
									};


									optionGeneration && GenerationChart.setOption(optionGeneration);
									window.addEventListener('resize', function() {
										GenerationChart.resize();
									});
								</script>
							</div>
							<hr>
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<!-- 9. -->
										<h3>Turn Over rate</h3>
									</div>
									<div class="col-md-2 text-end">
										<label for="year-section" class="col-form-label">ปี</label>
									</div>
									<div class="col-md-4 text-end" style="font-weight: 900;">
										<?php
										$currentYear = date("Y"); // ปีปัจจุบัน

										echo '<select class="form-select select-sm" name="year-section" id="year-section">';

										for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {

											echo '<option value="' . $year . '"';
											if ($year == $currentYear) {
												echo ' selected';
											}
											echo '>' . ($year + 543) . '</option>';
										}
										echo '</select>';
										?>
									</div>
									<hr class="mt-3 mb-3">
									<?php $year = 2025; ?>
									<div class="col-md-4">
										<?php
										// ช่วงปีปกติ
										$startDate_normal = "$year-01-01";
										$endDate_normal = "$year-12-31";
										$employees_normal = countEmployees($startDate_normal, $endDate_normal);

										echo "<b>ปีปกติ:</b>";
										echo "<p>เริ่มงาน: {$employees_normal['started']} คน</p>";
										echo "<p>ลาออก: {$employees_normal['left']} คน</p>";
										echo "<p>ยังอยู่: {$employees_normal['still']} คน</p>";
										echo "<p>ยังไม่กรอกข้อมูล : {$employees_normal['not_set']} คน</p>";
										echo "<p>อัตราการลาออก (Turnover Rate): {$employees_normal['turnover_rate']}%</p>";
										?>
										<div id="normal-chart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
										<div class="card d-none">
											<span>
												<p>อัตราการลาออก (Turnover Rate) : </p><b id="turn_normal"></b><p> %</p>
											</span>
										</div>
									</div>
									<div class="col-md-4">
										<?php
										// ช่วงปีงบประมาณ
										$startDate_fiscal = ($year - 1) . "-10-01";
										$endDate_fiscal = "$year-09-30";
										$employees_fiscal = countEmployees($startDate_fiscal, $endDate_fiscal);

										echo "<b>ปีงบประมาณ:</b>";
										echo "<p>เริ่มงาน: {$employees_fiscal['started']} คน</p>";
										echo "<p>ลาออก: {$employees_fiscal['left']} คน</p>";
										echo "<p>ยังอยู่: {$employees_fiscal['still']} คน</p>";
										echo "<p>ยังไม่กรอกข้อมูล : {$employees_fiscal['not_set']} คน</p>";
										echo "<p>อัตราการลาออก (Turnover Rate): {$employees_fiscal['turnover_rate']}%</p>";
										?>
										<div id="fiscal-chart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
										<div class="card d-none">
											<span>
												<p>อัตราการลาออก (Turnover Rate) : </p><b id="turn_fiscal"></b><p> %</p>
											</span>
										</div>
									</div>
									<div class="col-md-4">
										<?php
										// ช่วงปีการศึกษา
										$startDate_academic = "$year-07-01";
										$endDate_academic = ($year + 1) . "-06-30";
										$employees_academic = countEmployees($startDate_academic, $endDate_academic);

										echo "<b>ปีการศึกษา:</b>";
										echo "<p>เริ่มงาน: {$employees_academic['started']} คน</p>";
										echo "<p>ลาออก: {$employees_academic['left']} คน</p>";
										echo "<p>ยังอยู่: {$employees_academic['still']} คน</p>";
										echo "<p>ยังไม่กรอกข้อมูล : {$employees_academic['not_set']} คน</p>";
										echo "<p>อัตราการลาออก (Turnover Rate): {$employees_academic['turnover_rate']}%</p>";
										?>
										<div id="academic-chart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
										<div class="card d-none">
											<span>
												<p>อัตราการลาออก (Turnover Rate) : </p><b id="turn_academic"></b><p> %</p>
											</span>
										</div>
									</div>
								</div>
								<script>
									var selectedYear = null;
									var currentDate = new Date();
									var initialYear = currentDate.getFullYear().toString(); //ปีปัจจุ บัน
									fetchData(initialYear);

									$('#year-section').change(function() {
										selectedYear = $(this).val();

										fetchData(selectedYear);
									});

									function fetchData(year) {
										$.ajax({
											type: "POST",
											url: 'config/get_userwork.php',
											data: {
												year: year
											},
											success: function(response) {
												createChart(
													'normal-chart',
													'Turnover Rate (ปีปกติ)',
													response.normal.started,
													response.normal.left,
													response.normal.still,
													response.normal.not_set
												);
												createChart(
													'fiscal-chart',
													'Turnover Rate (ปีงบประมาณ)',
													response.fiscal.started,
													response.fiscal.left,
													response.fiscal.still,
													response.fiscal.not_set
												);
												createChart(
													'academic-chart',
													'Turnover Rate (ปีการศึกษา)',
													response.academic.started,
													response.academic.left,
													response.academic.still,
													response.academic.not_set
												);
												$('#turn_normal').text(response.normal.turnover_rate);
												$('#turn_fiscal').text(response.fiscal.turnover_rate);
												$('#turn_academic').text(response.academic.turnover_rate);
											}

										});
									}

									function createChart(elementId, title, started, left, still, not_set) {
										var chartDom = document.getElementById(elementId);
										var myChart = echarts.init(chartDom);

										var option = {
											backgroundColor: 'rgba(254,248,239,1)',
											title: {
												text: title,
												left: 'center',
												top: '5%',
												textStyle: {
													color: '#d7ab82'
												}
											},
											tooltip: {
												trigger: 'item',
												formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, จำนวน, และอัตราร้อยละใน tooltip
											},
											legend: {
												top: '15%',
												left: 'center'
											},
											series: [{
												top: '60',
												name: 'Access From',
												type: 'pie',
												radius: ['40%', '70%'],
												avoidLabelOverlap: false,
												padAngle: 5,
												itemStyle: {
													borderRadius: 10
												},
												label: {
													show: false,
													position: 'center'
												},
												emphasis: {
													label: {
														show: true,
														fontSize: 20,
														fontWeight: 'bold',
														formatter: function(params) {
															return `${params.name}\n${params.percent}%`;
														},
														color: '#000' // ปรับสีข้อความให้ชัดเจน
													}
												},
												labelLine: {
													show: false
												},
												data: [{
														value: started,
														name: "เริ่มงาน",

														itemStyle: {
															color: "#787464",
															borderColor: '#6e7074', // สีเส้นขอบ
															borderWidth: 1 // ความหนาของเส้นขอบ
														}
													},
													{
														value: left,
														name: "ลาออก",

														itemStyle: {
															color: "#cc7e63",
															borderColor: '#6e7074', // สีเส้นขอบ
															borderWidth: 1 // ความหนาของเส้นขอบ
														}
													},
													{
														value: still,
														name: "ยังอยู่",

														itemStyle: {
															color: "#724e58",
															borderColor: '#6e7074', // สีเส้นขอบ
															borderWidth: 1 // ความหนาของเส้นขอบ
														}
													},
													{
														value: not_set,
														name: "ยังไม่กรอกข้อมูล",

														itemStyle: {
															color: "#dddddd",
															borderColor: '#6e7074', // สีเส้นขอบ
															borderWidth: 1 // ความหนาของเส้นขอบ
														}
													}
												]
											}]
										};

										myChart.setOption(option);
										window.addEventListener('resize', function() {
											myChart.resize();
										});
									}
								</script>
							</div>
							<hr>
							<div class="col-md-12">
								<!-- 12. -->
								<h3>แยกเพศ</h3>
								<div class="row">
									<div class="col-md-6">
										<b>อาจารย์</b>
										<?php
										$mal_tec = $male_tec;
										$gilr_tec = $female_tec;
										$noneg_tec = $none_gend_tec;

										echo "<p>เพศชาย: {$mal_tec} คน</p>";
										echo "<p>เพศหญิง: {$gilr_tec} คน</p>";
										echo "<p>ไม่ระบุ: {$noneg_tec} คน</p>";

										?>
										<input type="hidden" id="ma_t" value="<?php echo $mal_tec; ?>">
										<input type="hidden" id="gi_t" value="<?php echo $gilr_tec; ?>">
										<input type="hidden" id="No_t" value="<?php echo $noneg_tec; ?>">
										<div id="gender" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
										<script>
											var mat = $("#ma_t").val();
											var git = $("#gi_t").val();
											var not = $("#No_t").val();

											var chartDom = document.getElementById('gender');
											var genderChart = echarts.init(chartDom, 'vintage');
											var optiongender;

											optiongender = {
												backgroundColor: 'rgba(254,248,239,1)',
												title: {
													text: 'อาจารย์',
													left: 'center',
													top: '5%',
													textStyle: {
														color: '#d7ab82'
													}
												},
												tooltip: {
													trigger: 'item',
													formatter: '{b}: {c} ({d}%)' // แสดงชื่อ, จำนวน, และอัตราร้อยละใน tooltip
												},
												legend: {
													top: '15%',
													left: 'center'

												},
												series: [{
													top: '60',
													name: 'Access From',
													type: 'pie',
													radius: ['40%', '70%'],
													avoidLabelOverlap: false,
													padAngle: 5,
													itemStyle: {
														borderRadius: 10
													},
													label: {
														show: false,
														position: 'center'
													},
													emphasis: {
														label: {
															show: true,
															fontSize: 20,
															fontWeight: 'bold',
															formatter: function(params) {
																return `${params.name}\n${params.percent}%`;
															},
															color: '#000' // ปรับสีข้อความให้ชัดเจน
														}
													},
													labelLine: {
														show: false
													},
													data: [{
															value: mat,
															name: "เพศชาย",

															itemStyle: {
																color: "#72ccff",
																borderColor: '#6e7074', // สีเส้นขอบ
																borderWidth: 1 // ความหนาของเส้นขอบ
															}
														},
														{
															value: git,
															name: "เพศหญิง",

															itemStyle: {
																color: "#fc97af",
																borderColor: '#6e7074', // สีเส้นขอบ
																borderWidth: 1 // ความหนาของเส้นขอบ
															}
														},
														{
															value: not,
															name: "ไม่ระบุ",

															itemStyle: {
																color: "#dddddd",
																borderColor: '#6e7074', // สีเส้นขอบ
																borderWidth: 1 // ความหนาของเส้นขอบ
															}
														}
													]
												}]
											};


											optiongender && genderChart.setOption(optiongender);
											window.addEventListener('resize', function() {
												genderChart.resize();
											});
										</script>
									</div>
									<div class="col-md-6">
										<b>บุคลากร</b>
										<?php
										$mal_per = $male_per;
										$gilr_per = $female_per;
										$noneg_per = $none_gend_per;

										echo "<p>เพศชาย: {$mal_per} คน</p>";
										echo "<p>เพศหญิง: {$gilr_per} คน</p>";
										echo "<p>ไม่ระบุ: {$noneg_per} คน</p>";
										?>
									</div>
								</div>
							</div>
							<hr>
							<div class="col-md-12 d-none">
								<!-- 14. -->
								<h3>แยกอาจารย์ในแต่ละหลักสูตร</h3>
								<div class="row">
									<div class="col-md-6">
										<b>อาจารย์</b>
										<?php
										$mal_tec = $male_tec;
										$gilr_tec = $female_tec;
										$noneg_tec = $none_gend_tec;

										echo "<p>เพศชาย: {$mal_tec} คน</p>";
										echo "<p>เพศหญิง: {$gilr_tec} คน</p>";
										echo "<p>ไม่ระบุ: {$noneg_tec} คน</p>";
										?>
									</div>
									<div class="col-md-6">
										<b>บุคลากร</b>
										<?php
										$mal_per = $male_per;
										$gilr_per = $female_per;
										$noneg_per = $none_gend_per;

										echo "<p>เพศชาย: {$mal_per} คน</p>";
										echo "<p>เพศหญิง: {$gilr_per} คน</p>";
										echo "<p>ไม่ระบุ: {$noneg_per} คน</p>";
										?>
									</div>
								</div>
							</div>
							<hr>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>