<?php
// Sertakan file koneksi ke database
require 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    if (empty($_POST['nama']) || empty($_POST['kelas'])) {
        $message = "Mohon isi semua kolom.";
    } else {
        $nama = htmlspecialchars($_POST['nama']);
        $kelas = htmlspecialchars($_POST['kelas']);
        $judul_buku = htmlspecialchars($_POST['judul_buku']);
        $tanggal_peminjaman = htmlspecialchars($_POST['tanggal_peminjaman']);

        // Simpan data ke database
        try {
            $stmt = $pdo->prepare("INSERT INTO peminjaman (nama, kelas, judul_buku, tanggal_peminjaman) VALUES (:nama, :kelas, :judul_buku, :tanggal_peminjaman)");
            $stmt->execute(['nama' => $nama, 'kelas' => $kelas, 'judul_buku' => $judul_buku, 'tanggal_peminjaman' => $tanggal_peminjaman]);
            $message = "Terima Kasih, $nama! Peminjaman Anda telah diterima.";
        } catch (Exception $e) {
            $message = "Terjadi kesalahan: " . $e->getMessage();
        }

        // Menggunakan alert box untuk menampilkan pesan
        echo "<script>
            alert('$message');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus SMKN 4 Bojonegoro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav id="home">
            <ul class="nav-links">
                <li><a href="#about">Tentang Kami</a></li>
                <li><a href="#books">Koleksi Buku</a></li>
                <li><a href="#testimonials">Tanggapan Siswa</a></li>
                <li><a href="#events">Kegiatan</a></li>
                <li><a href="#contact">Kontak</a></li>
            </ul>
            <a href="tampildata.php" class="borrow-now">Lihat Data Peminjaman</a>
        </nav>
        <div class="hero-section">
            <h1>PERPUSTAKAAN</h1>
            <h1>SMKN 4 BOJONEGORO</h1>
            <p> Tempat terbaik untuk menemukan buku-buku yang dapat meningkatkan 
                pengetahuan dan minat baca Anda.</p>
            <a href="#borrow-form" class="borrow-now">Pinjam Buku</a>
        </div>
    </header>

    <!-- Selection About -->
    <section id="about">
        <h2>Tentang Kami</h2>
        <p> Perpustakaan SMKN 4 Bojonegoro menyediakan berbagai koleksi buku yang lengkap untuk menunjang 
            kegiatan belajar mengajar. Dengan pembaruan koleksi secara berkala, perpustakaan ini memastikan 
            siswa mendapatkan akses ke sumber belajar yang berkualitas. Selain buku pelajaran, terdapat juga 
            buku tambahan yang mendukung pengembangan pengetahuan dan keterampilan siswa. Perpustakaan ini 
            menjadi tempat yang nyaman untuk membaca, belajar, dan meningkatkan prestasi akademik siswa.</p>
        <div class="features">
            <div class="feature-item">
                <h3>Buku Berkualitas</h3>
                <p> Kami menyediakan koleksi buku yang bervariasi, mulai dari buku 
                    pelajaran hingga fiksi untuk hiburan dan pengembangan diri.</p>
            </div>
            <div class="feature-item">
                <h3>Fasilitas Nyaman</h3>
                <p>Perpustakaan kami dilengkapi dengan fasilitas yang nyaman untuk belajar dan membaca.</p>
            </div>
            <div class="feature-item">
                <h3>Waktu Akses Fleksibel</h3>
                <p> Perpustakaan kami buka setiap hari dengan jam operasional yang fleksibel agar
                    memudahkan siswa mengakses buku.</p>
            </div>
        </div>
    </section>

    <!-- Books Section -->
    <section id="books">
        <h2>Koleksi Buku</h2>
        <div class="books-slider">
            <div class="books-item">
                <img src="img/Matematika.jpg" alt="Buku Matematika">
                <p>Buku Matematika Dasar</p>
                <p>Kelas 10</p>
            </div>
            <div class="books-item">
                <img src="img/B.Indonesia.png" alt="Buku Bahasa Indonesia">
                <p>Buku Bahasa Indonesia</p>
                <p>Kelas 11</p>
            </div>
            <div class="books-item">
                <img src="img/PemWeb.jpg" alt="Buku Pemrograman Web">
                <p>Buku Pemrograman Web</p>
                <p>Kelas 12</p>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section id="testimonials">
        <h2>Tanggapan Siswa</h2>
        <div class="testimonial-item">
            <p>"Perpustakaan SMKN 4 Bojonegoro merupakan tempat yang ideal untuk mendukung kegiatan belajar siswa. 
                Dengan koleksi buku yang lengkap dan suasana nyaman, perpustakaan ini memudahkan siswa 
                mengakses sumber belajar berkualitas untuk menunjang prestasi akademik."</p>
            <p>Irfan Daffa - Kelas 11 </p>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events">
        <h2>Kegiatan Perpustakaan</h2>
        <div class="event-item">
            <p>"Workshop Membaca Cepat - Meningkatkan kemampuan membaca dalam waktu singkat."</p>
            <p>- 15 Desember 2024</p>
        </div>
        <div class="event-item">
            <p>"Lomba Baca Buku - Tantang dirimu dalam lomba membaca buku terbaik!"</p>
            <p>- 20 Desember 2024</p>
        </div>
    </section>

    <!-- Formulir Peminjaman -->
    <section>
        <br>
        <h2>Formulir Peminjaman Buku</h2>
        <form id="borrow-form" method="POST" action="">
            <input type="text" id="nama" name="nama" placeholder="Nama" required>
            <input type="text" id="kelas" name="kelas" placeholder="Kelas" required>
            <input type="text" id="judul_buku" name="judul_buku" placeholder="Judul Buku" required>
            <input type="date" id="tanggal_peminjaman" name="tanggal_peminjaman" placeholder="Tanggal Peminjaman" required>
            <button type="submit">Submit</button><br><br><br>
        </form>
    </section>
    
    <!-- Footer Section -->
    <footer id="contact">
        <div class="borrow-us">
            <h2>Ayo Pinjam Buku Sekarang!</h2>
            <a href="#borrow-form" class="borrow-now">Pinjam Buku</a>
        </div>
        <div class="footer-info">
            <div class="library-info">
                <p>Kunjungi Kami</p>
                <p>Perpus SMKN 4 Bojonegoro</p>
                <p>Kec. Kapas Kab. Bojonegoro Jawa Timur</p>
                <p>0812-1212-1212</p>
                <p>perpus_smkn4bjn@gmail.com</p>
            </div>
            <div class="footer-links">
                <p>Links</p>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang Kami</a></li>
                    <li><a href="#books">Koleksi Buku</a></li>
                    <li><a href="#testimonials">Tanggapan Siswa</a></li>
                    <li><a href="#events">Kegiatan Perpustakaan</a></li>
                </ul>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>
</html>