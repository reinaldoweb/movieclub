<?PHP
require_once("globals.php");
require_once("db.php");
require_once("dao/UserDao.php");
require_once("models/Message.php");

$message = new Message($BASE_URL);

$flassMessage = $message->getMessage();

if (!empty($flassMessage["msg"])) {
  //Limpar a mensagem
  $message->clearMessage();
}

$userDao = new UserDAO($conn,$BASE_URL);
$userData = $userDao->verifyToken(false);//Qualquer usuario poderá ver o cabecalho
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Club - Seu novo clube de filmes</title>
  <link rel="short icon" href="<?=$BASE_URL?>img/style.css">  
  <!--Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
  <!-- CSS do projeto -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.css" integrity="sha512-Mg1KlCCytTmTBaDGnima6U63W48qG1y/PnRdYNj3nPQh3H6PVumcrKViACYJy58uQexRUrBqoADGz2p4CdmvYQ==" crossorigin="anonymous" />
  <link rel="stylesheet" href="<?=$BASE_URL?>css/styles.css">
</head>
<body>
 <header>
  <nav id="main-navbar" class="navbar navbar-expand-lg">
  <a href="<?=$BASE_URL?>" class="navbar-brand">
  <img src="<?=$BASE_URL?>img/logo.svg" alt="MovieStar" id="logo">
  <sapn id="moviestar-title">Movie Club</sapn>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
  aria-espanded="false" aria-label="Toggle navigation"></button>
  <i class="fas fa-bars"></i>
  </a>
  <form action="" method="GET" id="search-form" class="form-inline my-2 my-lg-0">
  <input type="text" name="q" id="search" class="form-control mr-sm-2" type="search" placeholder="Buscar Filmes" 
  aria-label="Search">
  <button class="btn my-2 my-sm-0" type="submit">
  <i class="fa fa-search"></i>
  </button>
  
  </form>
  <div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav">
    <?php if ($userData): ?>
      <li class="nav-item"><a href="<?=$BASE_URL?>newmovie.php" class="nav-link"><i class="far fa-plus-square"> Incluir 
      Filme</i></a></li>
      <li class="nav-item"><a href="<?=$BASE_URL?>dashboard.php" class="nav-link">Meus Filmes</a></li>
      <li class="nav-item"><a href="<?=$BASE_URL?>editprofile.php" class="nav-link bold"><?=$userData->name?></a></li>
      <li class="nav-item"><a href="<?=$BASE_URL?>logout.php" class="nav-link">Sair</a></li>
    <?php else: ?>
    <li class="nav-item"><a href="<?=$BASE_URL?>auth.php" class="nav-link">Entrar / Cadastrar</a></li>
    <?php endif;?>
    </ul>
  </div>
  </nav>
 </header>
 <?php if(!empty($flassMessage["msg"])): ?>
  <div class="msg-container">
    <p class="msg <?=$flassMessage["type"]?>"><?=$flassMessage["msg"]?></p>
  </div>
  <?php endif;?>
