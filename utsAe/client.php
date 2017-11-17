<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation">
			<div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Title</a>
				</div>
		
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="client.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
						<li><a href="createTransaksi.php"><i class="glyphicon glyphicon-plus"></i> Tambah Transaksi</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<div class="panel-body">
	<div class="table-responsive">
		<table class="table table-hover">
			<tr>
				<th>KTP</th>
				<th>NAMA</th>
				<th>Jumlah Item</th>
				<th>Total harga</th>
				<th></th>
			</tr>

<?php 
require_once('lib/nusoap.php');
	$client = new nusoap_client('http://localhost/utsAe/server.php?wsdl','wsdl');
	//$param="";
	$response = $client->call('SelectTransaksi');
	if ($client->fault) {
		echo "FAULT:<br/>";
		echo "Code: { $client->faultcode }<br/>";
		echo "String: { $client->faultstring }";
	} 
	else {
		if (is_array($response))
		{
			foreach ($response as $data) {
				echo "<tr>
						 <td>".$data['ktp']."</td>
						 <td>".$data['nama']."</td>
						 <td>".$data['jumlah']."</td>
						 <td>".$data['total']."</td>
						 <td><a class='"."btn btn-sm btn-danger"."' href='updateTransaksi.php?ktp=".$data['id_transaksi']."'>EDIT</a> <a class='"."btn btn-sm btn-default"."' href='deleteTransaksi.php?ktp=".$data['id_transaksi']."'>DELETE</a></td>
					</tr>";
			}
		}
		else{
			echo "No data";
			echo print_r($response, true);
		}
	}

 ?>
 </table>
	</div>
</div>
		 	

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>