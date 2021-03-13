<h1>Модерация аккаунтов</h1>

<div class="col-12">
  <div class="row">
    <div class="col-12 bg-dark text-light my-1 d-flex align-items-center rounded p-2">
      <div class="col-1 text-center border">
        ID
      </div>

      <div class="col-2 text-center border">
        Email
      </div>

      <div class="col-2 text-center border">
        Фамилия
      </div>

      <div class="col-2 text-center border">
        Имя
      </div>

      <div class="col-1 text-center border">
        Админ
      </div>

      <div class="col-1 text-center border">
        Бан
      </div>

      <div class="col-3 text-center border">
        Заблокировать/Удалить
      </div>

    </div>
    <?php
      foreach ($data as $row) { ?>
        <div class="col-12 bg-dark text-light my-1 d-flex align-items-center rounded p-2">
          <div class="col-1 text-center">
            <?= $row['id'] ?>
          </div>

          <div class="col-2 text-center">
            <?= $row['email'] ?>
          </div>

          <div class="col-2 text-center">
            <?= $row['lastName'] ?>
          </div>

          <div class="col-2 text-center">
            <?= $row['firstName'] ?>
          </div>

          <div class="col-1 text-center">
            <?php echo $row['admin'] == 1 ? 'true' : 'false'; ?>
          </div>

          <div class="col-1 text-center">
            <?php echo $row['blocked'] == 1 ? 'true' : 'false'; ?>
          </div>

          <div class="col-3 text-center d-flex flex-grow-1 justify-content-end">

            <?php if($row['admin']) {?>
              <form class="m-0 p-0 d-flex justify-content-end" action="manage_account/remove_admin" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-info me-2" title="Забрать права администратора">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                  </svg>
                </button>
              </form>
            <?php }else { ?>
              <form class="m-0 p-0 d-flex justify-content-end" action="manage_account/add_admin" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-secondary me-2" title="Дать права администратора">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x" viewBox="0 0 16 16">
                    <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                    <path fill-rule="evenodd" d="M12.146 5.146a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
                  </svg>
                </button>
              </form>
            <?php } ?>

            <?php if($row['blocked']) {?>
              <form class="m-0 p-0 d-flex justify-content-end" action="manage_account/un_block" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-warning" title="Разблокировать">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                    <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2zM5 8h6a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1z"/>
                  </svg>
                </button>
              </form>
            <?php }else { ?>
              <form class="m-0 p-0 d-flex justify-content-end" action="manage_account/block" method="post">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn btn-success" title="Заблокировать">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-unlock" viewBox="0 0 16 16">
                    <path d="M11 1a2 2 0 0 0-2 2v4a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9a2 2 0 0 1 2-2h5V3a3 3 0 0 1 6 0v4a.5.5 0 0 1-1 0V3a2 2 0 0 0-2-2zM3 8a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1H3z"/>
                  </svg>
                </button>
              </form>
            <?php } ?>

            <form class="m-0 p-0 d-flex justify-content-end" action="manage_account/delete_user" method="post">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn btn-danger ms-2" title="Удалить">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                </svg>
              </button>
            </form>
          </div>
        </div>
<?php } ?>
  </div>
</div>
