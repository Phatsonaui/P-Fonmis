<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=Res">วิจัย</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">เป้าหมายงบประมาณวิจัย</li>
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
						<div class="col-md-12 gridd_budd text-center">
							<div class="row budd" style="background-color: #54A24B;margin-right: 30px;">
								<div class="col-md-2">
							        <input class="Check_budd me-1" type="checkbox" value="เงินรายได้ส่วนงาน" id="firstCheckbox">
							    </div>
							    <div class="col-md-10">
							    	<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">เงินรายได้ส่วนงาน</p>
							    </div>
							</div>
							<div class="row budd" style="background-color: #4C78A8;margin-right: 30px;">
								<div class="col-md-2">
							        <input class="Check_budd me-1" type="checkbox" value="ได้รับทุนภายนอก" id="secondCheckbox">
							    </div>
							    <div class="col-md-10">
							    	<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ได้รับทุนภายนอก</p>
							    </div>
							</div>
							<div class="row budd" style="background-color: #F58518;margin-right: 30px;">
								<div class="col-md-2">
							        <input class="Check_budd me-1" type="checkbox" value="เงินรายได้มหาวิทยาลัย" id="thirdCheckbox">
							    </div>
							    <div class="col-md-10">
							    	<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">เงินรายได้มหาวิทยาลัย</p>
							    </div>
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
									<th class="text-center" width="28%">เงิน</th>
								  </tr>
								</thead>
								<tbody id="T_1">
									<?php $row=0;
											$year_bud = $_GET['Year'];
												$db5=new Database('nurse');
												$db5->Table = "RS_Project";
												$db5->Where = "Where PJ_Year = '$year_bud' AND PJ_TypeFunds IN ('02', '03', '04') order by PJ_id";	
												$user5= $db5->Select();
													foreach($user5 as $values5=>$data5){
														$row++;
												?>
									<tr>
										<td><?php echo $row;?></td>
										<td><?php echo $_GET['Year']+543;?></td>
										<td class="text-start" ><?php echo $data5['PJ_NameTH'];?></td>
										<td><?php 
										switch ($data5['PJ_TypeFunds']) {
											case '02':
												echo 'เงินรายได้มหาวิทยาลัย';
												break;
											
											case '03':
												echo 'เงินรายได้ส่วนงาน';
												break;
											
											case '04':
												echo 'ได้รับทุนภายนอก';
												break;
										}
										?></td>
										<td class="text-center"><?php echo number_format($data5['PJ_SumMoney']);?></td>
									</tr>
									<?php	}?>
								</tbody>
								<tfoot>
			            <tr>
			              <th class="text-center" width="2%">ลำดับ</th>
										<th class="text-center" width="2%">ปี</th>
										<th class="text-center" width="35%">ชื่อโครงการ</th>
										<th class="text-center" width="28%">ประเภท</th>
										<th class="text-center" width="28%">เงิน</th>
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
  $('.Check_budd').on('change', function() {
    var filterValues = $(this).val();
    var filterValues = $('.Check_budd:checked').map(function() {
      return this.value;
    }).get();
    console.log(filterValues);
    table.column(3).search(filterValues.join('|'), true, false).draw();
  });
});

</script>