<?php

require_once './config.php';
//編寫查詢sql語句
$sql = 'SELECT * FROM `goods`';
//執行查詢操作、處理結果集
$result = mysqli_query($link, $sql);
if (!$result) {
    exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
}
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
// echo '<pre>';
// var_dump($data); //array(2) { [0]=> array(4) { ["id"]=> string(1) "1" ["name"]=> string(12) "鴨頭小份" ["specification"]=> strin
// echo '</pre>';
?>

<!doctype html>
<html lang="en">

    <head>
        <title>結帳系統</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="./css/index.css">
    </head>

    <body>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>

        <div class="container-fluid">
            <div class="d-flex">
                <div class="col mr-3">
                    <div class="row">
                        <div class="col">
                            <div class="row justify-content-around m-3">
                                <div class="col-4 border text-center p-2 clearcache">清緩存用</div>
                                <div class="col-4 border text-center p-2">查看報表</div>
                                <!-- <div class="col-4 border text-center p-2 historyOrder"> <a href="history.php">歷史訂單</a></div> -->
                                <div class="col-4 border text-center p-2 historyOrder">歷史訂單</div>
                            </div>
                            <!-- <form action="create_order.php" method="post"> -->
                            <div>
                                <table class="table table-striped gooosTable text-center m-auto w-100">
                                    <thead>
                                        <tr>
                                            <th class="p-2 border orderNumber">序號</th>
                                            <th class="p-2 w-25 border">商品</th>
                                            <th class="p-2 border">單價</th>
                                            <th class="p-2 border">數量</th>
                                            <th class="p-2 w-25 border">小記</th>
                                            <th class="p-2 border deltd">刪除</th>
                                        </tr>
                                    </thead>
                                    <tbody class="scrollLeft">
                                    </tbody>
                                </table>
                            </div>
                            <div class="row justify-content-around m-3">
                                <div class="col-7 border text-center p-2 allmoney font-weight-bold">總金額$ :
                                    <span>0</span>
                                </div>
                                <div class="col-3 text-center p-2 font-weight-bold bg-info text-white">
                                    <div id="submit">訂單確認</div>
                                </div>
                            </div>
                            <!-- </form> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10 m-auto border">
                            <div class="row ">
                                <div class="col border text-center p-2 fz-0 numberbtnNum">1</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">2</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">3</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-2 fz-0 numberbtnNum">4</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">5</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">6</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-2 fz-0 numberbtnNum">7</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">8</div>
                                <div class="col border text-center p-2 fz-0 numberbtnNum">9</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-2 fz-0 numberbtnNum">0</div>
                                <div class="col border text-center p-2 fz-0"></div>
                                <div class="col border text-center p-2 fz-0 countDel">DEL</div>
                            </div>
                            <div class="row">
                                <div class="col-4 border text-center p-2 fz-1 cancelAll">交易取消</div>
                                <div class="col-8 border text-center p-2 fz-1 confirm">確認</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col scorllRight h5">
                    <!-- 迴圈處 -->
                    <?php
                        $all_type = ['鴨肉類', '豬肉類', '飲料', '雞肉類', '其他類'];
                        $all_type_switch = ['duck', 'pork', 'drink', 'chicken', 'others'];
                        for ($i = 0; $i < count($all_type); ++$i) {
                            echo '<div>';
                            echo '<div class="h3 m-2 p-3 text-center bg-info text-white">';
                            echo $all_type[$i];
                            echo '</div>';
                            echo '<div class="rightGoods d-flex justify-content-start flex-wrap">';

                            for ($j = 0; $j < count($data); ++$j) {
                                if ($data[$j]['type'] == $all_type_switch[$i]) {
                                    $k = $j + 1;
                                    echo "<div class='goodsTitle border py-3 px-2 m-2 text-center' data-name='".$data[$j]['name']."' data-money='".$data[$j]['money']."' data-specification='".$data[$j]['specification']."'  data-id='".$k."' >";
                                    echo $data[$j]['name'].'</br>'.$data[$j]['money'].'元';
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                            echo '</div>';
                        }

                        ?>
                </div>
            </div>
        </div>

        <!-- 彈窗範例
        <div class="modal historypage" tabindex="-1" role="dialog"> 
            <div class="modal-dialog" role="document"> 
                <div class="modal-content"> 
                    <div class="modal-body"> 
                        <p>Modal body text goes here.</p> 
                    </div> 
                </div> 
            </div> 
        </div> -->

        <div class="container-fluid position-absolute historypage">
            <div class="historyheader sticky-top">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold text-center">歷史訂單</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table class="table table-hover table-striped text-center tablehead mb-0">
                    <!-- <thead>  加thead會跑版 原因不明所以關掉 -->
                    <tr class="historythead">
                        <td class="w-10">序號</th>
                        <td class="w-20">日期</td>
                        <td class="w-15">單號</td>
                        <td>商品</td>
                        <td class="w-10">項目單價</td>
                        <td class="w-10">數量</td>
                        <td>訂單總金額</td>
                        <td>刪除訂單</td>

                    </tr>
                </table>

            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped text-center">
                    <!-- </thead> -->
                    <tbody class="historytbody">
                        <?php
                        $sql_rocerds = 'SELECT * from order_goods join order_records on order_goods.order_id = order_records.order_id ORDER BY `order_records`.`time` DESC;';
                        // echo $sql_rocerds;

                        //執行查詢操作、處理結果集
                        $result = mysqli_query($link, $sql_rocerds);
                        if (!$result) {
                            exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
                        }

                        $dataHistory = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        // var_dump($dataHistory);
                    for ($i = 0; $i < count($dataHistory); ++$i) {
                        echo '<tr>';
                        echo '<td class="w-10">'.$i.'</td>';
                        echo '<td class="w-20">'.$dataHistory[$i]['time'].'</td>';
                        echo '<td class="w-15">'.$dataHistory[$i]['order_id'].'</td>';
                        echo '<td>'.$dataHistory[$i]['name'].'</td>';
                        echo '<td <td class="w-10">'.$dataHistory[$i]['money'].'</td>';
                        echo '<td <td class="w-10">'.$dataHistory[$i]['amount'].'</td>';
                        echo '<td>'.$dataHistory[$i]['total'].'</td>';
                        echo '<td ><button type="button" class="btn btn-danger historyDel" data-order='.$dataHistory[$i]['order_id'].'>刪除</button></td>';
                        echo '</tr>';
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script src="./js/index.js"></script>


    </body>

</html>
