-- To manage migration history (Stuck)
CREATE TABLE IF NOT EXISTS table_migrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    script_filename VARCHAR(255) NOT NULL
)