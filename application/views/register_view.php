<div1>
  <h1>Регистрация</h1>
  <form class="col-md-6" action="/register/submit" method="post">
      <div class="form-group">
          <label for="email">Введите Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
      </div>

      <div class="form-group">
          <label for="password">Пароль</label>
          <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="form-group">
          <label for="rePassword">Повторите пароль</label>
          <input type="password" class="form-control" id="rePassword" name="rePassword" required>
      </div>

      <div class="form-group">
          <label for="firstName">Введите Имя</label>
          <input type="text" class="form-control" id="firstName" name="firstName" required>
      </div>

      <div class="form-group">
          <label for="middleName">Введите Отчество</label>
          <input type="text" class="form-control" id="middleName" name="middleName">
      </div>

      <div class="form-group">
          <label for="lastName">Введите Фамилию</label>
          <input type="text" class="form-control" id="lastName" name="lastName" required>
      </div>

      <?php if(isset($_SESSION['message'])) { ?>
        <div class="alert alert-warning mt-2 mb-0">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
          ?>
        </div>
      <?php } ?>

      <button type="submit" class="btn btn-primary mt-2" name="submit">Регистрация</button>
  </form>
</div>
