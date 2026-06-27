CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email_confirmed_at NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL, 
);

CREATE TABLE IF NOT EXISTS posts (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    userID INT NOT NULL,
    FORIEGN KEY (userID) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS comments (
    commentID INT PRIMARY KEY AUTO_INCREMENT,
    commentText VARCHAR(255),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    userID INT NOT NULL,
    postID INT NOT NULL,
    FORIEGN KEY (userID) REFERENCES users(id),
    FORIEGN KEY (postID) REFERENCES posts(id)
);


CREATE TABLE IF NOT EXISTS post_likes (
    userID INT NOT NULL,
    postID INT NOT NULL,
    PRIMARY KEY (userID, postID),
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (postID) REFERENCES posts(postID)
);

CREATE TABLE IF NOT EXISTS comment_likes (
    userID INT NOT NULL,
    commentID INT NOT NULL,
    PRIMARY KEY (userID, commentID),
    FOREIGN KEY (userID) REFERENCES users(userID),
    FOREIGN KEY (commentID) REFERENCES comments(commentID)
)

