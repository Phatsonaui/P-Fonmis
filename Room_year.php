<style>
    .project-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin: 10px;
        background-color: #fafafa;
    }

    .box, .box-most, .box-lit, .box-def {
        background-color: #FFFFFF;
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 24px;
        border: 1px solid var(--color-box);
        box-shadow: 3px 3px 5px var(--color-box);

        .room-title {
            color: #1A202C;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            font-weight: 600;

            .sec-head {
                line-height: 24px;
                font-size: 16px;
                font-weight: 700;
            }
        }

        .room-info {
            display: flex;
            justify-content: center;
            align-items: center;

            span {
                line-height: 21px;
                font-size: 18px;
                font-weight: 600;
                color: var(--color-box);
                margin-left: 8px;
            }
        }

        h1 {
            line-height: 150%;
            margin-bottom: 14px;
            text-align: center;
            font-size: 1.5rem;
        }

        h6 {
            line-height: 150%;
            margin-bottom: 14px;
            text-align: center;
            font-weight: 700;
        }

        h2 {
            color: var(--color-box);
        }

        h4 {
            color: var(--color-box);
        }

        .room-num{
            display: flex;
            align-items: center;
            justify-content: flex-end;
            font-weight: 700;
            font-size: 16px;
            line-height: 15px;
            letter-spacing: -0.02em;
            color: var(--color-box);
        }

        p {
            font-weight: 700;
            font-size: 16px;
            line-height: 15px;
            letter-spacing: -0.02em;
            color: var(--color-box);
            text-align: end;
        }
    }

    .box-most {
        --color-box: var(--color-most);
    }

    .box-lit {
        --color-box: var(--color-littel);
    }

    .box-def {
        --color-box: var(--color-def);
    }

    .content-card {
        display: grid;
        grid-template-columns: repeat(3, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;

        .kpi-card{
            display: flex;
            align-items: center;
        }
    }
    
    .content-card_re {
        display: grid;
        grid-template-columns: repeat(1, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .content-card_plan {
        display: grid;
        grid-template-columns: repeat(2, minmax(150px, 1fr));
        gap: 10px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .kpi-card {
        background: #f8f8f8;
        /* rgb(216 214 214); */
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* 11px 12px 7px rgba(0, 0, 0, 0.15); */
        height: 100%;
        border: solid 1px #d0d0d0;
    }

    .kpi-card>h2 {
        padding: 1.5rem;
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #333;
        text-align: center;
    }

    .kpi-card>.card-body p,
    h1,
    p {
        font-weight: 700;
        margin: 0;
    }

    .kpi-data {
        display: flex;
        justify-content: center;
        align-items: baseline;
        gap: 10px;
    }

    .kpi-value {
        font-size: 2rem;
        font-weight: bold;
    }

    .kpi-label {
        font-size: 0.9rem;
    }

    .container-core {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .card-core {
        flex: 1 1 300px;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .number-core {
        font-size: 2em;
        text-align: center;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .header-core {
        background-color: #ff9b69;
        color: #fff;
        padding: 10px;
        text-align: center;
        font-weight: bold;
        border-radius: 4px;
        margin-bottom: 15px;
    }

    .list-item-core {
        display: flex;
        justify-content: space-between;
        padding: 8px;
        font-size: 1rem;
        border-bottom: 1px solid #d0d0d0;
    }

    .list-item-core:nth-child(2) {
        background-color: #d0d0d0;
    }

    .list-item-core:last-child {
        border-bottom: none;
    }

    .badge-count {
        font-weight: bold;
    }

    .rounded-full {
        border-radius: 9999px;
        width: 20px;
        /* กำหนดขนาด*/
        height: 13px;
        border: solid 1px #D0D0FF;
    }

    .success-full {
        background-color: rgb(34, 197, 94);
    }

    .warning-full {
        background-color: rgb(234 179 8);
    }

    .danger-full {
        background-color: rgb(239 68 68);
    }

    .default-full {
        background-color: rgb(107 114 128);
    }

    .flex-container-rounded {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bgg-primary {
        background-color: #c1602f;
    }

    .bgg-success {
        background-color: #ec7032;
    }

    .bgg-danger {
        background-color: #ff9b69;
    }

    .bgg-warning {
        background-color: #162339;
    }

    .bgg-info {
        background-color: #50514f;
    }

    @media all and (max-width: 572px) {
        .content-card {
            grid-template-columns: repeat(2, minmax(150px, 1fr));
        }
        .project-container {
            grid-template-columns: repeat(1, minmax(150px, 1fr));
        }
    }

    @media all and (max-width: 780px) {
        .sec-head{
            font-size: 18px;
        }
    }
</style>
<div class="container-fluid pb-4" style=" color: #000000; background-color:#d8d6d6">
	<div class="row g-3">
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-2 text-end">
                            <label for="year-section" class="col-form-label">ปี พ.ศ.</label>
                        </div>
                        <div class="col-md-4 text-end" style="font-weight: 900;">
                        <?php 
                            $currentYear = date("Y"); // ปีปัจจุบัน

                            echo '<select class="form-select select-sm" name="year-section" id="year-section">';

                            for ($year = $currentYear - 1; $year <= $currentYear + 1; $year++) {
                                
                                echo '<option value="' . $year . '"';
                                if ($year == $currentYear) {
                                    echo ' selected';
                                }
                                echo '>' . ($year + 543) . '</option>';
                            }
                            echo '</select>';
                        ?>
                    </div>
                </div>
                <h2><strong>Room Usage Analysis</strong></h2>
                <div class="content-card">
                    <div class="box">
                        <div class="room-title"> <h3 class="sec-head">จำนวนชั่วโมงการใช้ห้องทั้งหมด</h3><h2><i class="bi bi-clock"></i></h2></div>
                        <div class="room-info"> <p id="sH"></p> <span>(ชม.)</span></div>
                    </div>

                    <div class="box">
                        <div class="room-title"> <h3 class="sec-head">ความถี่การใช้ห้องทั้งหมด</h3><h2><i class="bi bi-check2-all"></i></h2></div>
                        <div class="room-info"> <p id="useds"></p> <span>(ครั้ง)</span></div>
                    </div>

                    <div class="box">
                        <div class="room-title"> <h3 class="sec-head">เฉลี่ยชั่วโมงต่อห้อง</h3><h2><i class="bi bi-clock"></i></h2></div>
                        <div class="room-info"> <p id="avgHours"></p> <span>(ชม.)</span></div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>รายงานการใช้ห้อง</strong></h2>
                <div class="row justify-content-center">
                    <div class="project-container">
                        <div class="kpi-card">
                            <div class="container">
                                <div class="row g-3 mb-3">
                                    <div class="box-most">
                                        <div class="room-title"> <h3 class="sec-head">ห้องที่ใช้งานบ่อย</h3><h2><i class="bi bi-buildings-fill"></i></h2></div>
                                        <h1 id="mostUsedRoomName"></h1>
                                        <div class="room-num">
                                            <p id="max_use"></p><span> ครั้ง</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 " style="border-bottom: red 1px solid;">
                                        <h3 class="sec-head">แยกตามประเภทอาคาร</h3>
                                    </div>
                                    <div class="project-container">
                                        <div class="box-most">
                                            <div class="room-title"> <h3 class="sec-head">อาคาร ผศ.นพรัตน์ ผลาพิบูลย์</h3><h2><i class="bi bi-buildings-fill"></i></h2></div>
                                            <h1 id="roommaxNames_n"></h1>
                                            <div class="room-num">
                                                <p id="maxUsage_n"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-most">
                                            <div class="room-title"> <h3 class="sec-head">อาคารเฉลิมพระเกียรติฯ</h3><h2><i class="bi bi-buildings-fill"></i></h2></div>
                                            <h1 id="roommaxNames_c"></h1>
                                            <div class="room-num">
                                                <p id="maxUsage_c"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 " style="border-bottom: red 1px solid;">
                                        <h3 class="sec-head">แยกตามประเภทห้อง</h3>
                                    </div>
                                    <div class="project-container">
                                        <div class="box-most">
                                            <div class="room-title"> <h3 class="sec-head">ห้องเรียน</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roommaxNames_std"></h6>
                                            <div class="room-num">
                                                <p id="maxUsage_std"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-most">
                                            <div class="room-title"> <h3 class="sec-head">ห้องประชุม</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roommaxNames_meet"></h6>
                                            <div class="room-num">
                                                <p id="maxUsage_meet"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-most">
                                            <div class="room-title"> <h3 class="sec-head">ห้องแลป</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roommaxNames_lab"></h6>
                                            <div class="room-num">
                                                <p id="maxUsage_lab"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kpi-card">
                            <div class="container">
                                <div class="row g-3 mb-3">
                                    <div class="box-lit">
                                        <div class="room-title"> <h3 class="sec-head">ห้องที่ใช้งานน้อย</h3><h2><i class="bi bi-building-fill"></i></h2></div>
                                        <h1 id="minUsedRoomName"></h1>
                                        <div class="room-num">
                                            <p id="min_use"></p><span> ครั้ง</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 " style="border-bottom: red 1px solid;">
                                        <h3 class="sec-head">แยกตามประเภทอาคาร</h3>
                                    </div>
                                    <div class="project-container">
                                        <div class="box-lit">
                                            <div class="room-title"> <h3 class="sec-head">อาคาร ผศ.นพรัตน์ ผลาพิบูลย์</h3><h2><i class="bi bi-building-fill"></i></h2></div>
                                            <h1 id="roomminNames_n"></h1>
                                            <div class="room-num">
                                                <p id="minUsage_n"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-lit">
                                            <div class="room-title"> <h3 class="sec-head">อาคารเฉลิมพระเกียรติฯ</h3><h2><i class="bi bi-building-fill"></i></h2></div>
                                            <h1 id="roomminNames_c"></h1>
                                            <div class="room-num">
                                                <p id="minUsage_c"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 " style="border-bottom: red 1px solid;">
                                        <h3 class="sec-head">แยกตามประเภทห้อง</h3>
                                    </div>
                                    <div class="project-container">
                                        <div class="box-lit">
                                            <div class="room-title"> <h3 class="sec-head">ห้องเรียน</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roomminNames_std"></h6>
                                            <div class="room-num">
                                                <p id="minUsage_std"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-lit">
                                            <div class="room-title"> <h3 class="sec-head">ห้องประชุม</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roomminNames_meet"></h6>
                                            <div class="room-num">
                                                <p id="minUsage_meet"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                        <div class="box-lit">
                                            <div class="room-title"> <h3 class="sec-head">ห้องแลป</h3><h4><i class="bi bi-building-fill"></i></h4></div>
                                            <h6 id="roomminNames_lab"></h6>
                                            <div class="room-num">
                                                <p id="minUsage_lab"></p><span> ครั้ง</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>Top 10 ห้องที่ใช้มากที่สุด (ชั่วโมง)</strong></h2>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="kpi-card">
                            <div id="room_10" style="width: 100%; height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <div class="kpi-card">
                <h2><strong>ความถี่การใช้ห้อง (ครั้ง)</strong></h2>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="kpi-card">
                            <div id="roomChart" style="width: 100%; height:500px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
			<div class="kpi-card">
					<div class="row g-3">
						<div class="col-md-12">
							<h2 class="card-title text-start">รายละเอียดการใช้ห้อง</h2>
							<div id="Reserv"></div>
						</div>
					</div>
			</div>
		</div>
	</div> <!-- row g-3 -->
</div> <!-- container -->
<script>
	$(document).ready(function() {
        var selectedYear = null;
        
        function animateMoney(element, start, end, duration) {
            // if (end === 0) return;

            // กำหนดเวลาให้สั้นลงถ้าค่าน้อย
            if (end <= 100) {
                duration = 300; // ปรับให้แสดงเร็วขึ้น
            }

            var range = end - start;
            var stepTime = Math.abs(Math.floor(duration / Math.max(range, 1))); // เวลาต่อการนับ
            var increment = range / (duration / 50); // เพิ่มค่าทีละน้อยตามเวลา

            var current = start;
            var timer = setInterval(function() {
                current += increment;

                if (current > end) current = end; // หยุดเมื่อถึง end

                // ตรวจสอบว่าเป็นจำนวนเต็มหรือไม่
                let displayValue = Number.isInteger(current)
                    ? current.toLocaleString() // จำนวนเต็ม
                    : current.toFixed(2).toLocaleString(); // มีทศนิยม 2 ตำแหน่ง

                $(element).text(displayValue);

                if (current >= end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        var currentDate = new Date();
        var initialYear = currentDate.getFullYear().toString(); //ปีปัจจุ บัน
        fetchData(initialYear);
        
        $('#year-section').change(function() {
            selectedYear = $(this).val();

            $('#result h1 span').html(`0`);
            fetchData(selectedYear);
        });

        function fetchData(year) {
            console.log("ปี : "+year);
            $.ajax({
                url: 'config/gen_room.php', // เปลี่ยนเป็น URL ที่จะรับข้อมูลจากเซิร์ฟเวอร์
                method: 'POST',
                data: {
                    year: year
                },
                success: function(data) {
                    console.log("Yo : "+data.totalHours+" / "+data.totalUsage+" / "+data.mostUsedRoom.room_name+" / "+data.maxUsageCount);

                    let avgHoursPerRoom = data.totalroom > 0 ? (data.totalHours / data.totalroom) : 0;
                    

                    // ใช้ animateMoney เพื่อแสดงข้อมูลพร้อมแอนิเมชัน
                    animateMoney('#sH', 0, data.totalHours || 0, 3000);
                    animateMoney('#useds', 0, data.totalUsage || 0, 3000);
                    animateMoney('#max_use', 0, data.maxUsageCount || 0, 3000);
                    animateMoney('#avgHours', 0, avgHoursPerRoom || 0, 3000);

                    // แสดงชื่อห้องที่ใช้งานมากที่สุด ถ้ามีข้อมูล
                    $('#mostUsedRoomName').text(data.maxUsageCount > 0 ? data.mostUsedRoom.room_name : 'ไม่มีข้อมูล');
                }
            });

            $.ajax({
                type: "POST",
                url: 'config/get_catebuil.php',
                data: {
                    year: year
                },
                success: function(response) {
                    let data = typeof response === "string" ? JSON.parse(response) : response;

                    let minUsage_n = Math.min(...data.roomUsage_n.map(room => room.usage_count_n)) || '0';
                    let maxUsage_n = Math.max(...data.roomUsage_n.map(room => room.usage_count_n)) || '0';
                    

                    let minRooms_n = data.roomUsage_n.filter(room => room.usage_count_n === minUsage_n);
                    let maxRooms_n = data.roomUsage_n.filter(room => room.usage_count_n === maxUsage_n);

                    let roomminNames_n = minRooms_n.length > 0 ? minRooms_n.map(room => room.room_name_n).join(', ') : 'ไม่มีข้อมูล';
                    let roommaxNames_n = maxRooms_n.length > 0 ? maxRooms_n.map(room => room.room_name_n).join(', ') : 'ไม่มีข้อมูล';

                    let minUsage_c = Math.min(...data.roomUsage_c.map(room => room.usage_count_c)) || '0';
                    let maxUsage_c = Math.max(...data.roomUsage_c.map(room => room.usage_count_c)) || '0';

                    let minRooms_c = data.roomUsage_c.filter(room => room.usage_count_c === minUsage_c);
                    let maxRooms_c = data.roomUsage_c.filter(room => room.usage_count_c === maxUsage_c);

                    let roomminNames_c = minRooms_c.length > 0 ? minRooms_c.map(room => room.room_name_c).join(', ') : 'ไม่มีข้อมูล';
                    let roommaxNames_c = maxRooms_c.length > 0 ? maxRooms_c.map(room => room.room_name_c).join(', ') : 'ไม่มีข้อมูล';

                    $('#roomminNames_n').text(roomminNames_n);
                    $('#roommaxNames_n').text(roommaxNames_n);

                    $('#roomminNames_c').text(roomminNames_c);
                    $('#roommaxNames_c').text(roommaxNames_c);

                    animateMoney('#minUsage_n', 0, minUsage_n, 3000);
                    animateMoney('#maxUsage_n', 0, maxUsage_n, 3000);

                    animateMoney('#minUsage_c', 0, minUsage_c, 3000);
                    animateMoney('#maxUsage_c', 0, maxUsage_c, 3000);

                    // let roomDetails = data.roomUsage_n.map(room => `${room.room_name_n}: ${room.usage_count_n}`).join('\n ');
                    // console.log("นพรัตน์ \n " + roomDetails);

                    // let roomDetailsc = data.roomUsage_c.map(room => `${room.room_name_c}: ${room.usage_count_c}`).join('\n ');
                    // console.log("เฉลิมพระเกียรติ \n " + roomDetailsc);

                    console.log(`
                        ห้องที่มีการใช้งานน้อยที่สุด (นพ): ${roomminNames_n}
                        ห้องที่มีการใช้งานมากที่สุด (นพ): ${roommaxNames_n}
                        ห้องที่มีการใช้งานน้อยที่สุด (เฉลิม): ${roomminNames_c}
                        ห้องที่มีการใช้งานมากที่สุด (เฉลิม): ${roommaxNames_c}
                        จำนวนการใช้งานน้อยที่สุด (นพ): ${minUsage_n}
                        จำนวนการใช้งานมากที่สุด (นพ): ${maxUsage_n}
                        จำนวนการใช้งานน้อยที่สุด (เฉลิม): ${minUsage_c}
                        จำนวนการใช้งานมากที่สุด (เฉลิม): ${maxUsage_c}
                    `);
                    setTimeout(function() {
                        updateUsageData(year);
                    }, 2000); 
                }
            });

            $.ajax({
                type: "POST",
                url: 'config/get_cateroom.php',
                data: {
                    year: year
                },
                success: function(response) {
                    let data = typeof response === "string" ? JSON.parse(response) : response;

                    // ห้องเรียน
                    let minUsage_std = Math.min(...data.roomUsage_std.map(room => room.usage_count_std)) || '0';
                    let maxUsage_std = Math.max(...data.roomUsage_std.map(room => room.usage_count_std)) || '0';

                    let minRooms_std = data.roomUsage_std.filter(room => room.usage_count_std === minUsage_std);
                    let maxRooms_std = data.roomUsage_std.filter(room => room.usage_count_std === maxUsage_std);

                    let roomminNames_std = minRooms_std.length > 0 ? minRooms_std.map(room => room.room_name_std).join(', ') : 'ไม่มีข้อมูล';
                    let roommaxNames_std = maxRooms_std.length > 0 ? maxRooms_std.map(room => room.room_name_std).join(', ') : 'ไม่มีข้อมูล';

                    // ห้องประชุม
                    let minUsage_meet = Math.min(...data.roomUsage_meet.map(room => room.usage_count_meet)) || '0';
                    let maxUsage_meet = Math.max(...data.roomUsage_meet.map(room => room.usage_count_meet)) || '0';

                    let minRooms_meet = data.roomUsage_meet.filter(room => room.usage_count_meet === minUsage_meet);
                    let maxRooms_meet = data.roomUsage_meet.filter(room => room.usage_count_meet === maxUsage_meet);

                    let roomminNames_meet = minRooms_meet.length > 0 ? minRooms_meet.map(room => room.room_name_meet).join(', ') : 'ไม่มีข้อมูล';
                    let roommaxNames_meet = maxRooms_meet.length > 0 ? maxRooms_meet.map(room => room.room_name_meet).join(', ') : 'ไม่มีข้อมูล';

                    // ห้องแล็บ
                    let minUsage_lab = Math.min(...data.roomUsage_lab.map(room => room.usage_count_lab)) || '0';
                    let maxUsage_lab = Math.max(...data.roomUsage_lab.map(room => room.usage_count_lab)) || '0';

                    let minRooms_lab = data.roomUsage_lab.filter(room => room.usage_count_lab === minUsage_lab);
                    let maxRooms_lab = data.roomUsage_lab.filter(room => room.usage_count_lab === maxUsage_lab);

                    let roomminNames_lab = minRooms_lab.length > 0 ? minRooms_lab.map(room => room.room_name_lab).join(', ') : 'ไม่มีข้อมูล';
                    let roommaxNames_lab = maxRooms_lab.length > 0 ? maxRooms_lab.map(room => room.room_name_lab).join(', ') : 'ไม่มีข้อมูล';


                    $('#roomminNames_std').text(roomminNames_std);
                    $('#roommaxNames_std').text(roommaxNames_std);

                    $('#roomminNames_meet').text(roomminNames_meet);
                    $('#roommaxNames_meet').text(roommaxNames_meet);

                    $('#roomminNames_lab').text(roomminNames_lab);
                    $('#roommaxNames_lab').text(roommaxNames_lab);

                    animateMoney('#minUsage_std', 0, minUsage_std, 3000);
                    animateMoney('#maxUsage_std', 0, maxUsage_std, 3000);

                    animateMoney('#minUsage_meet', 0, minUsage_meet, 3000);
                    animateMoney('#maxUsage_meet', 0, maxUsage_meet, 3000);

                    animateMoney('#minUsage_lab', 0, minUsage_lab, 3000);
                    animateMoney('#maxUsage_lab', 0, maxUsage_lab, 3000);

                    // let roomDetails = data.roomUsage_std.map(room => `${room.room_name_std}: ${room.usage_count_std}`).join('\n ');
                    // console.log("ห้องเรียน \n " + roomDetails);

                    // let roomDetailsmeet = data.roomUsage_meet.map(room => `${room.room_name_meet}: ${room.usage_count_meet}`).join('\n ');
                    // console.log("ห้องประชุม \n " + roomDetailsmeet);

                    // let roomDetailslab = data.roomUsage_lab.map(room => `${room.room_name_lab}: ${room.usage_count_lab}`).join('\n ');
                    // console.log("ห้องแลป \n " + roomDetailslab);

                    console.log(`
                        ห้องที่มีการใช้งานน้อยที่สุด (ห้องเรียน): ${roomminNames_std}
                        จำนวน : ${minUsage_std}
                        ห้องที่มีการใช้งานน้อยที่สุด (ห้องประชุม): ${roomminNames_meet}
                        จำนวน : ${maxUsage_meet}
                        ห้องที่มีการใช้งานน้อยที่สุด (ห้องแลป): ${roomminNames_lab}
                        จำนวน : ${minUsage_lab}

                        ห้องที่มีการใช้งานมากที่สุด (ห้องเรียน): ${roommaxNames_std}
                        จำนวน : ${maxUsage_std}
                        ห้องที่มีการใช้งานมากที่สุด (ห้องประชุม): ${roommaxNames_meet}
                        จำนวน : ${minUsage_meet}
                        ห้องที่มีการใช้งานมากที่สุด (ห้องแลป): ${roommaxNames_lab}
                        จำนวน : ${maxUsage_lab}
                    `);
                }
            });

            $.ajax({
                type: "POST",
                url: 'config/gen_frequency.php',
                data: {
                    year: year
                },
                success: function(response) {
                    // แปลง JSON response ให้เป็น Object (ถ้าจำเป็น)
                    let data = typeof response === "string" ? JSON.parse(response) : response;

                    // เรียงลำดับจากมากไปน้อย และเลือก 10 ห้องแรก
                    let sortedRooms = data.roomUsage ? data.roomUsage.sort((a, b) => b.usage_count - a.usage_count) : [];
                    let top10Rooms = sortedRooms.slice(0, 10);

                    let room_10 = top10Rooms.length > 0 ? top10Rooms.map(room => room.room_name) : ['ไม่มีข้อมูล'];
                    let room_v_10 = top10Rooms.length > 0 ? top10Rooms.map(room => room.usage_count) : ['ไม่มีข้อมูล'];
                    let room_h_10 = top10Rooms.length > 0 ? top10Rooms.map(room => room.usage_hours) : ['ไม่มีข้อมูล'];
                    
                    console.log("Yo1 : "+room_10+" / "+room_v_10+" / "+room_h_10);

                    var chartDom1 = document.getElementById('room_10');
                    var myChart1 = echarts.init(chartDom1, 'shine');
                    var option1;
                    
                    var colors = [];
                    for (var i = 0; i < 38; i++) {
                        colors.push('hsl(' + (i * 360 / 38) + ', 80%, 60%)'); // สร้างสีโดยใช้ HSL เพื่อหลีกเลี่ยงการซ้ำกัน
                    }
                    
                    option1 = {
                        legend: {},
                        title: {
                            text: 'การใช้งานห้อง (ปี ' + year + ')',
                            left: 'center'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow' // ชี้ที่แท่ง
                            },
                            formatter: function (params) {
                                // ตรวจสอบว่ามีข้อมูลใน params
                                if (params.length > 0) {
                                    let param = params[0]; // ECharts จะส่งข้อมูลของแท่งกราฟใน params[0]
                                    return `
                                        <b>ห้อง: ${param.name}</b><br/>
                                        <span style="color:${param.color};">ชั่วโมงการใช้งาน:</span> ${param.value.toFixed(2)} ชั่วโมง
                                    `;
                                }
                                return '';
                            }
                        },
                        xAxis: {
                            type: 'category',
                            data: room_10,
                            axisLabel: {
                                rotate: 35, // หมุนชื่อห้องถ้ายาวเกินไป
                                interval: 0 // แสดงชื่อห้องทั้งหมด
                            }
                        },
                        yAxis: {
                            type: 'value',
                            name: 'จำนวนชั่วโมงการใช้งาน (ชั่วโมง)'
                        },
                        series: [{
                            data: room_h_10,
                            type: 'bar',
                            itemStyle: {
                                color: '#c12e34' // สีของแท่งกราฟ
                            }
                        }]
                    };

                    // แสดงกราฟ
                    myChart1.setOption(option1);


                    // หาห้องที่ใช้งานน้อยที่สุด
                    let minUsage = data.roomUsage ? Math.min(...data.roomUsage.map(room => room.usage_count)) : 'ไม่มีข้อมูล';
                    let minRooms = data.roomUsage ? data.roomUsage.filter(room => room.usage_count === minUsage) : [];

                    let roomNamess = minRooms.length > 0 ? minRooms.map(room => room.room_name).join(', ') : 'ไม่มีข้อมูล';
                    $('#minUsedRoomName').text( minUsage > 0 ? roomNamess : "ไม่มีข้อมูล");
                    animateMoney('#min_use', 0, minUsage === 'ไม่มีข้อมูล' ? 0 : minUsage, 3000);

                    let roomNames = data.roomUsage ? data.roomUsage.map(room => room.room_name) : ['ไม่มีข้อมูล'];
                    let usageCounts = data.roomUsage ? data.roomUsage.map(room => room.usage_count) : ['ไม่มีข้อมูล'];
                    console.log("Yo1111: " + roomNames.join(', ') + " /\nvalue: " + minUsage);

                    // สร้างกราฟ ECharts
                    var chartDom = document.getElementById('roomChart');
                    var myChart = echarts.init(chartDom, 'shine');
                    var option;

                    
                    option = {
                        legend: {},
                        title: {
                            text: 'การใช้งานห้อง (ปี ' + year + ')',
                            left: 'center'
                        },
                        tooltip: {
                            trigger: 'axis',
                            axisPointer: {
                                type: 'shadow' // ชี้ที่แท่ง
                            }
                        },
                        xAxis: {
                            type: 'category',
                            data: roomNames,
                            axisLabel: {
                                rotate: 45, // หมุนชื่อห้องถ้ายาวเกินไป
                                interval: 0 // แสดงชื่อห้องทั้งหมด
                            }
                        },
                        yAxis: {
                            type: 'value',
                            name: 'จำนวนการใช้งาน (ครั้ง)'
                        },
                        series: [{
                            data: usageCounts,
                            type: 'bar',
                            itemStyle: {
                                // ใช้สีที่สร้างขึ้นจากการใช้ HSL
                                color: function(params) {
                                    return colors[params.dataIndex % colors.length]; // เลือกสีตามตำแหน่งของแท่ง
                                }
                            }
                        }]
                    };

                    // แสดงกราฟ
                    myChart.setOption(option);
                    window.addEventListener('resize', function() {
                        myChart.resize();
                        myChart1.resize();
                    });
                }
            });

            $.ajax({
                type: "POST",
                url: 'config/gen_roomy_t.php',
                data: {
                    year_r : year
                },
                success: function(data) {
                    $('#Reserv').html(data);
                    var table = $('#dtBasicExample').DataTable({
                        "lengthMenu": [
                            [10, 10, 25, 50, 100],
                            ["แสดงจำนวนข้อมูล", 10, 25, 50, 100]
                        ],
                        "dom": '<"d-flex justify-content-between align-items-center"l' +
                            '<"select-items"f>' +
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
                        initComplete: function() {
                            $('<input type="text" placeholder="ค้นหา"/>')
                                .appendTo('div.toolbar')
                                .on('keyup', function() {
                                    table.search(this.value).draw();
                                });
                            $('div.toolbar').addClass('d-flex flex-wrap justify-content-between align-items-center mb-3');
                            $('input[type="search"]').addClass('form-control me-2 mb-3');
                        },
                        "drawCallback": function(settings) {
                            $('[data-toggle="tooltip"]').tooltip();
                        }
                    });
                },
                error: function() {
                    Swal.close();
                    Swal.fire({
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถโหลดข้อมูลได้',
                        icon: 'error',
                        confirmButtonText: 'ตกลง'
                    });
                }
            });
            
        };

        function updateUsageData(year) {
            $('.box-lit, .box, .box-most, .box-def').each(function () {
                const usageValue = parseInt($(this).find('p').text());
                if (isNaN(usageValue)) return; // ถ้าค่าที่ได้ไม่ใช่ตัวเลขให้ข้ามไป

                const currentClass = $(this).attr('class'); // ดึงคลาสปัจจุบันของกล่อง
                const originalClass = $(this).data('original-class'); // ดึงคลาสเดิมจาก data attribute

                if (usageValue === 0) {
                    if (!originalClass) {
                        $(this).data('original-class', currentClass); // เก็บคลาสเดิมใน data-original-class
                    }
                    if (currentClass.includes('box-def')) return; // ถ้าเป็น box-def แล้วไม่ทำการเปลี่ยนแปลง
                    $(this).removeClass('box-lit box box-most').addClass('box-def');
                    $(this).attr('data-status', 'changed'); // เก็บสถานะการเปลี่ยนแปลง
                } else {
                    if (currentClass.includes('box-def')) {
                        // หากคลาสเป็น box-def ให้กลับไปที่คลาสเดิม
                        $(this).removeClass('box-def');
                        if (originalClass) {
                            $(this).addClass(originalClass); // เปลี่ยนกลับเป็นคลาสเดิม
                        }
                        $(this).attr('data-status', 'reset'); // รีเซ็ตสถานะ
                        $(this).removeData('original-class'); // ลบคลาสเดิมหลังจากรีเซ็ต
                    }
                }
            });
        }
        
    });
    
</script>