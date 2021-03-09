<h1>Портфолио</h1>

<div class="col-12">
  <div class="row">
    <?php
      foreach ($data as $row) { ?>
        <div class="col-12 bg-dark text-light my-1 d-flex align-items-center">
          <div class="col-3">
            <?= $row['year'] ?>
          </div>

          <div class="col-3">
            <?= $row['site'] ?>
          </div>

          <div class="col-6">
            <?= $row['description'] ?>
          </div>
        </div>
<?php } ?>
  </div>
</div>
