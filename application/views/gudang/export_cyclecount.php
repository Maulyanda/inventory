<!DOCTYPE html>
<html>
<head>
	<title>Export Data Ke Excel Dengan PHP - www.malasngoding.com</title>
</head>
<body>
	<style type="text/css">
	body{
		font-family: sans-serif;
	}
	table{
		margin: 20px auto;
		border-collapse: collapse;
	}
	table th,
	table td{
		border: 1px solid #3c3c3c;
		padding: 3px 8px;
	}
	a{
		background: blue;
		color: #fff;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 2px;
	}
	</style>

	<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data Pegawai.xls");
	?>

	<center>
		<h1>Export Data Ke Excel Dengan PHP <br/> www.malasngoding.com</h1>
	</center>

	<table border="1">
		<tr>
			<th>No</th>
			<th>Part Case</th>
			<th>Location</th>
			<th>QTY</th>
		</tr>
		<?php
		// koneksi database
		$koneksi = mysqli_connect("localhost","root","","inventorydb");
		// menampilkan data pegawai
		$data = mysqli_query($koneksi,"select * from tb_cyclecount");
		$no = 1;
		while($d = mysqli_fetch_array($data)){
		?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $d['part_case']; ?></td>
			<td><?php echo $d['location']; ?></td>
			<td><?php echo $d['qty']; ?></td>
		</tr>
		<?php
		}
		?>
	</table>
</body>
</html>
