<style type="text/css">
    .table-bordered {
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
    }

    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }

    .kpi-card {
        border-radius: 12px;
        padding: 20px;
        height: 100%;
        border: none;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }

    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }
</style>
<?php
function calculateDateDifferenceDetailed($startDate, $endDate = null)
{
    if (empty($startDate)) {
        return "ไม่มีข้อมูลวันที่";
    }

    try {
        $start = new DateTime($startDate);
        $end = $endDate ? new DateTime($endDate) : new DateTime();

        $diff = $start->diff($end);

        $years = $diff->y;
        $months = $diff->m;
        $days = $diff->d;
        $totalDays = $diff->days;

        $result = "";
        $statusClass = "";
        $statusText = "";
        $statusIcon = "";

        if ($years > 0) {
            $result .= $years . " ปี ";
        }
        if ($months > 0) {
            $result .= $months . " เดือน ";
        }
        if ($days > 0) {
            $result .= $days . " วัน ";
        }

        if (empty($result)) {
            $result = "วันเดียวกัน";
            $statusClass = "text-success";
            $statusText = "ใหม่";
            $statusIcon = "✓";
        } else {
            $result = trim($result);

            // กำหนดระดับการแจ้งเตือนตามจำนวนวัน
            if ($totalDays <= 30) {
                $statusClass = "text-success";
                $statusText = "ปกติ";
                $statusIcon = "✓";
            } elseif ($totalDays <= 90) {
                $statusClass = "text-warning";
                $statusText = "ควรติดตาม";
                $statusIcon = "⚠";
            } elseif ($totalDays <= 180) {
                $statusClass = "text-orange";
                $statusText = "ล่าช้า";
                $statusIcon = "⚡";
            } elseif ($totalDays <= 365) {
                $statusClass = "text-danger";
                $statusText = "ล่าช้ามาก";
                $statusIcon = "❗";
            } else {
                $statusClass = "text-danger fw-bold";
                $statusText = "ล่าช้าวิกฤต";
                $statusIcon = "🚨";
            }
        }

        // สร้างผลลัพธ์แบบละเอียด
        $output = "<div class='d-flex align-items-center'>";
        $output .= "<span class='me-2'>" . $result . "</span>";
        $output .= "<span class='badge bg-light text-dark border'> รวม " . $totalDays . " วัน</span>";
        $output .= "</div>";
        $output .= "<div class='mt-1'>";
        $output .= "<small class='$statusClass'>";
        $output .= "<i class='me-1'>" . $statusIcon . "</i>";
        $output .= "<strong>" . $statusText . "</strong>";
        $output .= "</small>";
        $output .= "</div>";

        return $output;
    } catch (Exception $e) {
        return "รูปแบบวันที่ไม่ถูกต้อง";
    }
}
?>
<div class="container-fluid pb-4" style=" color: #000000; background-color:#d8d6d6">
    <div class="row g-3 mt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Page.php" style="color: #fff;">Home</a></li>
                <li class="breadcrumb-item active" id="activet" aria-current="page">โครงการ</li>
            </ol>
        </nav>
    </div>
    <div class="Header_sub_nu" style="padding-right: 10px;">
        <h3>โครงการที่ไม่ได้ดำเนินรายงานผล (<?php $year_all = $_GET['year_a'] + 543;
                                            echo "ในปี พ.ศ." . $year_all; ?>)</h3>
    </div>
    <div class="kpi-card">
        <table class="table table-hover" id="dtBasicExample">
            <thead class="Table_header_nu">
                <tr>
                    <th width="5%">#</th>
                    <th width="10%">เลขที่รับ</th>
                    <th width="30%">ชื่อโปรเจค</th>
                    <th width="15%">ระยะวัน</th>
                    <th width="15%">รายชื่อ</th>
                </tr>
            </thead>
            <tbody class="Table_body_nu">
                <?php
                $pro = "";
                $r = 0;

                $db6 = new Database('nurse');
                $db6->Table = "proj_list";
                $db6->Where = "where project_Year = '$_GET[year_a]' AND project_status IN ('06') order by project_dateofyear ASC";
                $user6 = $db6->Select();
                foreach ($user6 as $values6 => $data6) {
                    $dbGrpabo = new Database('nurse');
                    $dbGrpabo->Table = "proj_comment";
                    $dbGrpabo->Where = "where project_id = '$data6[project_id]' ANd comm_part = '5' AND comm_status = '3'";
                    $userGrpabo = $dbGrpabo->Select();
                    foreach ($userGrpabo as $valuesGrpabo => $dataGrpabo) {
                        $apporve_date = $dataGrpabo['comm_date'];
                    }
                    $r++; ?>

                    <tr>
                        <td class="text-center"><?php echo $r; ?></td>
                        <?php
                        if ($data6['project_ReceiptNo'] == "") {
                            echo "<td class='text-center'>-</td>";
                        } else {
                            $year_r = strtotime($data6['project_ReceiptDate']);
                            $year_re = date('Y', $year_r) + 543; ?>
                            <td><?php echo $data6['project_ReceiptNo'] . "/" . $year_re; ?></td>
                        <?php } ?>
                        <td><span class="d-inline-block text-truncate" style="max-width: 350px;">
                                <?php echo $data6['project_name']; ?>
                            </span><br>
                            <span style="font-size: 10px;" class="text-secondary">
                                <?php echo "สร้างเมื่อ : " . DateThai($data6['project_dateofyear']) ?>
                            </span>
                        </td>
                        <td>
                            <!-- คำนวนว่ากี่วันกี่เดือนกี่ปีตั้งแต่วันที่อนุมัติโครงการจนถึงปัจจุบัน -->
                            <?php
                            echo calculateDateDifferenceDetailed($apporve_date, $endDate = null);
                            ?>
                        </td>

                        <td style="font-size: 10px;">
                            <?php
                            $manager = 0;
                            $dbGrp12 = new Database('nurse');
                            $dbGrp12->Table = "proj_userProject";
                            $dbGrp12->Where = "where project_id = '$data6[project_id]' AND (userProj_status = '1' OR userProj_status = '2') ORDER BY userProj_status DESC";
                            $userGrp12 = $dbGrp12->Select();
                            foreach ($userGrp12 as $valuesGrp12 => $dataGrp12) {
                                $dbGrp2 = new Database('nurse');
                                $dbGrp2->Table = "user_data";
                                $dbGrp2->Where = "where ud_id='$dataGrp12[ud_id]' ";
                                $userGrp2 = $dbGrp2->Select();
                                foreach ($userGrp2 as $valuesGrp2 => $dataGrp2) {
                                    $dbtitle11 = new Database('nurse');
                                    $dbtitle11->Table = "front_title";
                                    $dbtitle11->Where = "where front_id='$dataGrp2[title]'";
                                    $usertitle11 = $dbtitle11->Select();
                                    foreach ($usertitle11 as $valuestitle11 => $datatitle11) {
                                        if ($dataGrp12['userProj_status'] == 2 && $_SESSION['ud_id_MGProject'] == $dataGrp12['ud_id']) {
                                            $manager = 1;
                                        }

                                        switch ($dataGrp12['userProj_status']) {
                                            case '1':
                                                echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ผู้จัดทำ<br>";
                                                break;

                                            case '2':
                                                echo $dataGrp2['name_th'] . " " . $dataGrp2['lname_th'] . " : ประธาน<br>";

                                                break;
                                        }
                                    }
                                }
                            } ?>
                        </td>
                    </tr>


                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {

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
                $('select').addClass('form-select form-select-sm ms-2 mb-3')[0].style.width = "150px";
                $('input[type="search"]').addClass('form-control me-2 mb-3');
            },
            "drawCallback": function(settings) {
                $('[data-toggle="tooltip"]').tooltip();
            }
        });

    });
</script>