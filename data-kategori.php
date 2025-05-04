<?php 
	session_start();
	include 'db.php';
	if($_SESSION['status_login'] != true){
		echo '<script>window.location="login.php"</script>';
	}
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

		/* Table */
		table {
			width: 100%;
			margin-top: 20px;
			border-collapse: collapse;
		}

		th, td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid var(--text-light);
		}

		th {
			background-color: var(--primary);
			color: #fff;
		}

		tr:hover {
			background-color: var(--hover);
		}

		a {
			color: var(--primary);
			text-decoration: none;
		}

		a:hover {
			color: var(--secondary);
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
	<a href="profil.php"><i data-feather="user"></i> Profil</a>
	<a href="data-kategori.php" class="active"><i data-feather="layers"></i> Data Kategori</a>
	<a href="data-produk.php"><i data-feather="package"></i> Data Produk</a>
	<a href="keluar.php"><i data-feather="log-out"></i> Keluar</a>
</aside>

<main class="main">
	<h1>Data Kategori</h1>
	<div class="card">
		<p><a href="tambah-kategori.php" class="btn">Tambah Data</a></p>
		<table>
			<thead>
				<tr>
					<th width="60px">No</th>
					<th>Kategori</th>
					<th width="150px">Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$no = 1;
					$kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
					if(mysqli_num_rows($kategori) > 0){
					while($row = mysqli_fetch_array($kategori)){
				?>
				<tr>
					<td><?php echo $no++ ?></td>
					<td><?php echo $row['category_name'] ?></td>
					<td>
						<a href="edit-kategori.php?id=<?php echo $row['category_id'] ?>">Edit</a> || 
						<a href="proses-hapus.php?idk=<?php echo $row['category_id'] ?>" onclick="return confirm('Yakin ingin hapus ?')">Hapus</a>
					</td>
				</tr>
				<?php }}else{ ?>
					<tr>
						<td colspan="3">Tidak ada data</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
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
