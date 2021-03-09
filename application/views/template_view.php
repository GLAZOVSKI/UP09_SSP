<!DOCTYPE html>
<html lang="ru" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js" charset="utf-8"></script>
    <title>Главная</title>
  </head>
  <body>
    <div class="container">
      <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom">
        <p class="h5 my-0 me-md-auto fw-normal">GLZVSKI LTD</p>
        <nav class="my-2 my-md-0 me-md-3">
          <a class="p-2 text-dark" href="/">Home</a>
          <a class="p-2 text-dark" href="/portfolio">Portfolio</a>
        </nav>
        <a class="btn btn-outline-primary" href="#">Sign up</a>
      </header>

      <?php include 'application/views/'.$content_view; ?>
    </div>
  </body>
</html>
