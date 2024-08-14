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
CREATE TABLE IF NOT EXISTS newsletter (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    UNIQUE KEY(email)
);
CREATE TABLE IF NOT EXISTS contact (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    phone varchar(255) NULL,
    subject varchar(255) NOT NULL,
    message text,
    comments text,
    subject_answer varchar(255) NULL,
    answer text,
    status tinyint(1) NOT NULL DEFAULT 0,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id)
);

/* TEST BLOG */

CREATE TABLE IF NOT EXISTS blog_categories (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  lang varchar(6) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS blog_tags (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  lang varchar(6) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS blog (
    id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    published tinyint(1) NOT NULL DEFAULT 0,
    author varchar(255) NOT NULL,
    title varchar(255) NOT NULL,
    subtitle varchar(255) NOT NULL,
    content text,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id bigint(20) unsigned NOT NULL,
    blog_category_id bigint(20) unsigned NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY(blog_category_id) REFERENCES blog_categories(id)
);

CREATE TABLE IF NOT EXISTS blog_images(
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  original_filename varchar(255) NOT NULL,
  storage_filename varchar(255) NOT NULL,
  media_type varchar(255) NOT NULL,
  created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  blog_id bigint(20) unsigned NOT NULL,
  size mediumint unsigned NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY(blog_id) REFERENCES blog(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS blog_tag_rel (
  blog_id bigint(20) unsigned NOT NULL,
  tag_id bigint(20) unsigned NOT NULL,
  CONSTRAINT blog_tag_pk PRIMARY KEY (blog_id, tag_id),
  CONSTRAINT FK_blog 
      FOREIGN KEY (blog_id) REFERENCES blog (id) ON DELETE CASCADE,
  CONSTRAINT FK_tag 
      FOREIGN KEY (tag_id) REFERENCES blog_tags (id) ON DELETE CASCADE
);

