<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}

	$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
	$d = mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Bukawarung</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
	<script src="https://unpkg.com/feather-icons"></script>
	<style>
		:root {
			--bg-dark: #0f172a;
			--bg-glass: rgba(255, 255, 255, 0.05);
			--primary: #6366f1;
			--secondary: #8b5cf6;
			--text: #e2e8f0;
			--text-light: #94a3b8;
			--hover: #1e293b;
			--active: #6366f1;
		}

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			font-family: 'Inter', sans-serif;
			background: var(--bg-dark);
			color: var(--text);
			display: flex;
			min-height: 100vh;
			transition: 0.3s ease;
		}

		.sidebar {
			width: 250px;
			background: var(--bg-glass);
			backdrop-filter: blur(16px);
			padding: 40px 20px;
			border-right: 1px solid rgba(255,255,255,0.05);
			position: fixed;
			height: 100%;
		}

		.sidebar h2 {
			font-size: 28px;
			font-weight: 800;
			margin-bottom: 40px;
			background: linear-gradient(to right, var(--primary), var(--secondary));
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
			animation: glow 3s infinite ease-in-out;
		}

		@keyframes glow {
			0%, 100% { opacity: 1; transform: scale(1); }
			50% { opacity: 0.9; transform: scale(1.03); }
		}

		.sidebar a {
			display: flex;
			align-items: center;
			color: var(--text-light);
			text-decoration: none;
			padding: 12px 16px;
			border-radius: 8px;
			margin-bottom: 12px;
			transition: 0.3s;
			font-weight: 500;
		}

		.sidebar a:hover,
		.sidebar a.active {
			background: var(--hover);
			color: var(--active);
		}

		.sidebar a i {
			margin-right: 12px;
			vertical-align: middle;
		}

		.main {
			flex: 1;
			margin-left: 250px;
			padding: 40px;
			width: calc(100% - 250px);
		}

		.main h1 {
			font-size: 32px;
			font-weight: 700;
			margin-bottom: 20px;
		}

		.card {
			background: var(--bg-glass);
			padding: 30px;
			border-radius: 16px;
			box-shadow: 0 0 20px rgba(255,255,255,0.03);
			border: 1px solid rgba(255,255,255,0.05);
			transition: 0.3s ease;
		}

		.card:hover {
			transform: scale(1.01);
			box-shadow: 0 0 40px rgba(139, 92, 246, 0.1);
		}

		footer {
			text-align: center;
			padding: 20px;
			color: var(--text-light);
			font-size: 14px;
			margin-top: 40px;
		}

		/* Form styling */
		input[type="text"], input[type="email"], input[type="password"], .btn {
			width: 100%;
			padding: 15px;
			margin: 10px 0;
			background: var(--bg-glass);
			border: 1px solid var(--text-light);
			border-radius: 8px;
			color: var(--text);
			font-size: 16px;
		}

		.btn {
			background: var(--primary);
			border: none;
			cursor: pointer;
			transition: 0.3s;
		}

		.btn:hover {
			background: var(--secondary);
		}

		/* Responsive Layout */
		@media (max-width: 768px) {
			.sidebar {
				transform: translateX(-100%);
			}

			.sidebar.active {
				transform: translateX(0);
			}

			.main {
				margin-left: 0;
				width: 100%;
			}

			.toggle-btn {
				display: block;
				position: fixed;
				top: 20px;
				left: 20px;
				z-index: 1000;
				background: var(--bg-glass);
				border: none;
				color: var(--text);
				padding: 10px 14px;
				border-radius: 8px;
				cursor: pointer;
			}
		}

		.toggle-btn {
			display: none;
		}
	</style>
</head>
<body>

<button class="toggle-btn" onclick="toggleSidebar()">
	<i data-feather="menu"></i>
</button>

<aside class="sidebar" id="sidebar">
	<h2>Bukawarung</h2>
	<a href="dashboard.php"><i data-feather="home"></i> Dashboard</a>
	<a href="profil.php" class="active"><i data-feather="user"></i> Profil</a>
	<a href="data-kategori.php"><i data-feather="layers"></i> Data Kategori</a>
	<a href="data-produk.php"><i data-feather="package"></i> Data Produk</a>
	<a href="keluar.php"><i data-feather="log-out"></i> Keluar</a>
</aside>

<main class="main">
	<h1>Profil</h1>
	<div class="card">
		<h3>Ubah Profil</h3>
		<form action="" method="POST">
			<input type="text" name="nama" placeholder="Nama Lengkap" value="<?php echo $d->admin_name ?>" required>
			<input type="text" name="user" placeholder="Username" value="<?php echo $d->username ?>" required>
			<input type="text" name="hp" placeholder="No Hp" value="<?php echo $d->admin_telp ?>" required>
			<input type="email" name="email" placeholder="Email" value="<?php echo $d->admin_email ?>" required>
			<input type="text" name="alamat" placeholder="Alamat" value="<?php echo $d->admin_address ?>" required>
			<input type="submit" name="submit" value="Ubah Profil" class="btn">
		</form>
		<?php 
			if(isset($_POST['submit'])){
				$nama 	= ucwords($_POST['nama']);
				$user 	= $_POST['user'];
				$hp 	= $_POST['hp'];
				$email 	= $_POST['email'];
				$alamat = ucwords($_POST['alamat']);

				$update = mysqli_query($conn, "UPDATE tb_admin SET 
								admin_name = '".$nama."',
								username = '".$user."',
								admin_telp = '".$hp."',
								admin_email = '".$email."',
								admin_address = '".$alamat."'
								WHERE admin_id = '".$d->admin_id."' ");
				if($update){
					echo '<script>alert("Ubah data berhasil")</script>';
					echo '<script>window.location="profil.php"</script>';
				}else{
					echo 'gagal '.mysqli_error($conn);
				}
			}
		?>
	</div>

	<h3>Ubah Password</h3>
	<div class="card">
		<form action="" method="POST">
			<input type="password" name="pass1" placeholder="Password Baru" required>
			<input type="password" name="pass2" placeholder="Konfirmasi Password Baru" required>
			<input type="submit" name="ubah_password" value="Ubah Password" class="btn">
		</form>
		<?php 
			if(isset($_POST['ubah_password'])){
				$pass1 	= $_POST['pass1'];
				$pass2 	= $_POST['pass2'];

				if($pass2 != $pass1){
					echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
				}else{
					$u_pass = mysqli_query($conn, "UPDATE tb_admin SET 
								password = '".MD5($pass1)."'
								WHERE admin_id = '".$d->admin_id."' ");
					if($u_pass){
						echo '<script>alert("Ubah data berhasil")</script>';
						echo '<script>window.location="profil.php"</script>';
					}else{
						echo 'gagal '.mysqli_error($conn);
					}
				}
			}
		?>
	</div>
</main>

<footer>&copy; 2025 Bukawarung. All rights reserved.</footer>

<script>
	feather.replace();
	function toggleSidebar() {
		document.getElementById('sidebar').classList.toggle('active');
	}
</script>

</body>
</html>
