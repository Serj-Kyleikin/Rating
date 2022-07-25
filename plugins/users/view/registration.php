
<div class="login">
    <p>Регистрация пользователя</p>
    <form method="post" action="javascript:getData('registration')">
        <div>
            <label>Имя:</label>
            <input type="text" name="name" required>
        </div>
        <div id="mail">
            <label>Почта:</label>
            <input type="mail" name="mail" required>
        </div>
        <div id="login">
            <label>Логин:</label>
            <input type="text" name="login" required>
        </div>
        <div id="password">
            <label>Пароль:</label>
            <input type="password" name="password" required>
        </div>
        <button name="submit" type="submit">Сохранить</button>
    </form>
</div>