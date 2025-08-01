<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=Aca">วิชาการ</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">นิสิตทั้งหมดของคณะพยาบาลศาสตร์มหาวิทยาลัยบูรพา</li>
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
							<div href="" class="circle " style="background-color: #54A24B; margin-right: 50px;">
								<input class="Check_c me-1 as" type="checkbox" value="ตรี" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ป.ตรี</p>
							</div>
							<div href="" class="circle " style="background-color: #4C78A8; margin-right: 50px;">
								<input class="Check_c me-1 as" type="checkbox" value="โท" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ป.โท</p>
							</div>
							<div href="" class="circle " style="background-color: #F58518; margin-right: 50px;">
								<input class="Check_c me-1 as" type="checkbox" value="เอก" id="thirdCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ป.เอก</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
			<div class="col-md-4 year-content" id="firstYear">
						<div class="card">
							<div class="card-body">
								<div class="row g-3">
									<div class="col-md-12">
										ปีการศึกษา
									</div>
									<div class="col-md-12 relation text-center" id="year-section">
										<div href="" class="circle " style="background-color: #54A24B; margin-right: 50px;">
											<input class="Check_c me-1 Check_y" type="checkbox" value="1" id="firstCheckbox">
											<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ปี 1</p>
										</div>
										<div href="" class="circle " style="background-color: #4C78A8; margin-right: 50px;">
											<input class="Check_c me-1 Check_y" type="checkbox" value="2" id="secondCheckbox">
											<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ปี 2</p>
										</div>
										<div href="" class="circle " style="background-color: #F58518; margin-right: 50px;">
											<input class="Check_c me-1 Check_y" type="checkbox" value="3" id="thirdCheckbox">
											<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ปี 3</p>
										</div>
										<div href="" class="circle " style="background-color: #E45756;margin-right: 30px;">
											<input class="Check_c me-1 Check_y" type="checkbox" value="4" id="fourCheckbox">
											<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">ปี 4</p>
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
							<table class="table table-striped table-hover" id="T_1">
							  <thead>
							  
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->
<script>
  $(document).ready(function() {
  	var table = $('#T_1').DataTable({
  		"data" : [
  			{no : '1', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '2', name : 'xxxx xxx', status : 'ตรี', year : '2'},
  			{no : '3', name : 'xxxx xxx', status : 'โท', year : '1'},
  			{no : '4', name : 'xxxx xxx', status : 'เอก', year : '1'},
  			{no : '5', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '6', name : 'xxxx xxx', status : 'เอก', year : '1'},
  			{no : '7', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '8', name : 'xxxx xxx', status : 'ตรี', year : '2'},
  			{no : '9', name : 'xxxx xxx', status : 'เอก', year : '2'},
  			{no : '10', name : 'xxxx xxx', status : 'ตรี', year : '4'},
  			{no : '11', name : 'xxxx xxx', status : 'ตรี', year : '4'},
  			{no : '12', name : 'xxxx xxx', status : 'โท', year : '2'},
  			{no : '13', name : 'xxxx xxx', status : 'เอก', year : '1'},
  			{no : '14', name : 'xxxx xxx', status : 'ตรี', year : '3'},
  			{no : '15', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '16', name : 'xxxx xxx', status : 'เอก', year : '3'},
  			{no : '17', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '18', name : 'xxxx xxx', status : 'ตรี', year : '1'},
  			{no : '19', name : 'xxxx xxx', status : 'โท', year : '2'},

  			],
  		columns: [
            { data: 'no', title: '#' },
            { data: 'name', title: 'ชื่อ - สกุล' },
            { data: 'status', title: 'ระดับการศึกษา' },
            { data: 'year', title: 'ชั้นปี' }
        ],
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
        $('select').addClass('form-select form-select-sm ms-2').attr('id', 'floatingInput')[0].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2');
    },
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip();
    }
  });

// เมื่อมีการเลือก checkbox ในส่วนคัดกรองตามสถานะ
  	$("#firstYear").hide();
  $('.as, .Check_y').on('change', function() {
    // รับค่า checkbox ที่เลือก
    var status_1 = $('.as:checked').map(function() {
      return $(this).val();
    }).get();

    var year = $('.Check_y:checked').map(function() {
      return $(this).val();
    }).get();

    // หา element ของปีการศึกษา

    var yearEl = $('#firstYear');

    // ถ้ามีสถานะที่ถูกเลือกอย่างน้อย 1 อัน
    if (status_1.length > 0) {
      // แสดงปีการศึกษา
      yearEl.show();
    } else {
      // ซ่อนปีการศึกษา
      yearEl.hide();
    }
console.log(status_1);
    console.log(year);
				table.column(2).search(status_1.join('|'), true, false);
        table.column(3).search(year.join('|'), true, false);
        table.draw();
    

});
  });
	</script>