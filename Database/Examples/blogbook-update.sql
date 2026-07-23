-- Create a new subscriptions table
CREATE TABLE IF NOT EXISTS subscriptions (
    subscriptionID INT PRIMARY KEY AUTO_INCREMENT,
    subscriptionName VARCHAR(50) NOT NULL,
    subscriptionStatus VARCHAR(50),
    subscriptionCreatedAt DATETIME,
    subscriptionEndsAt DATETIME,
    userID INT NOT NULL,
    FOREIGN KEY (userID) REFERENCES users(id)
);

-- Create taxonomy table
CREATE TABLE IF NOT EXISTS taxonomy (
    taxonomyID INT PRIMARY KEY AUTO_INCREMENT,
    taxonomyName VARCHAR(255) NOT NULL,
    description VARCHAR(255)
);

-- Create taxonomy_term table
CREATE TABLE IF NOT EXISTS taxonomy_term (
    taxonomyTermID INT PRIMARY KEY AUTO_INCREMENT,
    taxonomyTermName VARCHAR(255) NOT NULL,
    taxonomyTypeID INT NOT NULL,
    description VARCHAR(255),
    parentTaxonomyTerm INT NULL,
    FOREIGN KEY (taxonomyTypeID)
        REFERENCES taxonomy(taxonomyID),
    FOREIGN KEY (parentTaxonomyTerm)
        REFERENCES taxonomy_term(taxonomyTermID)
);

-- Create post_taxonomy table
CREATE TABLE IF NOT EXISTS post_taxonomy (
    postTaxonomyID INT PRIMARY KEY AUTO_INCREMENT,
    postID INT NOT NULL,
    taxonomyTermID INT NOT NULL,
    FOREIGN KEY (postID)
        REFERENCES posts(postID),
    FOREIGN KEY (taxonomyTermID)
        REFERENCES taxonomy_term(taxonomyTermID)
);

-- Move old subscription data from users
INSERT INTO subscriptions (
    subscriptionName,
    subscriptionStatus,
    subscriptionCreatedAt,
    subscriptionEndsAt,
    userID
)
SELECT
    subscription,
    subscription_status,
    subscriptionCreatedAt,
    subscriptionEndsAt,
    id
FROM users
WHERE subscription IS NOT NULL
AND NOT EXISTS (
    SELECT 1
    FROM subscriptions
    WHERE subscriptions.userID = users.id
);