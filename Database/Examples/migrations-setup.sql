-- To manage migration history (Stuck)
CREATE TABLE IF NOT EXIST table_migrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    script_filename VARCHAR(255) NOT NULL
)