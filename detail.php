<?php
require_once("class/movie.php");
include("/db.php");

$mysqli = new mysqli("localhost", "root", "", "webprog");

if ($mysqli->connect_errno) {

    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

if (!isset($_GET['id'])) {
    header("location: index.php");
} else {
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script> -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="style/style2.css">
    <title>MyMovie</title>
</head>

<body>
    <form action="grid.php" method="get">
        <div class="container">
            <div class="header">
                <a href="index.php">
                    <h1>MyMovie</h1>
                </a>
            </div>
            <div class="navigation">
                <div class="menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="grid.php?serial=0">Movie</a></li>
                        <li><a href="grid.php?serial=1">Serial</a></li>
                    </ul>
                </div>
                <div class="search-bar">
                    <input type='text' placeholder='Search...' id='search-text-input' name='txtcari' autocomplete="off">

                    <button id='button-holder' type="submit" name="btncari" value="xxx"> <img src='img/search.png'></button>
                </div>
            </div>

            <div class="penampung-konten">
                <?php
                $arr_genre = array();
                $sql = "Select gm.idmovie, g.nama from genre_movie gm inner join genre g on gm.idgenre=g.idgenre";
                $res_genre = $mysqli->query($sql);
                while ($row_genre = $res_genre->fetch_assoc()) {
                    $arr_genre[$row_genre['idmovie']][] = $row_genre['nama'];
                }

                $arr_pemain = array();
                $arr_peran = array();
                $sql = "select m.idmovie, p.nama, d.peran from movie m inner join detail_pemain d on m.idmovie=d.idmovie inner join pemain p  on p.idpemain=d.idpemain";
                $res_pemain = $mysqli->query($sql);
                while ($row_pemain = $res_pemain->fetch_assoc()) {
                    $arr_pemain[$row_pemain['idmovie']][] = $row_pemain['nama'];
                    $arr_peran[$row_pemain['idmovie']][] = $row_pemain['peran'];
                }


                $sql = "SELECT * FROM movie where idmovie = ?";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $res = $stmt->get_result();


                while ($row = $res->fetch_assoc()) {

                    $date = $row['rilis'];
                    $newdateformat = date("Y", strtotime($date));

                    echo "<div class='view_item2'>";
                    echo "<div class='vi_left'>";
                    echo "<img class='img' src='uploads/" . $row['idmovie'] . "." . $row['extention'] . "' alt=''>";
                    echo "<div class='ribbon'>";

                    if ($row['serial'] == 0) {
                        echo "<span class='movie'>&nbsp;&nbsp;&nbsp;&nbsp;Movie&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                    } else if ($row['serial'] == 1) {
                        echo "<span class='serial'>&nbsp;&nbsp;&nbsp;&nbsp;Serial&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                    }
                    echo "</div>";
                    echo "<div class='pemain'>";
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Pemain</th>";
                    echo "<th>Peran</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    if (isset($arr_pemain[$row['idmovie']]) && isset($arr_peran[$row['idmovie']])) {
                        $arr_kumpulan_detil_peran__movie_ini = $arr_pemain[$row['idmovie']];
                        $arr_kumpulan_detil_peran__movie_ini2 = $arr_peran[$row['idmovie']];
                    }

                    foreach ($arr_kumpulan_detil_peran__movie_ini as $key => $val) {
                        echo "<tr>";
                        echo "<td>" . $val . "</td>";
                        echo "<td>" . $arr_kumpulan_detil_peran__movie_ini2[$key] . "</td>";
                        echo "</tr>";
                    }

                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                    echo "<div class='right'>";
                    echo "<div class='vi_right'>";
                    echo "<p class='title'>" . $row['judul'] . " (" . $newdateformat . ")</p>";
                    echo "<p class='star'><i class='fas fa-star'></i>" . $row['skor'] . " IMDb</p>";
                    echo "</div>";
                    echo "<div class='genre'>";
                    echo "<ul>";

                    // select * from genre_movies where idmovie=$row['id']; ini nggak efektif krn akan diexecute berkali2
                    if (isset($arr_genre[$row['idmovie']])) {
                        $arr_kumpulan_genre_movie_ini = $arr_genre[$row['idmovie']];
                    }
                    foreach ($arr_kumpulan_genre_movie_ini as $key => $value) {
                        echo "<li>" . $value . "</li>";
                    }
                    echo "</ul>";

                    echo "</div>";
                    echo "<div class='synopsis'>";
                    echo "<p>" . $row['sinopsis'] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
            <div class="footer">
                <p class="copy"><small>&copy; Copyright 2021, Cathrine Abigael Christy</small> </p>
                <!-- Icons made by <a href="https://www.flaticon.com/authors/mynamepong" title="mynamepong">mynamepong</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> -->
            </div>
        </div>
    </form>

</body>
</body>

</html>
<?php
//close connection
$mysqli->close();
?>