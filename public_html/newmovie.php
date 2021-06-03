<?php require_once("templates/header.php");

//Verifica se usuario está autenticado
require_once("dao/UserDao.php");
require_once("models/User.php");

$user = new User();
$userDao = new UserDAO($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

?>

  <div id="main-container" class="container-fluid">

  <div class="offset-md-4 col-md-4 new-movie-container">
    <h1 class="page-title">Adicionar Filme</h1>
    <p class="page-description">Adicione sua critica e compartgilhe com o mundo</p>

    <form action="<?=$BASE_URL?>MOVIE_PRECESS.PHP" id="add-movie-form" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="type" value="create">    
      <div class="form-group">
        <label for="title">Título</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Digite o título do seu filme">
      </div>
      <div class="form-group">
        <label for="image">Título</label>
        <input type="file" class="form-control-file" id="image" name="image">
      </div>
      <div class="form-group">
        <label for="length">Título</label>
        <input type="text" class="form-control" id="length" name="length" placeholder="Digite a duração do seu filme">
      </div>

      <div class="form-group">
        <label for="category">categoria</label>
          <select name="category" id="catgegory" class="form-control">

          <option value="">Selecione</option>
          <option value="Ação">Ação</option>
          <option value="Darama">Darama</option>
          <option value="Comédia">Comédia</option>
          <option value="Ficção">Fixãp</option>
          <option value="Romance">Romance</option>
         
          </select>
      </div>

      <div class="form-group">
        <label for="trailer">Título do traile</label>
        <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">
      </div>

      <div class="form-group">
        <label for="description">Descrição</label>
        <textarea name="description" id="description" rows="5" class="form-control" placeholder="Descreva o filme"></textarea>
      </div>
      <input type="submit" class="btn card-btn" value="Adicionar filme">
  </form>
  </div>
  
  </div>

  <?php require_once("templates/footer.php")?>

  