<?php

return [

    'core' => [
        "CREATE TABLE IF NOT EXISTS settings_pages (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            name VARCHAR(100), 
            title NVARCHAR(50), 
            description NVARCHAR(100), 
            h1 NVARCHAR(100), 
            annotation NVARCHAR(100), 
            scripts VARCHAR(100)
        );"
    ],
    'plugins' => [
        "CREATE TABLE IF NOT EXISTS settings_plugins (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            plugin_name VARCHAR(100), 
            name VARCHAR(100) NULL, 
            title NVARCHAR(50) NULL, 
            description NVARCHAR(100) NULL, 
            h1 NVARCHAR(100) NULL, 
            annotation NVARCHAR(100) NULL, 
            scripts VARCHAR(100) NULL
        );",
        "CREATE TABLE IF NOT EXISTS plugin_users_registered (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
            login VARCHAR(100), 
            password VARCHAR(100), 
            password_hash VARCHAR(100)
        ) ENGINE = InnoDB;",
        "CREATE TABLE IF NOT EXISTS plugin_users_secure (
            user_id INTEGER(10) UNSIGNED NOT NULL, 
            secret VARCHAR(30), 
            attempts TINYINT(1) NULL, 
            date TIMESTAMP NULL, 
            FOREIGN KEY (user_id) REFERENCES plugin_users_registered (id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB;",
        "CREATE TABLE IF NOT EXISTS plugin_users_personal (
            user_id INTEGER(10) UNSIGNED NOT NULL, 
            name NVARCHAR(50), 
            mail VARCHAR(30), 
            FOREIGN KEY (user_id) REFERENCES plugin_users_registered (id) ON DELETE CASCADE ON UPDATE CASCADE
        ) ENGINE = InnoDB;"
    ],
    'content' => [
        "CREATE TABLE IF NOT EXISTS articles (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,  
            text TEXT
        );",
        "CREATE TABLE IF NOT EXISTS rating_votes (
            article_id INTEGER(10) UNSIGNED NOT NULL, 
            rating SMALLINT(3), 
            voters INTEGER(10), 
            FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE ON UPDATE CASCADE
        );",
        "CREATE TABLE IF NOT EXISTS rating_voters (
            user_id INTEGER(10) UNSIGNED NOT NULL, 
            article_id INTEGER(10) UNSIGNED NOT NULL, 
            vote TINYINT(1), 
            FOREIGN KEY (user_id) REFERENCES plugin_users_registered (id) ON DELETE CASCADE ON UPDATE CASCADE, 
            FOREIGN KEY (article_id) REFERENCES articles (id) ON DELETE CASCADE ON UPDATE CASCADE
        );"
    ]
];