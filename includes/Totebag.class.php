<?php

/******************************************
TP4 DPBO
 ******************************************/

class Totebag extends DB
{

	// }
	function add($data)
	{
		$name = $data['name'];
		$telp = $data['telp'];
		$type = $data['tipe'];
		$color = $data['color'];
		$size = $data['size'];
		$tali = $data['tali'];

		$tambah = 0;
		if ($tali == "Yes") {
			$tambah = 10000;
		}

		if ($size == 'S') {
			$harga = 100000 + $tambah;
		} else if ($size == 'M') {
			$harga = 130000 + $tambah;
		} else if ($size == 'L') {
			$harga = 155000 + $tambah;
		} else {
			$harga = 175000 + $tambah;
		}
		$status = "Belum";

		$query = "insert into custom values ('', '$name', '$telp', '$type', '$color', '$size', '$tali', '$harga', '$status')";

		echo $query;
		// Mengeksekusi query
		return $this->execute($query);
	}

	function delete($id)
	{

		$query = "delete FROM custom WHERE id = '$id'";
		// Mengeksekusi query
		return $this->execute($query);
	}

	function statusTotebag($id)
	{

		$status = "Sudah";
		$query = "update custom set status = '$status' where id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengambil data
	function getTotebag()
	{
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM custom";


		// Mengeksekusi query
		return $this->execute($query);
	}
}
