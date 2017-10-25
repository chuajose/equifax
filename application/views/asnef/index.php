
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Añadir registro asnef</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/docs/4.0/examples/navbar-top-fixed/navbar-top-fixed.css" rel="stylesheet">
    <style>
    h3 {
  margin-top: 2rem;
}

.row {
  margin-bottom: 1rem;
}
.row .row {
  margin-top: 1rem;
  margin-bottom: 0;
}
[class*="col-"] {
  padding-top: 1rem;
  padding-bottom: 1rem;
}

hr {
  margin-top: 2rem;
  margin-bottom: 2rem;
}
    </style>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="<?php echo base_url();?>"><img width="130px" src="https://dhrb2lz9k17o6.cloudfront.net/v2/img/logo_trocobuy.svg"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url();?>asnef/index">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>asnef/sended">Registros Enviados</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>-->
        </ul>
        <form method="post" action="<?php echo base_url();?>asnef/<?php echo $this->uri->segment(2);?>" class="form-inline mt-2 mt-md-0">
          <input class="form-control mr-sm-2" type="text" placeholder="Buscar" name="search" aria-label="Search">
          <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar </button>
        </form>
      </div>
    </nav>

    <main role="main" class="container">
    <?php echo $content;?>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
  </body>
</html>
