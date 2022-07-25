// Авторизация и регистрация

async function getData(method) {

    let info;

    try {
        let response = await fetch('https://json.geoiplookup.io/'); 
        info = await response.json(); 
    } catch(error) {
        info = error.name;
    }

    // Формирование данных

    let formData = new FormData();
    formData.append('ajaxSettings', 'plugins:users:'+method);

    formData.append('info', JSON.stringify(info));

    let form = document.forms[0];

    for(let i = 0; i < form.length; i++) {
        if(form.elements[i].getAttribute('type') != 'submit') {
            formData.append(form.elements[i].getAttribute('name'), form.elements[i].value);
        }
    }

    // Запрос на сервер

    let sentAjax = await fetch('/Ajax.php', {
        method: 'POST',
        body: formData
    });

    let data = await sentAjax.text();
    formData = null;

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

    let error = document.querySelector('.wrong');
    if(error) error.remove();

    let status = data.split('_');
    let message, field;

    if(status[0] == 'password') {

        field = document.getElementById(status[0]);

        message = 'Неверный пароль! Остал';

        if(status[1] != 'blocked') message += (status[1] == '2') ? 'ось 2 попытки' : 'ась 1 попытка';
        else message = 'Следующая попытка через 1 час!'

    } else {
        field = document.getElementById(status[2]);
        message = errors[data];
    }

    let DIV = document.createElement('div');
    field.appendChild(DIV);
    DIV.classList.add('wrong');

    DIV.textContent = message;
    field.children[1].value = '';
}