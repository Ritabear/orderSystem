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
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
        /* 右邊滾動 */
        .scorllRight {
            overflow: -moz-hidden-unscrollable;
            height: 99vh;
            overflow: scroll;
        }

        .scorllRight::-webkit-scrollbar {
            display: none;
        }

        /* 左邊滾動 */
        .scrollLeft {
            /* IE */
            overflow: -moz-hidden-unscrollable;
            height: 35vh;
            overflow-y: scroll;
            display: block;
        }

        /* chrome */
        .scrollLeft::-webkit-scrollbar {
            display: none;
        }

        .gooosTable thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin: -1px 0 0 0;
        }

        /* 超出部分... */
        .gooosTable td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rightGoods div {
            width: calc(25% - 16px);
        }

        </style>
        <link rel="stylesheet" href="menu.js">
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
                                <div class="col-4 border text-center p-2"> <a href="#">查看報表</a> </div>
                                <div class="col-4 border text-center p-2"> <a href="history.php">歷史訂單</a></div>
                            </div>
                            <form action="create_order.php" method="post">
                                <div>
                                    <table class="table table-striped gooosTable text-center m-auto w-100">
                                        <thead>
                                            <tr>
                                                <td class="p-2 border">序號</td>
                                                <td class="p-2 col-4 border">商品</td>
                                                <td class="p-2 border">單價</td>
                                                <td class="p-2 border">數量</td>
                                                <td class="p-2 col-2 border">小記</td>
                                                <td class="p-2 border">刪除</td>

                                            </tr>
                                        </thead>
                                        <tbody class="scrollLeft ">

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row justify-content-around m-3">
                                    <div class="col-7 border text-center p-2">總金額$ : 10000</div>
                                    <div class="col-3 border text-center p-2"> <button type="submit" value="Submit"
                                            id="submit"> 訂單確認</button> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-10 m-auto border">
                            <div class="row ">
                                <div class="col border text-center p-3">1</div>
                                <div class="col border text-center p-3">2</div>
                                <div class="col border text-center p-3">3</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-3">4</div>
                                <div class="col border text-center p-3">5</div>
                                <div class="col border text-center p-3">6</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-3">7</div>
                                <div class="col border text-center p-3">8</div>
                                <div class="col border text-center p-3">9</div>
                            </div>
                            <div class="row">
                                <div class="col border text-center p-3">0</div>
                                <div class="col border text-center p-3"></div>
                                <div class="col border text-center p-3">DEL</div>
                            </div>
                            <div class="row">
                                <div class="col-4 border text-center p-3">交易取消</div>
                                <div class="col-8 border text-center p-3">確認</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col scorllRight">
                    <!-- 迴圈處 -->
                    <?php
                        $all_type = ['鴨肉類', '豬肉類', '雞肉類', '其他類'];
                        $all_type_switch = ['duck', 'pork', 'chicken', 'others'];
                        for ($i = 0; $i < count($all_type); ++$i) {
                            echo '<div>';
                            echo '<div class="m-2 p-3 border text-center bg-info text-white">';
                            echo $all_type[$i];
                            echo '</div>';
                            echo '<div class="rightGoods d-flex justify-content-start flex-wrap">';
                            for ($j = 0; $j < count($data); ++$j) {
                                if ($data[$j]['type'] == $all_type_switch[$i]) {
                                    $k = $j + 1;
                                    echo "<div class='goodsTitle border p-3 m-2 text-center' data-name='".$data[$j]['name']."' data-money='".$data[$j]['money']."' data-specification='".$data[$j]['specification']."'  data-id='".$k."' >";
                                    echo $data[$j]['name'].'</br>'.$data[$j]['money'].'元';
                                    echo '</div>';
                                }
                            }
                            echo '</div>';
                        }
                        ?>
                </div>
            </div>
        </div>
        <script>
        let number = 0
        $(".scorllRight").on("click", ".goodsTitle", function() {
            console.log($(this).html())
            let goodsName = $(this).data("name")
            console.log(goodsName)
            let goodsMoney = $(this).data("money")
            console.log(goodsMoney)
            let specification = $(this).data("specification")
            console.log(specification)
            let amount = 1
            let total = goodsMoney * amount

            number += 1;

            $(".scrollLeft").append(
                // `<tr>
                //     <td class="px-1 py-2 border">${number}</td>
                //     <td class="px-1 py-2 col-4 border" >${goodsName}</td> 
                //     <td class="px-1 py-2 border">${goodsMoney}</td>

                //     <td class="px-1 py-2 border amount" >${amount}</td>

                //     <td class="px-1 py-2 col-2 border">${total}</td>

                //     <td class="px-1 py-2 border">
                //     <button type="button" class="btn btn-danger">刪除</button></td>
                // </tr>`
                `<tr>
                        <td class="px-1 py-2 border">${number}</td>
                        <td class="px-1 py-2 col-4 border" >${goodsName}</td>
                        <input type ="hidden" name ="goodsName[]" value="${goodsName}">
                        <td class="px-1 py-2 border">${goodsMoney}</td>
                        <input type ="hidden" name ="goodsMoney[]" value="${goodsMoney}">
                        <td class="px-1 py-2 border amount" >${amount}</td>
                        <input type ="hidden" name ="amount[]" value="${amount}">
                        <td class="px-1 py-2 col-2 border">${total}</td>
                        <input type ="hidden" name ="total[]" value="${total}">
                        <input type ="hidden" name ="specification[]" value="${specification}">

                        <td class="px-1 py-2 border">
                        <button type="button" class="btn btn-danger">刪除</button></td>
                    </tr>`
            )


            $(".amount").click(function() {

            })

            $("#submit").click(function() {
                $.ajax({
                    type: "POST", //呼叫模式
                    url: "create_order.php", //呼叫的網址
                    data: { //這裡發送要傳遞的資料，格式=> 參數名稱:內容
                        "goodsName": goodsName,
                        "goodsMoney": goodsMoney,
                    },
                    // dataType: "text", //回傳的資料型態
                    success: function() {
                        // alert("sucess");
                        console.log(goodsName);
                    },
                    error: function() {
                        console.log("fail");
                    }
                })
            })
        })
        </script>

    </body>

</html>
