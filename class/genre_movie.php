<?php
require_once("parentClass.php");
class Genre_movie extends ParentClass
{
    public function __construct($server, $database, $userid, $password)
    {
        parent::__construct($server, $database, $userid, $password);
    }

    public function insertGenreMovie($idmovie, $idgenre)
    {
        $sql = "insert into genre_movie(idmovie, idgenre) values (?, ?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ii", $idmovie, $idgenre);
        $stmt->execute();
    }

    public function getGenreMovie()
    {
        
    }
}
