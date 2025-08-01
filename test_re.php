<style>
	#selectableList {
      display: grid;
      grid-template-columns: repeat(2, minmax(150px, 1fr));
      gap: 10px;
      list-style: none;
      padding: 0;
      margin: 0;
  }
  @media all and (max-width: 572px) {
    #selectableList {
        grid-template-columns: repeat(1, minmax(150px, 1fr));
    }
}
  #selectableList li {
      position: relative;
      background-color: #ffffff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: background-color 0.3s ease;
      font-weight: 600;
      border: 1px solid black; 
  }

  #selectableList li:hover {
      background-color: #e6f7ff;
  }

  #selectableList li.active {
      background-color: #cce5ff;
  }
  #roomStatusChart, #usageChart{
    width: 100% !important;
  }
</style>
<div class="container-fluid pb-4">
	<div class="row g-3 p-3">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<h3>ห้องเรียน/ห้องประชุม</h3>
				</div>
				<div class="col-md-12">
					<p>ข้อมูล ณ วันที่ <?php echo Datethai(date("Y-m-d")); ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row g-3">
		<div class="col-md-12">
			<ul id="selectableList" class="text-center">
				<li data-date="1" id="start">วัน</li>
				<!-- <li data-date="2">เดือน</li> -->
				<li data-date="3">ปี</li>
			</ul>
		</div>
        <div id="day">
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        
        $('#selectableList li').on('click', function() {
            $('#selectableList li').removeClass('active');

            $(this).addClass('active');

            var selectedDate = $(this).data('date');
            console.log(selectedDate);
            if (selectedDate === 1) {
                $('#day').load('load_room.php', function (response, status, xhr) {
                    if (status === "error") {
                        console.log("Error loading Room.php: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
            if (selectedDate === 2) {
                
            }
            if (selectedDate === 3) {
                $('#day').load('load_roomy.php', function (response, status, xhr) {
                    if (status === "error") {
                        console.log("Error loading Room.php: " + xhr.status + " " + xhr.statusText);
                    }
                });
            }
        });
    });
</script>