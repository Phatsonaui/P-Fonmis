<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="Page.php">Home</a></li>
				<li class="breadcrumb-item"><a href="Page.php?feed=Res">วิจัย</a></li>
				<li class="breadcrumb-item active" id="activet" aria-current="page">เป้าหมายวิจัย</li>
			</ol>
		</nav>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							คัดกรองตามสถานะ
						</div>
						<div class="col-md-12 relation text-center">
							<div href="" class="circle " style="background-color: #4C78A8;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="SJR ลำดับควอไทล์ที่ 1" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">Q1</p>
							</div>
							<div href="" class="circle " style="background-color: #F58518;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="SJR ลำดับควอไทล์ที่ 2" id="thirdCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">Q2</p>
							</div>
							<div href="" class="circle " style="background-color: #E45756;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="SJR ลำดับควอไทล์ที่ 3" id="fourCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">Q3</p>
							</div>
							<div href="" class="circle " style="background-color: #72B7B2;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="SJR ลำดับควอไทล์ที่ 4" id="fiveCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">Q4</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row g-3 mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12 text-center">
							<table class="table table-striped table-hover" id="dtBasicExample" style="width:100%">
								<thead>
									<tr>
										<th class="text-center" width="2%">ลำดับ</th>
										<th class="text-center" width="2%">ปี</th>
										<th class="text-center" width="35%">ชื่อโครงการ</th>
										<th class="text-center" width="28%">ประเภท</th>
										<th class="text-center" width="28%">รายชื่อ</th>
									</tr>
								</thead>
								<tbody id="T_1">
									<?php $row = 0;

									$db5 = new Database('nurse');
									$db5->Table = "RS_JNLInDatabase";
									$db5->Where = "Where DB_ID IN ('03', '04', '05', '06') ORDER BY DB_ID";
									$user5 = $db5->Select();
									foreach ($user5 as $values5 => $data5) {
										$db4 = new Database('nurse');
										$db4->Table = "RS_Journal";
										$db4->Where = "Where JNL_ID ='$data5[JNL_ID]' AND JNL_Year = '$_GET[Year]' order by JNL_Year desc";
										$user2566_4 = $db4->Select();
										foreach ($user2566_4 as $values2566_4 => $data2566_4) {
											$row++;


											$db6 = new Database('nurse');
											$db6->Table = "RS_Database";
											$db6->Where = "Where DB_ID='$data5[DB_ID]' order by DB_ID";
											$user6 = $db6->Select();
											foreach ($user6 as $values6 => $data6) {
									?>
												<tr>
													<td><?php echo $row; ?></td>
													<td><?php echo $data2566_4['JNL_Year'] + 543; ?></td>
													<td class="text-start"><?php echo $data2566_4['JNL_NameTH']; ?></td>
													<td><?php echo $data6['DB_NameTH']; ?></td>
													<td>
														<div class="list-group">
															<?php
															$db1 = new Database('nurse');
															$db1->Table = "RS_LsNameJNL";
															$db1->Where = "Where JNL_ID='$data2566_4[JNL_id]' order by LN_Status desc";
															$user1 = $db1->Select();
															foreach ($user1 as $values1 => $data1) { ?>
																<div class="list-group-item py-2 px-1">
																	<div class="row align-items-center">
																		<div class="col-8">
																			<?php
																			if ($data1['LN_typeOrg'] == 1) {
																				$db2 = new Database('nurse');
																				$db2->Table = "user_data";
																				$db2->Where = "where ud_id='$data1[LN_Name]'";
																				$user2 = $db2->Select();
																				foreach ($user2 as $values2 => $data2) {
																					echo $data2['name_th'] . " " . $data2['lname_th'];
																				}
																			} else {
																				echo $data1['LN_Name'];
																			}
																			?>
																		</div>
																		<div class="col-4">
																			<?php
																			switch ($data1['LN_Status']) {
																				case '6':
																					echo "ชื่อแรก";
																					break;
																				case '5':
																					echo "ชื่อหลัก";
																					break;
																				case '4':
																					echo "ผู้ร่วม";
																					break;
																				case '3':
																					echo "ที่ปรึกษาโครงการฯ";
																					break;
																			}
																			?>
																		</div>
																	</div>
																</div>
															<?php } ?>
														</div>
													</td>
												</tr>
									<?php	}
										}
									} ?>
								</tbody>
								<tfoot>
									<tr>
										<th class="text-center" width="2%">ลำดับ</th>
										<th class="text-center" width="2%">ปี</th>
										<th class="text-center" width="35%">ชื่อโครงการ</th>
										<th class="text-center" width="28%">ประเภท</th>
										<th class="text-center" width="28%">รายชื่อ</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- row g-3 -->
</div> <!-- contaniner -->
<script type="text/javascript">
	$(document).ready(function() {

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
				$('select').addClass('form-select form-select-sm ms-2')[0].style.width = "150px";
				$('input[type="search"]').addClass('form-control me-2');
			},
			"drawCallback": function(settings) {
				$('[data-toggle="tooltip"]').tooltip();
			}
		});
		var visibleIndex = 1; // เริ่มต้นเลขลำดับที่ 1
		$('.Check_c').on('change', function() {
			var filterValues = $(this).val();
			var filterValues = $('.Check_c:checked').map(function() {
				return this.value;
			}).get();
			console.log(filterValues);
			table.column(3).search(filterValues.join('|'), true, false).draw();
		});
	});
</script>