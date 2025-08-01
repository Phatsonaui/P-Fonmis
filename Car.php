<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>ยานพหนะ</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d"));?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<?php
							$dtoday=date('Y-m-d');
						 	$car_to = 0;
						 	$bus_air = 0;
						 	$bus_fan = 0;
						 	$bus_mini = 0;
						 	$van = 0;
						 	$sedan = 0;
						 	$pickup = 0;
							$dbpp1=new Database('nurse');
							$dbpp1->Table = "car_detail";	
							$dbpp1->Where = "order by car_id";	
							$userpp1 = $dbpp1->Select();
							$car_to = count($userpp1);
							foreach($userpp1 as $valuespp1=>$datapp1){
								if ($datapp1['car_type'] == '001' ) {
									$bus_air++;
								}
								if ($datapp1['car_type'] == '002' ) {
									$bus_fan++;
								}
								if ($datapp1['car_type'] == '003' ) {
									$bus_mini++;
								}
								if ($datapp1['car_type'] == '004' ) {
									$van++;
								}
								if ($datapp1['car_type'] == '005' ) {
									$sedan++;
								}
								if ($datapp1['car_type'] == '006' ) {
									$pickup++;
								}
							}
							$bus = $bus_air+$bus_fan+$bus_mini;
							$van_t = $van;
							$sedan_t = $sedan;
							$pickup_t = $pickup;

							echo "<script> var bus1 = $bus; var van_t1 = $van_t; var sedan_t1 = $sedan_t; var pickup_t1 = $pickup_t; </script>";

							$db1=new Database('nurse');
							$db1->Table = "car_time";
							$db1->Where = "where time_date like '$dtoday%' order by mg_status,time_date";
							$user1 = $db1->Select();
							foreach($user1 as $values1=>$data1){
								
									$dbcar=new Database('nurse');
									$dbcar->Table = "car_detail";	
									$dbcar->Where = "where car_id = '$data1[car_id]' order by car_id";	
									$usercar = $dbcar->Select();
									foreach($usercar as $valuescar=>$datacar){
										if ($datacar['car_type'] == '001' ) {
											$bus_air1++;
										}
										if ($datacar['car_type'] == '002' ) {
											$bus_fan1++;
										}
										if ($datacar['car_type'] == '003' ) {
											$bus_mini1++;
										}
										if ($datacar['car_type'] == '004' ) {
											$van1++;
										}
										if ($datacar['car_type'] == '005' ) {
											$sedan1++;
										}
										if ($datacar['car_type'] == '006' ) {
											$pickup1++;
										}
									}
									if($bus_air1 == "" && $bus_fan1 == "" && $bus_mini1 == ""){
										$bus_ac = 0;
									}else{
										$bus_ac =  $bus_air1+$bus_fan1+$bus_mini1;
									}
									// echo $bus_air1.' / '.$bus_fan1.' / '.$bus_mini1;
									if($van1 == ""){
										$van_t_ac = 0;
									}else{
										$van_t_ac = $van1;
									}
									if($sedan1 == ""){
										$sedan_t_ac = 0;
									}else{
										$sedan_t_ac = $sedan1;
									}
									if($pickup1 == ""){
										$pickup_t_ac = 0;
									}else{
										$pickup_t_ac = $pickup1;
									}
									
									
									echo "<script> var busaction = $bus_ac; var van_taction = $van_t_ac; var sedan_taction = $sedan_t_ac; var pickup_taction = $pickup_t_ac; </script>";
							}
							
						?> 

						<div class="col-md-12">
							<h2 class="card-title text-start">สถานะยานพาหนะแยกตามประเภท</h2>	
						</div>
						<div class="col-md-6 d-flex align-items-center mt-3">
							<div class="card w-100 text-end border-0">
								<i style="font-size: 12px;" class="text-danger fw-bold">*** สามารถคลิ๊กที่แท่งกราฟเพื่อดูข้อมูลยานพาหนะได้ ***</i>
								<div id="typecar" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
							</div>
						</div>
						<div id="detail_c" class="col-md-6 mt-3 d-none"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<p class="text-end"> ณ วันที่ <?php echo Datethai(date("Y-m-d"));?></p>
							<h2 class="card-title text-center">จำนวนรถที่ใช้ภายในวันนี้</h2>
						</div>
						<?php 	
							$ydate=date('Y-m-d');
							$r=0;
							$cond="";		
							$cond="AND time_date like '$ydate%'";
								
						        $db1=new Database('nurse');
								$db1->Table = "car_time";	
								$db1->Where = "where form_status = '4' $cond order by time_date";	
								$user1 = $db1->Select();
								foreach($user1 as $values1=>$data1){
									$r++;
						        }?>  
						<div class="col-md-12 p-5 text-center" id="result">
							<!-- <a href="Page.php?feed=Cred"> -->
								<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"><?php echo $r." คัน";?></h1>
							<!-- </a> -->
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
							<h2 class="card-title text-start">รายการจองล่าสุด</h2>
							<div id="Carr"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->
