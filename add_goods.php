<?php

require_once 'config.php';

$goods_name = ['鴨頭小份', '鴨頭大份', '鴨心', '鴨翅', '鴨肝', '鴨舌', '鴨腸', '腱頭', '鴨腱', '鴨肉', '鴨腿', '豬耳朵', '豬頭皮', '菊花肉', '豬心', '豬大腸', '脆腸', '蹄膀', '豬舌', '雞腿', '雞翅小份', '雞翅大份', '雞腳', '雞腱', '雞屁股', '米血', '百頁', '黑輪片', '小甜不辣', '大甜不辣', '豆丁', '海帶', '鳥蛋', '貢丸', '德腸', '芋條', '魚蛋'];
$goods_type = ['duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'duck', 'pork', 'pork', 'pork', 'pork', 'pork', 'pork', 'pork', 'pork', 'chicken', 'chicken', 'chicken', 'chicken', 'chicken', 'chicken', 'others', 'others', 'others', 'others', 'others', 'others', 'others', 'others', 'others', 'others', 'others', 'others'];
$goods_specification = [1, 3, 1, 1, 1, 1, 1, 3, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 6, 15, 1, 1, 1, 1, 1, 1, 1, 1, 1, 6, 2, 1, 1, 4];
$goods_money = [40, 100, 30, 25, 10, 10, 30, 20, 30, 150, 80, 35, 30, 40, 30, 40, 40, 100, 35, 80, 20, 100, 50, 5, 30, 20, 20, 20, 10, 20, 20, 20, 20, 15, 25, 20, 30];
// var_dump(count($goods_name));
// var_dump(count($goods_type));
// var_dump(count($goods_specification));
// var_dump(count($goods_money));

//編寫預處理sql語句
$sql = 'INSERT INTO goods(name,type,specification,money) VALUES(?,?, ?, ?)';
//預處理SQL模板
$stmt = mysqli_prepare($link, $sql);

for ($i = 0; $i < count($goods_name); ++$i) {
    // 參數綁定，並為已經綁定的變量賦值
    mysqli_stmt_bind_param($stmt, 'ssii', $goods_name[$i], $goods_type[$i], $goods_specification[$i], $goods_money[$i]);
    if ($stmt) {
        // 執行預處理（第1次執行）
        $result = mysqli_stmt_execute($stmt);
    //關閉連接
    } else {
        //添加失败
        echo '新增失敗！<br><br>'.mysqli_error($link);
    }
}

mysqli_close($link);
