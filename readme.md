### 資料表
- table1
CREATE TABLE goods (id int NOT NULL PRIMARY KEY AUTO_INCREMENT, 
                    name VARCHAR(20) NOT NULL,
                    type VARCHAR(20) NOT NULL,
                    specification int NOT NULL,
                    money int);

- table2

CREATE TABLE order_records (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    time DATETIME default current_timestamp,
    total int);
    

- table3
CREATE TABLE order_goods (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20),
    specification int,
    money int,
    amount int,
    records_id int
);
    

<!-- - table3????
CREATE TABLE order_goods (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20),
    specification int,
    money int,
    records_id int,
	FOREIGN KEY (records_id) REFERENCES order_records (id)
); -->

### 作法
1. 先有需求，這間店要一個簡易點單系統，不過因為已經開幕，所以這功能要求開發快速，加上對方覺得純PHP比較快，所以最後選用純PHP開發，之後再改框架
2. 討論excel格式，對方所需要的所有報表以及確認優先順序哪些功能需要先出來
3. 畫原型圖
4. 再次確認需求以及優先順序
5. 規劃tables 及 DB欄位
6. 將所有商品新增進去(add_goods.php)
7. 基本版面(Bootstrap)
8. 實作





- 嘗試SQL:
ROW_NUMBER() OVER (ORDER BY time DESC)
name,specification,money,amount
order_goods.
SELECT * from order_goods full join order_records on 'order_goods.records_id' = 'order_records.id';
121 121

SELECT name,specification,money,amount,records_id from order_goods full join order_records on records_id = order_records.id ORDER BY order_records.time DESC;
select * from order_records join order_goods;
select * from order_records as t1 join order_goods as t2 on t1.id = t2.records_id;
select * from order_records as t1 , order_goods as t2 Where t1.id = t2.records_id;


SELECT order_records.* , order_goods.name ,order_goods.specification,order_goods.money,order_goods.amount FROM order_records,order_goods WHERE order_records.id = order_goods.records_id;