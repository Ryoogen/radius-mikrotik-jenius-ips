CREATE TABLE radcheck (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(64) NOT NULL,
    attribute VARCHAR(32) NOT NULL,
    op CHAR(2) NOT NULL,
    value VARCHAR(255) NOT NULL
);
