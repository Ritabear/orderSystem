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

        .gooosTable td,
        .historytbody {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rightGoods div {
            width: calc(25% - 16px);
        }

        /* 樣式 */

        .btnStyle {
            border: 1px solid transparent;
            background: #bb2d3b;
            color: white;
            border-radius: 5px;
            padding: 0px 6px;
        }

        .fz-0 {
            font-size: 30px;
            font-weight: bold;
        }

        .fz-1 {
            font-size: 26px;
            font-weight: bold;
        }

        .active {
            border: 3px solid #17a2b8 !important;
        }

        .amountinput {
            width: 40px;
            font-size: 13px;
        }

        /* 彈窗 */

        .historypage {
            border: 1px solid #e0e0e0;
            overflow-y: scroll;
            width: 90vw;
            height: 90vh;
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            display: none;
        }

        .historythead {
            background: #17a2b8 !important;
            color: white;
            font-weight: bold;
            border: 1px solid transparent;
        }

        .modal-header {
            background: white;
            z-index: 10;
        }

        </style>

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
                                <div class="col-4 border text-center p-2"> <a href="#">查看報表</a> </div>
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
                        $all_type = ['鴨肉類', '豬肉類', '雞肉類', '其他類'];
                        $all_type_switch = ['duck', 'pork', 'chicken', 'others'];
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
                        <td>序號</th>
                        <td>日期</td>
                        <td>單號</td>
                        <td>商品</td>
                        <td>項目單價</td>
                        <td>數量</td>
                        <td>訂單總金額</td>
                    </tr>
                </table>

            </div>
            <div class="table-responsive">
                <table class="table table-hover table-striped text-center">
                    <!-- </thead> -->
                    <tbody class="historytbody">
                        <?php
                        $sql_rocerds = 'SELECT * from order_goods join order_records on order_goods.order_id = order_records.order_id;';
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
                        echo '<td>'.$i.'</td>';
                        echo '<td>'.$dataHistory[$i]['time'].'</td>';
                        echo '<td>'.$dataHistory[$i]['order_id'].'</td>';
                        echo '<td>'.$dataHistory[$i]['name'].'</td>';
                        echo '<td>'.$dataHistory[$i]['money'].'</td>';
                        echo '<td>'.$dataHistory[$i]['amount'].'</td>';
                        echo '<td>'.$dataHistory[$i]['total'].'</td>';
                        echo '</tr>';
                    }
                ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
        // 序號 
        let number = 0
        // 總金額 
        let allmoney = 0
        // 資料物件 
        let allOrder = {}
        let goodsOrder = []
        // 數量變更 
        let countChange = ""
        let countinit = ""
        let countTmoney = ""
        let countPrice = ""
        let countOrder = ""
        // 鍵盤輸入 
        let kbNumber = "";
        // 右邊商品點擊 
        // $(".scorllRight").on("click", ".goodsTitle", function() { 
        $(".scorllRight").on("click", ".goodsTitle", function() {
            goodsOrder = []
            // console.log($(this).html()) 
            let goodsName = $(this).data("name")
            // console.log(goodsName) 
            let goodsMoney = $(this).data("money")
            // console.log(goodsMoney) 
            let specification = $(this).data("specification")
            // console.log(specification) 
            let amount = 1
            let total = goodsMoney * amount
            allmoney += total
            number += 1
            // 存入陣列和物件 
            goodsOrder.push(goodsName, +goodsMoney, +amount, +total, +specification)
            allOrder[number] = goodsOrder
            console.log(allOrder)

            //渲染 
            $(".allmoney>span").html(allmoney)
            $(".scrollLeft").append(
                `<tr class="ordertrstyle ordertr${number}"> 
                    <td class="px-1 py-2 border countOrder orderNumber">${number}</td> 
                    <td class="px-1 py-2 w-25 border goodsName">${goodsName}</td> 
                    <td class="px-1 py-2 border goodsMoney">${goodsMoney}</td> 
                    <td class="px-1 py-2 border amount"><input class="amountinput amountinput${number}" type="number" value="1" disabled /></td> 
                    <td class="px-1 py-2 w-25 border totalPrice">${total}</td> 
                    <td class="px-1 py-2 border"> 
                    <button type="button" class="btnStyle deltd${number}">刪除</button></td> 
                </tr>`
                // winnie 
                // `<tr> 
                //         <td class="px-1 py-2 border">${number}</td> 
                //         <td class="px-1 py-2 col-4 border" >${goodsName}</td> 
                //         <input type ="hidden" name ="goodsName[]" value="${goodsName}"> 
                //         <td class="px-1 py-2 border">${goodsMoney}</td> 
                //         <input type ="hidden" name ="goodsMoney[]" value="${goodsMoney}"> 
                //         <td class="px-1 py-2 border amount" >${amount}</td> 
                //         <input type ="hidden" name ="amount[]" value="${amount}"> 
                //         <td class="px-1 py-2 col-2 border">${total}</td> 
                //         <input type ="hidden" name ="total[]" value="${total}"> 
                //         <input type ="hidden" name ="specification[]" value="${specification}"> 
                //         <td class="px-1 py-2 border"> 
                //         <button type="button" class="btnStyle">刪除</button></td> 
                //     </tr>` 
            )

            let idList = Object.keys(allOrder);

            // 刪除點擊 
            $(".deltd" + number).on("click", function() {
                let reducer = []
                let getnumber = ""
                let getnumber2 = ""
                getnumber = $(this).parent().siblings(".orderNumber")
                getnumber2 = getnumber.html()
                // 刪掉資料物件裡的項 
                delete allOrder[getnumber2]
                console.log(allOrder)
                // 刪除畫面 
                $(this).parent().parent().remove()
                if (Object.keys(allOrder).length != 0) {
                    // 總金額重寫 
                    for (let k in allOrder) {
                        reducer.push(allOrder[k][3])
                    }
                    const reTotal = reducer.reduce((pre, cur) => pre + cur)
                    // console.log(reTotal) 
                    allmoney = reTotal
                    $(".allmoney>span").html(allmoney)
                } else {
                    allmoney = 0
                    $(".allmoney>span").html(allmoney)
                }
            })

            // 數量點擊 
            $(".ordertr" + number).on("click", function() {
                countChange = ""
                countinit = ""
                countTmoney = ""
                countPrice = ""
                countOrder = ""
                kbNumber = ""
                $(this).addClass("active").siblings().removeClass("active")
                // $(this).find(".amountinput").focus() 
                countinit = Number($(this).find(".amountinput").val())
                countChange = $(this).find(".amountinput")
                countTmoney = $(this).find(".totalPrice")
                countPrice = Number($(this).find(".goodsMoney").html())
                countOrder = $(this).find(".countOrder").html()
                // console.log(countinit) 
                // console.log(countChange) 
                // console.log(countTmoney) 
                // console.log(countPrice) 
                // console.log(countOrder) 
            })

            // 監聽變化(棄用) 
            // $(".amountinput" + number).on("input", function(){ 
            //     console.log("aaaaaaaaa") 
            // }) 
            // 訂單確認(棄用) 
            // $("#submit").click(function() { 
            // goodsOrder = [] 
            // sumPrice = 0 
            // for(i=0; i< number; i++){ 
            //     goodsOrder = [] 
            //     let namegd = $(".ordertr").find(".goodsName")[i] 
            //     let namegdf = namegd.innerHTML 
            //     let moneygd = $(".ordertr").find(".goodsMoney")[i] 
            //     let moneygdf = moneygd.innerHTML 
            //     let amountgd = $(".ordertr").find(".amount")[i] 
            //     let amountgdf = amountgd.innerHTML 
            // let totalPrice = $(".ordertr").find(".totalPrice")[0] 
            //     let totalPricef = totalPrice.innerHTML 
            //     goodsOrder.push(namegdf, moneygdf, amountgdf, totalPricef) 
            //     // console.log(goodsOrder) 
            //     allOrder[i] = goodsOrder 
            //     // console.log(allOrder) 
            //     sumPrice += Number(totalPrice.innerHTML) 
            // } 
            // console.log(totalPrice) 
            // console.log(sumPrice) 
            // $.ajax({ 
            //     type: "POST", //呼叫模式 
            //     url: "create_order.php", //呼叫的網址 
            //     data: { //這裡發送要傳遞的資料，格式=> 參數名稱:內容 
            //         "goodsName": goodsName, 
            //         "goodsMoney": goodsMoney, 
            //     }, 
            //     // dataType: "text", //回傳的資料型態 
            //     success: function() { 
            //         // alert("sucess"); 
            //         console.log(goodsName); 
            //     }, 
            //     error: function() { 
            //         console.log("fail"); 
            //     } 
            // }) 
            // }) 
        })

        // 鍵盤點擊 
        $(".numberbtnNum").on('click', function() {
            let reducer2 = []
            kbNumber += ($(this).html())
            if (countChange != "") {
                countChange.val(kbNumber)
                let muti = countPrice * kbNumber
                countTmoney.html(muti)
                allOrder[countOrder][2] = Number(kbNumber)
                allOrder[countOrder][3] = muti
                // 總金額重寫 
                for (let k in allOrder) {
                    reducer2.push(allOrder[k][3])
                }
                const reTotal2 = reducer2.reduce((pre, cur) => pre + cur)
                // console.log(reTotal) 
                allmoney = reTotal2
                $(".allmoney>span").html(allmoney)
            }
        })

        // 數量del 
        $(".countDel").on('click', function() {
            if (countChange != "") {
                kbNumber = ""
                let reducer3 = []
                countChange.val(1)
                let muti = countPrice * 1
                countTmoney.html(muti)
                allOrder[countOrder][2] = 1
                allOrder[countOrder][3] = muti
                // 總金額重寫 
                for (let k in allOrder) {
                    reducer3.push(allOrder[k][3])
                }
                const reTotal3 = reducer3.reduce((pre, cur) => pre + cur)
                allmoney = reTotal3
                $(".allmoney>span").html(allmoney)
            }
        })

        // 交易取消 
        $(".cancelAll").on('click', function() {
            $(".scrollLeft").html("")
            number = 0
            allmoney = 0
            $(".allmoney>span").html(allmoney)
            allOrder = {}
            goodsOrder = []
            countChange = ""
            countinit = ""
            countTmoney = ""
            countPrice = ""
            countOrder = ""
            kbNumber = "";
        })

        // 確認 (目前無作用) 
        $(".confirm").click(function() {
            // $(".scrollLeft").find("tr").removeClass("active") 
            console.log(allOrder)
        })
        // 訂單確認 
        $("#submit").click(function() {
            let jsonorder = JSON.stringify(allOrder)
            $.ajax({
                type: "POST", //呼叫模式 
                // dataType: 'json', 
                dataType: 'json',
                // dataType: 'multipart/form-data',//回傳的資料型態 //返回數據格式 
                // contentType: "application/json", 
                url: "create_order.php", //呼叫的網址 
                data: { //這裡發送要傳遞的資料，格式=> 參數名稱:內容 
                    "order": jsonorder,
                },
                // data: JSON.stringify(jsonorder), 
                // //res 回傳 
                success: function(req, res) {
                    console.log(req, res);
                    alert("sucess");
                    // window.location.href = '/Orderfood/create_order.php'; 
                },

                error: function(err) {
                    console.log(err);
                    console.log('出現錯誤');
                    // window.location.href = '/Orderfood/create_order.php'; 
                }

            })

            // .then(() => {

            //     window.location.href = '/Orderfood/create_order.php';

            // })

            $(".scrollLeft").html("")
            number = 0
            allmoney = 0
            $(".allmoney>span").html(allmoney)
            allOrder = {}
            goodsOrder = []
            countChange = ""
            countinit = ""
            countTmoney = ""
            countPrice = ""
            countOrder = ""
            kbNumber = "";

        })

        // 歷史訂單 
        $(".historyOrder").on("click", function() {
            $(".historypage").show();
            // api拿資料 
        })

        $(".close").click(function() {
            $(".historypage").hide();
        })

        $(".historypage").click(function(e) {
            e.stopPropagation();
        });

        // 清緩存用

        $(".clearcache").on("click", function() {
            Toyun.clearCache();
            Toyun.loadMainView("https://pos.raybii.com/");
        })
        </script>

    </body>

</html>
