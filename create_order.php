<?php

require_once './config.php';
// $id = isset($_POST['id']) ? $_POST['id'] : '';
$goodsName = isset($_POST['goodsName']) ? $_POST['goodsName'] : '';
$specification = isset($_POST['specification']) ? $_POST['specification'] : '';
$goodsMoney = isset($_POST['goodsMoney']) ? $_POST['goodsMoney'] : '';
//幾份
$goodsAmount = isset($_POST['amount']) ? $_POST['amount'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '';

$totalMoney = 0;

foreach ($total as $k) {
    $totalMoney += $k;
}
echo $totalMoney;

// if ($totalMoney > 0) {
    //寫進order_records做總金額紀錄
//編寫查詢sql語句
$sql_total = "INSERT INTO order_records (total) VALUES ($totalMoney) "; //每筆總共 //Duplicate entry '0' for key 'PRIMARY' :it's not auto increment
echo '<hr>';
    echo 'sql_total:'.$sql_total; //INSERT INTO order_records(`total`) VALUES('200') '200'錯
    //對資料庫執行查訪的動作， 用mysqli_query方法執行(sql語法)將結果存在變數中
    $result_orderID = mysqli_query($link, $sql_total);

    // 如果有資料
    if ($result_orderID) {
        $rowcount = mysqli_affected_rows($link);
        var_dump('新增幾筆資料'.$rowcount);
    } else {
        echo "{$sql} 語法執行失敗，錯誤訊息: ".mysqli_error($link);
    }
// }

//編寫查詢sql語句，找最新id
$sql_records = 'SELECT *, ROW_NUMBER() OVER (ORDER BY time DESC) FROM order_records ';
//對資料庫執行查訪的動作
$result = mysqli_query($link, $sql_records);
if (!$result) {
    exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
} else {
    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
    echo '<hr>';
    // var_dump($data); //array(1) { [0]=> array(3) { ["id"]=> string(1) "0" ["time"]=> NULL ["total"]=> string(1) "0" } }
    $id = $data['0']['id'];
    echo 'id:'.$id;
}

//寫進order_goods做訂單內容紀錄
$sql = 'INSERT INTO order_goods(name,specification,money,amount,records_id	) VALUES(?,?, ?,?, ?) '; //每個商品
//預處理SQL模板
$stmt = mysqli_prepare($link, $sql);

if (is_array($goodsName)) {
    $count = count($goodsName);
    // echo count($goodsName);
    for ($i = 0; $i < count($goodsName); ++$i) {
        // 參數綁定，並為已經綁定的變量賦值
        mysqli_stmt_bind_param($stmt, 'ssiii', $goodsName[$i], $specification[$i], $goodsMoney[$i], $goodsAmount[$i], $id);
        if ($stmt) {
            // 執行預處理（第1次執行）
            $result_goods = mysqli_stmt_execute($stmt);
        //關閉連接
        } else {
            //添加失败
            echo '新增失敗！<br><br>'.mysqli_error($link);
        }
    }
} else {
    $count = '1';
}
    // for ($i = 0; $i < count($goodsName); ++$i) {
    // echo $goodsName[$i].'</br>';
    // echo $specification[$i].'</br>';
    // echo $amount[$i].'</br>';
    // echo $total[$i].'</br>';
    // }
// foreach ($goodsName as $goods) {
//     echo $goods.'<br>';
// }

mysqli_close($link);
