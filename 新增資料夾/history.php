<?php

require_once './config.php';
//編寫查詢sql語句
// $sql_rocerds = 'SELECT order_records.* , order_goods.name ,order_goods.specification,order_goods.money,order_goods.amount FROM order_records,order_goods WHERE order_records.id = order_goods.records_id';

$sql_rocerds = 'SELECT * from order_records join order_goods;';
// echo $sql_rocerds;

//執行查詢操作、處理結果集
$result = mysqli_query($link, $sql_rocerds);
if (!$result) {
    exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
// echo count($data);
// echo '<pre>';
// var_dump($data); //array(2) { [0]=> array(4) { ["id"]=> string(1) "1" ["name"]=> string(12) "鴨頭小份" ["specification"]=> strin
// echo '</pre>';
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"
            integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="table-responsive">
            <table class="table table-hover table-striped text-center ">
                <thead>
                    <tr>
                        <th>序號</th>
                        <th>日期</th>
                        <th>單號</th>
                        <th>商品</th>
                        <th>項目單價</th>
                        <th>數量</th>
                        <th>訂單總金額</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($data); ++$i) {
                        echo '<tr>';
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$data[$i]['time'].'</td>';
                        echo '<td>'.$data[$i]['order_id'].'</td>';
                        echo '<td>'.$data[$i]['name'].'</td>';
                        echo '<td>'.$data[$i]['money'].'</td>';
                        echo '<td>'.$data[$i]['amount'].'</td>';
                        echo '<td>'.$data[$i]['total'].'</td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
        </div>

</html>
