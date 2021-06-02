<?php 

require_once("templates/header.php");
require_once("dao/UserDao.php");
require_once("models/User.php");

$user = new User();

$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao->verifyToken(true);

$fullName = $user->getFullName($userData);

if($userData->image == ""){
  $userData->image = "user.png";
}
?>

  <div id="main-container" class="container-fluid">

  <div class="col-md-12">

  <form action="<?=$BASE_URL?>user_process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="type" value="update">

  <div class="row">
    <div class="col-md-4">
      <h1><?=$fullName?></h1>
      <p class="page-description">Altere seus dados no formulário abaixo:</p>

      <div class="form-group">
      <label for="name">Nome</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Digite seu nome" value="<?=$userData->name ?>">
      </div>

      <div class="form-group">
      <label for="lastname">Sobre Nome</label>
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite seu Sobre nome" value="<?=$userData->lastname ?>">
      </div>

      <div class="form-group">
      <label for="email">E-mail</label>
      <input type="email" readonly class="form-control disabled" id="email" name="email" placeholder="Digite seu e-mail" value="<?=$userData->email ?>">
      </div>
          <input type="submit" class="btn card-btn" value="Alterar">
    </div>
    <div class="col-md-4">
    
        <div id="profile-image-container" style="background-image:url('<?=$BASE_URL?>img/users/<?=$userData->image?>')">
        </div>
      
        <div class="form-group">
            <label for="image">Foto</label>
             <input type="file" class="form-control-file" name="image" placeholder="Insira sua foto">
      </div>

      <div class="form-group">
      <label for="bio">Sobre você:</label>
      <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="conte quem você é, o que faz e onde trabalha..."><?=$userData->bio?></textarea>
      </div>

    </div>
  </div>
  </form>
    <div class="row" id="change-password-container">
    <div class="col-md-4">
      <h2>Alterar a senha:</h2>
      <p class="opage-description">Digite a nova senha e confirme.</p>
      <form action="<?= $BASE_URL?>user_process.php" method="POST">
        <input type="hidden" name="type" value="changepassword">

      <div class="form-group">
      <label for="password">E-mail</label>
      <input type="password"  class="form-control" id="password" name="password" placeholder="Digite sua nova senha">
      </div>
      <div class="form-group">
      <label for="confirmpassword">Confirme sua senha</label>
      <input type="password"  class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm sua nova senha">
      </div>
        <input type="submit" class="btn card-btn" value="Confirme sua senha">
      </form>
    </div>
    </div>

  </div>
  
  </div>

  <?php require_once("templates/footer.php")?>

  