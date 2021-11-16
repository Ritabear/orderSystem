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
    order_id VARCHAR(20) NOT NULL ,
    time DATETIME default current_timestamp,
    total int);
    

- table3
CREATE TABLE order_goods (
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(20),
    specification int,
    money int,
    amount int,
    records_id VARCHAR(20)
);
    
unique
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





