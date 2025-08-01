<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=Res">วิจัย</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">Proceeding</li>
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
								<input class="Check_c me-1" type="checkbox" value="ระดับนานาชาติ" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">EN</p>
							</div>
							<div href="" class="circle " style="background-color: #4C78A8;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="ระดับชาติ" id="secondCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">TH</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- <div class="col-md-4">
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
		</div> -->
	</div>
	<div class="row g-3 mt-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12 text-center">
							<table class="table table-striped table-hover" id="T_1">
							  <thead>
								  <tr>
									<th>ลำดับ</th>
									<th>ชื่อโครงการ</th>
									<th width="15%">ประเภท</th>
									<th width="25%">ผู้เขียน</th>
									<tr>
										<th colspan="3"></th>
										<th>ชื่อ - นามสกุล &nbsp;&nbsp;&nbsp;&nbsp; เกี่ยวข้อง</th>
									</tr>
								  </tr>
								</thead>
								<tbody id="bod">
									<?php
									$row1=0;
									$r=0;
									
								$db4=new Database('nurse');
								$db4->Table = "RS_Proceeding";	
								$db4->Where = "Where PCD_Year >= '".(date('Y')-4)."' AND PCD_Year <= '".date('Y')."' AND PCD_status = '1' ORDER BY PCD_Year DESC";
								$user4= $db4->Select();
								foreach($user4 as $values4=>$data4){
									$row1++;
								  ?>
									<tr>
										<th><?php echo $row1;?></th>
										<td class="text-start"><?php if($data4['PCD_Level'] == 1){
												echo $data4['PCD_NameEN'];
											}else if($data4['PCD_Level'] == 2){
												echo $data4['PCD_NameTH'];
											} ?>
										</td>
										<?php switch($data4['PCD_Level']){
			                	case'1':{echo "<td>ระดับนานาชาติ</td>";break;} 
												case'2':{echo "<td>ระดับชาติ</td>";break;}
											}?>
										
										<td valign="top" bgcolor="#FFFFFF"><table class="table table-striped table-hover">
             <?php
				$db1=new Database('nurse');
				$db1->Table = "RS_LsNamePCD";
				$db1->Where = "Where PCD_id='$data4[PCD_id]' order by LN_Status desc";	
				$user1= $db1->Select();
				foreach($user1 as $values1=>$data1){
					$len=strlen($data1['LN_Name']);
      		?>
      		
      		<tbody id="dob">
              <tr><?php 
		if($len==8){
			$db2=new Database('nurse');
			$db2->Table = "user_data";
			$db2->Where = "where ud_id='$data1[LN_Name]'";	
			$user2= $db2->Select();
			foreach($user2 as $values2=>$data2){ echo "<td class='text-start'>".$data2['name_th']." ".$data2['lname_th']."</td>";}
		}else{echo "<td class='text-start'>".$data1['LN_Name']."</td>";}
		?>
                <?php switch($data1['LN_Status']){
                	case'6':{echo "<td class='text-start'>ชื่อแรก</td>";break;} 
									case'5':{echo "<td class='text-start'>หัวหน้าโครงการฯ</td>";break;} 
									case'4':{echo "<td class='text-start'>ผู้ร่วม</td>";break;} 
									case'3':{echo "<td class='text-start'>ที่ปรึกษาโครงการฯ</td>";break;} 
			}
		?>
              </tr>
              </tbody>
              <?php }?>
            </table></td>
									</tr>
										<?php	}?>
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
  	var table = $('#T_1').DataTable({
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


  	const checkboxes = document.querySelectorAll('.Check_c');
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
  
  table.column(2).search(selectedStatuses.join('|'), true, false);
  table.draw();
});


});
	</script>