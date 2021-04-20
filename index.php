<?php

/******************************************
PRAKTIKUM RPL
 ******************************************/

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Totebag.class.php");

// Membuat objek dari kelas task
$otask = new Totebag($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTotebag();

if (isset($_POST['add'])) {
	//memanggil add
	$otask->add($_POST);
	header("location:index.php");
}

if (!empty($_GET['id_hapus'])) {
	//memanggil add
	$id = $_GET['id_hapus'];

	$otask->delete($id);
	header("location:index.php");
}

if (!empty($_GET['id_status'])) {
	//memanggil add
	$id = $_GET['id_status'];

	$otask->statusTotebag($id);
	header("location:index.php");
}

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $name, $telp, $type, $color, $size, $tali, $harga, $status) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if ($status == "Sudah") {
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $name . "</td>
		<td>" . $telp . "</td>
		<td>" . $type . "</td>
		<td>" . $color . "</td>
		<td>" . $size . "</td>
		<td>" . $tali . "</td>
		<td>" . $harga . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else {
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $name . "</td>
		<td>" . $telp . "</td>
		<td>" . $type . "</td>
		<td>" . $color . "</td>
		<td>" . $size . "</td>
		<td>" . $tali . "</td>
		<td>" . $harga . "</td>
		<td>" . $status . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
