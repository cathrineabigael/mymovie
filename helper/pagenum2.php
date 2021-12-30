<?php
function generate_page_number($data_per_page, $total_data, $cari = "", $halaman_ke = 1)
{
	//asumsi tampilan halaman per halaman ada 3
	$jum_hal = 3;
	$max = ceil($total_data / $data_per_page);
	echo "<ul>";
	if ($halaman_ke > 1) {
		echo "<li><a href='?page=" . ($halaman_ke - 1) . "&txtcari=$cari'>Previous</a>&nbsp;</li>";
	}
	if ($jum_hal >= $max) {
		for ($hal = 1; $hal <= $max; $hal++) {
			echo "<li>";
			if ($halaman_ke == $hal) {

				echo "<span>$hal<span>";
			} else {
				echo "<a href='?page=$hal&txtcari=$cari'>$hal</a>";
			}
			echo " &nbsp;</li>";
		}
	} else {
		$cekMulai = $halaman_ke - 1;
		$indexmulai = 0;

		if ($cekMulai > 0) {
			$indexmulai = $cekMulai;
		} else {
			$indexmulai = 1;
		}

		$indexAkhir = 0;
		$cekAkhir = $halaman_ke + 1;
		if ($cekAkhir > $max) {
			$indexAkhir = $max;
		} else {
			$indexAkhir = $cekAkhir;
		}

		$arr_halaman = [];
		for ($i = $indexmulai; $i < $indexAkhir + 1; $i++) {
			array_push($arr_halaman, $i);
		}

		$kekurangan = 0;
		$kekurangan = $jum_hal - count($arr_halaman);
		if ($kekurangan > 0 && $indexAkhir < $max) {
			for ($i = 1; $i < $kekurangan + 1; $i++) {
				array_push($arr_halaman, ($indexAkhir + $i));
			}
		}

		$kekurangan = 0;
		if (count($arr_halaman) < $jum_hal) {
			$kekurangan = $jum_hal - count($arr_halaman);
		}

		$ambilhalTerakhir = $arr_halaman[count($arr_halaman) - 1];
		if ($ambilhalTerakhir == $max && $kekurangan > 0) {
			$new = $max - $jum_hal + 1;
			array_push($arr_halaman, $new);
		}

		sort($arr_halaman);
		foreach ($arr_halaman as $value) {
			echo "<li>";
			if ($halaman_ke == $value) {
				echo $value;
			} else {
				echo "<a href='?page=$value&txtcari=$cari'>$value</a>";
			}
			echo " &nbsp;</li>";
		}
	}
	if ($halaman_ke < $max) {
		$halaman_selanjutnya = $halaman_ke + 1;
		echo "<li><a href='?page=" . $halaman_selanjutnya . "&txtcari=$cari'>Next</a>&nbsp;</li>";
	}
	echo "</ul>";
}
