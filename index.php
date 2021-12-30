<?php
require_once("class/movie.php");
include("/db.php");

$mysqli = new mysqli("localhost", "root", "", "webprog");



if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

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
                        <li><a href="index.php" id='activenav'>Home</a></li>
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
                <!-- <div class="carousel">
                </div> -->
                <?php
                if ($halaman_ke == 1) {
                    echo "<div class='slider-frame'>
                    <figure>
                        <img src='img/1.jpg' alt=''>
                        <img src='img/2.jpg' alt=''>
                        <img src='img/1.jpg' alt=''>
                        <img src='img/3.jpg' alt=''>
                        <img src='img/1.jpg' alt=''>
                 
                    </figure>
                </div>";
                }
                ?>

                <div class="content">

                    <div class="view-as" id="idx">
                        <a href="grid.php" id="active" class="btngrid"><i class="fas fa-th fa-lg"></i></a>
                        <a href="list.php" class="btnlist"><i class="fas fa-list fa-lg"></i></a>
                    </div>
                    <div class="grid-content">

                        <h1>Checkout your collections!</h1>
                        <div class="grid-view">
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


                            $o = 0;
                            $sql = "SELECT * FROM movie where judul LIKE ? ORDER BY serial LIMIT ?, ?";
                            $stmt = $mysqli->prepare($sql);
                            $stmt->bind_param("sii", $keyword, $offset, $DATA_PER_PAGE);
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
                                echo "<p class='title'>" . $row['judul'] . "</p>";
                                echo "<p class='content'>" . $newdateformat . "</p>";
                                echo "<p class='star'><i class='fas fa-star'></i>  " . $row['skor'] . "</p>";
                                echo "</div>";
                                echo "</div>";
                                echo "</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class=" pagination">
                    <p>
                        <?php

                        include "helper/pagenum2.php";
                        generate_page_number($DATA_PER_PAGE, $total_data, $cari, $halaman_ke);

                        ?>
                    </p>
                </div>
                <div class="footer">
                    <p class="copy"><small>&copy; Copyright 2021, Cathrine Abigael Christy</small> </p>
                    <!-- Icons made by <a href="https://www.flaticon.com/authors/mynamepong" title="mynamepong">mynamepong</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> -->
                </div>
            </div>
        </div>

    </form>
    <!-- tidak diperlukan karena grid dan list ada di halaman yang berbeda
    <script type="text/javascript">
        // INI TIDAK BISA 
        // $('.btnhapus').click(function(){
        //     $(this).remove();
        // })

        //ini cara mengetik jquery yg lebih aman
        //kalau gini kan maunya ada objek baru di dlm dom yg tdk bisa dikenali apabila pakai header function yg sederhana
        $('body').on('click', '.btngrid', function() {
            $('.btnlist').removeClass("active");

            $(this).addClass("active");
        });

        $('body').on('click', '.btnlist', function() {
            $('.btngrid').removeClass("active");

            $(this).addClass("active");
        });
    </script> -->
</body>

</html>
<?php
//close connection
$mysqli->close();
?>