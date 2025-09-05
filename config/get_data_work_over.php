<?php
include("../../class/class.db.php");
require_once("../class/chgdatethai.php");

$deviceIDs  = isset($_POST['devices']) ? $_POST['devices'] : "-";
$status  = isset($_POST['status']) ? $_POST['status'] : "-";
$idList = implode("','", array_map('addslashes', $deviceIDs));
$col_name = "";
$condition = "";
$date_device = "";
if ($status == "in") {
  $col_name = "วันที่รับสินค้า";
  $condition = "WHERE device_ID IN ('$idList') ORDER BY device_ID ASC";
} elseif ($status == "out") {
  $col_name = "วันที่จำหน่าย";
  $condition = "LEFT JOIN DV_OutStock ON DV_Data.device_ID = DV_OutStock.device_id where DV_OutStock.device_id IN ('$idList')";
}
?>
<div class="col-md-12">
  <style>
    /* Header */
    .Table_header_nu th {
      background-color: #4a6fa5;
      color: white;
      text-align: center;
    }

    /* แถวข้อมูล */
    .Table_body_nu tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .Table_body_nu tr:hover {
      background-color: #eef6ff;
      transition: 0.2s;
    }

    /* วันที่รับสินค้า */
    .date-in {
      background-color: #e3f2fd !important;
      /* ฟ้าอ่อน */
      color: #0d47a1 !important;
      font-weight: bold !important;
    }

    /* วันที่จำหน่าย */
    .date-out {
      background-color: #ffebee !important;
      /* แดงอ่อน */
      color: #b71c1c !important;
      font-weight: bold !important;
    }
  </style>

  <table class="table table-bordered table-striped table-hover" id="dtBasicExample">
    <thead class="Table_header_nu">
      <tr>
        <th>#</th>
        <th width="15%">เลขครุภัณฑ์</th>
        <th width="55%">ชื่อครุภัณฑ์</th>
        <?php if ($status == "out") : ?>
          <th width="15%">วันที่รับสินค้า</th>
        <?php endif; ?>
        <th width="15%">
          <?php echo $col_name; ?>
        </th>
      </tr>
    </thead>
    <tbody class="Table_body_nu">
      <?php
      $drow = 0;
      $db3 = new Database('nurse');
      $db3->Table = "DV_Data";
      $db3->Where = "$condition";
      $user3 = $db3->Select();
      foreach ($user3 as $values3 => $data3) {
        $drow++;
      ?>
        <tr>
          <td class="text-center"><?php echo $drow; ?></td>
          <?php if ($data3['device_Number'] == "") {
            echo "<td class='text-center'>-</td>";
          } else { ?>
            <td><?php echo $data3['device_Number']; ?></td>
          <?php } ?>
          <td><span><?php echo $data3['device_Name']; ?></span></td>

          <?php if ($status == "out") { ?>
            <td class="date-in">
              <?php echo DateThai($data3['device_DateInput']); ?>
            </td>
          <?php } ?>

          <td class="<?php echo ($status == 'in') ? 'date-in' : 'date-out'; ?>">
            <?php
            if ($status == "in") {
              $date_device = DateThai($data3['device_DateInput']);
            } elseif ($status == "out") {
              $date_device = DateThai($data3['OutStock_date']);
            }
            echo ($date_device == "") ? "-" : $date_device;
            ?>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>