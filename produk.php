<?php 
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bukawarung</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Inter', sans-serif;
		}
		body {
			background: linear-gradient(135deg, #0f0f0f, #1e1e1e);
			color: #fff;
			line-height: 1.6;
		}
		a {
			text-decoration: none;
			color: inherit;
		}
		.container {
			width: 90%;
			max-width: 1200px;
			margin: auto;
			padding: 20px 0;
		}
		header {
			background: url('img/header-bg.jpg') center/cover no-repeat;
			position: relative;
			padding: 60px 0;
			box-shadow: 0 8px 24px rgba(0,0,0,0.4);
			border-radius: 0 0 24px 24px;
		}
		header::before {
			content: "";
			position: absolute;
			inset: 0;
			background: rgba(0,0,0,0.5);
			z-index: 1;
		}
		header .container {
			position: relative;
			z-index: 2;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}
		header h1 a {
			color: #fff;
			font-size: 2rem;
			font-weight: 700;
			transition: 0.3s ease;
		}
		header h1 a:hover {
			color: #00c6ff;
		}
		header ul {
			list-style: none;
			display: flex;
			gap: 20px;
		}
		header ul li a {
			color: #fff;
			font-weight: 500;
			transition: 0.3s;
		}
		header ul li a:hover {
			color: #fffb95;
		}
		.search {
			margin-top: 30px;
			text-align: center;
			background: rgba(255,255,255,0.05);
			backdrop-filter: blur(10px);
			border-radius: 16px;
			padding: 30px;
		}
		.search input[type="text"] {
			padding: 14px;
			width: 60%;
			border: none;
			border-radius: 10px;
			background: #2c2c2c;
			color: #fff;
			margin-right: 10px;
		}
		.search input[type="submit"] {
			padding: 14px 22px;
			background: linear-gradient(135deg, #00ffcc, #00c6ff);
			border: none;
			border-radius: 10px;
			color: #000;
			font-weight: 600;
			cursor: pointer;
			box-shadow: 0 4px 20px rgba(0,255,204,0.3);
			transition: all 0.3s;
		}
		.search input[type="submit"]:hover {
			transform: scale(1.05);
		}
		.section h3 {
			font-size: 1.6rem;
			color: #00c6ff;
			margin-bottom: 20px;
		}
		.box {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
		}
		.col-4 {
			background: rgba(255,255,255,0.05);
			backdrop-filter: blur(12px);
			border-radius: 16px;
			padding: 20px;
			text-align: center;
			flex: 1 1 22%;
			min-width: 200px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.4);
			transition: 0.4s ease;
		}
		.col-4:hover {
			transform: scale(1.05);
			box-shadow: 0 12px 30px rgba(0,255,204,0.4);
		}
		.col-4 img {
			width: 100%;
			height: 150px;
			object-fit: cover;
			border-radius: 10px;
			margin-bottom: 10px;
		}
		.nama {
			font-weight: 600;
			font-size: 1rem;
		}
		.harga {
			color: #00ffcc;
		}
		.footer {
			background: rgba(255,255,255,0.05);
			text-align: center;
			padding: 40px 0;
			margin-top: 60px;
			border-top: 1px solid rgba(255,255,255,0.1);
		}
		.footer h4 {
			color: #00c6ff;
			margin-bottom: 8px;
		}
		.footer p {
			color: #ccc;
		}
		.footer small {
			margin-top: 20px;
			display: block;
			color: #888;
		}
		@media(max-width:768px){
			.col-4 {
				flex: 1 1 45%;
			}
			.search input[type="text"] {
				width: 90%;
				margin-bottom: 10px;
			}
		}
	</style>
</head>
<body>
	<header>
		<div class="container">
			<h1><a href="index.php">Bukawarung</a></h1>
			<ul>
				<li><a href="produk.php">Produk</a></li>
			</ul>
		</div>
	</header>

	<div class="search container" data-aos="zoom-in">
		<form action="produk.php">
			<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
			<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
			<input type="submit" name="cari" value="Cari Produk">
		</form>
	</div>

	<!-- Produk -->
	<div class="section container">
		<h3 data-aos="fade-right">Produk</h3>
		<div class="box">
			<?php 
				if($_GET['search'] != '' || $_GET['kat'] != '') {
					$where = "AND product_name LIKE '%".$_GET['search']."%' AND category_id LIKE '%".$_GET['kat']."%' ";
				}

				$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where ORDER BY product_id DESC");
				if(mysqli_num_rows($produk) > 0) {
					while($p = mysqli_fetch_array($produk)) {
			?>	
				<a href="detail-produk.php?id=<?php echo $p['product_id'] ?>" class="col-4" data-aos="fade-up">
					<img src="produk/<?php echo $p['product_image'] ?>">
					<p class="nama"><?php echo substr($p['product_name'], 0, 30) ?></p>
					<p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
				</a>
			<?php }} else { ?>
				<p>Produk tidak ada</p>
			<?php } ?>
		</div>
	</div>

	<!-- Footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>

			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>

			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2025 - Bukawarung.</small>
		</div>
	</div>

	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>AOS.init({ duration: 1000, once: true });</script>
</body>
</html>
