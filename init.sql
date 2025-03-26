DROP TABLE IF EXISTS kananian;
CREATE TABLE kananian (
    id INT AUTO_INCREMENT PRIMARY KEY,
    namee VARCHAR(255) NOT NULL,
    bookname VARCHAR(255) NOT NULL,
    date1 DATE NOT NULL,
    date1g INT NOT NULL,
    tamdid INT NOT NULL,
    date2 DATE
);

DROP TABLE IF EXISTS katarinianlist;
CREATE TABLE katarinianlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    namee VARCHAR(255) NOT NULL,
    bookname VARCHAR(255) NOT NULL,
    date1 DATE NOT NULL,
    date1g INT NOT NULL,
    tamdid INT NOT NULL,
    date2 DATE
);

DROP TABLE IF EXISTS olialist;
CREATE TABLE olialist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    namee VARCHAR(255) NOT NULL,
    bookname VARCHAR(255) NOT NULL,
    date1 DATE NOT NULL,
    date1g INT NOT NULL,
    tamdid INT NOT NULL,
    date2 DATE
);
