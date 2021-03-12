<script type="text/javascript">
  function showEditField(id) {
    document.getElementById('edit_' + id).hidden = !document.getElementById('edit_' + id).hidden;
  }
</script>

<h1>Управление портфолио</h1>
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
          <form class="m-0 p-0" action="" method="post">
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
