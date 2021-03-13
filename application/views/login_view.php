<div>
  <h1>Вход в аккаунт</h1>
  <form class="col-md-6" action="/login/auth" method="post">
    <div class="form-group">
        <label for="email">Введите Email</label>
        <input type="text" class="form-control" id="email" name="email" required>
    </div>

    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn-primary mt-2" name="register">Войти</button>
</form>
</div>
