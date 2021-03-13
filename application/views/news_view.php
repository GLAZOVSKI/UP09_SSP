<script type="text/javascript">
function comments(id) {
  document.getElementById('comments_' + id).hidden = !document.getElementById('comments_' + id).hidden;
}
</script>

<h1>Новости</h1>

<?php if(isset($_SESSION['message'])) { ?>
  <div class="alert alert-warning mt-2 mb-0">
    <?php
      echo $_SESSION['message'];
      unset($_SESSION['message']);
    ?>
  </div>
<?php } ?>

<div class="col-12">
  <?php foreach ($data['news'] as $row) { ?>
    <div class="col-12 bg-dark text-light my-2 p-2 rounded">
      <div class="col-12 h2">
        <?= $row['title'] ?>
      </div>

      <div class="col-12 h6">
        <?= $row['description'] ?>
      </div>

      <div class="col-12">
        <small><?= $row['date'] ?></small>
      </div>

      <div class="col-12">
        <button type="button" class="btn btn-outline-info btn-sm mt-1" onclick="comments(<?= $row['id'] ?>)">Комментарии</button>
      </div>
    </div>

    <div class="col-12 bg-dark text-light my-1 p-2 rounded" id="comments_<?= $row['id'] ?>" hidden>
      <h6>Комментарии</h6>

        <?php foreach ($data['comments'] as $com) { ?>
          <?php if($com['newsID'] == $row['id']) {?>
            <div class="mt-2 my-1 d-flex bg-light rounded p-1 text-dark align-items-center">
              <div class="me-2">
                <span><?= $com['name'] ?>:</span>
              </div>

              <div class="">
                <span><?= $com['comment'] ?></span>
              </div>

              <?php if($data['thisUserID'] == $com['userID']) {?>
                <div class="flex-grow-1 ms-2 justify-content-end d-flex">
                  <form class="m-0 p-0 d-flex" action="news/delete_comment" method="post">
                    <input type="hidden" name="id" value="<?= $com['id'] ?>">
                    <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                  </form>
                </div>
              <?php } ?>
            </div>
          <?php } ?>
        <?php } ?>

        <form class="m-0 p-0" action="news/add_comment" method="post">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <div class="input-group mt-3">
            <span class="input-group-text">Комментарий</span>
            <input type="text" class="form-control" name="comment">
            <button type="submit" class="btn btn-success">Добавить</button>
          </div>
        </form>
    </div>
    <?php } ?>
</div>
