CREATE TABLE IF NOT EXISTS User
(
    id        INT          NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username  VARCHAR(255) NOT NULL,
    password  VARCHAR(255) NOT NULL,
    email     VARCHAR(255) NOT NULL,
    firstName VARCHAR(255),
    lastName  VARCHAR(255),
    gender    CHAR(1),
    roles     int NOT NULL
);

CREATE TABLE IF NOT EXISTS Post
(
    id      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    author  int NOT NULL
);
CREATE TABLE IF NOT EXISTS Comment
(
    id      INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    content TEXT,
    postId  int NOT NULL,
    author  int NOT NULL
);

