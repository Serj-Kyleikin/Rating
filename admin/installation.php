<div style="display: flex; flex-direction: column; align-items: center;">
    
    <h1>Ведите данные для создания подключения к БД</h1>

    <div style="width: 300px;">
        <form action="javascript:save()" style="width: 300px; display: flex; flex-direction: column;">
            <label>Хост:</label>
            <input type="text" name="host" required style="margin-bottom: 2%;">
            <label>Имя новой базы данных mysql:</label>
            <input type="text" name="base" minlength="4" maxlength="20" required style="margin-bottom: 2%;">
            <h3>Укажите данные пользователя, имеющего GRANT привелегии для: создания базы данных и таблиц, внесения и извлечения данных.</h3>
            <label>Пароль mysql:</label>
            <input type="text" name="password" minlength="4" required style="margin-bottom: 2%;">
            <label>Логин mysql:</label>
            <input type="text" name="login" minlength="4" required style="margin-bottom: 2%;">
            <button name="submit" type="submit" style="width: 100px; margin-top: 3%;">Сохранить</button>
        </form>
    </div>
</div>

<script type="text/javascript">

    async function save() {

        let formData = new FormData();

        let form = document.forms[0];
        let elements = form.getElementsByTagName('input')

        for(let i = 0; i < form.length; i++) {
            if(form.elements[i].getAttribute('name') != 'submit') {
                formData.append(form.elements[i].getAttribute('name'), form.elements[i].value);
            }
        }

        let sentAjax = await fetch('/admin/configuration/setup.php', {
            method: 'POST',
            body: formData
        });

        document.location.href = '/';
    }

</script>