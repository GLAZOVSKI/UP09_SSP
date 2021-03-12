<h1>Новости</h1>

<div class="col-12">
    <?php
      foreach ($data as $row) { ?>
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
        </div>
      <?php } ?>
</div>
