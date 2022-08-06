// Авторизация и регистрация

async function getData(method) {

    new Promise((resolve) => {

        let info = loadData("https://json.geoiplookup.io/", 5000);
        if(info) resolve(info);

    }).then((data) => { 
        sent(data, method);
    }).catch((error) => {
        sent(error.name, method);
    });
}

// Получение данных пользователя

async function loadData(url, time) {

    let controller = new AbortController();
  
    let timeoutId = setTimeout(() => {
        controller.abort();
    }, time);

    let response = await fetch(url, {
        signal: controller.signal,
    });

    if(response) {

        clearTimeout(timeoutId);
        return await response.json();
    }
}

async function sent(info, method) {

    // Формирование данных

    let formData = new FormData();
    formData.append('ajaxSettings', 'plugins:users:'+method);
    formData.append('info', JSON.stringify(info));

    let form = document.forms[0];

    if(method == 'registration') {

        formData.append('name', form.elements.name.value);
        formData.append('mail', form.elements.mail.value);
    }

    formData.append('login', form.elements.login.value);
    formData.append('password', form.elements.password.value);

    // Запрос на сервер

    let sentAjax = await fetch('/Ajax.php', {
        method: 'POST',
        body: formData
    });

    let data = await sentAjax.text();

    // Проверка данных

    if(data == 'verify') document.location.href = '';
    else showError(data);
}

// Показ сообщения об ошибке

function showError(data) {

    let errors = {
        wrong_a_login: 'Неверный логин!',
        wrong_r_login: 'Логин занят!',
        wrong_r_mail: 'Почта уже используется!'
    }

    let status = data.split('_'), message, field,
         error = document.querySelector('.wrong');

    if(error) error.remove();

    if(status[0] == 'password') {

        field = document.getElementById(status[0]);

        message = 'Неверный пароль! Остал';

        if(status[1] != 'blocked') message += (status[1] == '2') ? 'ось 2 попытки' : 'ась 1 попытка';
        else message = 'Следующая попытка через 1 час!';

    } else {
        field = document.getElementById(status[2]);
        message = errors[data];
    }

    let DIV = document.createElement('div');
    DIV.className = 'wrong';
    field.append(DIV);

    DIV.textContent = message;
    field.children[1].value = '';
}