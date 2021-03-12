<script type="text/javascript">
  function showEditField(id) {
    document.getElementById('edit_' + id).hidden = !document.getElementById('edit_' + id).hidden;
  }

  function showNewRecord() {
    document.getElementById('newRecord').hidden = !document.getElementById('newRecord').hidden;
  }
</script>

<div class="d-flex">
  <h1>Управление портфолио</h1> <button type="submit" class="btn btn-primary ms-4" onclick="showNewRecord()">Новая запись</button>
</div>

<div class="bg-dark rounded p-2 mt-4" id="newRecord" hidden>
  <form class="m-0 p-0" action="manage_portfolio/add" method="post">

    <div class="input-group">
      <input type="text" class="form-control" placeholder="Год" name="year">

      <input type="text" class="form-control" placeholder="Сайт" name="site">

      <input type="text" class="form-control" placeholder="Описание" name="description">

      <div class="input-group-append">
        <button class="btn btn-primary" type="send">Добавить</button>
      </div>
    </div>
  </form>
</div>

<?php if(isset($_SESSION['message'])) { ?>
  <div class="alert alert-warning mt-2 mb-0">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php } ?>

<div class="col-12 mt-4">
  <div class="row">
    <?php
      foreach ($data as $row) { ?>
        <div class="col-12 bg-dark text-light my-1 d-flex align-items-center rounded p-2">
          <div class="col-1">
            <?= $row['year'] ?>
          </div>

          <div class="col-3">
            <?= $row['site'] ?>
          </div>

          <div class="col-5">
            <?= $row['description'] ?>
          </div>

          <div class="col-2 text-center">
            <button type="submit" class="btn btn-warning" onclick="showEditField(<?= $row['id'] ?>)">Изменить</button>
          </div>

          <div class="col-1 text-center">
            <form class="m-0 p-0" action="manage_portfolio/delete" method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
          </div>
        </div>

        <div class="bg-dark rounded p-2 mb-2" id="edit_<?= $row['id'] ?>" hidden>
          <form class="m-0 p-0" action="manage_portfolio/edit" method="post">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">

            <div class="input-group">
              <input type="text" class="form-control" placeholder="Год" name="year">

              <input type="text" class="form-control" placeholder="Сайт" name="site">

              <input type="text" class="form-control" placeholder="Описание" name="description">

              <div class="input-group-append">
                <button class="btn btn-success" type="send">Сохранить</button>
              </div>
            </div>
          </form>
        </div>
<?php } ?>
  </div>
</div>
