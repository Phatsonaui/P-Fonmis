<?php 
// include("../class/class.db.php");
//     require_once("../chgdatethai.php"); 
	?>
    
<div class="container-fluid pb-4">
	<div class="row g-3 p-3 d-none">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>ห้องเรียน/ห้องประชุม</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d")); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row g-3">
		<!-- <div class="col-md-12">
			<ul id="selectableList" class="text-center">
				<li data-date="1" id="start">วัน</li>
				<li data-date="2">เดือน</li>
				<li data-date="3">ปี</li>
			</ul>
		</div> -->
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-start">สถานะห้องแยกตามประเภท</h2>
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
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-start">อัตราการใช้งานตามช่วงเวลา</h2>
							<div id="usageChart" style="width: 100%; height: 400px;border-radius: 10px; overflow: hidden;"></div>
						</div>
						<?php 
							$hours = range(7, 20);
							$usageData = [];
							
							$dbRoomUse = new Database('nurse');
							$dbRoomUse->Table = "RM_Reserv";
							$dbRoomUse->Where = "where Rs_startdate='$roomtoday' AND RS_status = '3' order by Rs_startTime DESC";
							$userRoomUse = $dbRoomUse->Select();
							
							foreach ($hours as $hour) {
								$usageData["$hour:00"] = 0;
								$usageData["$hour:30"] = 0;
								foreach ($userRoomUse as $dataRoomUse) {
									
									list($startHour, $startMinute) = explode('.', $dataRoomUse['Rs_startTime']);
							
									if ((int)$startHour == $hour) {
										if ($startMinute == "01") {
											$usageData["$hour:00"]++;
										} elseif ($startMinute == "31") {
											$usageData["$hour:30"]++;
										}
									}
								}
							}
							echo "<script>
								var hoursJson = " . json_encode(array_keys($usageData)) . ";
								var usageDataJson = " . json_encode(array_values($usageData)) . ";
							</script>";
						?>
						<script>
							// console.log(hoursJson+" / "+usageDataJson);
							var chartDom1 = document.getElementById('usageChart');
							var myChart1 = echarts.init(chartDom1, 'shine');
							var option1;

							option1 = {
								tooltip: {
									trigger: 'axis',
									formatter: function (params) {
										let data = params[0];
										return '<span style="color: #ff5722">' + data.axisValue + '</span><br/>'
											+ 'จำนวนการใช้งาน: <span style="color: #4caf50">' + data.data + '</span>';
									}
								},
								xAxis: {
									type: 'category',
									data: hoursJson 
								},
								yAxis: {
									type: 'value',
									name: 'จำนวนการใช้งาน'
								},
								series: [
									{
										name: 'จำนวนการใช้งาน',
										data: usageDataJson, // ข้อมูลการใช้งาน
										type: 'line',
										smooth: true,
										symbolSize: 10,
										lineStyle: {
											color: '#c12e34',
											width: 4
										},
    									color:"#c12e34"
									}
								]
							};

							option1 && myChart1.setOption(option1);
						</script>
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
							<div id="Reserv"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- row g-3 -->
</div> <!-- contaniner -->
<script>
	$(document).ready(function() {
		var today = new Date().toISOString().slice(0, 10);
		$.ajax({
			type: "POST",
			url: 'config/gen_Reserv.php',
			data: {
				date: today
			},
			success: function(data) {
				$('#Reserv').html(data);
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
				Swal.close();
				Swal.fire({
					title: 'เกิดข้อผิดพลาด',
					text: 'ไม่สามารถโหลดข้อมูลได้',
					icon: 'error',
					confirmButtonText: 'ตกลง'
				});
			}
		});

	var chartDom = document.getElementById('roomStatusChart');
	var myChart = echarts.init(chartDom, 'shine');
	var option;

	option = {
		legend: {},
		tooltip: {
			trigger: 'axis', // ทำให้ tooltip ปรากฏเมื่อชี้ที่แกน x
			axisPointer: {
				type: 'shadow' // ทำให้เป็นแบบกราฟแท่ง
			},
			formatter: function (params) {
				let content = `<b style="color:#000">${params[0].value.Room}</b><br/>`; // ใช้ชื่อห้องเป็นชื่อหลัก

				params.forEach((param) => {
					content += `<span style="color:${param.color}">${param.seriesName}</span>: ${param.data[param.seriesName]}<br/>`; // แสดงชื่อข้อมูล (จำนวนทั้งหมด, กำลังใช้งาน, ว่าง) และค่าของมัน
				});
				return content;
			}
		},
		dataset: {
			dimensions: ['Room', 'จำนวนทั้งหมด', 'กำลังใช้งาน', 'ว่าง'],
			source: [
				{
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
                date_r: today, type_r: a, statu_r: b
            },
            success: function(data) {
                $('#detail_r').removeClass('d-none');
                $('#detail_r').html(data);
            }
        });
    }
});



	window.addEventListener('resize', function() {
		myChart.resize();
		myChart1.resize();
	});

});
</script>