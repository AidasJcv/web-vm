-- Create the sessions database
CREATE DATABASE IF NOT EXISTS sessions;

-- Switch to the sessions database
USE sessions;

-- Create a table to store session data
CREATE TABLE IF NOT EXISTS sessions_data (
    session_id VARCHAR(255) PRIMARY KEY,
    user_id INT,
    username VARCHAR(255)
);

-- Create a user for the webserver
CREATE USER IF NOT EXISTS 'webserver'@'localhost' IDENTIFIED BY 'admin';

-- Grant privileges on the sessions database
GRANT ALL PRIVILEGES ON sessions.* TO 'webserver'@'localhost';

-- Flush privileges to apply changes
FLUSH PRIVILEGES;
