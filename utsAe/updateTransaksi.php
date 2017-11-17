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
						<li><a href="client.php"><i class="glyphicon glyphicon-home"></i> Home</a></li>
						<li><a href="createTransaksi.php"><i class="glyphicon glyphicon-plus"></i> Tambah Transaksi</a></li>
					</ul>
				</div><!-- /.navbar-collapse -->
			</div>
		</nav>
		<?php 

		if(!isset($_POST['update']))
		{
		?>
			<div class="panel-body">
				<h3>EDIT DATA TRANSAKSI</h3>
			<div class="table-responsive">
				<form action="updateTransaksi.php" method="POST" name="updateTrans">
				
						
			<?php 
			require_once('lib/nusoap.php');
				$client = new nusoap_client('http://localhost/utsAe/server.php?wsdl','wsdl');
				if(isset($_GET['ktp']))
				{
					$getktp = $_GET['ktp'];
					$dataktp = array('ktp' => $getktp);

					$response = $client->call('SelectKtp', $dataktp);
					if ($client->fault) {
						echo "FAULT:<br/>";
						echo "Code: { $client->faultcode }<br/>";
						echo "String: { $client->faultstring }";
					} 
					else {
						if (is_array($response))
						{
							foreach ($response as $data) {
								echo "
										ID Transaksi :  <input type='text' value='".$data['id_transaksi']."'' name="."id_transaksi"." class='"."form-control"."' readonly></td>
										KTP :  <input type='text' value='".$data['ktp']."'' name="."ktptrans"." class='"."form-control"."' readonly></td>
										Nama : <input type='text' value='".$data['nama']."'' name="."nama"." class='"."form-control"."' readonly></td>
										 
										 Jumlah Item : <input type='text' value='".$data['jumlah']."'' name="."jumlah"." class='"."form-control"."'>
										  Total harga : <input type='text' value='".$data['total']."'' name="."total"." class='"."form-control"."'>
										 <input type="."submit"." name="."update"." value="."Update"." class='"."btn btn-sm btn-primary"."'>
									";
							}
						}
						else{
							echo $_GET['ktp'];
							echo "No data";
						}
					}
				}
				else{
					header("Location:client.php");
				}
			 ?>

			 		
			 		</form>
				</div>
			</div>
		<?php 
		}
		else{
			$data = array(
				'id_transaksi'=> $_POST['id_transaksi'],
				'ktp'=> $_POST['ktptrans'],
				'jumlah'=>$_POST['jumlah'],
				'total'=> $_POST['total']
			);
			require_once('lib/nusoap.php');
			$client = new nusoap_client('http://localhost/utsAe/server.php?wsdl','wsdl');
			$response = $client->call('UpdateTransaksi', array('data_trans'=>$data));
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