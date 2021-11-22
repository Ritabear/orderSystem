<?php

require_once './config.php';

if (isset($_POST['order'])) {
    $order = isset($_POST['order']) ? $_POST['order'] : '';
    $arr = json_decode($order, true);

    for ($i = 0; $i < count($arr) + 1; ++$i) {
        $goodsName[] = $arr[$i][0];
        // var_dump($arr[$i][0]);

        $goodsMoney[] = $arr[$i][1];
        $goodsAmount[] = $arr[$i][2];
        $total[] = $arr[$i][3];
        $specification[] = $arr[$i][4];
    }
    // var_dump($goodsName);
    // var_dump($goodsMoney);

    //生成訂單編號
    $store_order_id = date('Ymd').str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

    $totalMoney = 0;
    foreach ($total as $k) {
        $totalMoney += $k;
    }

    if ($totalMoney > 0) {
        //寫進order_records做總金額紀錄
        //編寫查詢sql語句
        $sql_total = "INSERT INTO order_records (`order_id`,`total`) VALUES ($store_order_id , $totalMoney) "; //每筆總共 //Duplicate entry '0' for key 'PRIMARY' :it's not auto increment
    // echo 'sql_total:'.$sql_total; //INSERT INTO order_records(`total`) VALUES('200') '200'錯

    //對資料庫執行查訪的動作， 用mysqli_query方法執行(sql語法)將結果存在變數中
        $result_order = mysqli_query($link, $sql_total);
        // 如果有資料
        if ($result_order) {
            $rowcount = mysqli_affected_rows($link);
        // var_dump('新增幾筆資料'.$rowcount);
        } else {
            echo "{$sql} 語法執行失敗，錯誤訊息: ".mysqli_error($link);
        }

        //寫進order_goods做訂單內容紀錄
        $sql = 'INSERT INTO order_goods(name,specification,money,amount,records_id) VALUES(?,?, ?,?, ?) '; //每個商品
        //預處理SQL模板
        $stmt = mysqli_prepare($link, $sql);

        if (is_array($goodsName)) {
            for ($i = 0; $i < count($goodsName); ++$i) {
                // 參數綁定，並為已經綁定的變量賦值
                mysqli_stmt_bind_param($stmt, 'ssiis', $goodsName[$i], $specification[$i], $goodsMoney[$i], $goodsAmount[$i], $store_order_id);
                if ($stmt) {
                    // 執行預處理（第1次執行）
                    $result_goods = mysqli_stmt_execute($stmt);
                //關閉連接
                } else {
                    //添加失败
                    echo '新增失敗！<br><br>'.mysqli_error($link);
                }
            }
            mysqli_close($link);
        }
    }

    $allData = json_encode($order);
    echo $allData; //{"1":["鴨頭小份",40,1,40],"2":["鴨肝",10,1,10]}
}
