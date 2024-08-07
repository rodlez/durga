CREATE TABLE IF NOT EXISTS users (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    user_name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(255) NULL,
    password varchar(255) NOT NULL,
    role tinyint(2) NOT NULL DEFAULT 0,
    age tinyint(3) unsigned NOT NULL,
    country varchar(255) NOT NULL,
    social_media_url varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    last_activity datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    otp_code varchar(6) NULL,
    otp_expired_at datetime NULL,   
    PRIMARY KEY(id),
    UNIQUE KEY(user_name, email)
);