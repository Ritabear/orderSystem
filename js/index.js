// 序號 
let number = 0
    // 總金額 
let allmoney = 0
    // 資料物件 
let arrayOrder = []
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
//寫在外面為了全域用 寫在裡面作用域裡面，不污染=>自己會弄混


//var 宣告少用，有汙染危險

// 右邊商品點擊 
//動態渲染 不可以寫L178 的click形式
//on 與click 的影響，寫成下面要原本節點就存在(靜態才可)   綁結點還在渲染就沒辦法綁到
//on 寫法綁在原本就存在的地方，下面就可以寫事件綁動態產生節點.goodsTitle
//動態:php ajax 渲染出來的DOM 結構，靜態原本就寫在html

//每次做一個點擊下面動作重新
$(".scorllRight").on("click", ".goodsTitle", function() {
    //資料處理
    //沒清空陣列內無線陣列 陣列處理，顯示console 物件
    goodsOrder = []
        // console.log($(this).html()) 
        // data-name 才用.data() 這個data-屬性固定
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
        //num() == +
    goodsOrder.push(goodsName, +goodsMoney, +amount, +total, +specification)
    allOrder[number] = goodsOrder
    console.log(allOrder)


    // 另一個方法渲染完再抓資料進行處理

    //渲染:畫面呈現 
    //<div class="col-7 border text-center p-2 allmoney font-weight-bold">總金額$ :<span>0</span> </div>  下一層的span
    $(".allmoney>span").html(allmoney)
    $(".scrollLeft").append(
        //一般寫法  vs框架不一樣
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

    // let idList = Object.keys(allOrder);

    // 刪除點擊 
    // deltd${number}">刪除
    $(".deltd" + number).on("click", function() {
        let reducer = []
        let getnumber = ""
        let getnumber2 = ""
            // $(this) = ".deltd" + number    拿到parent() =<td> </td>  siblings   .orderNumber classneme: td.px-1.py-2.border.countOrder.orderNumber
        getnumber = $(this).parent().siblings(".orderNumber")
            // console.log(getnumber)
            // orderNumber">${number}</td>  的序號
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
    if (Object.keys(allOrder).length >= 1) {
        arrayOrder = Object.keys(allOrder).map(key => {
            return allOrder[key]
        })
        operArr = {...arrayOrder }
        let jsonorder = JSON.stringify(operArr)

        $.ajax({
            type: "POST", //呼叫模式 
            dataType: 'json',
            // dataType: 'multipart/form-data',//回傳的資料型態 //返回數據格式 
            // contentType: 'application/json; charset=utf-8',
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
    }

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
$(".clearcache").on("touchstart mousedown", function() {
    $(".clearcache").addClass("acticein")
})
$(".clearcache").on("touchend mouseup", function() {
    $(".clearcache").removeClass("acticein")
})
$(".clearcache").on("click", function() {
    Toyun.clearCache();
    Toyun.loadMainView("https://pos.raybii.com/");
})


//歷史訂單刪除功能

$(".historyDel").on("click", function() {
    let hisDel = $(this).data("order")

    $.post("./delete_order.php", {
        "order_id": hisDel
    }, function(res) {

        if (res === "1") {
            let orderDOM = $('[data-order="' + hisDel + '"]').parent().parent()
            orderDOM.remove()
        } else {
            alert("刪除失敗")
        }

    })
})