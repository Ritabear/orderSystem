<?php

require_once './config.php';
$order_id = ($_POST['order_id']);
// echo $order_id;

//編寫預處理sq'語句
// $sql = "Delete from  order_goods  WHERE name= $order_id And Delete from order_records WHERE name= $order_id";
$sql = "delete order_goods,order_records from order_goods, order_records where order_goods.order_id = $order_id and order_records.order_id=$order_id";

//預處理SQL模板
$stmt = mysqli_prepare($link, $sql);

$result = mysqli_query($link, $sql);
if (!$result) {
    exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
}
// $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
echo '1';