<script>
	$(document).ready(function() {
		var today = new Date().toISOString().slice(0, 10);
		$.ajax({
			type: "POST",
			url: 'config/get_Car.php',
			data: {
				date: today
			},
			success: function(data) {
				$('#Carr').html(data);
				var table = $('#dtBasicExample').DataTable({
					"lengthMenu": [
						[10, 10, 25, 50, 100],
						["แสดงจำนวนข้อมูล", 10, 25, 50, 100]
					],
					"dom": '<"d-flex justify-content-between align-items-center"l' +
						'<"select-items"f>' +
						'>tip',
					"pagingType": "simple_numbers",
					"renderer": {
						"header": "bootstrap",
						"pageButton": "bootstrap",
						"number": "num",
						"paginate": "full_numbers",
						"sort": "bootstrap",
						"typeBased": "bootstrap",
						"display": "bootstrap"
					},
					"language": {
						"searchPlaceholder": "ค้นหา",
						"lengthMenu": "_MENU_",
						"paginate": {
							"first": "First",
							"last": "Last",
							"next": "&raquo;",
							"previous": "&laquo;"
						},
						"info": "แสดงข้อมูลตั้งแต่ _START_ ถึง _END_ จาก _TOTAL_ รายการ ",
						"infoFiltered": "( โดยมีข้อมูลทั้งหมด _MAX_ รายการ )",
						"infoEmpty": "ไม่พบข้อมูลในตาราง",
						"emptyTable": "ไม่พบข้อมูลในตาราง",
						"zeroRecords": "ไม่พบข้อมูลในตาราง",
						"loadingRecords": "กำลังโหลด...",
						"processing": "กำลังประมวลผล",
						"search": ""
					},
					initComplete: function() {
						$('<input type="text" placeholder="ค้นหา"/>')
							.appendTo('div.toolbar')
							.on('keyup', function() {
								table.search(this.value).draw();
							});
						$('div.toolbar').addClass('d-flex flex-wrap justify-content-between align-items-center mb-3');
						$('input[type="search"]').addClass('form-control me-2 mb-3');
					},
					"drawCallback": function(settings) {
						$('[data-toggle="tooltip"]').tooltip();
					}
				});
			},
			error: function() {
				// ปิด SweetAlert เมื่อเกิดข้อผิดพลาด
				Swal.close();
				Swal.fire({
					title: 'เกิดข้อผิดพลาด',
					text: 'ไม่สามารถโหลดข้อมูลได้',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
		});

	var chartDom = document.getElementById('typecar');
	var myChart = echarts.init(chartDom, 'shine');
	var option;
	
	var buss = busaction;
	var vann = van_taction;
	var sedann = sedan_taction;
	var pickupp = pickup_taction;

	if (buss === undefined) {
		var busaction  = 0;
	}
	if (vann === undefined) {
		var van_taction  = 0;
	}
	if (sedann === undefined) {
		var sedan_taction  = 0;
	}
	if (pickupp === undefined) {
		var pickup_taction  = 0;
	}

	console.log(busaction+" / "+van_taction+" / "+sedan_taction+" / "+pickup_taction+" / "+bus1+" / "+van_t1+" / "+sedan_t1+" / "+pickup_t1);					

	option = {
		legend: {},
		tooltip: {},
		dataset: {
			dimensions: ['Car', 'จำนวนทั้งหมด', 'กำลังใช้งาน', 'ว่าง'],
			 source: [
			 	{
			 		Car: 'รถบัส',
			 		'จำนวนทั้งหมด': bus1,
			 		'กำลังใช้งาน': busaction,
			 		'ว่าง': bus1 - busaction
			 	},
			 	{
			 		Car: 'รถตู้',
			 		'จำนวนทั้งหมด': van_t1,
			 		'กำลังใช้งาน': van_taction,
			 		'ว่าง': van_t1 - van_taction
			 	},
			 	{
			 		Car: 'รถเก๋ง',
			 		'จำนวนทั้งหมด': sedan_t1,
			 		'กำลังใช้งาน': sedan_taction,
			 		'ว่าง': sedan_t1 - sedan_taction
			 	},
			 	{
			 		Car: 'รถกระบะ',
			 		'จำนวนทั้งหมด': pickup_t1,
			 		'กำลังใช้งาน': pickup_taction,
			 		'ว่าง': pickup_t1 - pickup_taction
			 	}
			 ]
		},
		xAxis: {
			type: 'category'
		},
		yAxis: {},
		series: [{
				type: 'bar',
				name: 'จำนวนทั้งหมด',
				color: "#005eaa",
				itemStyle: {
					borderColor: 'darkblue', // สีเส้นขอบ
					borderWidth: 2 // ความหนาของเส้นขอบ
				}
			},
			{
				type: 'bar',
				name: 'กำลังใช้งาน',
				color: "#c12e34",
				itemStyle: {
					borderColor: 'darkred', // สีเส้นขอบ
					borderWidth: 2 // ความหนาของเส้นขอบ
				}
			},
			{
				type: 'bar',
				name: 'ว่าง',
				color: "#2b821d",
				itemStyle: {
					borderColor: 'darkgreen', // สีเส้นขอบ
					borderWidth: 2 // ความหนาของเส้นขอบ
				}
			}
		]
	};

	myChart.setOption(option);

	myChart.on('click', function (params) {
		let a, b;

		if (params.value.Car === 'รถบัส') {
			a = 1;
		} else if (params.value.Car === 'รถตู้') {
			a = 2;
		} else if (params.value.Car === 'รถเก๋ง') {
			a = 3;
		} else if (params.value.Car === 'รถกระบะ') {
			a = 4;
		}

		$.ajax({
			url: 'config/gen_Detail_C.php',
			method: 'POST',
			data: {
				date_c: today, type_c: a
			},
			success: function(data) {
				$('#detail_c').removeClass('d-none');
				$('#detail_c').html(data);
			}
		});
	});

	window.addEventListener('resize', function() {
		myChart.resize();
	});

});
</script>