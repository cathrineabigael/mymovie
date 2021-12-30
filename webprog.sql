-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Inang: 127.0.0.1
-- Waktu pembuatan: 26 Mar 2021 pada 16.47
-- Versi Server: 5.5.32
-- Versi PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Basis data: `webprogproject`
--
CREATE DATABASE IF NOT EXISTS `webprogproject`DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `webprogproject`

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pemain`
--

CREATE TABLE IF NOT EXISTS `detail_pemain` (
  `idpemain` int(11) NOT NULL,
  `idmovie` int(11) NOT NULL,
  `peran` enum('utama','pembantu','cameo') DEFAULT NULL,
  PRIMARY KEY (`idpemain`,`idmovie`),
  KEY `fk_pemain_has_movie_movie1_idx` (`idmovie`),
  KEY `fk_pemain_has_movie_pemain1_idx` (`idpemain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `detail_pemain`
--

INSERT INTO `detail_pemain` (`idpemain`, `idmovie`, `peran`) VALUES
(1, 4, 'utama'),
(1, 13, 'utama'),
(2, 9, 'utama'),
(2, 14, 'utama'),
(2, 16, 'utama'),
(3, 1, 'utama'),
(3, 8, 'utama'),
(3, 9, 'pembantu'),
(3, 12, 'pembantu'),
(3, 13, 'utama'),
(3, 16, 'utama'),
(4, 1, 'utama'),
(4, 4, 'utama'),
(4, 14, 'utama'),
(4, 18, 'cameo'),
(4, 20, 'cameo'),
(5, 1, 'pembantu'),
(5, 6, 'utama'),
(5, 8, 'pembantu'),
(5, 10, 'utama'),
(5, 11, 'pembantu'),
(5, 13, 'pembantu'),
(5, 16, 'pembantu'),
(6, 1, 'cameo'),
(6, 11, 'utama'),
(6, 14, 'pembantu'),
(6, 18, 'pembantu'),
(6, 20, 'cameo'),
(7, 2, 'utama'),
(7, 5, 'utama'),
(7, 7, 'utama'),
(7, 8, 'utama'),
(7, 9, 'cameo'),
(7, 13, 'cameo'),
(8, 2, 'utama'),
(8, 5, 'pembantu'),
(8, 6, 'utama'),
(8, 14, 'cameo'),
(8, 16, 'utama'),
(8, 18, 'utama'),
(8, 20, 'pembantu'),
(9, 2, 'utama'),
(9, 9, 'utama'),
(9, 10, 'pembantu'),
(9, 12, 'utama'),
(10, 2, 'pembantu'),
(10, 8, 'cameo'),
(10, 12, 'cameo'),
(10, 18, 'utama'),
(11, 2, 'cameo'),
(11, 5, 'utama'),
(11, 15, 'cameo'),
(11, 17, 'cameo'),
(12, 7, 'utama'),
(12, 10, 'pembantu'),
(12, 19, 'utama'),
(13, 4, 'pembantu'),
(13, 8, 'utama'),
(13, 19, 'utama'),
(14, 7, 'pembantu'),
(14, 15, 'utama'),
(14, 19, 'utama'),
(15, 6, 'pembantu'),
(15, 11, 'utama'),
(15, 17, 'cameo'),
(15, 19, 'pembantu'),
(16, 4, 'pembantu'),
(16, 6, 'utama'),
(16, 9, 'cameo'),
(16, 10, 'cameo'),
(16, 13, 'utama'),
(16, 15, 'cameo'),
(16, 19, 'cameo'),
(16, 20, 'utama'),
(17, 3, 'utama'),
(17, 12, 'utama'),
(17, 15, 'utama'),
(18, 3, 'utama'),
(18, 4, 'cameo'),
(18, 5, 'pembantu'),
(19, 3, 'pembantu'),
(19, 5, 'utama'),
(20, 3, 'cameo'),
(20, 11, 'cameo'),
(20, 17, 'utama'),
(21, 14, 'utama'),
(22, 14, 'utama'),
(22, 17, 'pembantu'),
(23, 14, 'cameo'),
(23, 17, 'utama'),
(24, 14, 'pembantu'),
(24, 16, 'pembantu'),
(24, 17, 'pembantu'),
(24, 20, 'utama');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar`
--

CREATE TABLE IF NOT EXISTS `gambar` (
  `idgambar` int(11) NOT NULL AUTO_INCREMENT,
  `extention` varchar(4) NOT NULL,
  `idmovie` int(11) NOT NULL,
  PRIMARY KEY (`idgambar`),
  KEY `fk_gambar_movie1_idx` (`idmovie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `idgenre` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idgenre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data untuk tabel `genre`
