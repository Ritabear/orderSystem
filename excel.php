<?php

require_once './config.php';

//編寫查詢sql語句

$sql_rocerds = 'SELECT * from order_records as t1 join order_goods as t2 on t1.order_id = t2.order_id;';
// echo $sql_rocerds;

//執行查詢操作、處理結果集
$result = mysqli_query($link, $sql_rocerds);
if (!$result) {
    exit('查詢sql語句執行失敗。錯誤信息：'.mysqli_error($link)); // 獲取錯誤信息
}

$data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo '<pre>';
// var_dump($data);
// echo '</pre>';

//設定系統環境，確保輸出執行環境無礙
set_time_limit(0);
ini_set('memory_limit', '256M');

//判斷執行權限
//建立資料庫連線，開始取得資料
//撰寫資料庫欄位與可讀性資料的轉換方法
function mapping_submission_category($id = '')
{
    //常見的就是把變數換成換成可閱讀可理解的字串
    $arr = [
        '0' => '分類一',
        '1' => '分類二',
    ];
    if ($id != '') {
        return $arr[$id];
    } else {
        return $arr;
    }
}

function mapping_submission_user_age($id = '')
{
    //或是某些根據專案特殊轉譯過的變數替換
}

//開始準備一組匯出陣列
$csv_arr = [];
//先放置 CSV 檔案的標頭資料
$csv_arr[] = ['id', 'order_id', 'time', 'total', 'name', 'specification', 'money', 'amount'];
//設定檔案輸出名稱
$filename = 'contest-data-export-'.date('Y-m-d-H-i-s').'.csv';
//設定瀏覽器讀取此份資料為不快取，與解讀行為是下載 CSV 檔案
header('Pragma: no-cache');
header('Expires: 0');
header('Content-Disposition: attachment;filename="'.$filename.'";');
header('Content-Type: application/csv; charset=UTF-8');

for ($i = 0; $i < count($data); ++$i) {
    $csv_arr[] = [
        //開始根據資料變數組裝後面的陣列資料
        $data[$i]['id'], $data[$i]['order_id'], $data[$i]['time'], $data[$i]['total'], $data[$i]['name'], $data[$i]['specification'], $data[$i]['money'], $data[$i]['amount'],
    ];
}
//確保輸出內容符合 CSV 格式，定義下列方法來處理
function csvstr(array $fields): string
{
    $f = fopen('php://memory', 'r+');
    if (fputcsv($f, $fields) === false) {
        return false;
    }
    rewind($f);
    $csv_line = stream_get_contents($f);

    return rtrim($csv_line);
}
//正式循環輸出陣列內容
for ($j = 0; $j < count($csv_arr); ++$j) {
    if ($j == 0) {
        //檔案標頭如果沒補上 UTF-8 BOM 資訊的話，Excel 會解讀錯誤，偏向輸出給程式觀看的檔案
        echo "\xEF\xBB\xBF";
    }
    //輸出符合規範的 CSV 字串以及斷行
    echo csvstr($csv_arr[$j]).PHP_EOL;
}
//跑完這份檔案就會是下載一份完整的 CSV 檔案囉！
