<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>ภาระงาน</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d"));?></p>
				</div>
			</div>
		</div>
		<div class="col-md-4" style="display: none;">
			<label for="project_Year" class="form-label"><strong>ปีการศึกษา</strong></label>
	    <select id="project_Year" class="form-select" name="project_Year">
	      <option selected disabled value="">เลือก</option>
	      
	      <option value="2023">2566</option>
	      
	    </select>
		</div>
		<div class="col-md-4">
			<label for="project_Year" class="form-label"><strong>ปีงบประมาณ</strong></label>
			<select class="form-select select-sm" name="year-section" id="year-section">
			    <!-- สร้างตัวเลือกปีปัจจุบันและย้อนหลัง 5 ปี -->
			    <?php
			        $currentYear = date('Y');
			        for ($i = 0; $i < 4; $i++) {
			            $year = $currentYear - $i;
			            $buddhistYear = $year + 543;
			            $selected = ($i === 0) ? 'selected' : '';
			            echo "<option value=\"$year\" $selected>$buddhistYear</option>";
			        }
			    ?>
			</select>
		</div>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">ภาระงานรวม</h2>	
						</div>
						<div class="col-md-12 p-5 text-center" id="result">
							<!-- <a href="Page.php?feed=Cred"> -->
								<h1 style="color: #EF6400;font-weight: 900;font-size: xxx-large;"></h1>
							<!-- </a> -->
						</div>
						<div class="col-md-12">
							<div class="row">
							<div class="col-md-6 text-center" id="work_per" style="border-right: 2px solid black; padding-right: 0.3rem; ">
								<h1 style="color: #008BEF;">ภาระงานเฉลี่ยต่อคน</h1>
								<h2 class="p-5"> </h2>	
							</div>
							<div class="col-md-6 text-center" id="work_over">
								<h1 style="color: #0500FA;">ประมาณค่าสอนเกิน</h1>
								<h2 class="p-5"> XXX,XXX บาท</h2>	
							</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12" style="display: none;">
			<a href="Page.php?feed=Stand">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">ภาระงานเป็นไปตามมาตราฐานภาระงาน</h2>	
						</div>
						<div class="col-md-12 p-5 text-center" >
							<h1 style="color: #077312;font-weight: 900;font-size: xxx-large;">XX คน</h1>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
		<div class="col-md-6" style="display: none;">
			<a href="Page.php?feed=Stand">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">สูงกว่ามาตราฐาน</h2>	
						</div>
						<div class="col-md-12 p-5 text-center" >
							<h1 style="color: #F70000;font-weight: 900;font-size: xxx-large;">XX คน</h1>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
		<div class="col-md-6" style="display: none;">
			<a href="Page.php?feed=Stand">
			<div class="card">
				<div class="card-body">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-center">ต่ำกว่ามาตราฐาน</h2>	
						</div>
						<div class="col-md-12 p-5 text-center" >
							<h1 style="color: #827507;font-weight: 900;font-size: xxx-large;">XX คน</h1>
						</div>
					</div>
				</div>
			</div>
			</a>
		</div>
	</div>	<!-- row g-3 -->
</div>	<!-- contaniner -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	// JavaScript
	$(document).ready(function() {
		$('#year-section').change(function() {
			var selectedYear = $(this).val();
			if (selectedYear !== '') {
				fetchData(selectedYear);
			} else {
				$('#result h1').empty();
			}
		});

		function fetchData(year) {
			$.ajax({
				url: 'config/get_data_work.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
				method: 'POST',
				data: {
					year: year
				},
				success: function(data) {
					$('#result h1').text(data);
				}
			});

			$.ajax({
				url: 'config/get_data_work_per.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
				method: 'POST',
				data: {
					year: year
				},
				success: function(data) {
					$('#work_per h2').text(data);
				}
			});

			$.ajax({
				url: 'config/get_data_work_over.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
				method: 'POST',
				data: {
					year: year
				},
				success: function(data) {
					$('#work_over h2').text(data);
				}
			});
		}

		var initialYear = new Date().getFullYear().toString();
		fetchData(initialYear);
	});
</script>