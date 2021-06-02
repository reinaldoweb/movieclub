<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);

//Pega o tipo do formulário
$type = filter_input(INPUT_POST, "type");
  
//Atualizar usuario
if($type === "update"){
  // Resgata dados do usuario
  $userData = $userDao->verifyToken();

  //Recebe dados do post
  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $bio = filter_input(INPUT_POST, "bio");

  //Criar um novo objeto de usuario
  $user = new User();

  //Preencher os dados do usuario
  $userData->name = $name;
  $userData->lastname = $lastname;
  $userData->email = $email;
  $userData->bio = $bio;


  //Faz upload da imagem
  if(isset($_FILES["image"]) && !empty($_FILES["image"]["temp_name"])){
    //print_r($_FILES); exit;

    $image = $_FILES["image"];

    //Imagens permitdas
    $imageTypes = ["image/jpeg", "image/jpg", "image/png"];
    $jpgArray = ["image/jpeg", "image/jpg"];

    //Checa tipo de imagem
    if (in_array($image["type"], $imageTypes)) {

      //Checa se é jpg
      if(in_array($image, $jpgArray)) {
        $imageFile = imagecreatefromjpeg($image["tmp_name"]);

        //imagem png
      }else{
        $imageFile = imagecreatefrompng($image["tmp_name"]);
      }

      $imageName = $user->imageGenerateName();

      imagejpeg($imageFile, "./img/users/".$imageName, 100);

      $userData->image = $imageName;      
      
    }else{
      $message->setMessage("Tipo de imagem inválido!, insira .png ou .jpg", "error", "back");
    }
  }

  $userDao->update($userData);

  //Atualiza a senha do usuario
}else if($type === "changepassword"){


}else{

$message->setMessage("Informações inválidas", "error", "index.php");
}












?>