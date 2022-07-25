<?php

// \$ - экранирование

return [

        'core' => [
                "INSERT INTO settings_pages(
                        id, 
                        name, 
                        title, 
                        description, 
                        h1, 
                        annotation,
                        scripts
                ) VALUES(
                        '1', 
                        'main', 
                        'Главная страница сайта', 
                        'Описание главной страницы сайта', 
                        'Заголовок страницы', 
                        'Добро пожаловать на сайт',
                        'main.js,'
                )"
        ],
        'plugins' => [
                "INSERT INTO settings_plugins(
                        id, 
                        plugin_name, 
                        name, 
                        title, 
                        description, 
                        h1, 
                        annotation, 
                        scripts
                ) VALUES(
                        '1', 
                        'users', 
                        'authorization', 
                        'Страница авторизации', 
                        'Описание страницы авторизации', 
                        'Страница авторизации', 
                        'Добро пожаловать!', 
                        'users.min.js,'
                )",
                "INSERT INTO settings_plugins(
                        id, 
                        plugin_name, 
                        name, 
                        title, 
                        description, 
                        h1, 
                        annotation, 
                        scripts
                ) VALUES(
                        '2', 
                        'users', 
                        'registration', 
                        'Страница регистрации', 
                        'Описание страницы регистрации', 
                        'Страница регистрации', 
                        'Добро пожаловать!', 
                        'users.min.js,'
                )",
                "INSERT INTO plugin_users_registered(
                        id, 
                        login, 
                        password, 
                        password_hash
                ) VALUES(
                        '1', 
                        'admin', 
                        'admin', 
                        '$2y$10\$UxZi4pfbxXAoyiawbL4dteGxxtnrjcUYPiNGf0gEUC5nuCW4JrX16'
                )",
                "INSERT INTO plugin_users_secure(
                        user_id, 
                        secret
                ) VALUES(
                        '1', 
                        'd2315af356f82b6574816d84708e'
                )",
                "INSERT INTO plugin_users_personal(
                        user_id, 
                        name, 
                        mail
                ) VALUES(
                        '1', 
                        'Администратор',
                        'admin@mail.ru'
                )",
                "INSERT INTO plugin_users_registered(
                        id, 
                        login, 
                        password, 
                        password_hash
                ) VALUES(
                        '2', 
                        'user', 
                        'user', 
                        '$2y$10\$UxZi4pfbxXAoyiawbL4dteGxxtnrjcUYPiNGf0gEUC5nuCW4JrX16'
                )",
                "INSERT INTO plugin_users_secure(
                        user_id, 
                        secret
                ) VALUES(
                        '2', 
                        'd2315af356f82b6574816d84708e'
                )",
                "INSERT INTO plugin_users_personal(
                        user_id, 
                        name, 
                        mail
                ) VALUES(
                        '2', 
                        'Пользователь',
                        'user@mail.ru'
                )"
        ],
        'content' => [
                "INSERT INTO articles(
                        id, 
                        text
                ) VALUES(
                        '1', 
                        'Удобная структура позволяет использовать только те функции, что необходимы в данный момент.'
                )",
                "INSERT INTO articles(
                        id, 
                        text
                ) VALUES(
                        '2', 
                        'Продуманная архитектура и современные технологические решения.'
                )",
                "INSERT INTO articles(
                        id, 
                        text
                ) VALUES(
                        '3', 
                        'Реализация полиморфизма, значительно сокращает код, автоматизируя и оптимизируя процессы.'
                )",
                "INSERT INTO articles(
                        id, 
                        text
                ) VALUES(
                        '4', 
                        'Быстрый запуск и удобная настройка.'
                )",
                "INSERT INTO articles(
                        id, 
                        text
                ) VALUES(
                        '5', 
                        'С помощью MVC можно реализовать самые крутые проекты.'
                )",
                "INSERT INTO rating_votes(
                        article_id, 
                        rating, 
                        voters
                ) VALUES(
                        '5', 
                        '400', 
                        '1'
                )",
                "INSERT INTO rating_voters(
                        user_id, 
                        article_id, 
                        vote
                ) VALUES(
                        '2', 
                        '5', 
                        '4'
                )",
                "INSERT INTO rating_votes(
                        article_id, 
                        rating, 
                        voters
                ) VALUES(
                        '4', 
                        '450', 
                        '2'
                )",
                "INSERT INTO rating_voters(
                        user_id, 
                        article_id, 
                        vote
                ) VALUES(
                        '2', 
                        '4', 
                        '4'
                )",
                "INSERT INTO rating_voters(
                        user_id, 
                        article_id, 
                        vote
                ) VALUES(
                        '1', 
                        '4', 
                        '5'
                )"
        ]
];