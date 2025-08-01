<style>
  .img-fluidd {
    max-width: 50%;
    height: auto;
  }
</style>
<?php
include_once("../function/fun_verify.php");
if (isUserVerified_fon()) {
  include("../../class/class.db.php");
  $selected_year = $_POST['year'];

  echo '<div class="col-md-7">';
  echo '<div class="row g-3">';
  echo '<div class="col-md-12 text-start">';
  echo '<h4>ร้อยละความสำเร็จตามแผนกลยุทธ์</h4>';
  echo '</div>';
  echo '<div class="vol-md-12">';
  $r = 0;
  $sumPillar = 0;
  $dbPillar = new Database('nurse');
  $dbPillar->Table = "stg_Pillar";
  $dbPillar->Where = "where Pillar_year='$selected_year' AND Pillar_status='1'";
  $userPillar = $dbPillar->Select();
  $row1 = count($userPillar);
  foreach ($userPillar as $valuesPillar => $dataPillar) {
    $r++;
    $sumskpi = 0;

    $dbSKPI = new Database('nurse');
    $dbSKPI->Table = "stg_SKPI";
    $dbSKPI->Where = "where Pillar_id='$dataPillar[Pillar_id]' order by SKPI_id";
    $userSKPI = $dbSKPI->Select();
    $countskpi = count($userSKPI);
    foreach ($userSKPI as $valuesSKPI => $dataSKPI) {

      $sumskpi += (float)$dataSKPI['SKPI_Percent'];
    }
    $totalskpi[$r] = $sumskpi / $countskpi;

    $barColor = 'bg-danger';  // ค่า default
    $barWidth = $totalskpi[$r];

    if ($totalskpi[$r] > 0 && $totalskpi[$r] <= 30) {
      $barColor = 'bg-danger';
    } elseif ($totalskpi[$r] >= 31 && $totalskpi[$r] <= 70) {
      $barColor = 'bg-warning';
    } elseif ($totalskpi[$r] >= 71 && $totalskpi[$r] <= 100) {
      $barColor = 'bg-success';
    } elseif ($totalskpi[$r] <= 0 || $totalskpi[$r] > 100) {
      $barColor = 'bg-danger';
      $barWidth = 0;
    }
    echo '<div class="row">';
    echo '<div class="col-md-3 text-center">';
    if ($dataPillar['Pillar_id'] == 6 || $dataPillar['Pillar_id'] == 1 || $dataPillar['Pillar_id'] == "00011" || $dataPillar['Pillar_id'] == "00016") {
      echo "<div><img src='https://nurse.buu.ac.th/Fonmis/img/Ckpi/R.jpg' class='img-fluidd' alt='R'></div>";
    } elseif ($dataPillar['Pillar_id'] == 7 || $dataPillar['Pillar_id'] == 2 || $dataPillar['Pillar_id'] == "00012" || $dataPillar['Pillar_id'] == "00017") {
      echo "<div><img src='https://nurse.buu.ac.th/Fonmis/img/Ckpi/E.jpg' class='img-fluidd' alt='E'></div>";
    } elseif ($dataPillar['Pillar_id'] == 8 || $dataPillar['Pillar_id'] == 3 || $dataPillar['Pillar_id'] == "00013" || $dataPillar['Pillar_id'] == "00018") {
      echo "<div><img src='https://nurse.buu.ac.th/Fonmis/img/Ckpi/A.jpg' class='img-fluidd' alt='A'></div>";
    } elseif ($dataPillar['Pillar_id'] == 9 || $dataPillar['Pillar_id'] == 4 || $dataPillar['Pillar_id'] == "00014" || $dataPillar['Pillar_id'] == "00019") {
      echo "<div><img src='https://nurse.buu.ac.th/Fonmis/img/Ckpi/D.jpg' class='img-fluidd' alt='D'></div>";
    } elseif ($dataPillar['Pillar_id'] == 10 || $dataPillar['Pillar_id'] == 5 || $dataPillar['Pillar_id'] == "00015" || $dataPillar['Pillar_id'] == "00020") {
      echo "<div><img src='https://nurse.buu.ac.th/Fonmis/img/Ckpi/Y.jpg' class='img-fluidd' alt='Y'></div>";
    }
    echo '</div>';
    echo '<div class="col-md-9">';
    echo '<div class="d-flex align-items-center justify-content-between">';
    echo '<label class=" form-check-label text-break" >' . $dataPillar['Pillar_name'] . '</label>';
    echo '<div class="d-flex badge ' . $barColor . ' align-items-center" style="font-size: 18px; font-weight: 700;">' . number_format($totalskpi[$r], 2) . '%</div>';
    echo '</div>';

    if ($totalskpi[$r] == 0) {
      $barWidth = 1; // ให้พอมองเห็น
    }
    echo '<div class="progress">';
    echo '<div class="progress-bar progress-bar-striped progress-bar-animated ' . $barColor . ' animated-fade-in"
      role="progressbar"
      style="--bar-width: ' . $barWidth . '%; width: 0%"
      aria-valuenow="' . $barWidth . '"
      aria-valuemin="0"
      aria-valuemax="100">
      </div>';
    echo '</div>';
    echo '</div></div>';
    $sumPillar += $totalskpi[$r];
  }
  echo '</div>'; //col-md-12
  if ($row1 > 0) {
    $sum = $sumPillar / $row1;
  } else {
    $sum = 0;
  }
  $tt = 100 - $sum;
  $t_P = number_format($sum, 2);
  $t_t = number_format($tt, 2);
  echo '</div>'; //row g-3
  echo '</div>'; //col-md-7
  echo '<div class="col-md-5">';
  echo '<div class="row">';
  echo '<div class="col-md-12 text-center">';
  echo '<h1>ภาพรวม</h1>';
  if ($sum <= 30 && $sum >= 0) {
    echo '<h1 class="text-danger" style="font-weight: 900">' . number_format($sum, 2) . "%" . '</h1>';
  } elseif ($sum <= 70 && $sum >= 31) {
    echo '<h1 class="text-warning" style="font-weight: 900">' . number_format($sum, 2) . "%" . '</h1>';
  } elseif ($sum <= 100 && $sum >= 71) {
    echo '<h1 class="text-success" style="font-weight: 900">' . number_format($sum, 2) . "%" . '</h1>';
  }
  echo '</div>'; //col-md-12 text-center
  echo '<div class="col-md-12">';
  echo '<div id="echartKPI" style="width:100%;height:350px;"></div>';
  echo '</div>'; // col-md-12
  echo '</div>'; // row
  echo '</div>'; // col-md-5

  echo '<hr>';
  echo '<div class="col-md-12">';
  echo '<div class="row g-3">';
  echo '<div class="col-md-12 text-start">';
  echo '<h4>CKPI</h4>';
  echo '</div>'; // col-md-12 text-start
  echo '<div class="col-md-12">';
  echo '<table class="table table-striped table-hover table-border" id="T_2">';
  echo '<thead>';
  echo '<tr class="text-center">';
  echo '<th>#</th>';
  echo '<th>ตัวชี้วัด</th>';
  echo '<th>ค่าเป้าหมาย</th>';
  echo '<th>ผล</th>';
  echo '<th>ความก้าวหน้า</th>';
  echo '<th>สถานะ</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  $rowc = $C_per = $ch_Cre = 0;
  $dbStg = new Database('nurse');
  $dbStg->Table = "stg_strategic";
  $dbStg->Where = "where strategic_year = '$selected_year' order by strategic_id";
  $userdbStg = $dbStg->Select();
  foreach ($userdbStg as $valuesStg => $dataStg) {

    //AND SKPI_status = '1' 
    $dbCKPI = new Database('nurse');
    $dbCKPI->Table = "stg_CKPI";
    $dbCKPI->Where = "where strategic_id = '$dataStg[strategic_id]' order by CKPI_id ASC";
    $userCKPI = $dbCKPI->Select();
    foreach ($userCKPI as $valuesCKPI => $dataCKPI) {
      $rowc++;
      echo '<tr>';
      echo '<td>' . $rowc . '</td>';
      echo '<td>' . $dataCKPI['CKPI_name'] . '</td>';
      echo '<td class="text-center">' . $dataCKPI['CKPI_GoalScore'] . ' ' .  $dataCKPI['CKPI_Unit'] . '</td>';
      $dbCKPI3 = new Database('nurse');
      $dbCKPI3->Table = "stg_CKPIRespon";
      $dbCKPI3->Where = "where CKPI_id = '$dataCKPI[CKPI_id]' order by CKPIR_DateOver Desc limit 1";
      $userCKPI3 = $dbCKPI3->Select();
      $ch_Cre = count($userCKPI3);
      if ($ch_Cre == "") {
        echo "<td class='text-center'> 0 </td>";
      } else {
        foreach ($userCKPI3 as $valuesCKPI3 => $dataCKPI3) {
          $CK_score = is_numeric($dataCKPI3['CKPIR_score']) ? (float)$dataCKPI3['CKPIR_score'] : 0;
          echo '<td class="text-center">' . number_format($CK_score) . '</td>';
        }
      }

      if ($dataCKPI['CKPI_Percent'] == "") {
        $C_per = '0';
      } else {
        $C_per = $dataCKPI['CKPI_Percent'];
      }
      echo '<td class="text-center">' . $C_per . "%" . '</td>';
      echo '<td class="text-center">';
      if ($dataCKPI['CKPI_Percent'] <= 30 && $dataCKPI['CKPI_Percent'] >= 0) {
        echo "<span class='badge rounded-pill bg-danger'>...</span>";
      } elseif ($dataCKPI['CKPI_Percent'] <= 69 && $dataCKPI['CKPI_Percent'] >= 31) {
        echo "<span class='badge rounded-pill bg-warning'>...</span>";
      } elseif ($dataCKPI['CKPI_Percent'] <= 100 && $dataCKPI['CKPI_Percent'] >= 70) {
        echo "<span class='badge rounded-pill bg-success'>...</span>";
      } else {
        echo "<span class='badge rounded-pill bg-secondary'>...</span>";
      }
      echo '</td>';
      echo '</tr>';
    }
  }
  echo '</tbody>';
  echo '</table>';
  echo '</div>';
  echo '</div>'; // row g-3
  echo '</div>'; // col-md-12
  echo '<hr>';
  echo '<div class="col-md-12">';
  echo '<div class="row g-3">';
  echo '<div class="col-md-12 text-start">';
  echo '<h4>KPI</h4>';
  echo '</div>'; // col-md-12 text-start
  echo '<div class="col-md-12">';
  echo '<table class="table table-striped table-hover table-border" id="T_1">';
  echo '<thead>';
  echo '<tr class="text-center">';
  echo '<th>#</th>';
  echo '<th>ตัวชี้วัด</th>';
  echo '<th>อ้างอิง</th>';
  echo '<th>ค่าเป้าหมาย</th>';
  echo '<th>ค่าจริง</th>';
  echo '<th>ความก้าวหน้า</th>';
  echo '<th></th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';
  $row = $S_per = $ch_re = 0;
  $dbPillar1 = new Database('nurse');
  $dbPillar1->Table = "stg_Pillar";
  $dbPillar1->Where = "where Pillar_name <> '' AND Pillar_year = '$selected_year' order by Pillar_id ";
  $userPillar1 = $dbPillar1->Select();
  foreach ($userPillar1 as $valuesPillar1 => $dataPillar1) {

    //AND SKPI_status = '1' 
    $dbPillar = new Database('nurse');
    $dbPillar->Table = "stg_SKPI";
    $dbPillar->Where = "where Pillar_id = '$dataPillar1[Pillar_id]' order by SO_id,SKPI_id ";
    $userPillar = $dbPillar->Select();
    foreach ($userPillar as $valuesPillar => $dataPillar) {
      $row++;
      echo '<tr>';
      echo '<td>' . $row . '</td>';
      echo '<td>' . $dataPillar['SKPI_name'] . '</td>';
      echo '<td>';
      echo 'Pillar ' . $dataPillar1['Pillar_no'] . '';
      $dbPillar4 = new Database('nurse');
      $dbPillar4->Table = "stg_SO";
      $dbPillar4->Where = "where SO_id = '$dataPillar[SO_id]' ";
      $userPillar4 = $dbPillar4->Select();
      foreach ($userPillar4 as $valuesPillar4 => $dataPillar4) {
        echo " / SO " . $dataPillar4['SO_no'];
      }
      echo '</td>';
      echo '<td class="text-center">' . number_format($dataPillar['SKPI_GoalScore']) . '</td>';
      $dbPillar3 = new Database('nurse');
      $dbPillar3->Table = "stg_SKPIRespon";
      $dbPillar3->Where = "where SKPI_id = '$dataPillar[SKPI_id]' order by KPIR_DateOver Desc limit 1";
      $userPillar3 = $dbPillar3->Select();
      $ch_re = count($userPillar3);
      if ($ch_re == "") {
        echo "<td class='text-center'> 0 </td>";
      } else {
        foreach ($userPillar3 as $valuesPillar3 => $dataPillar3) {
          $SKP_score = is_numeric($dataPillar3['KPIR_score']) ? (float)$dataPillar3['KPIR_score'] : 0;
          echo '<td class="text-center">' .  number_format($SKP_score) . '</td>';
        }
      }
      if ($dataPillar['SKPI_Percent'] == "") {
        $S_per = '0';
      } else {
        $S_per = $dataPillar['SKPI_Percent'];
      }
      echo '<td class="text-center">' . $S_per . "%" . '</td>';
      echo '<td>';
      if ($dataPillar['SKPI_Percent'] <= 30 && $dataPillar['SKPI_Percent'] >= 0) {
        echo "<span class='badge rounded-pill bg-danger'>...</span>";
      } elseif ($dataPillar['SKPI_Percent'] <= 69 && $dataPillar['SKPI_Percent'] >= 31) {
        echo "<span class='badge rounded-pill bg-warning'>...</span>";
      } elseif ($dataPillar['SKPI_Percent'] <= 100 && $dataPillar['SKPI_Percent'] >= 70) {
        echo "<span class='badge rounded-pill bg-success'>...</span>";
      } else {
        echo "<span class='badge rounded-pill bg-secondary'>...</span>";
      }
      echo '</td>';
      echo '</tr>';
    }
  }
  echo '</tbody>';
  echo '</table>';
  echo '</div>';
  echo '</div>'; // row g-3
  echo '</div>'; // col-md-12

?>
  <script>
    //doughnut
    var t_P = <?php echo $t_P; ?>;
    var t_t = <?php echo $t_t; ?>;
    var colorSet;
    if (t_P <= 30 && t_P >= 0) {
      colorSet = ["#dc3545", "#6c757d"];
    } else if (t_P <= 70 && t_P >= 31) {
      colorSet = ["#ffc107", "#6c757d"];
    } else if (t_P <= 100 && t_P >= 71) {
      colorSet = ["#198754", "#6c757d"];
    } else {
      colorSet = ["#6c757d", "#6c757d"];
    }
    var chartDom = document.getElementById('echartKPI');
    var myChart = echarts.init(chartDom, 'vintage');
    var option = {
      // backgroundColor: 'rgba(254,248,239,1)',
      tooltip: {
        trigger: 'item',
        formatter: '{b}: {c}%'
      },
      legend: {
        orient: 'horizontal',
        top: '3%',
        left: 'center'
      },
      series: [{
        name: 'KPI',
        type: 'pie',
        radius: ['50%', '75%'],
        avoidLabelOverlap: false,
        itemStyle: {
          borderRadius: 10,
          borderColor: '#fff',
          borderWidth: 2
        },
        label: {
          show: false,
          position: 'center',
          formatter: function(params) {
            if (params.name === "ความก้าวหน้า") {
              return params.value + "%";
            }
            return "";
          },
          fontSize: 24,
          fontWeight: 'bold',
          color: (t_P <= 30 && t_P >= 0) ? "#dc3545" : ((t_P <= 70 && t_P >= 31) ? "#ffc107" : ((t_P <= 100 && t_P >= 71) ? "#198754" : "#6c757d"))
        },
        emphasis: {
          label: {
            show: true,
            fontSize: 36,
            fontWeight: 'bold',
            color: function(params) {
              // ถ้า hover ที่ "คงเหลือ" ให้เป็นสี #6c757d
              if (params.name === "คงเหลือ") {
                return "#6c757d";
              }
              // ถ้า hover ที่ "ความก้าวหน้า" ให้ใช้สีเดิม
              if (t_P <= 30 && t_P >= 0) return "#dc3545";
              if (t_P <= 70 && t_P >= 31) return "#ffc107";
              if (t_P <= 100 && t_P >= 71) return "#198754";
              return "#6c757d";
            },
            formatter: function(params) {
              return params.value + "%";
            }
          }
        },
        labelLine: {
          show: false
        },
        data: [{
            value: t_P,
            name: "ความก้าวหน้า",
            itemStyle: {
              color: colorSet[0]
            }
          },
          {
            value: t_t,
            name: "คงเหลือ",
            itemStyle: {
              color: colorSet[1]
            }
          }
        ]
      }]
    };
    myChart.setOption(option);
    window.addEventListener('resize', function() {
      myChart.resize();
    });

    var table = $('#T_1').DataTable({
      "lengthMenu": [
        [10, 25, 40, 50, 100],
        ["แสดง 10 รายการ", 25, 40, 50, 100]
      ],
      "pagingType": "simple_numbers",
      "responsive": true,
      "details": {
        "display": $.fn.dataTable.Responsive.display.modal({
          header: function(row) {
            var data = row.data();
            return 'Details for ' + data[0];
          }
        }),
        "renderer": $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      },
      "language": {
        "searchPlaceholder": "ค้นหา",
        "lengthMenu": "แสดง _MENU_",
        "paginate": {
          "first": "First",
          "last": "Last",
          "next": "&raquo;",
          "previous": "&laquo;"
        },
        "info": "แสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ ",
        "infoFiltered": "( ค้นหาจาก _MAX_ รายการทั้งหมด )",
        "infoEmpty": "ไม่พบข้อมูล",
        "emptyTable": "ไม่พบข้อมูล",
        "zeroRecords": "ไม่พบข้อมูลที่ตรงกับการค้นหา",
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
        $('select').addClass('form-select form-select-sm ms-2')[0].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2');
      }
    });

    var table = $('#T_2').DataTable({
      "lengthMenu": [
        [10, 25, 40, 50, 100],
        ["แสดง 10 รายการ", 25, 40, 50, 100]
      ],
      "pagingType": "simple_numbers",
      "responsive": true,
      "details": {
        "display": $.fn.dataTable.Responsive.display.modal({
          header: function(row) {
            var data = row.data();
            return 'Details for ' + data[0];
          }
        }),
        "renderer": $.fn.dataTable.Responsive.renderer.tableAll({
          tableClass: 'table'
        })
      },
      "language": {
        "searchPlaceholder": "ค้นหา",
        "lengthMenu": "แสดง _MENU_",
        "paginate": {
          "first": "First",
          "last": "Last",
          "next": "&raquo;",
          "previous": "&laquo;"
        },
        "info": "แสดงข้อมูล _START_ ถึง _END_ จาก _TOTAL_ รายการ ",
        "infoFiltered": "( ค้นหาจาก _MAX_ รายการทั้งหมด )",
        "infoEmpty": "ไม่พบข้อมูล",
        "emptyTable": "ไม่พบข้อมูล",
        "zeroRecords": "ไม่พบข้อมูลที่ตรงกับการค้นหา",
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
        $('select').addClass('form-select form-select-sm ms-2')[0].style.width = "150px";
        $('input[type="search"]').addClass('form-control me-2');
      }
    });
  </script>
<?php } else {
  echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=ctrl_logout.php\">";
} ?>