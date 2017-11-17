<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Rest Api</title>

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
						<li><a href="client.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
						<li class="active"><a href="createTransaksi.php"><i class="glyphicon glyphicon-plus"></i> Tambah Transaksi</a></li>
					</ul>
					
					
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<?php
			if(!isset($_POST['insertTrans']))
		{
		?>
			<div class="panel-body">
				<h3>TAMBAH TRANSAKSI</h3>
			<div class="table-responsive">
				<form action="createTransaksi.php" method="POST" name="editmhs">
				
	<?php 
	require_once('lib/nusoap.php');
		$client = new nusoap_client('http://localhost/utsAe/server.php?wsdl','wsdl');
		$response = $client->call('SelectPelanggan'); //panggil method SelectPelanggan yang ada di server
		if ($client->fault) {
			echo "FAULT:<br/>";
			echo "Code: { $client->faultcode }<br/>";
			echo "String: { $client->faultstring }";
		} 
		else {
			if (is_array($response))
			{
				echo "
						ID Transaksi : <input type='text' name="."addid"." class='"."form-control"."'>
						
						Jumlah Item : <input type='text' name="."addjumlah"." class='"."form-control"."'>
						Total Harga <input type='text' name="."addtotal"." class='"."form-control"."'>
						Nama : <select name='"."addnama"."' class='"."form-control"."'>";
						 foreach ($response as $pelanggan) {
							echo "<option value=".$pelanggan['ktp'].">".$pelanggan['nama']."</option>";
						 }
						 
				echo "
						 
						 <input type="."submit"." name="."insertTrans"." value="."Tambah Data"." class='"."btn btn-sm btn-primary"."'>
					";
			}
			else{
				// echo var_dump($response);
				echo "No data";
			}
		}
	 ?>
	 

	 		
	 		</form>
		</div>
	</div>

	<?php 
	}
	else{
	$data = array(
		'nama'=>$_POST['addnama'],
		'jumlah'=> $_POST['addjumlah'],
		'total'=>$_POST['addtotal']
	);
	require_once('lib/nusoap.php');
	$client = new nusoap_client('http://localhost/utsAe/server.php?wsdl','wsdl');
	$response = $client->call('InsertTransaksi', array('ins_trans'=>$data));
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
		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
 		<script src="Hello World"></script>
	</body>
</html>