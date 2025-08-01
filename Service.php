<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>บริการวิชาการ</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d"));?></p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<label for="project_Year" class="form-label"><strong>ปีการศึกษา</strong></label>
	    <select id="project_Year" class="form-select" name="project_Year">
	      <option selected disabled value="">เลือก</option>
	      
	      <option value="2023">2566</option>
	      
	    </select>
		</div>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<!-- <div class="col-md-3"></div> -->
						<div class="col-md-12 text-center">
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
				<div class="card-header text-center">
							ฐานข้อมูลที่ปรากฏ
				</div>
						  <div class="card-body">
				<?php 			$datesave = array();
								$da_base01 = array();
								$da_base02 = array();
								$da_base03 = array();
								$da_base04 = array();
								$da_base05 = array();
								$da_base06 = array();
								$da_base07 = array();

									$da_1 = 0;
									$da_2 = 0;
									$da_3 = 0;
									$da_4 = 0;
									$da_5 = 0;
									$da_6 = 0;
									$da_7 = 0;


								$db6 = new Database('nurse');
								$db6->Table = "Proj_MoneyIN";
								$db6->Where = "WHERE project_id <> '' ORDER BY project_id ASC";
								$user6 = $db6->Select();
								foreach($user6 as $values6 => $data6) {

											if($data6['source_id'] == '01'){
												$da_1 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '02'){
												$da_2 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '03'){
												$da_3 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '04'){
												$da_4 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '05'){
												$da_5 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '06'){
												$da_6 += $data6['moneyIN_Money'];
											}else if($data6['source_id'] == '07'){
												$da_7 += $data6['moneyIN_Money'];
											}
										}



								
								$da_base01[]=$da_1;
								$da_base02[]=$da_2;
								$da_base03[]=$da_3;
								$da_base04[]=$da_4;
								$da_base05[]=$da_5;
								$da_base06[]=$da_6;
								$da_base07[]=$da_7;

								$datesave = implode(",", $datesave);
								$da_base01 = implode(",", $da_base01);
								$da_base02 = implode(",", $da_base02);
								$da_base03 = implode(",", $da_base03);
								$da_base04 = implode(",", $da_base04);
								$da_base05 = implode(",", $da_base05);
								$da_base06 = implode(",", $da_base06);
								$da_base07 = implode(",", $da_base07);

								$da1 = number_format($da_base01);
								$da2 = number_format($da_base02);
								$da3 = number_format($da_base03);
								$da4 = number_format($da_base04);
								$da5 = number_format($da_base05);
								$da6 = number_format($da_base06);
								$da7 = number_format($da_base07);
								$tot = $da_base01 + $da_base02 + $da_base03 + $da_base04 + $da_base05 + $da_base06 + $da_base07;
								  ?>
							<p align="center">
								<div class="chart-container">
									<canvas id="myChart1" ></canvas>
								</div>
								<script>
								var ctx = document.getElementById("myChart1").getContext('2d');
								var myChart1 = new Chart(ctx, {

								type: 'bar',
								data: {
								labels: ["ประเภท"],
								datasets: [
								{
									label : 'เงินอุดหนุนจากรัฐบาล',
									data: ['<?php echo $da_base01; ?>'],
									backgroundColor: ['rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)'],
									borderColor: ['rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)'],
									borderWidth: 2
								}, 
								{
									label : 'เงินรายได้จากส่วนงาน',
									data: [<?php echo $da_base02;?>],
									backgroundColor: ['rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)'],
									borderColor: ['rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)'],
									borderWidth: 2
								}, {
									label : 'เงินรับฝากเงินแผ่นดิน',
									data: [<?php echo $da_base03;?>],
									backgroundColor: ['rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)'],
									borderColor: ['rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)'],
									borderWidth: 2
								}, {
									label : 'เงินรับฝากเงินรายได้',
									data: [<?php echo $da_base04;?>],
									backgroundColor: ['rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)'],
									borderColor: ['rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)'],
									borderWidth: 2
								}, 
								{
									label : 'เงินบริจาค',
									data: [<?php echo $da_base05;?>],
									backgroundColor: ['rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)'],
									borderColor: ['rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)', 'rgba(84, 162, 75, 1)'],
									borderWidth: 2
								}, 
								{
									label : 'เงินรายได้จากการลงทะเบียน',
									data: [<?php echo $da_base06;?>],
									backgroundColor: ['rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)'],
									borderColor: ['rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)', 'rgba(5, 0, 250, 1)'],
									borderWidth: 2
								}, 
								{
									label : 'เงินสนับสนุนจากภายนอก',
									data: [<?php echo $da_base07;?>],
									backgroundColor: ['rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)'],
									borderColor: ['rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)', 'rgba(130, 117, 7, 1)'],
									borderWidth: 2
								}
								]
								},
								options: {
									responsive: true,
									legend: {
						              position: 'top',
						               labels: {
						                    boxWidth: 20,
						                     padding: 10,
						                     usePointStyle: true,
						                     fontSize: 14,
						                     fontColor: '#000000'
						                 }
						             },
								}
								});
								</script>
							</p>
			</div>
		</div>
							</div>
						<div class="col-md-12">
							<h2 class="card-title text-center">รายรับ</h2>	
						</div>
						<div class="col-md-12 p-5 text-center" >
							<a href="Page.php?feed=Ser_pro">
								<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"><?php echo number_format($tot);?> บาท</h1>
							</a>
						</div>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินอุดหนุนจากรัฐบาล</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:#008BEF;">
							                  	<strong><?php echo $da1;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินรายได้จากส่วนงาน</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:#F58518;">
							                  	<strong><?php echo $da2;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินรับฝากเงินแผ่นดิน</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:rgba(228, 87, 86, 1);">
							                  	<strong><?php echo $da3;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินรับฝากเงินรายได้</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:rgba(114, 183, 178, 1);">
							                  	<strong><?php echo $da4;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินบริจาค</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:rgba(84, 162, 75, 1);">
							                  	<strong><?php echo $da5;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินอุดหนุนจากรัฐบาล</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:rgba(5, 0, 250, 1);">
							                  	<strong><?php echo $da6;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
							    <div class="col-md-4" style="padding-top: 10px;">
							      <div class="card" style="background-color: white;">   
							          <div class="card-header" align="center">
							            <div class="row">
							              <div class="col-md-12 text-start">
							                  <h5>เงินสนับสนุนจากภายนอก</h5>
							              </div>
							              <div class="col-md-12 text-end">
							                  <h3 class="card-text" style="color:rgba(130, 117, 7, 1);">
							                  	<strong><?php echo $da7;?> บาท</strong>
							                  </h3>
							              </div>
							          </div>
							          </div>          
							      </div>
							    </div>
									<!-- <div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: #008BEF;">เงินอุดหนุนจากรัฐบาล</h1>
										<div class="p-5"><?php echo $da1;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: #F58518;">เงินรายได้จากส่วนงาน</h1>
										<div class="p-5"> <?php echo $da2;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: rgba(228, 87, 86, 1);">เงินรับฝากเงินแผ่นดิน</h1>
										<div class="p-5"> <?php echo $da3;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: rgba(114, 183, 178, 1);">เงินรับฝากเงินรายได้</h1>
										<div class="p-5"><?php echo $da4;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: rgba(84, 162, 75, 1);">เงินบริจาค</h1>
										<div class="p-5"> <?php echo $da5;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: rgba(5, 0, 250, 1);">เงินค่าลงทะเบียน</h1>
										<div class="p-5"> <?php echo $da6;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center">
								<a href="Page.php?feed=Ser_rev">
										<h1 style="color: rgba(130, 117, 7, 1);">เงินสนับสนุนจากภายนอก</h1>
										<div class="p-5"> <?php echo $da7;?> บาท</div>	
								</a>
									</div>
									<div class="col-md-4 text-center">
								<a href="Page.php?feed=Ser_rev">
									<h1>รวมเป็นเงินทั้งสิ้น</h1>
										<h3 style="color: #EF6400;"><?php echo number_format($tot);?> บาท </h3>	
								</a>
									</div> -->
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
							<h2 class="card-title text-center">รายจ่าย</h2>	
						</div>
						<div class="col-md-12">
							<div class="row">
							<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<h1 style="color: #008BEF;">งบxxxxxx</h1>
								<div class="p-5"> XXX,XXX บาท</div>	
							</div>
							<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<h1 style="color: #F58518;">งบxxxxxx</h1>
								<div class="p-5"> XXX,XXX บาท</div>	
							</div>
							<div class="col-md-4 text-center">
								<h1 style="color: #54A24B;">กำไรจากโครงการ</h1>
								<div class="p-5"> XXX,XXX บาท</div>	
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
							<h2 class="card-title text-center">โครงการทั้งหมด</h2>	
						</div>
						<?php 
				            $no_approve = 0;
				            $approve = 0;
				            $being = 0;
				            $pro = 0;
				            $dbGrp1=new Database('nurse');
				            $dbGrp1->Table = "proj_list";   
				            $dbGrp1->Where = "";    
				            $userGrp1 = $dbGrp1->Select();
				            foreach($userGrp1 as $valuesGrp1=>$dataProject1){ $pro++;
				                if ($dataProject1['project_status'] == "09") {
				                    $no_approve++;
				                }else if ($dataProject1['project_status'] == "07") {
				                    $approve++;
				                }else{
				                    $being++;
				                }
				            }
				        ?>
						<div class="col-md-12 p-5 text-center" >
							<a href="Page.php?feed=Ser_pro">
								<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"><?php echo $pro;?> เรื่อง</h1>
							</a>
						</div>
						<div class="col-md-12">
							<div class="row">
							<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<h1 style="color: #54A24B;">อนุมัติ</h1>
								<div class="p-5"> <?php echo $approve." เรื่อง"?></div>	
							</div>
							<div class="col-md-4 text-center" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<h1 style="color: #F58518;">กำลังดำเนินการ</h1>
								<div class="p-5"> <?php echo $being." เรื่อง"?></div>	
							</div>
							<div class="col-md-4 text-center">
								<h1 style="color: #E45756;">ไม่อนุมัติ</h1>
								<div class="p-5"> <?php echo $no_approve." เรื่อง"?></div>	
							</div>
							</div>
						</div>
						<div class="col-md-12 mt-5">
							<div class="row">
							<div class="col-md-12 text-center" >
			<div class="card" style="background-color: white; margin-bottom: 15px; padding: 10px;">
				<div class="card-header text-center">
							ประเภทของโครงการ
				</div>
						  <div class="card-body">
						  	<div class="row p-2">
						  		<div class="col-md-3"></div>
						  		<div class="col-md-6 text-center">
									<canvas id="myChart11" ></canvas>
						  		</div>
						  	</div>
						  			
								<script>

								var ctx = document.getElementById("myChart11").getContext('2d');
								var myChart11 = new Chart(ctx, {

								type: 'bar',
								data: {
								labels: [<?php echo $datesave;?>

								],
								datasets: [
								{
									label : 'บริการวิชาการ',
									data: [130],
									backgroundColor: ['rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)'],
									borderColor: ['rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)', 'rgba(76, 120, 168, 1)'],
									borderWidth: 2
								}, 
								{
									label : 'วิจัย',
									data: [150],
									backgroundColor: ['rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)'],
									borderColor: ['rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)', 'rgba(245, 133, 24, 1)'],
									borderWidth: 2
								}, {
									label : 'การศึกษา',
									data: [50],
									backgroundColor: ['rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)'],
									borderColor: ['rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)', 'rgba(228, 87, 86, 1)'],
									borderWidth: 2
								}
								// , {
								// 	label : 'ชั้นปีที่ 4',
								// 	data: [279],
								// 	backgroundColor: ['rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)'],
								// 	borderColor: ['rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)', 'rgba(114, 183, 178, 1)'],
								// 	borderWidth: 2
								// }
								]
								},
								options: {
									responsive: true,
									legend: {
						              position: 'top',
						               labels: {
						                    boxWidth: 20,
						                     padding: 10,
						                     usePointStyle: true,
						                     fontSize: 14,
						                     fontColor: '#000000'
						                 }
						             },
						              scales: {
								yAxes: [{
								ticks: {
								beginAtZero:true
								}
								}]
								}
								}
								});
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
		
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->