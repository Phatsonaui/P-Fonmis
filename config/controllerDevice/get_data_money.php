<?php
include_once("../../../class/class.db.php");
header('Content-Type: application/json');

$moneyStone = $moneyGrov = $moneyIncome = $moneyOther = $sumMoney = 0;

$db = new Database('nurse');
$db->Table = "DV_Data";
$db->Where = "ORDER BY device_ID DESC";
$rows = $db->Select();

foreach ($rows as $row) {
    switch ($row['device_UseMoney']) {
        case '1':
            $moneyStone += $row['device_Price'];
            break;
        case '2':
            $moneyGrov += $row['device_Price'];
            break;
        case '3':
            $moneyIncome += $row['device_Price'];
            break;

        default:
            $moneyOther += $row['device_Price'];
            break;
    }
    $sumMoney += $row['device_Price'];
}
echo json_encode([
    'moneyStone' => $moneyStone,
    'moneyGrov' => $moneyGrov,
    'moneyIncome' => $moneyIncome,
    'moneyOther' => $moneyOther,
    'sumMoney' => $sumMoney,
    'success' => true
], JSON_UNESCAPED_UNICODE);
