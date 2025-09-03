<?php
include("../../class/class.db.php");
require_once("../class/chgdatethai.php");

$deviceIDs  = isset($_POST['devices']) ? $_POST['devices'] : "-";
$idList = implode("','", array_map('addslashes', $deviceIDs));
$col_name = "";
$condition = "";
$date_device = "";

$col_name = "วันที่รับสินค้า";
$condition = "WHERE device_ID IN ('$idList') ORDER BY device_ID ASC";

?>
<div class="col-md-12">
  <table class="table" id="dataType">
    <thead class="Table_header_nu">
      <tr>
        <th>#</th>
        <th>เลขครุภัณฑ์</th>
        <th width="60%">ชื่อครุภัณฑ์</th>
        <th width="15%">
          <?php
          echo $col_name;
          ?>
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
        $drow++; ?>
        <tr>
          <td class="text-center"><?php echo $drow; ?></td>
          <?php
          if ($data3['device_Number'] == "") {
            echo "<td class='text-center'>-</td>";
          } else { ?>
            <td><?php echo $data3['device_Number']; ?></td>
          <?php } ?>
          <td><span><?php echo $data3['device_Name']; ?></span></td>

          <td>
            <?php
            $date_device =  DateThai($data3['device_DateInput']);

            if ($date_device == "") {
              echo "-";
            } else {
              echo $date_device;
            }
            ?>
          </td>
        </tr>
      <?php
      } ?>

    </tbody>
  </table>
</div>