<div class="container mx-auto p-6">
	<div class="flex flex-col md:flex-row md:justify-between items-center mb-6">
		<h1 class="text-2xl font-semibold text-gray-800 mb-3 md:mb-0">ภาระงาน</h1>
		<div class="flex items-center space-x-4">
			<label class="text-gray-600 font-medium">ปีงบประมาณ:</label>
			<select id="year-section" class="border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
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

	<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		<!-- ภาระงานรวม -->
		<div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
			<span class="text-gray-500 font-medium mb-2">ภาระงานรวม</span>
			<span id="total_unit" class="text-4xl font-extrabold text-gray-900">-</span>
		</div>

		<!-- ภาระงานเฉลี่ยต่อคน -->
		<div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
			<span class="text-gray-500 font-medium mb-2">ภาระงานเฉลี่ยต่อคน</span>
			<span id="work_per" class="text-4xl font-extrabold text-blue-500">-</span>
		</div>

		<!-- ประมาณค่าสอนเกิน -->
		<div class="bg-white rounded-2xl shadow-md p-6 flex flex-col items-center">
			<span class="text-gray-500 font-medium mb-2">ประมาณค่าสอนเกิน</span>
			<span id="work_over" class="text-4xl font-extrabold text-indigo-500">-</span>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		function fetchData(year) {
			// console.log("Fetching data for year:", year);
			$.ajax({
				type: "POST",
				url: 'config/get_data_work.php',
				data: {
					year: year
				},
				success: function(data) {
					// console.log("Raw response:", data);
					try {
						if (typeof data === 'string') {
							data = JSON.parse(data);
						}
						$('#total_unit').text(data.total_unit);
						$('#work_per').text(data.work_per);
						$('#work_over').text(data.work_over);
					} catch (e) {
						console.error("JSON Parse Error:", e);
						console.log("Response:", data);
					}
				},
				error: function(xhr, status, error) {
					console.error("AJAX Error:", error);
				}
			});
		}

		$('#year-section').change(function() {
			// console.log($(this).val());
			fetchData($(this).val());
		});

		fetchData(new Date().getFullYear());
	});
</script>