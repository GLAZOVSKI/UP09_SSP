<h1>Hi, <?= $data['userName']; ?>!</h1>

<?php if ($data['admin']) { ?>
  <div class="bg-dark text-light p-2 mt-4 rounded shadow-sm">
    <h5>Панель администратора</h5>
    <div>
      <a href="/manage_portfolio" class="btn btn-warning">Управление портфолио</a>
    </div>
  </div>
<?php } ?>
