<?php
require_once("class/movie.php");
include("/db.php");

$mysqli = new mysqli("localhost", "root", "", "webprog");

if ($mysqli->connect_errno) {

    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

if (isset($_GET['txtcari'])) {
    // $cari = (isset($_GET['txtcari'])) ? $_GET['txtcari'] : "";
    $cari = $_GET['txtcari'];

    $msg = "Showing result(s) for '" . $cari . "'";
    if (isset($_GET['serial'])) {
        $serial = $_GET['serial'];
        if ($serial == 0) {
            $type = "Movie";
        } else if ($serial == 1) {
            $type = "Serial";
        }
        $msg = "Showing collection(s) of " . $type . "";
    }
} else {
    $cari = "";
    $msg = "&nbsp;";
}
$keyword = "%$cari%";

$DATA_PER_PAGE = (isset($_GET['jmlhdata'])) ? $_GET['jmlhdata'] : 12;
$halaman_ke = (isset($_GET['page'])) ? $_GET['page'] : 1;
$offset = $DATA_PER_PAGE * ($halaman_ke - 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=div, initial-scale=1.0">
    <title>MyMovie</title>
    <!-- <script type="text/javascript" src="../../js/jquery-3.5.1.min.js"></script> -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <form action="" method="get">
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
                        <?php
                        if (isset($_GET['serial'])) {
                            $serial = $_GET['serial'];
                            if ($serial == 0) {
                                echo "<li><a href='grid.php?serial=0' id='activenav'>Movie</a></li>";
                                echo "<li><a href='grid.php?serial=1'>Serial</a></li>";
                            } else if ($serial == 1) {
                                echo "<li><a href='grid.php?serial=0'>Movie</a></li>";
                                echo "<li><a href='grid.php?serial=1' id='activenav'>Serial</a></li>";
                            }
                        } else {

                            echo "<li><a href='grid.php?serial=0'>Movie</a></li>";
                            echo "<li><a href='grid.php?serial=1'>Serial</a></li>";
                        }
                        ?>
                    </ul>
                </div>
                <?php
                if (!isset($serial)) {
                    echo "<div class='search-bar'>
                            <input type='text' placeholder='Search...' id='search-text-input' name='txtcari' autocomplete='off'>
                            <button id='button-holder' type='submit' name='btncari' value='xxx'> <img src='img/search.png'></button>
                        </div>";
                }
                ?>
            </div>

            <div class="penampung-konten">
                <!-- <div class="carousel"></div> blm fix-->
                <div class="content">
                    <div class="view-as">
                        <?php
                        if (isset($serial)) {
                            echo "<a href='grid.php?txtcari=$cari&serial=$serial'  class='btngrid'><i class='fas fa-th fa-lg'></i></a>";
                            echo "<a href='list.php?txtcari=$cari&serial=$serial' id='active'  class='btnlist'><i class='fas fa-list fa-lg'></i></a>";
                        } else {
                            echo "<a href='grid.php?txtcari=$cari'  class='btngrid'><i class='fas fa-th fa-lg'></i></a>";
                            echo "<a href='list.php?txtcari=$cari' id='active'  class='btnlist'><i class='fas fa-list fa-lg'></i></a>";
                        }
                        ?>
                    </div>
                    <div class="grid-content">
                        <p class='msg'><?php echo $msg; ?></p>
                        <hr>
                        <div class="list-view">
                            <?php
                            //cari jumlah data utk pagination
                            $cari = (isset($_GET['txtcari'])) ? $_GET['txtcari'] : "";
                            $keyword = "%$cari%";
                            $sql = "SELECT * FROM movie where judul LIKE ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("s", $keyword);
                            $stmt->execute();
                            $res = $stmt->get_result();

                            $total_data = $res->num_rows;

                            $keyword = "%$cari%";
                            $o = 0;
                            $o = 0;
                            if (isset($_GET['serial'])) {
                                $serial = $_GET['serial'];
                                $sql = "SELECT idmovie, judul, rilis, skor,extention,serial, LEFT(sinopsis, 200) AS synopsis FROM movie where judul LIKE ? and serial=? ORDER BY serial LIMIT ?, ?";
                                $stmt = $mysqli->prepare($sql);
                                $stmt->bind_param("ssii", $keyword, $serial, $offset, $DATA_PER_PAGE);
                            } else {
                                $serial = "";
                                $sql = "SELECT idmovie, judul, rilis, skor,extention,serial, LEFT(sinopsis, 200) AS synopsis FROM movie where judul LIKE ? ORDER BY serial LIMIT ?, ?";
                                $stmt = $mysqli->prepare($sql);
                                $stmt->bind_param("sii", $keyword, $offset, $DATA_PER_PAGE);
                            }
                            $stmt->execute();
                            $res = $stmt->get_result();


                            while ($row = $res->fetch_assoc()) {

                                $date = $row['rilis'];
                                $newdateformat = date("Y", strtotime($date));
                                echo "<a href='detail.php?id=" . $row['idmovie'] . "'>";
                                echo "<div class='view_item'>";
                                echo "<div class='vi_left'>";
                                echo "<img class='img' src='uploads/" . $row['idmovie'] . "." . $row['extention'] . "' alt=''>";
                                echo "<div class='ribbon'>";
                                if ($row['serial'] == 0) {
                                    echo "<span class='movie'>&nbsp;&nbsp;&nbsp;&nbsp;Movie&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                                } else if ($row['serial'] == 1) {
                                    echo "<span class='serial'>&nbsp;&nbsp;&nbsp;&nbsp;Serial&nbsp;&nbsp;&nbsp;&nbsp;</span>";
                                }
                                echo "</div>";
                                echo "</div>";
                                echo "<div class='vi_right'>";
                                echo "<div class='primary'>";
                                echo "<p class='title'>" . $row['judul'] . "</p>";
                                echo "<p class='content'>" . $newdateformat . "</p>";
                                echo "<p class='star'><i class='fas fa-star'></i>  " . $row['skor'] . "</p>";
                                echo "</div>";
                                echo "<p class='synopsis'>" . $row['synopsis'] . "...</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="pagination">
                    <p>
                        <?php
                        // if (!isset($_GET['serial']) && $cari == "") {
                        //     include "helper/pagenum.php";
                        //     generate_page_number($DATA_PER_PAGE, $total_data, $halaman_ke, $serial);
                        // } else if ($cari == "") {
                        //     include "helper/pagenum2.php";
                        //     generate_page_number($DATA_PER_PAGE, $total_data, $cari, $halaman_ke);
                        // } else {

                        //     include "helper/pagenum2.php";
                        //     generate_page_number($DATA_PER_PAGE, $total_data, $cari, $halaman_ke);
                        // }

                        if (!isset($_GET['serial'])) {
                            if ($cari == "") {
                                include "helper/pagenum2.php";
                                generate_page_number($DATA_PER_PAGE, $total_data,$cari, $halaman_ke);
                            }
                            else if(isset($cari)){
                                include "helper/pagenum2.php";
                                generate_page_number($DATA_PER_PAGE, $total_data,$cari, $halaman_ke);
                            }
                        } else{
                            include "helper/pagenum.php";
                            generate_page_number($DATA_PER_PAGE, $total_data, $halaman_ke, $serial);
                        }
                            
                        ?>
                    </p>
                </div>
                <div class="footer">
                    <p class="copy"><small>&copy; Copyright 2021, Cathrine Abigael Christy</small> </p>
                    <!-- Icons made by <a href="https://www.flaticon.com/authors/mynamepong" title="mynamepong">mynamepong</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> -->
                </div>
            </div>
    </form>
</body>

</html>
<?php
//close connection
$mysqli->close();
?>