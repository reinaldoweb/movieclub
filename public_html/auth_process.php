<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDao.php");

$message = new Message($BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);

//Verifica o tipo de formulario

$type = filter_input(INPUT_POST, "type");

if($type === "register"){

  $name = filter_input(INPUT_POST, "name");
  $lastname = filter_input(INPUT_POST, "lastname");
  $email = filter_input(INPUT_POST, "email");
  $password = filter_input(INPUT_POST, "password");
  $confirmapassword = filter_input(INPUT_POST, "confirmpassword");


  //Verificação de  dados mínimos

  if($name && $lastname && $email && $password){

    //Verificar se as senhas são iguais
    if ($password === $confirmapassword) {
      
      //Verificar se e-mail já está cadastrado no sistema

      if ($userDao->findByEmail($email) === false) {

            $user = new User();

            //Criação de token e senha
            $userToken = $user->generateToken();
            $finalPassword = $user->generatorPassword($password);

            $user->name = $name;
            $user->lastname = $lastname;
            $user->email = $email;
            $user->password = $finalPassword;
            $user->token = $userToken;

            $auth = true;

            $userDao->create($user, $auth);
        
      }else{

        $message->setMessage("Usuário já cadastrado, tente outro e-mail!", "error", "back");

      }

    }else{

      $message->setMessage("Senhas não são iguias", "error", "back");
    }


  }else{

    //Envia mensagem de erro dos dados faltantes

    $message->setMessage("Por favor preencha todos os campos", "error", "back");

  }
}else if($type === "login"){

  $email = filter_input(INPUT_POST, "email");
  $password = filter_input(INPUT_POST, "password");

  // Tenta autenticar usuario
  if($userDao->authenticateUser($email, $password)) {
    
  $message->setMessage("Seja bem-vindo!", "success", "editprofile.php");//Mensagem do login

    //Redireciona usuário, caso não autentique
  }else{

    $message->setMessage("Usuário e/ou senha incorretos!", "error", "back");//Erro de usuario e senha

  }

}else {
  $message->setMessage("Dados inválidos!", "error", "index.php");//Se enviar algo que não esteja mapeado

}