CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email_confirmed_at DATETIME NULL,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS posts (
    postID INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255),
    content TEXT,
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS comments (
    commentID INT PRIMARY KEY AUTO_INCREMENT,
    commentText VARCHAR(255),
    created_at DATETIME NOT NULL,
    updated_at DATETIME NOT NULL,
    userID INT NOT NULL,
    postID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(id),
    FOREIGN KEY (postID) REFERENCES posts(postID)
);


CREATE TABLE IF NOT EXISTS post_likes (
    userID INT NOT NULL,
    postID INT NOT NULL,
    PRIMARY KEY (userID, postID),
    FOREIGN KEY (userID) REFERENCES users(id),
    FOREIGN KEY (postID) REFERENCES posts(postID)
);

CREATE TABLE IF NOT EXISTS comment_likes (
    userID INT NOT NULL,
    commentID INT NOT NULL,
    PRIMARY KEY (userID, commentID),
    FOREIGN KEY (userID) REFERENCES users(id),
    FOREIGN KEY (commentID) REFERENCES comments(commentID)
);

CREATE TABLE IF NOT EXISTS categories (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tags (
    tagID INT PRIMARY KEY AUTO_INCREMENT,
    tagName VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS user_settings (
    entryID INT PRIMARY KEY AUTO_INCREMENT,
    userID INT NOT NULL,
    metaKey VARCHAR(255),
    metaValue VARCHAR(255),
    FOREIGN KEY (userID) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS post_tags (
    postID INT NOT NULL,
    tagID INT NOT NULL,
    PRIMARY KEY (postID, tagID),
    FOREIGN KEY (postID) REFERENCES posts(postID),
    FOREIGN KEY (tagID) REFERENCES tags(tagID)
);

ALTER TABLE users ADD COLUMN IF NOT EXISTS subscription VARCHAR(50) NULL;
ALTER TABLE users ADD COLUMN IF NOT EXISTS subscription_status VARCHAR(50) NULL;
ALTER TABLE users ADD COLUMN IF NOT EXISTS subscriptionCreatedAt DATETIME NULL;
ALTER TABLE users ADD COLUMN IF NOT EXISTS subscriptionEndsAt DATETIME NULL;

ALTER TABLE posts ADD COLUMN IF NOT EXISTS categoryID INT NULL;

ALTER TABLE posts
ADD CONSTRAINT fk_posts_category
FOREIGN KEY (categoryID) REFERENCES categories(categoryID);

