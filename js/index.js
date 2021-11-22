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
// 右邊商品點擊 
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
    if (Object.keys(allOrder).length >= 1) {
        arrayOrder = Object.keys(allOrder).map(key => {
            return allOrder[key]
        })
        operArr = {...arrayOrder}
        let jsonorder = JSON.stringify(operArr)

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