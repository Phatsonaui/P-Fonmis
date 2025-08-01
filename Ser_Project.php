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
		<div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							คัดกรองตามสถานะ
						</div>
						<div class="col-md-12 relation text-center">
							<div href="" class="circle " style="background-color: #54A24B;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="อนุมัติ." id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">อนุมัติ</p>
							</div>
							<div href="" class="circle " style="background-color: #F58518;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="กำลังดำเนินการ" id="thirdCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">กำลัง</p>
							</div>
							<div href="" class="circle " style="background-color: #E45756;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="ไม่อนุมัติ" id="fourCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 12px;position: static;font-size:11px">ไม่อนุมัติ</p>
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
									<th class="text-center" width="2%">สถานะโครงการ</th>
									<th class="text-center" width="28%">ผู้จัดทำโครงการ</th>
								  </tr>
								</thead>
								<tbody id="T_1">
									<?php $row=0;
										
												$db5=new Database('nurse');
												$db5->Table = "proj_list";
												$db5->Where = "Where project_Year >= '".(date('Y')-4)."' AND project_Year <= '".date('Y')."' ORDER BY project_id ASC";	
												$user5= $db5->Select();
													foreach($user5 as $values5=>$data5){ $row++;
														

															
											
												?>
									<tr>
										<td><?php echo $row;?></td>
										<?php if ($data5["project_name"] == "") {
											
										}else{ ?>
											<td><?php echo $data5['project_Year']+543;?></td>	
										<?php }?>
										<td class="text-start" ><?php echo $data5['project_name'];?></td>
										<td class='text-center'>
										<?php switch ($data5['project_status']) {
											case '09':
												echo "ไม่อนุมัติ";
												break;
											case '07':
												echo "อนุมัติ.";
												break;
											
											default:
												echo "กำลังดำเนินการ";
												break;
										}?>
										</td>
										<td class="text-start" >
										<?php $db2=new Database('nurse');
											$db2->Table = "user_data";
											$db2->Where = "where ud_id='$data5[project_userupdate]'";	
											$user2= $db2->Select();
											foreach($user2 as $values2=>$data2){ echo $data2['name_th']." ".$data2['lname_th'];}

										?>
									</td>
									</tr>
									<?php	}?>
								</tbody>
								<tfoot>
			            <tr>
			              <th class="text-center" width="2%">ลำดับ</th>
										<th class="text-center" width="2%">ปี</th>
										<th class="text-center" width="35%">ชื่อโครงการ</th>
										<th class="text-center" width="2">สถานะโครงการ</th>
										<th class="text-center" width="28%">ผู้จัดทำโครงการ</th>
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
        table.column(3).search(filterValues.join('|'), true, false).draw();

  
  });
});

</script>