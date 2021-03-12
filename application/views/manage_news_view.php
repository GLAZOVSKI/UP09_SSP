<script type="text/javascript">
  function showEditField(id) {
    document.getElementById('news_' + id).hidden = !document.getElementById('news_' + id).hidden;
  }

  function newNews() {
    document.getElementById('addNews').hidden = !document.getElementById('addNews').hidden;
  }

</script>

<div class="d-flex">
  <h1>Управление новостями</h1> <button type="submit" class="btn btn-primary ms-4" onclick="newNews()">Новая запись</button>
</div>

<div class="col-12 bg-dark text-light my-1 mt-2 p-2 rounded mb-4" id="addNews" hidden>
    <h4>Добавить новость</h4>
    <form class="m-0 p-0" action="manage_news/add" method="post">
      <div class="input-group mb-1">
        <span class="input-group-text">Название</span>
        <input type="text" class="form-control" name="title">
      </div>

      <div class="input-group mb-2">
        <span class="input-group-text">Описание</span>
        <textarea class="form-control" name="description"></textarea>
      </div>

      <button type="submit" class="btn btn-success col-12">Создать</button>
    </form>
</div>

<?php if(isset($_SESSION['message'])) { ?>
  <div class="alert alert-warning mt-1 mb-0">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php } ?>

<div class="col-12 mt-2">
    <?php
      foreach ($data as $row) { ?>
        <div class="col-12 bg-dark text-light my-2 p-2 rounded">
          <div class="col-12 h2 d-flex">
              <div class="col-9">
                  <?= $row['title'] ?>
              </div>

              <div class="col-3">
                  <form class="m-0 p-0 d-flex justify-content-end" action="manage_news/delete" method="post">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                    <button type="button" class="btn btn-warning ms-2" onclick="showEditField(<?= $row['id'] ?>)">Изменить</button>
                  </form>
              </div>
          </div>

          <div class="col-12 h6">
            <?= $row['description'] ?>
          </div>

          <div class="col-12">
            <small><?= $row['date'] ?></small>
          </div>
        </div>

        <div class="col-12 bg-dark text-light my-1 p-2 rounded" id="news_<?= $row['id']?>" hidden>
            <h4>Редактировать новость</h4>
            <form class="m-0 p-0" action="manage_news/edit" method="post">
              <input type="hidden" name="id" value="<?= $row['id']?>">
              <div class="input-group mb-1">
                <span class="input-group-text">Название</span>
                <input type="text" class="form-control" name="title">
              </div>

              <div class="input-group mb-2">
                <span class="input-group-text">Описание</span>
                <textarea class="form-control" name="description"></textarea>
              </div>

              <button type="submit" class="btn btn-success col-12">Сохранить</button>
            </form>
        </div>
      <?php } ?>
</div>
