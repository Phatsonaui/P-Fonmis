<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=workl">ภาระงาน</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">มาตราฐานภาระงาน</li>
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
								<input class="Check_c me-1" type="checkbox" value="S" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">S</p>
							</div>
							<div href="" class="circle " style="background-color: #4C78A8; margin-right: 50px;">
								<input class="Check_c me-1" type="checkbox" value="H" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">H</p>
							</div>
							<div href="" class="circle " style="background-color: #F58518; margin-right: 50px;">
								<input class="Check_c me-1" type="checkbox" value="L" id="thirdCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">L</p>
							</div>
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
							ค้นหาข้อมูล
						</div>
						<div class="col-md-12 m-0">
							<div class="form-floating">
							  <input type="email" class="form-control " id="floatingInput" placeholder="name@example.com">
							  <label for="floatingInput">Search</label>
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
							<table class="table table-striped table-hover" id="dtBasicExample">
							  <thead>
							    <tr>
							      <th scope="col">#</th>
							      <th scope="col">ชื่อ - สกุล</th>
							      <th scope="col">สาขาวิชา</th>
							      <th scope="col">สถานะ</th>
							      <th scope="col">ตรี</th>
							      <th scope="col">โท</th>
							      <th scope="col">เอก</th>
							      <th scope="col">รวม</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <th scope="row">1</th>
							      <td>xxxx xxx</td>
							      <td>xxxxxx</td>
							      <td>S</td>
							      <td>1</td>
							      <td>3</td>
							      <td>2</td>
							      <td>6</td>
							    </tr>
							    <tr>
							      <th scope="row">2</th>
							      <td>xxxxxxx xxxxxx</td>
							      <td>xxxxxxxxxx</td>
							      <td>S</td>
							      <td>3</td>
							      <td>3</td>
							      <td>3</td>
							      <td>9</td>
							    </tr>
							    <tr>
							      <th scope="row">3</th>
							      <td>xxxx xxxxxxx</td>
							      <td>xxxxx</td>
							      <td>L</td>
							      <td>4</td>
							      <td>2</td>
							      <td>1</td>
							      <td>7</td>
							    </tr>
							    <tr>
							      <th scope="row">4</th>
							      <td>xx xxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>4</td>
							      <td>4</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">5</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">6</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">7</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">8</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">9</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">10</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">11</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">12</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">13</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">14</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">15</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">16</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							    <tr>
							      <th scope="row">17</th>
							      <td>xx xxxxxxxxx</td>
							      <td>xxxxxxx</td>
							      <td>H</td>
							      <td>5</td>
							      <td>3</td>
							      <td>4</td>
							      <td>12</td>
							    </tr>
							  </tbody>
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
  	const checkboxes = document.querySelectorAll('.Check_c');
 $(checkboxes).each(function() {
    if (this.checked) {
      $(this).change();
      console.log("yes");
    }
  });
// When checkbox is checked
$(checkboxes).change(function() {
  const selectedStatuses = []; // Store selected statuses
var visibleIndex = 1; // เริ่มต้นเลขลำดับที่ 1
  // Loop through all checkboxes
  $(checkboxes).each(function() {
    // If checkbox is checked, add its value (status) to the array
    if ($(this).prop('checked')) {
      selectedStatuses.push($(this).val());
    console.log("checked : "+selectedStatuses);

    }
  });

  // If no checkbox is selected, show all rows
  if (selectedStatuses.length === 0) {
    $('tbody tr').show();
    $("tbody tr").each(function(index) {
	      $(this).find("th:eq(0)").text(index+1); // จัดลำดับเหมือนเดิม
	    });
    return;
  }

  // Loop through each row and check its status
  $('tbody tr').each(function() {
    const status = $(this).find('td:eq(2)').text();
    // console.log("checked : "+selectedStatuses);

    console.log("sta : "+status);
    // If the row's status is in the selected statuses array, show the row
    if (selectedStatuses.includes(status)) {
      $(this).show();
      $(this).find("th:eq(0)").text(visibleIndex++);
    } else {
      $(this).hide();
    }
  });
});

// ค้นหา
$("#floatingInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });

});
	</script>