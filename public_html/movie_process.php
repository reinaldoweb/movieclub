<?php


require_once("globals.php");
require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");
require_once("dao/MovieDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Resgata o tipo do formulário
$type = filter_input(INPUT_POST, "$type");

// Resgata dados do usuario

$userData = $userDao->verifyToken();

if ($type === "create") {
  //Receber os dados dos inputs

  $title = filter_input(INPUT_POST, "title");
  $description = filter_input(INPUT_POST, "description");
  $trailer = filter_input(INPUT_POST, "trailer");
  $category = filter_input(INPUT_POST, "category");
  $length = filter_input(INPUT_POST, "length");
  
  $movie = new Movie();

  if (!empty($title) && !empty($description) && !empty($category)) {
    # code...
  }else{

    $message->setMessage("Voçê precisa adicionar pelo menos: titulo, descrição e categoria", "error", "back");
  }

}else{

  $message->setMessage("Informações inválidas", "error", "index.php");
}