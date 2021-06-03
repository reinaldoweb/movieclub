<?php

require_once("models/Movie.php");
require_once("models/Message.php");

//Reviw DAO

class MovieDao implements MovieDaoInterface{

  private $conn;
  private $url;
  private $mensage;

  public function __construct(PDO $conn, $url)
  {
    $this->conn = $conn;
    $this->url = $url;
    $this->mensage = new Message($url);
    
  }



  public function buildMovie($data){
    //Criar objeto de usuario

    $movie = new Movie();

    $movie->id = $data["id"];
    $movie->title = $data["title"];
    $movie->description = $data["description"];
    $movie->image = $data["image"];
    $movie->trailer = $data["trailer"];
    $movie->category = $data["category"];
    $movie->length = $data["length"];
    $movie->id = $data["id"];
    
    return $movie;

  }

  public function findAll(){

  }

  public function getLatestMovies(){

  }
  public function getMovieByuserCategory($category){

  }
  public function getMovieByuserId($id){

  }

  public function findById($id){

  }

  public function findByTitle($title){

  }

  public function creat(Movie $movie){

  }

  public function update(Movie $movie){

  }

  public function destroy($id){

  }






}