<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="YesayaGalatia">
	<title>BUKU - REST API CLIENT</title>
	<link rel="stylesheet" href="Assets/css/bootstrap.css">
	<link rel="stylesheet" href="Assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Mahasiswa SOAP Client</a>
			</div>
			
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="client.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
					<li><a href="tambahmhs.php"><i class="glyphicon glyphicon-plus"></i> Tambah Data</a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div>
	</nav> 
<?php
if(!isset($_POST['insertMHS']))
{
?>
	<div class="panel-body">
		<h3>TAMBAH DATA MAHASISWA</h3>
	<div class="table-responsive">
		<form action="tambahmhs.php" method="POST" name="editmhs">
		<table class="table table-hover">
			<tr>
				<th>NIM</th>
				<th>NAMA MAHASISWA</th>
				<th>ALAMAT</th>
				<th>JURUSAN</th>
				<th></th>
			</tr>
	<?php 
	require_once('lib/nusoap.php');
		$client = new nusoap_client('http://localhost/soapServer/server.php?wsdl','wsdl');
		$response = $client->call('SelectJurusan');
		if ($client->fault) {
			echo "FAULT:<br/>";
			echo "Code: { $client->faultcode }<br/>";
			echo "String: { $client->faultstring }";
		} 
		else {
			if (is_array($response))
			{
				echo "<tr>
						 <td> <input type='text' name="."addnim"." class='"."form-control"."'></td>
						 <td><input type='text' name="."addnama"." class='"."form-control"."'></td>
						 <td><textarea name="."addalamat"." rows=3 class='"."form-control"."''></textarea></td>
						 <td><select name='"."addJurusan"."' class='"."form-control"."'>";
						 foreach ($response as $jurusan) {
							echo "<option value=".$jurusan['id_jurusan'].">".$jurusan['nama_jurusan']."</option>";
						 }
				echo "
						 </td>
						 <td><input type="."submit"." name="."insertMHS"." value="."Tambah Data"." class='"."btn btn-sm btn-primary"."'></td>
					</tr>";
			}
			else{
				echo "No data";
			}
		}
	 ?>

	 		</table>
	 		</form>
		</div>
	</div>
<?php 
}
else{
	$data = array(
		'nim'=> $_POST['addnim'],
		'nama'=>$_POST['addnama'],
		'alamat'=> nl2br($_POST['addalamat']),
		'jurusan'=>$_POST['addJurusan']
	);
	require_once('lib/nusoap.php');
	$client = new nusoap_client('http://localhost/soapServer/server.php?wsdl','wsdl');
	$response = $client->call('InsertMahasiswa', array('ins_mhs'=>$data));
			if ($client->fault) {
				echo "FAULT:<br/>";
				echo "Code: { $client->faultcode }<br/>";
				echo "String: { $client->faultstring }";
			} 
			else {
				echo "<div class='"."alert alert-success"."'>
						 <strong>Success!</strong> $response &nbsp&nbsp&nbsp<a href='client.php' class='"."btn btn-sm btn-warning"."'>Home</a>
					</div>"	;
			}

} 
 ?>