<?php
include 'config.php'; // Menyertakan file database.php untuk koneksi

// Query untuk mengambil data alumni
$sql = "SELECT * FROM alumni";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduTrack</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Menambahkan efek hover dan border-radius pada tombol */
        .rounded-btn {
            background-color: #5573B9;
            /* Warna tombol default */
            color: white;
            padding: 12px 24px;
            border-radius: 50px;
            /* Membuat tombol melengkung */
            font-size: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 350px;
            /* Batas maksimal lebar tombol */
            transition: background-color 0.3s, transform 0.2s;
            /* Animasi perubahan warna */
            text-decoration: none;
            /* Menghapus garis bawah pada link */
        }

        /* Efek hover */
        .rounded-btn:hover {
            background-color: #5573B9;
            /* Warna tombol saat hover */
            transform: scale(1.05);
            /* Efek pembesaran sedikit saat hover */
        }

        /* Efek tombol yang aktif (dihighlight dengan warna biru) */
        .rounded-btn.active {
            background-color: #5573B9;
            /* Warna tombol aktif */
        }

        /* Efek tombol non-aktif (warna abu-abu) */
        .rounded-btn:not(.active) {
            background-color: #D1D1D1;
            /* Warna tombol non-aktif */
            color: #1C5FEF;
        }

        .rounded-btn i {
            margin-right: 8px;
            /* Memberikan jarak antara ikon dan teks */
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="w-1/4 p-4 flex flex-col items-center fixed top-0 left-0 h-full bg-blue-200" style="background-color: #89A9ED;">
            <div class="d-flex align-items-center"
                style="display: flex; align-items: center; padding-bottom:30px; font-family:Typography; font-size:20px;">
                <a class="logowisuda">
                    <img src="assets/wisudalur.png" alt="Logo Wisuda" height="30px" width="20px">
                </a>
                <a class="navbar-brand" href="#" style="color: black; margin-left: 10px;">EduTrack</a>
            </div>
            <div class="flex items-center justify-center mb-6">
                <img src="assets/profil.png" alt="EduTrack logo" class="mr-2 w-[60%] h-auto">
            </div>
            <div class="text-center mb-6" style="color:white;">
                <p class="text-lg">Halo, Admin</p>
            </div>
            <div class="text-center mb-6" style="color:white;">
                <p class="text-lg">SMPN 1 Ngadirejo</p>
            </div>

            <!-- Link ke halaman Data Alumni -->
            <a href="alldataadmin.php" id="linkDataAlumni" class="rounded-btn mb-4 w-full active">
                <i class="fas fa-users"></i>Lihat Data Alumni
            </a>

            <!-- Link ke halaman Tambah Data -->
            <a href="tambahdataadmin.php" id="linkTambahData" class="rounded-btn mb-4 w-full">
                <i class="fas fa-users"></i>Tambah Data
            </a>

            <!-- Link ke halaman Buat Pengumuman -->
            <a href="buat_pengumuman.php" id="linkBuatPengumuman" class="rounded-btn mb-4 w-full">
                <i class="fas fa-bullhorn"></i>Pengumuman/Informasi
            </a>

            <!-- Link ke halaman Logout -->
            <a href="logout.php" id="linkLogout" class="rounded-btn w-full"
                style="background-color: #E8AA24; color:white">
                <i class="fas fa-sign-out-alt"></i>Logout
            </a>
        </div>

        <script>
            // Menambahkan event listener pada setiap tombol untuk mengubah warnanya
            const links = document.querySelectorAll('.bg-gray-400');

            links.forEach(link => {
                link.addEventListener('click', function () {
                    // Mengatur warna tombol menjadi biru untuk tombol yang diklik
                    links.forEach(btn => btn.classList.remove('bg-blue-600'));
                    link.classList.add('bg-blue-600');

                    // Mengatur tombol yang tidak diklik menjadi abu-abu
                    links.forEach(btn => {
                        if (btn !== link) {
                            btn.classList.remove('bg-blue-600');
                            btn.classList.add('bg-gray-400');
                        }
                    });
                });
            });
        </script>

        <!-- Main Content -->
        <div class="w-3/4 p-8 ml-[25%]">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <a href="alldataadmin.php"
                        class="bg-blue-200 text-black py-2 px-4 rounded-l inline-block text-center 
                            <?php echo basename($_SERVER['PHP_SELF']) == 'alldataadmin.php' ? 'bg-blue-500 text-white' : ''; ?>">
                        DATA ALUMNI
                    </a>
                    <a href="statistikadmin.php"
                        class="bg-gray-200 text-black py-2 px-4 rounded-r inline-block text-center 
                            <?php echo basename($_SERVER['PHP_SELF']) == 'statistikadmin.php' ? 'bg-blue-500 text-white' : ''; ?>">
                        STATISTIK DATA
                    </a>
                </div>

                <form action="search.php" method="GET">
                    <!-- Input teks -->
                    <input type="text" name="nama" placeholder="Cari Nama" required
                        style="width: 300px; padding: 10px; font-size: 16px;">
                    <button type="submit" style="display: none;"></button>
                </form>

                <!-- Tempat untuk menampilkan hasil -->
                <?php
                if (isset($_POST['result'])) {
                    echo $_POST['result'];
                }
                ?>
            </div>
            <h2 class="text-center text-xl font-bold mb-4">Data Keseluruhan Alumni</h2>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border border-gray-300 py-2 px-4">No.</th>
                        <th class="border border-gray-300 py-2 px-4">Nama</th>
                        <th class="border border-gray-300 py-2 px-4">Nomor Induk</th>
                        <th class="border border-gray-300 py-2 px-4">Jenis Kelamin</th>
                        <th class="border border-gray-300 py-2 px-4">Angkatan</th>
                        <th class="border border-gray-300 py-2 px-4">Status</th>
                        <th class="border border-gray-300 py-2 px-4">Instansi</th>
                        <th class="border border-gray-300 py-2 px-4">Terakhir Update</th>
                        <th class="border border-gray-300 py-2 px-4">Ubah</th>
                    </tr>
                </thead>

                <body>
                    <?php
                    if ($result->num_rows > 0) {
                        // Menampilkan data alumni
                        $no = 1; // untuk nomor urut
                        while ($row = $result->fetch_assoc()) {
                            $name = urlencode($row['nama']);
                            echo "<tr>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>" . $no++ . ".</td>";
                            echo "<td class='border border-gray-300 py-2 px-4'>" . htmlspecialchars($row['nama']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4'>" . htmlspecialchars($row['nomer_induk']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>" . ($row['jenis_kelamin'] == 'L' ? 'Laki-Laki' : 'Perempuan') . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>" . htmlspecialchars($row['tahun_masuk']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>" . htmlspecialchars($row['status']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4'>" . htmlspecialchars($row['instansi']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>" . htmlspecialchars($row['terakhir_update']) . "</td>";
                            echo "<td class='border border-gray-300 py-2 px-4 text-center'>
                                    <div class='flex justify-start space-x-2'>
                                        <a href='editdataadmin.php?nama=$name' class='bg-blue-500 text-white py-1 px-2 rounded'>Edit</a>
                                        <a href='deletedata.php?nama=$name' class='bg-red-500 text-white py-1 px-2 rounded' onclick='return confirm(\"Are you sure you want to delete this item?\")'>Delete</a>
                                    </div>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center py-4'>No data available</td></tr>";
                    }
                    ?>
                </body>
            </table>
            <div class="flex justify-between mt-4">
                <button onclick="window.location.href='tambahdataadmin.php'"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg">Tambah Data</button>
                <button onclick="window.location.href='buat_pengumuman.php'"
                    class="bg-blue-500 text-white py-2 px-4 rounded-lg">Buat Pengumuman</button>
            </div>
        </div>
    </div>
</body>

</html>