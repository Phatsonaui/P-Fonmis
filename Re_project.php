<div class="container-fluid pb-4">
	<div class="row g-3 mt-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb">
		    <li class="breadcrumb-item"><a href="Page.php">Home</a></li>
		    <li class="breadcrumb-item"><a href="Page.php?feed=Res">วิจัย</a></li>
		    <li class="breadcrumb-item active" id="activet" aria-current="page">โครงการวิจัย</li>
		  </ol>
		</nav>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
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
		<!-- <div class="col-md-4">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							คัดกรองตามสถานะ
						</div>
						<div class="col-md-12 relation text-center">
							<div href="" class="circle " style="background-color: #54A24B;margin-right: 30px;">
								<input class="Check_c me-1" type="checkbox" value="TCI" id="firstCheckbox">
								<p style="color: #fff;font-weight: 800;margin-top: 9px;position: static;">TCI</p>
							</div>
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
		</div> -->
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
									<th width="2%">#</th>
									<th width="35%">ชื่อโครงการ</th>
									<th width="28%">ผู้เขียน</th>
								  </tr>
								</thead>
								<tbody>
									<?php 		
									$row1 =0;	
								$db4=new Database('nurse');
								$db4->Table = "RS_Project";	
								$db4->Where = "Where PJ_Year >= '".(date('Y')-4)."' AND PJ_Year <= '".date('Y')."' ORDER BY PJ_Year DESC";
								$user4= $db4->Select();
								foreach($user4 as $values4=>$data4){ $row1++; ?>
									<tr>
										<th><?php echo $row1;?></th>
										<?php 
										$count_row = count($user4); 
										if ($row1 == $count_row) { // เปรียบเทียบจำนวนแถวในตารางกับจำนวนแถวที่นับได้ 
											echo "<td class='text-start' style='color:red;'>ข้อมูลสุดท้ายคือ ".$data4['PJ_NameTH']."</td>"; 
										}else{ 
											echo "<td class='text-start'>".$data4['PJ_NameTH']."</td>"; 
										} ?>
										<td bgcolor="#FFFFFF">
											<table class="table table-striped table-hover">
												<tbody>
             <?php
				$db1=new Database('nurse');
				$db1->Table = "RS_LsNamePJ";
				$db1->Where = "Where PJ_ID='$data4[PJ_id]' order by LN_Status desc";	
				$user1= $db1->Select();
				foreach($user1 as $values1=>$data1){
					$len=strlen($data1['LN_Name']);
      		?>
              <tr>
                <td class='text-start'><?php 
		if($len==8){
			$db2=new Database('nurse');
			$db2->Table = "user_data";
			$db2->Where = "where ud_id='$data1[LN_Name]'";	
			$user2= $db2->Select();
			foreach($user2 as $values2=>$data2){ echo $data2['name_th']." ".$data2['lname_th'];}
		}else{echo $data1['LN_Name'];}
		?></td>
                <td class='text-start'><?php switch($data1['LN_Status']){
				case'5':{echo "หัวหน้าโครงการฯ";break;} 
				case'4':{echo "ผู้ร่วมโครงการฯ";break;} 
				case'3':{echo "ที่ปรึกษาโครงการฯ";break;} 
			}
		?></td>
              </tr>
              <?php }?>
              </tbody>
            </table>            </td>
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
        $('select').addClass('form-select form-select-sm ms-2')[0].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2');
    },
    "drawCallback": function( settings ) {
        $('[data-toggle="tooltip"]').tooltip();
    }
  });

  	$(".Check_c").change(function() {
  var checkedValues = $('.Check_c:checked').map(function() {
    return this.value;
  }).get();
console.log(checkedValues);
});


});
	</script>