--

INSERT INTO `genre` (`idgenre`, `nama`) VALUES
(1, 'Action'),
(2, 'Comedy'),
(3, 'Drama'),
(4, 'Thriller'),
(5, 'Family'),
(6, 'Romance'),
(7, 'Music'),
(8, 'Animation'),
(9, 'Adventure'),
(10, 'Crime'),
(11, 'Fantasy'),
(12, 'Biography');

-- --------------------------------------------------------

--
-- Struktur dari tabel `genre_movie`
--

CREATE TABLE IF NOT EXISTS `genre_movie` (
  `idmovie` int(11) NOT NULL,
  `idgenre` int(11) NOT NULL,
  PRIMARY KEY (`idmovie`,`idgenre`),
  KEY `fk_movie_has_genre_genre1_idx` (`idgenre`),
  KEY `fk_movie_has_genre_movie_idx` (`idmovie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `genre_movie`
--

INSERT INTO `genre_movie` (`idmovie`, `idgenre`) VALUES
(8, 1),
(9, 1),
(12, 1),
(19, 1),
(20, 1),
(1, 2),
(2, 2),
(4, 2),
(5, 2),
(6, 2),
(14, 2),
(19, 2),
(20, 2),
(1, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(9, 3),
(10, 3),
(11, 3),
(13, 3),
(14, 3),
(15, 3),
(19, 3),
(20, 3),
(7, 4),
(3, 5),
(6, 5),
(11, 5),
(13, 5),
(14, 5),
(15, 5),
(16, 5),
(18, 5),
(1, 6),
(2, 6),
(4, 6),
(5, 6),
(2, 7),
(3, 8),
(8, 8),
(12, 8),
(16, 8),
(18, 8),
(3, 9),
(8, 9),
(9, 9),
(12, 9),
(16, 9),
(19, 9),
(7, 10),
(15, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idmenu` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`idmenu`, `nama`, `link`) VALUES
(1, 'Tambah Movie', 'insertmovie.php'),
(2, 'Tambah Pemain', 'insertpemain.php'),
(3, 'Galeri', 'galeri.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_profil`
--

CREATE TABLE IF NOT EXISTS `menu_profil` (
  `idmenu` int(11) NOT NULL,
  `idprofil` int(11) NOT NULL,
  PRIMARY KEY (`idmenu`,`idprofil`),
  KEY `fk_menu_has_profil_profil1_idx` (`idprofil`),
  KEY `fk_menu_has_profil_menu1_idx` (`idmenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
  `idmovie` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(75) DEFAULT NULL,
  `rilis` date DEFAULT NULL,
  `skor` double DEFAULT NULL,
  `sinopsis` varchar(1000) DEFAULT NULL,
  `serial` tinyint(1) DEFAULT '0',
  `extention` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`idmovie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data untuk tabel `movie`
--

INSERT INTO `movie` (`idmovie`, `judul`, `rilis`, `skor`, `sinopsis`, `serial`, `extention`) VALUES
(1, 'Imperfect', '2019-12-19', 7.8, 'Being born fat and has dark skins, it feels like a curse for Rara, especially when she worked at the office that has surrounded by pretty girls. Her boss wants her to lose her weight, but there is a man who loves the way she were.', 0, 'jpeg'),
(2, 'Suckseed', '2011-04-20', 7.5, 'Ped (Jirayu La-ongmanee) was a shy boy who had never listened to music until introduced to the world of Pop and Rock by would-be childhood crush Ern (Nattasha Nualjam). Ern soon left for Bangkok, however, and it is six years later in their final school year when she is re-introduced to Ped and his brash best friend Koong (Pachara Chirathivat). Koong convinces Ped, along with schoolmate Ex (Thawat Pornrattanaprasert), to form a band, partly to be cool and attract girls, partly as an attempt by Koong to try and one-up his popular twin brother Kay. Their musical talents aren''t great, but that doesn''t stop them from trying. However, when Ern decides to lend them her outstanding guitar skills, Ped and Koong''s shared attraction to her puts a strain on the band''s survival, as well as their friendship.', 0, 'jpg'),
(3, 'Spirited Away', '2001-07-20', 8.6, 'During her family''s move to the suburbs, a sullen 10-year-old girl wanders into a world ruled by gods, witches, and spirits, and where humans are changed into beasts.', 0, 'jpg'),
(4, 'Flipped', '2010-09-10', 7.7, 'Two eighth-graders start to have feelings for each other despite being total opposites.', 0, 'jpg'),
(5, 'Mariposa', '2020-03-12', 6.7, 'Iqbal (Angga Yunanda) is like a Mariposa butterfly to Acha (Adhisty Zara). Each time someone approach, he always runs away. Acha is determined to win Iqbal, a man known to be handsome, smart, yet cold.', 0, 'jpg'),
(6, 'Cek Toko Sebelah', '2016-12-28', 7.9, 'Right when everything is going well for Erwin, his father falls sick and asks him to drop everything and help out at the family store disappointing Yohan, his irresponsible older brother.', 0, 'jpg'),
(7, 'Breaking Bad', '2008-01-01', 9.5, 'A high school chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine in order to secure his family''s future.', 1, 'jpg'),
(8, 'Avatar: The Last Airbender', '2005-01-01', 9.2, 'In a war-torn world of elemental magic, a young boy reawakens to undertake a dangerous mystic quest to fulfill his destiny as the Avatar, and bring peace to the world.', 1, 'jpg'),
(9, 'Game of Thrones', '2011-01-01', 9.3, 'Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.', 1, 'jpg'),
(10, 'The Shawnshank Redemption', '1994-10-14', 9.3, 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.', 0, 'jpg'),
(11, 'Keluarga Cemara', '2019-01-03', 7.8, 'After the bankruptcy, Abah loses his house and all of his treasures. He also loses his case in the court, hence his family is threatened to live in poverty forever. Abah then had to get used to his new life along with his little family.', 0, 'jpg'),
(12, 'Attack on Titan', '2013-01-01', 8.9, 'After his hometown is destroyed and his mother is killed, young Eren Jaeger vows to cleanse the earth of the giant humanoid Titans that have brought humanity to the brink of extinction.', 1, 'jpg'),
(13, 'Dua Garis Biru', '2019-07-11', 8, 'A young couple violated the boundary without knowing the consequences. They try to take responsibility for their choices and their innocence was tested when families who really loved them knew, then forced into their chosen journey.', 0, 'jpg'),
(14, 'Susah Sinyal', '2017-12-21', 7.1, 'Ellen does not keep her promise to watch Kiara''s performance at the talent show competition between high schools. Kiara is angry and goes to Sumba alone, where she could feel a glimmer of happiness.', 0, 'jpg'),
(15, 'Kartini', '2017-04-19', 7.7, 'This movie follows the story of the Indonesian heroine named Kartini. In the early 1900s, when Indonesia was still a colony of the Netherlands, women weren''t allowed to get higher education. Kartini grew up to fight for equality for women.', 0, 'jpg'),
(16, 'Howl''s Moving Castle', '2004-11-20', 8.2, 'When an unconfident young woman is cursed with an old body by a spiteful witch, her only chance of breaking the spell lies with a self-indulgent yet insecure young wizard and his companions in his legged, walking castle.', 0, 'jpg'),
(17, 'My Neighbor Totoro', '1988-04-16', 8.2, 'When two girls move to the country to be near their ailing mother, they have adventures with the wondrous forest spirits who live nearby.', 0, 'jpg'),
(18, 'Tom and Jerry', '2021-03-10', 5.2, 'A chaotic battle ensues between Jerry Mouse, who has taken refuge in the Royal Gate Hotel, and Tom Cat, who is hired to drive him away before the day of a big wedding arrives.', 0, 'jpg'),
(19, 'Avengers: Endgame', '2019-04-24', 8.4, 'After the devastating events of Avengers: Infinity War (2018), the universe is in ruins. With the help of remaining allies, the Avengers assemble once more in order to reverse Thanos'' actions and restore balance to the universe.', 0, 'jpg'),
(20, 'WandaVision', '2021-03-19', 8.1, 'Blends the style of classic sitcoms with the MCU, in which Wanda Maximoff and Vision - two super-powered beings living their ideal suburban lives - begin to suspect that everything is not as it seems.', 1, 'jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemain`
--

CREATE TABLE IF NOT EXISTS `pemain` (
  `idpemain` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) NOT NULL,
  `gender` enum('pria','wanita') NOT NULL,
  PRIMARY KEY (`idpemain`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data untuk tabel `pemain`
--

INSERT INTO `pemain` (`idpemain`, `nama`, `gender`) VALUES
(1, 'Wynona Rider', 'wanita'),
(2, 'Millie Bobby Brown', 'wanita'),
(3, 'Jessica Mila', 'wanita'),
(4, 'Reza Rahadian', 'pria'),
(5, 'Naqueenza Vevila Arissa', 'wanita'),
(6, 'Muhadkly Acho', 'pria'),
(7, 'Jirayu La-ongmanee', 'pria'),
(8, 'Pachara Chirathivat', 'pria'),
(9, 'Nattasha Nauljam', 'wanita'),
(10, 'Tonhon Tantiwetchakun', 'pria'),
(11, 'Adisorn Tresirikasem', 'pria'),
(12, 'Robert Downey Jr.', 'pria'),
(13, 'Chris Hemsworth', 'pria'),
(14, 'Mark Ruffalo', 'pria'),
(15, 'Maria Hill', 'wanita'),
(16, 'Wong', 'pria'),
(17, 'Rumi Hiiragi', 'wanita'),
(18, 'Miyu Irino', 'pria'),
(19, 'Takashi Naito', 'pria'),
(20, 'Ken Yasuda', 'pria'),
(21, 'Adinia Wirasti', 'wanita'),
(22, 'Aurora Ribero ', 'wanita'),
(23, 'Aci Resti', 'wanita'),
(24, 'Ernest Prakasa', 'pria');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil`
--

CREATE TABLE IF NOT EXISTS `profil` (
  `idprofil` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idprofil`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data untuk tabel `profil`
--

INSERT INTO `profil` (`idprofil`, `nama`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Visitor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) NOT NULL,
  `name` varchar(45) NOT NULL,
  `pwd` varchar(45) NOT NULL,
  `salt` varchar(5) NOT NULL,
  `error` int(11) NOT NULL DEFAULT '0',
  `next_login` datetime DEFAULT NULL,
  `idprofil` int(11) NOT NULL,
  PRIMARY KEY (`username`),
  KEY `fk_users_profil2_idx` (`idprofil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`username`, `name`, `pwd`, `salt`, `error`, `next_login`, `idprofil`) VALUES
('maria', 'Maria', '446d6d45dc8e59b9d63b9b6b781f8cf31868d41a', '5g4bc', 0, NULL, 0);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pemain`
--
ALTER TABLE `detail_pemain`
  ADD CONSTRAINT `fk_pemain_has_movie_movie1` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pemain_has_movie_pemain1` FOREIGN KEY (`idpemain`) REFERENCES `pemain` (`idpemain`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `gambar`
--
ALTER TABLE `gambar`
  ADD CONSTRAINT `fk_gambar_movie1` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `genre_movie`
--
ALTER TABLE `genre_movie`
  ADD CONSTRAINT `fk_movie_has_genre_genre1` FOREIGN KEY (`idgenre`) REFERENCES `genre` (`idgenre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_movie_has_genre_movie` FOREIGN KEY (`idmovie`) REFERENCES `movie` (`idmovie`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `menu_profil`
--
ALTER TABLE `menu_profil`
  ADD CONSTRAINT `fk_menu_has_profil_menu1` FOREIGN KEY (`idmenu`) REFERENCES `menu` (`idmenu`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_menu_has_profil_profil1` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`idprofil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profil2` FOREIGN KEY (`idprofil`) REFERENCES `profil` (`idprofil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
