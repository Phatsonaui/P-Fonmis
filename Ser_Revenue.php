<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=Ser">บริการวิชาการ</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">โครงการทั้งหมด</li>
		  </ol>
		</nav>
	</div>
	<div class="row g-3">
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							ข้อมูลวันที่
						</div>
						<div class="col-md-12 ">
							<h3><?php echo Datethai(date("Y-m-d"));?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							คัดกรองตามประเภท
						</div>
						<div class="col-md-12 relation text-center">
							<div href="" class="circle " style="background-color: #4C78A8; margin-right: 30px;">
								<input class="Check_c me-1 ye" type="checkbox" value="เงินอุดหนุนจากรัฐบาล" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800; margin-top: 12px;position: static; font-size:11px">หนุน</p>
							</div>
							<div href="" class="circle " style="background-color: #54A24B;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="เงินสนับสนุนจากภายนอก" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">นอก</p>
							</div>
							<div href="" class="circle " style="background-color: #F58518;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="เงินบริจาค" id="thirdCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">จาค</p>
							</div>
							<div href="" class="circle " style="background-color: #E45756;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="เงินรายได้จากการลงทะเบียน" id="fourCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">เบียน</p>
							</div>
							<div href="" class="circle " style="background-color: #54A24B; margin-right: 30px;">
								<input class="Check_c me-1 ye" type="checkbox" value="เงินรายได้จากส่วนงาน" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800; margin-top: 12px;position: static; font-size:11px">ส่วนงาน</p>
							</div>
							
							<div href="" class="circle " style="background-color: #008BEF; margin-right: 30px;">
								<input class="Check_c me-1 ye" type="checkbox" value="เงินรับฝากเงินแผ่นดิน" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800; margin-top: 12px;position: static; font-size:11px">แผ่นดิน</p>
							</div>
							<div href="" class="circle " style="background-color: #E45756; margin-right: 30px;">
								<input class="Check_c me-1 ye" type="checkbox" value="เงินรับฝากเงินรายได้" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800; margin-top: 12px;position: static; font-size:11px">รับฝาก</p>
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
									<th class="text-center" width="35%">ชื่อโครงการ</th>
									<th class="text-center" width="28%">ประเภท</th>
									<th class="text-center" width="35%">รายละเอียด</th>
									<th class="text-center" width="15%">จำนวนเงิน</th>
								  </tr>
								</thead>
								<tbody id="T_1">
									<?php 
									$row=0;
									$db6 = new Database('nurse');
									$db6->Table = "Proj_MoneyIN";
									$db6->Where = "WHERE project_id <> '' ORDER BY project_id ASC";
									$user6 = $db6->Select();
									foreach($user6 as $values6 => $data6) { $row++;?>
									<tr>
										<td><?php echo $row;?></td>
											<?php 	$db5 = new Database('nurse');
												    $db5->Table = "proj_list";
												    $db5->Where = "WHERE project_id = '$data6[project_id]' ";	
												    $user5 = $db5->Select();

												    foreach($user5 as $values5 => $data5) { ?>
										<td class="text-start"><?php echo $data5['project_name']; ?></td>
									<?php }?>
										<td class='text-center'>
										<?php switch ($data6['source_id']) {
											case '01':
												echo "เงินอุดหนุนจากรัฐบาล";
												$tot += $data6['moneyIN_Money'];
												break;
											case '02':
												echo "เงินรายได้จากส่วนงาน";
												break;
											case '03':
												echo "เงินรับฝากเงินแผ่นดิน";
												break;
											case '04':
												echo "เงินรับฝากเงินรายได้";
												break;
											case '05':
												echo "เงินบริจาค";
												break;
											case '06':
												echo "เงินรายได้จากการลงทะเบียน";
												break;
											
											default:
												echo "เงินสนับสนุนจากภายนอก";
												break;
										}?>
										</td>
										<td><?php echo $data6['moneyIN_name'];?></td>	
										<td class="text-end" ><?php echo $data6['moneyIN_Money'];?></td>
									</tr>
									<?php echo $tot;?>
									<?php	}?>
								</tbody>
								<tfoot>
			            <tr>
			              	<th class="text-center" width="2%">ลำดับ</th>
							<th class="text-center" width="35%">ชื่อโครงการ</th>
							<th class="text-center" width="28%">ประเภท</th>
							<th class="text-center" width="35%">รายละเอียด</th>
							<th class="text-center" width="15%">จำนวนเงิน</th>
			            </tr>
			        </tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->
<script type="text/javascript">
$(document).ready(function () {

  var table = $('#dtBasicExample').DataTable({
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
                table.search(this.value).draw();
            });
        $('div.toolbar').addClass('d-flex flex-wrap justify-content-between align-items-center mb-3');
        $('select').addClass('form-select form-select-sm ms-2')[0].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2');
    },
    "drawCallback": function( settings ) {
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
        table.column(2).search(filterValues.join('|'), true, false).draw();

  
  });
});

</script>