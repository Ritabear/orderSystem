<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>魯豫點單</title>
        <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <div class="order">
            <div class="title">
                <button>查看報表</button>
                <button>歷史訂單</button>
            </div>
            <div class="list">
                <table>
                    <tr>
                        <td>序號</td>
                        <td>商品</td>
                        <td>單價</td>
                        <td>數量</td>
                        <td>小計</td>
                        <td><button>刪除</button></td>
                    </tr>
                </table>
            </div>
            <div class="checkout">

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
    </body>

</html>
