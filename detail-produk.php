<?php 
	error_reporting(0);
	include 'db.php';
	$kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 2");
	$a = mysqli_fetch_object($kontak);

	$produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
	$p = mysqli_fetch_object($produk);
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bukawarung</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<style>
		* {
			margin: 0; padding: 0;
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
			font-size: 2rem;
			color: #00c6ff;
			margin-bottom: 20px;
		}
		.box {
			display: flex;
			flex-wrap: wrap;
			gap: 20px;
		}
		.col-2 {
			flex: 1 1 45%;
			background: rgba(255,255,255,0.05);
			backdrop-filter: blur(12px);
			border-radius: 16px;
			padding: 20px;
			text-align: center;
			box-shadow: 0 4px 12px rgba(0,0,0,0.4);
		}
		.col-2 img {
			width: 100%;
			height: auto;
			object-fit: cover;
			border-radius: 12px;
		}
		.col-2 h3 {
			font-size: 2rem;
			color: #fff;
			margin-top: 20px;
		}
		.col-2 h4 {
			font-size: 1.5rem;
			color: #00ffcc;
			margin: 10px 0;
		}
		.col-2 p {
			color: #ddd;
			font-size: 1rem;
			line-height: 1.6;
			margin-bottom: 20px;
		}
		.wa-button {
			display: inline-block;
			padding: 10px 16px;
			background: #00ffcc;
			border-radius: 8px;
			color: #000;
			font-weight: 600;
			text-decoration: none;
			box-shadow: 0 4px 12px rgba(0,255,204,0.3);
			transition: all 0.3s;
		}
		.wa-button:hover {
			background: #00c6ff;
			transform: scale(1.05);
		}
		.wa-button i {
			font-size: 16px;
			margin-right: 6px;
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

	<!-- search -->
	<div class="search container">
		<form action="produk.php">
			<input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
			<input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?>">
			<input type="submit" name="cari" value="Cari Produk">
		</form>
	</div>

	<!-- product detail -->
	<div class="section container">
		<h3>Detail Produk</h3>
		<div class="box">
			<div class="col-2">
				<img src="produk/<?php echo $p->product_image ?>" alt="<?php echo $p->product_name ?>">
			</div>
			<div class="col-2">
				<h3><?php echo $p->product_name ?></h3>
				<h4>Rp. <?php echo number_format($p->product_price) ?></h4>
				<p>Deskripsi :<br>
					<?php echo nl2br($p->product_description) ?>
				</p>
				<p>
					<a class="wa-button" href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">
						<i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
					</a>
				</p>
			</div>
		</div>
	</div>

	<!-- footer -->
	<div class="footer">
		<div class="container">
			<h4>Alamat</h4>
			<p><?php echo $a->admin_address ?></p>
			<h4>Email</h4>
			<p><?php echo $a->admin_email ?></p>
			<h4>No. Hp</h4>
			<p><?php echo $a->admin_telp ?></p>
			<small>Copyright &copy; 2025 - Bukawarung</small>
		</div>
	</div>

	<script>AOS.init({ duration: 1000, once: true });</script>
</body>
</html>
