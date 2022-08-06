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
                )",
                "INSERT INTO icons(
                        type, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'general', 
                        'favicon', 
                        'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHZpZXdCb3g9IjAgMCAyMCAyMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3QgeD0iMS42NjY3NSIgeT0iOS4xNjY2OSIgd2lkdGg9IjE2LjY2NjciIGhlaWdodD0iMS42NjY2NyIgcng9IjAuODMzMzM0IiBmaWxsPSIjNDk4RUY1Ii8+CjxyZWN0IHg9IjEwLjgzMzMiIHk9IjEuNjY2NjkiIHdpZHRoPSIxNi42NjY3IiBoZWlnaHQ9IjEuNjY2NjciIHJ4PSIwLjgzMzMzMyIgdHJhbnNmb3JtPSJyb3RhdGUoOTAgMTAuODMzMyAxLjY2NjY5KSIgZmlsbD0iIzQ5OEVGNSIvPgo8L3N2Zz4K', 
                        'Favicon'
                )",
                "INSERT INTO icons(
                        type, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'header', 
                        'main', 
                        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAXCAQAAABKIxwrAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfjAgUXKSkOh9KsAAABLUlEQVQ4y7XSMWuTURTG8edNnVrcCxYF3TNIQD+CCLW42G/Q1al0VXBoRxfXFgcH0UGXTMFOjShV3AuFDu1mbYPp4pufQ1+FNG+iBvwv93LO/x7OAzf5nxR1RfeylDfF2yTxOPNJusVW7XuFNQPwVCPxFbTr5TmvwQl4ZXaCbsEnsOmyTbDr+xjdLUcYeKTpnaaHfvjFRd0DffQsuesEPffd8a1GV3higH1Na8pKGVjXtA+6iovxdlz13DAvLdiuYs8lccVH8MJ1H4zy2Y0q9hfXYg+lVTcdqOfQbatK7MWKU4uWnRnPmWWLTq0kMZtom0z73GskRf8vv1c/adTUO2mllVY6o61LNfpxsZskjkdbddMnMKVe/sErh3ffSC8z1f19dXbjt/zs37aYjp9t53KEqohgLAAAACV0RVh0ZGF0ZTpjcmVhdGUAMjAxOS0wMi0wNVQyMjo0MTo0MSswMTowMJ5XzZkAAAAldEVYdGRhdGU6bW9kaWZ5ADIwMTktMDItMDVUMjI6NDE6NDErMDE6MDDvCnUlAAAAGXRFWHRTb2Z0d2FyZQB3d3cuaW5rc2NhcGUub3Jnm+48GgAAAABJRU5ErkJggg==', 
                        'Иконка меню - на главную'
                )",
                "INSERT INTO icons(
                        type, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'header', 
                        'cabinet', 
                        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYEAQAAAAa7ikwAAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QAAKqNIzIAAAAJcEhZcwAAAGAAAABgAPBrQs8AAAAHdElNRQfmAwoQCzGK2LIKAAADgUlEQVRIx42TW2hcdRDGf2cvMWlaNyaQKE1qk5jYaMVLQNRYiJQUtVW3Sqg0hSaIrU++GI2IL0JlqT5oX4qVllhFKl2hXlIMxaAN1mKRFqyWXNAEYk1Nom5MuuxmL58P//92zya7dj84zJyZby5nzgzkgVT4cfkrjFzbLA2dks48I63/wPoCGW6+xOXXEqbZLXk6lhXxSviNXjMqhY/pGr78Qqp92fJKABx3cmANsACV30FwBDb5oTwO4144UQM/hoAzJuKGCBx+GnYN5bb56WvQfRNcfcVxcrv3mcq3dkknE1L6rHJwpUzqvqw0tYZXskF6381JGTE5J9V1rBiRCfJ+Lh2acQUlrFwyYjog3Rc2XM+gFHpC0rHcRiZ2SXWPZAp4css0fA/bajM1AZ/V/UAKbo7AU0eNqXQMNjYAzy7rNWEfcCWwqB2Gyhfsi7Ms0DbTfCc4LRB9EU43wVbAeZcCWFYgehskYlCaj5sASmDxFOgCrO6Dx3/5v+R5RjTaDxfftC8LLkfKJE9GYGjYmBb3w0ALqKvYAg5EfPDWHvj7RszKZuA1IrwBBiaMvjoCWyrA+ZhiIOFkj+mxk9Lp/VJ0vZRakqb2SaGkVFWT5VTHpdF7tQITD0q1/2R4Hpvcj9kaoKodymIw1QmLP0G6Aebuh3gQ6vvA22F/XwicSJ6h+MH/qLvzUrvXASl4j3S2VEr0Ky/C26WyI9Kmr6UT41LsgZWc+JQ0MC1t/llp7sgc2HvSS89L//bkOTKL+X6p/ROp7SPp93KXI+rSY1l1+m4p+I0tsHtMiu6wnoX83Q+3ShWD0vFfreGqCsPmOH8IqWW7NNprHYuFYz6clao7pEuVyxzpArqk5O0e6O6B5rftLykvvGfJo+DZCd6/XMaIWW91QjpmdOazt+Md8cC2c9aQvs4mtwJXgB9ctgqYPAd79sJzr8J4GAi4b8cHDU15ji4fZoFVQFWu+fi3cLjP6OtG4I3OzIICjg9KmygKThNoM3ALEM/a6xthzSVIzUPjFncA0OoDNhZXoGoSlgZhdh802xnjheBFqO6FVADaxl3j9sBMGBWN316X1l2Q+tYWuIEMXOt7sNEDkztcbarwF9TXQ9cCHDkPnx2wxjJXXCZ2lRFftUOoB2nnk9JE73XaTxrxx4TUNiPVPCS9MyZN75XSl128u6Q/56SDD0t1ByT4D0HCoh/QEdpKAAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIyLTAzLTEwVDE2OjExOjM4KzAwOjAwqPohSQAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMi0wMy0xMFQxNjoxMTozOCswMDowMNmnmfUAAAAASUVORK5CYII=', 
                        'Иконка меню - кабинет'
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