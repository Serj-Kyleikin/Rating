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
                "INSERT INTO icons(
                        type, 
                        page, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'page', 
                        ':main,', 
                        'gold', 
                        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAAAgCAYAAACVf3P1AAAE50lEQVR4XuWcX2gcVRTGvzOb7Gy0qBUpqKDSB60WiqIg1GRnqwhS0T4IIkWpYBUEK6IiBARTURS1CCKClT5YFPFNi5CXYpyNVR9UUGywPhT7YKWFtiCt3dl055OdnWiT7L+52Z1PdJ5Ccs/5vnPml7n3zt3E4HhxBiPw/M8BEMei2+1+NBxTOYcpPSi1mw37r+ib691nWNwK2IdJPLnVKvWPXHO5xik9KLWTlov7Pyj9FQDofw/gphSeH1GObjQDXWFyiWOo86DUbgGoq32Q+k4AsurfDeKzRdAQm60STbuA5BKj9KDUTm6+uP+D1HcDMPSrACaWgBNaEFVcYHKJodCDUjt9+kj7P8j6MwPI2bFbEcfftIXGvHErnz3gAlSWGKUHpXYCn7j/g9bPDmDo7wNwTwdg9lkQbckCk8tYCj0otdOnn7T/g64/E4AMi9cD9hMArwM4RMwNtqneHDOUS+lBqZ3ufKX9H0b92QCsFveC9lB3srjXgvq2odCXLMB1HpTarc2HrvZh6fcNIGdLaxHzZwCjPeCah2frbKJ2eNAQKj0otVtrP23/h6W/DEDOYjXOldbDww0A1oJcD0u+vhpAoX+o7BTAOQAHAR4GbQ4FO4jx2q9miLvlUXpQardA0/Y/b31jtfgAYm8LjNcBuBbAhf1D5jTyDIBfQDsEiz+xoP6x1kPjOFhYo6ofBlP2X61vDEsnAa52QmnFQTxhQf0yrYfk9KbvpciKS16UgCcAz1P2X61vrJYeBPl+l53tYHv+T7YYZtusXPtA7GE3yMdU9SftEPZfrZ/85rNaehjknhxvQvOp87gF0bsLPCo9KLX/Df1X1v/31MOw9AjA93KYjgjiCatE7yx9tCo9KLVb7/i0/VfpL1r78At/BwxvDWvOTfIanrNy9HonDaUHpXYCobj/Cv3lr2Gq/lMg3hwOhJy0oP5qr9wUelBqt6Zjbf/z1m+7+2PoPwPgjV6gZPs5n7eg/nK/MUoPSu3WdKztf576HV8/MCxNAXyhX2C6j7OdFtSmsuZSelBqp2tCaf/zqr/r+y+G/qcA7s0KzpLxK/qEjNKDUjt9Ekr7n0f9vQDcD+COFQFo2G/l6E7XHAx9mQeldgqgrPa89HsBeBTA5a7wpHFHLYiudM3B0Jd5UGqnAMhqz0u/8xpwBpfA80+5grMozosutQlkzkWhB6V2cvOFteep32UTMrYRiAfz8Xp6G61y9uusMDPUeVBqt54+utrz1O8MYLW0HUxORgZw2XYLas2jvkwXhR6U2gkAwtrz1O8CoL8LxNOZiOk8eJcF0bNZc7Gq86DUbgGgqz1P/W4AToO4qws0c81jNcBqIJtHawt/pN4uZNqCaLMDgDIPrPoy7RSA/4V+lzWgfwTAVW2g+Q2wF3Gstmfh/8GQ8BAW74PZawCuWRZjOGLlaPn3exDJUOdBqZ3uQKX9z6v+9kdxM1gFz/9jySdjzgD2NuLaS7YJp9uxw68whvnik4BNArj4vDFEHF3UKa5tLqEHCrXTHai0/3nW3x7A2dGbEXvfpmCcA7AbI6M77bbTx/uZRnlg1Ro05qdAPApgJInx4ltsYv67fuKTmyD0oNRW1563fnsAv7zgCjQaswB+QAGTNh4d6hec88dxprgOZq/AsAFWGLfyn7/3m4dCD0rtBABh7Xnr/wXOcPNRiiPSeAAAAABJRU5ErkJggg==', 
                        'Золотой рейтинг'
                )",
                "INSERT INTO icons(
                        type, 
                        page, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'page', 
                        ':main,', 
                        'silver', 
                        'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAKAAAAAgCAYAAACVf3P1AAAEM0lEQVR4Xu2cS4gcVRSG/3PtaXREE8RMfAVRxo2guBAfDam6RWUUBslCyIhGRST4QDc6uBAENz42EjcKIT4QjFmMuhDRTQ/cqqIZgwsRdNxEYUQl2C2iIKN2V9WRO3TGcaz3TKJU3bvpRZ9zf/j6o2fq3KomVFxKqWkhxDHdHobhQdd1v6m4VaU2k18P/lTp0wcQBEE3juN9ul8IsWhZ1kzVvar0mfx68K8kYBAE18Zx/CWA9X4iut627S+qyFS2x+TXh38lAZVSR4jo4Y3iENER27YfLStTlXqTXx/+pQVUSu0UQnzPzOdvkme13W7v6XQ6P1eRqmiPya8X/9IC+r4/z8wvpQgzL6U8XFSmKnUmv178SwnIzML3/ZMArk6RZ6Xf70/Pzc1FVeTK6zH59eNfSkDf9/cz8wc5ouyXUn6YJ1OV901+/fiXEnDj6CNDoK6U8rYqguX1mPy/Ry914Z8pYLfb3dFqtS4lol1EdA0zv75x9JICgYnoEDOfZOZBGIanZmZmfs2TK+l9k19//rS4uLh7YmLiAWaeBrAbwC4Al49fz60iTkLPHwAGAH4Yv/5IRF+PRqO3dK3Jby5/8jxvCcCt2yRa2W1OAGCT31z+5Pu+nunpb7z/YvWJaGTyG8zf87wDAI4DaJ1lA0MA94wzTX5D+a9dhCil9hHR+wAuPEsS/kZEd9m2/bHJbzb/9atg3/evY+aPAOw5wxKeEkLcYVnWZxtzTH4z+f9jDNPr9S4Lw1BLeMMZkvCrKIpmXdf9Nml/k988/v+aA/Z6vQuiKHqXmW/fZgkVM9/pOM4vWfua/GbxTxxELy8vtweDwRsA7t0mCbXQ9zuOo+eBucvkN4d/6kkIM+sZ4dtEdDDXmIwCZn5HSnkfEel5X+Fl8pvBP/MozvM8PR65u7A1yYXHpZSVJDb59eefKWAQBCtxHF+5RQFXpJRXVdnD5Neff6qA4ytSfXa75RVF0RWu65bay+SvXRGXYpb2Qf2f+acKOD4hWdiyffqwl/mA4zjvldnL5K+dUNWef5aA+tb6J8pIk1F7WEo5X2Yvz/NMfgP4Zwn4CYBbcqQ5PdPbmVN3QkpZ6o4bz/NMfgP4Jwq4tLR03nA41HK1U8TSI5VjYRg+NTk5ORoOh88CeFw/o55SP2q32zs6nc7vRb4FTX5z+CcK6HneXv3jBymyfE5Ej9m2re8jXF9KqRuFEK8w881Jfcy813GcXhEBTX5z+KcJqP/32/x4pX7e95l+v3807am3hYWFc6amph4C8ByAizbJ9qSU8uWCApr8hvBPFFApdYiIXhvLEgN4k5mfdhznpyICKaUuJqIXATx4+s+y/iUF27aPFuw3+Q3hnyZgi4ieB3CJEOJVy7I+LSLO5pogCG6K4/gRAN+trq6+MDs7+2eRfZRSJr8h/Es9lllEHlNjCJQh8BftNRKL+oLz6gAAAABJRU5ErkJggg==', 
                        'Серебряный рейтинг'
                )",
                "INSERT INTO icons(
                        type, 
                        page, 
                        name, 
                        image, 
                        description
                ) VALUES(
                        'page', 
                        ':main,', 
                        'vote', 
                        'data:image/png;base64,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', 
                        'Бордовый рейтинг'
                )",
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