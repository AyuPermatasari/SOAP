<?php 
	require_once('lib/nusoap.php');
	$server = new soap_server();

	$ns = "http://localhost/utsAe/server.php";
	$server->configureWSDL('transaksi', $ns);
	$server->wsdl->schemaTargetNamespace = $ns;

	$server->register('SelectTransaksi', array(), array('return'=>'xsd:Array'), $ns, "urn:".$ns."/SelectTransaksi", "rpc", "encoded", "Ambil data transaksi");

	function SelectTransaksi() {

			if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				$result = $conn->query("SELECT t.id_transaksi, p.ktp, p.nama, t.jumlah_item, t.total_harga FROM transaksi as t, pelanggan as p WHERE t.ktp = p.ktp ");

				while ($row = mysqli_fetch_array($result)) { 
			    	$data[] = array('ktp'=>$row['ktp'],
			    					'id_transaksi' =>$row['id_transaksi'],
			    					'nama'=>$row['nama'],
			    					'jumlah'=>$row['jumlah_item'],
			    					'total'=>$row['total_harga']);
			    } 

			    return $data;

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	function SelectKtp($ktp){
		if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				$result = $conn->query("SELECT t.ktp, p.nama, t.jumlah_item, t.total_harga, t.id_transaksi FROM transaksi as t, pelanggan as p WHERE t.ktp = p.ktp and t.id_transaksi='".$ktp."' ");

				while ($row = mysqli_fetch_array($result)) { 
			    	$data_trx[] = array('ktp'=>$row['ktp'],
			    					'id_transaksi'=>$row['id_transaksi'],
			    					'nama'=>$row['nama'],
			    					'jumlah'=>$row['jumlah_item'],
			    					'total'=>$row['total_harga']);
			    } 

			    return $data_trx;

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	function UpdateTransaksi($data_trans){
		if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				if($result = $conn->query("UPDATE transaksi SET jumlah_item='".$data_trans['jumlah']."', total_harga='".$data_trans['total']."' WHERE id_transaksi='".$data_trans['id_transaksi']."'"))
				{
					return "Update Data Transaksi Berhasil";
				}
				else{
					return "Update Data Transaksi Gagal";
				}

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	function SelectPelanggan(){
		if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				$result = $conn->query("SELECT * FROM pelanggan");

				while ($row = mysqli_fetch_array($result)) { 
			    	$data_pelanggan[] = array('ktp'=>$row['ktp'],
			    					'nama'=>$row['nama']);
			    } 

			    return $data_pelanggan;

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	function InsertTransaksi($ins_trans){
		if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				if($result = $conn->query("INSERT INTO transaksi (ktp,jumlah_item,total_harga) VALUES('".$ins_trans['nama']."', '".$ins_trans['jumlah']."', '".$ins_trans['total']."')"))
				{
					return "Insert Data Transaksi Berhasil";
				}
				else{
					return "Insert Data Transaksi Gagal";
				}

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	function DeleteTransaksi($del_ktp){
		if ($conn = mysqli_connect("localhost", "root", "", "uts")) {
				if($result = $conn->query("DELETE FROM transaksi WHERE id_transaksi='".$del_ktp."'"))
				{
					return "Delete Data Transaksi Berhasil";
				}
				else{
					return "Delete Data Transaksi Gagal";
				}

			} 
			else {
				return new soap_fault('Database Server', '', 'Koneksi ke database gagal!', '');
			}
	}

	$server->register('SelectKtp', array('ktp'=>'xsd:string'), array('return'=>'xsd:Array'), $ns, "urn:".$ns."/SelectKtp", "rpc", "encoded", "Ambil data trans by ktp");

	$server->register('UpdateTransaksi', array('data_trans'=>'xsd:Array'), array('return'=>'xsd:string'), $ns, "urn:".$ns."/UpdateTransaksi", "rpc", "encoded", "Update data trans by ktp");

	$server->register('SelectPelanggan', array(), array('return'=>'xsd:Array'), $ns, "urn:".$ns."/SelectPelanggan", "rpc", "encoded", "Ambil data pelanggan");

	$server->register('InsertTransaksi', array('ins_trans'=>'xsd:Array'),  	array('return'=>'xsd:string'), $ns, "urn:".$ns."/InsertTransaksi", "rpc", "encoded", "Insert data trans");

	$server->register('DeleteTransaksi', array('del_ktp'=>'xsd:string'), array('return'=>'xsd:string'), $ns, "urn:".$ns."/DeleteTransaksi", "rpc", "encoded", "Delete data trans");
    


	if (!isset($HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents("php://input");
	$server->service($HTTP_RAW_POST_DATA);
	exit();
 ?>