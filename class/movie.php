<!-- :: itu untuk manggil method & static class nya parent
-> itu untuk manggil data member/?-->

<!-- biasanya class yg bersifat static itu class2 yg generik, bisa dimanfaatkan untuk kondisi apapun -->

<?php
require_once("parentClass.php"); //me link-kan class yang lain/mengimport class yang lain

//"parent" tidak boleh dijadikan sebagai nama class karena nanti ndak bisa dikenali
class Movie extends ParentClass
{
    public function __construct($server, $database, $userid, $password)
    {
        parent::__construct($server, $database, $userid, $password);
        //parent ini kalau di C# itu base
    }

    public function getMovie($keyword_judul, $offset = null, $limit = null)
    {
        $sql = "SELECT * FROM movie WHERE judul LIKE ?";
        if (!is_null($offset)) {
            $sql .= " LIMIT ?, ?";
        }
        //mau panggil property di parent ya pake $this saja kan sudah diwariskan
        $stmt = $this->mysqli->prepare($sql);

        if (!is_null($offset)) {
            $stmt->bind_param("sii", $keyword_judul, $offset, $limit);
        } else {
            $stmt->bind_param("s", $keyword_judul);
        }
        $stmt->execute();
        $res = $stmt->get_result();
        return $res;
    }

    public function insertMovie()
    {
        $sql = "Insert into movie (judul, rilis, skor, sinopsis, serial) values (?,?,?,?,?)";
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("ssdsi", $judul, $rilis, $skor, $sinopsis, $serial);
        $stmt->execute();
    }

    public function updateExtention($ext, $idmovie){
        $sql = "Update movie set extention=? where idmovie=?";
        $stmt =  $this->mysqli->prepare($sql);
        $stmt->bind_param("si", $ext, $idmovie);
        $stmt->execute();
    }


}
