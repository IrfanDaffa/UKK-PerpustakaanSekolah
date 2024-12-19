<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM peminjaman WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    $pinjam = $stmt->fetch();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = htmlspecialchars($_POST['nama']);
        $kelas = htmlspecialchars($_POST['kelas']);
        $judul_buku = htmlspecialchars($_POST['judul_buku']);
        $tanggal_peminjaman = htmlspecialchars($_POST['tanggal_peminjaman']);
        $stmt = $pdo->prepare("UPDATE peminjaman SET nama = :nama, kelas = :kelas, judul_buku = :judul_buku, tanggal_peminjaman = :tanggal_peminjaman WHERE id = :id");
        $stmt->execute(['nama' => $nama, 'kelas' => $kelas, 'judul_buku' => $judul_buku, 'tanggal_peminjaman' => $tanggal_peminjaman, 'id' => $_GET['id']]);
        header("Location: tampildata.php"); // Mengarahkan ke tampildata.php
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <h1>UPDATE DATA PEMINJAMAN</h1>
    <form method="POST">
        <input type="text" name="nama" value="<?php echo htmlspecialchars($pinjam['nama']); ?>" required>
        <input type="text" name="kelas" value="<?php echo htmlspecialchars($pinjam['kelas']); ?>" required>
        <input type="text" name="judul_buku" value="<?php echo htmlspecialchars($pinjam['judul_buku']); ?>" required>
        <input type="date" name="tanggal_peminjaman" value="<?php echo htmlspecialchars($pinjam['tanggal_peminjaman']); ?>" required>
        <button type="submit">Update</button>
    </form>
</body>
</html>