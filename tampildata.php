<?php
// Sertakan koneksi
require 'koneksi.php';

// Hapus data jika terdapat parameter id
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM peminjaman WHERE id = :id");
    $stmt->execute(['id' => $_GET['id']]);
    header("Location: tampildata.php"); // Redirect kembali ke tampildata.php
    exit;
}

// Ambil data dari tabel peminjaman
$stmt = $pdo->query("SELECT * FROM peminjaman");
$peminjaman = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Peminjaman Buku</title>

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('img/background-library.jpg');
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            color: #333;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: rgb(0, 0, 0);
            margin-top: 20px;
        }

        section {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            display: block;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
        }

        td {
            background-color: #fafafa;
        }

        tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        td a {
            text-decoration: none;
            color: #007bff;
            margin-right: 10px;
        }

        td a:hover {
            text-decoration: underline;
        }

        td a.delete {
            color: red;
        }

        td a.delete:hover {
            color: darkred;
        }

        /* Printing Styles */
        @media print {
            button,
            th:last-child,
            td:last-child {
                display: none;
            }

            body {
                margin: 0;
                font-size: 12px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #4CAF50;
                color: white;
            }

            td {
                background-color: white;
            }

            h2 {
                page-break-before: always;
                text-align: center;
            }
        }
    </style>

    <script>
        function cetakLaporan() {
            window.print(); // Membuka dialog cetak
        }
    </script>
</head>

<body>
    <section>
        <h2>Daftar Peminjaman Buku</h2>

        <!-- Tombol Cetak Laporan -->
         <button onclick="cetakLaporan()"
         style="margin-bottom: 20px; padding: 10px 20px; background-color: #4CAF50; color: white;
                border: none; border-radius: 5px; cursor: pointer;">Cetak Peminjaman</button>

        <!-- Tombol Exit -->
         <a href="index.php" style="margin-bottom: 20px; padding: 10px 20px; background-color: #4CAF50;
                  color: white; border: none; border-radius: 5px; cursor: pointer;">Keluar</a>
        <table>
            <tr>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Judul Buku</th>
                <th>Tanggal Peminjaman</th>
                <th>Aksi</th>
            </tr>
            <?php if (!empty($peminjaman)): ?>
            <?php foreach ($peminjaman as $pinjam): ?>
            <tr>
                <td><?php echo htmlspecialchars($pinjam['nama']); ?></td>
                <td><?php echo htmlspecialchars($pinjam['kelas']); ?></td>
                <td><?php echo htmlspecialchars($pinjam['judul_buku']); ?></td>
                <td><?php echo htmlspecialchars($pinjam['tanggal_peminjaman']); ?></td>
                <td>
                    <!-- Tautan Edit mengarahkan ke edit.php dengan parameter ID data -->
                    <a href="edit.php?id=<?php echo $pinjam['id']; ?>">Edit</a>
                    <!-- Tautan Delete menambahkan parameter ID untuk dihapus -->
                    <a href="tampildata.php?id=<?php echo $pinjam['id']; ?>"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                </td>
            </tr>
            <?php endforeach;?>
            <?php else: ?>
            <tr>
                <td colspan="3">Tidak ada data peminjaman.</td>
            </tr>
            <?php endif;?>
        </table>
    </section>
</body>
</html>