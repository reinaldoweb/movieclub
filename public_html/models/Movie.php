<?php
class Movie{

public $id;
public $title;
public $description;
public $image;
public $trailer;
public $category;
public $length;
public $users_id;


//funcão para gerar imagem
public function imageGenerateName(){
  return bin2hex(random_bytes(60)).".jpg";
}


}

interface MovieDaoInterface{

  public function buildMovie($data);
  public function findAll();
  public function getLatestMovies();
  public function getMovieByuserCategory($category);
  public function getMovieByuserId($id);
  public function findById($id);
  public function findByTitle($title);
  public function creat(Movie $movie);
  public function update(Movie $movie);
  public function destroy($id);

}
