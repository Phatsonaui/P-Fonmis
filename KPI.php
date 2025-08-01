<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
<style>
	.chart-legend {
	  margin-top: 20px;
	}
	.project-card {
		background-color: #fff;
		padding: 10px;
		border-radius: 10px;
		text-align: center;
	}
</style>
<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>KPI</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d"));?></p>
				</div>
			</div>
		</div>
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<a style="text-decoration: none;color: #000;" id="year-link_All" href="Page.php?feed=CFR">
				<div class="project-card">
					<h1 style="color: #000;font-weight: 700;">CFR Dashboard <i class="bi bi-pie-chart"></i></h1>
				</div>
			</a>
		</div>
		<!-- <div class="col-md-4">
			<label for="project_Year" class="form-label"><strong>ปีการศึกษา</strong></label>
	    <select id="project_Year" class="form-select" name="project_Year">
	      <option selected disabled value="">เลือก</option>
	      
	      <option value="2023">2566</option>
	      
	    </select>
		</div> -->
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header d-flex" style="justify-content: space-between;">
					<div class="justify-content-start"><h2>แผนกลยุทธ์</h2></div>
					<div class="justify-content-end">
						<select class="form-select select-sm" name="year-section" id="year-section">
						    <?php
						    	$dbstg=new Database('nurse');
						    	$dbstg->Table = "stg_strategic";
						    	$dbstg->Where = "order by strategic_year DESC";
						    	$userstg = $dbstg->Select();
						    	foreach($userstg as $valuesstg=>$datastg){
						    		$yeae = $datastg['strategic_year']+543;
						            echo "<option value=\"$datastg[strategic_year]\">$yeae</option>";
						        }
						    ?>
						</select>
					</div>
				</div>
				
				<div class="row g-3 card-body mt-2">
					<div class="col-md-5" style="display: none;">
						<div class="row">
							<?php
							
							$r1 = 0;
							$total_kpi1 = 0;
							
								$dbPillar21=new Database('nurse');
								$dbPillar21->Table = "stg_Pillar";	
								$dbPillar21->Where = "where Pillar_name <> '' AND Pillar_year = '$P_year' order by Pillar_id";	
								$userPillar21 = $dbPillar21->Select();
								foreach($userPillar21 as $valuesPillar21=>$dataPillar21){ $r1++;
									$dbPillar1=new Database('nurse');
									$dbPillar1->Table = "stg_SKPI";	
									$dbPillar1->Where = "where Pillar_id = '$dataPillar21[Pillar_id]' AND SKPI_status = '1' order by SKPI_id ASC";	
									$userPillar1 = $dbPillar1->Select();
									foreach($userPillar1 as $valuesPillar1=>$dataPillar1){ 
										if ($dataPillar1['Pillar_id'] == 1) {
												$dataPillar_11 += $dataPillar1['SKPI_Percent'];
										}elseif ($dataPillar1['Pillar_id'] == 2) {
													$dataPillar_21 += $dataPillar1['SKPI_Percent'];
										}elseif ($dataPillar1['Pillar_id'] == 3) {
													$dataPillar_31 += $dataPillar1['SKPI_Percent'];
										}elseif ($dataPillar1['Pillar_id'] == 4) {
													$dataPillar_41 += $dataPillar1['SKPI_Percent'];
										}elseif ($dataPillar1['Pillar_id'] == 5) {
													$dataPillar_51 += $dataPillar1['SKPI_Percent'];
										}
										$total_kpi1 = count($userPillar1);
										$Pillar_Percent_11 = $dataPillar_11/$total_kpi1;
										$Pillar_Percent_21 = $dataPillar_21/$total_kpi1;
										$Pillar_Percent_31 = $dataPillar_31/$total_kpi1;
										$Pillar_Percent_41= $dataPillar_41/$total_kpi1;
										$Pillar_Percent_51 = $dataPillar_51/$total_kpi1;

										$Pil_11 = number_format($Pillar_Percent_11,0);
										$Pil_21 = number_format($Pillar_Percent_21,0);
										$Pil_31 = number_format($Pillar_Percent_31,0);
										$Pil_41 = number_format($Pillar_Percent_41,0);
										$Pil_51 = number_format($Pillar_Percent_51,0);

										 ?>
									

									<?php }?> 
							
						
							<div class="col-md-12 text-center">
										<?php if ($dataPillar21['Pillar_id'] == 1 && $dataPillar1['Pillar_id'] == 1) { 
											$Pil_tot = $Pillar_Percent_11 + $Pillar_Percent_21 + $Pillar_Percent_31 + $Pillar_Percent_41 + $Pillar_Percent_51;?>

												<label class=" form-check-label text-break" ><?php echo $dataPillar21['Pillar_name']." : ".$Pil_tot."%";?></label>
												
											<?php }elseif ($dataPillar21['Pillar_id'] == 2 && $dataPillar1['Pillar_id'] == 2) { ?>
												<label class=" form-check-label text-break" ><?php echo $dataPillar21['Pillar_name']." : ".$Pil_21."%";?></label>
												
											<?php }elseif ($dataPillar21['Pillar_id'] == 3 && $dataPillar1['Pillar_id'] == 3) { ?>
										<label class=" form-check-label text-break" ><?php echo $dataPillar21['Pillar_name']." : ".$Pil_31."%";?></label>
										
											<?php }elseif ($dataPillar21['Pillar_id'] == 4 && $dataPillar1['Pillar_id'] == 4) { ?>
										<label class=" form-check-label text-break" ><?php echo $dataPillar21['Pillar_name']." : ".$Pil_41."%";?></label>
										
											<?php }elseif ($dataPillar21['Pillar_id'] == 5 && $dataPillar1['Pillar_id'] == 5) { ?>
												<label class=" form-check-label text-break" ><?php echo $dataPillar21['Pillar_name']." : ".$Pil_51."%";?></label>
												
											<?php } ?>
									</div>
									<?php }?>
						</div>
					</div>
					<div id="data_kpi" class="row">

					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12" style="display: none;">
			<div class="card">
				<div class="card-header">
					<h2>แผนปฏิบัติการ</h2>
				</div>
				<div class="row g-3 card-body">
					<div class="col-md-5">
						<div class="row">
							<div class="col-md-12 text-center">
								<h1 class="text-danger">15.3 % !</h1>
							</div>
							<div class="col-md-12">
								<canvas id="doughnutChart1" class="mt-4"></canvas>
						<script>
							
						//doughnut
							var ctxD = document.getElementById("doughnutChart1").getContext('2d');
							var myLineChart = new Chart(ctxD, {
							type: 'doughnut',
							data: {
							labels: ["KPI", "พันธกิจ"],
							datasets: [{
							data: [30, 70],
							label: 'งบประมาณเงินรายได้',
							backgroundColor: ["#6c757d", "#008BEF"],
							hoverBackgroundColor: ["#6c757d", "#008BEF"],
							borderColor : ["#fff","#fff"],
							hoverBorderColor : ["#000000","#000000"],
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
							</script>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="row g-3">
							<div class="col-md-12 text-start">
								<h4>ร้อยละความสำเร็จ</h4>
							</div>
							<?php
							$r = 0;
								$dbMission=new Database('nurse');
								$dbMission->Table = "stg_Mission";	
								$dbMission->Where = "where mission_year = '2023'  order by mission_no ASC";	
								$userMission = $dbMission->Select();
								foreach($userMission as $valuesMission=>$dataMission){ $r++;?> 
									<div class="col-md-12">
										<label class="form-check-label text-break" ><?php echo $r.". ".$dataMission['mission_name'];?></label>
										<div class="progress">
											<?php if ($dataMission['mission_no'] == 1) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
											<?php }elseif ($dataMission['mission_no'] == 2) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
											<?php }elseif ($dataMission['mission_no'] == 3) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
											<?php }elseif ($dataMission['mission_no'] == 4) { ?>
												<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 80%"></div>
											<?php } ?>
										</div>
									</div>
								<?php }
							?>
						</div>
					</div>
					<div class="col-md-12">
						<div class="row g-3">
							<div class="col-md-12 text-start">
								<h4>KPI</h4>
							</div>
							<div class="col-md-12">
								<table class="table table-striped table-hover table-border" id="T_2">
									<thead>
										<tr class="text-center">
											<th>#</th>
											<th>Detail</th>
											<th>Mission</th>
											<th>Goal</th>
											<th>Value</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$row =0;
											$dbMission1=new Database('nurse');
											$dbMission1->Table = "stg_Mission";	
											$dbMission1->Where = "where mission_year = '2023'";	
											$userMission1 = $dbMission1->Select();
											foreach($userMission1 as $valuesMission1=>$dataMission1){ 
											
											$dbMission2=new Database('nurse');
											$dbMission2->Table = "stg_RoutineKPI";	
											$dbMission2->Where = "where mission_id = '$dataMission1[mission_id]' AND RKPI_status = '1' order by RKPI_id ASC";	
											$userMission2 = $dbMission2->Select();
											foreach($userMission2 as $valuesMission2=>$dataMission2){ $row++;?> 
										<tr >
											<td><?php echo $row;?></td>
											<td><?php echo $dataMission2['RKPI_name']?></td>
											<td><?php switch ($dataMission2['mission_id']) {
												case '1':
													echo "Mission 1";
													break;
												case '2':
													echo "Mission 2";
													break;
												case '3':
													echo "Mission 3";
													break;
												
												default:
													echo "Mission 4";
													break;
											}?></td>
											<td class="text-center"><?php echo $dataMission2['RKPI_GoalScore']?></td>
											<td class="text-center">2</td>
											<td class="text-center"><?php switch ($dataMission2['RKPI_rkpi_status']) {
												case '1':
													echo "<span class='badge rounded-pill bg-success'>...</span>";
													break;
												
												default:
													echo "<span class='badge rounded-pill bg-danger'>...</span>";
													break;
											}?></td>
										</tr>
									<?php }}?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->
<script type="text/javascript">
$(document).ready(function() {

var currentDate = new Date();
var initialYear = currentDate.getFullYear().toString(); //ปีปัจจุ บัน
fetchData(initialYear);

$('#year-section').change(function() {
	selectedYear = $(this).val();

	fetchData(selectedYear);
});
function fetchData(year) {
	$.ajax({
		url: 'config/get_data_kpi.php',
		method: 'POST',
		data: {
			year: year
		},
		success: function (data) {
			$('#data_kpi').html(data);
		}
	});
}
});

var table1 = $('#T_2').DataTable({
  	"lengthMenu": [[10, 10, 25, 50, 100], ["แสดงจำนวนข้อมูล", 10, 25, 50, 100]],
  	"dom": '<"d-flex justify-content-between align-items-center"l'+
           '<"select-items"f>'+
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
  "responsive": true, // เพิ่ม responsive ที่นี่
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
    initComplete: function () {
    		
        $('<input type="text" placeholder="ค้นหา"/>')
            .appendTo('div.toolbar')
            .on('keyup', function () {
                table1.search(this.value).draw();
            });
        $('div.toolbar').addClass('d-flex flex-wrap justify-content-between align-items-center mb-3');
        $('select').addClass('form-select form-select-sm ms-2 mb-2')[1].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2 mb-2');
    }
});


</script>