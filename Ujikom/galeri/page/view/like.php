<?php

session_start();
include "../../config/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_id'])) {
        // Ambil data dari form
        $fotoID = $_POST['foto_id'];
        $userID = $_SESSION['user_id'];
        $tanggalLike = date('Y-m-d H:i:s'); // Tanggal dan waktu saat ini

        // Periksa apakah pengguna sudah melike foto tersebut sebelumnya
        $sql_check_like = "SELECT * FROM likefoto WHERE FotoID='$fotoID' AND UserID='$userID'";
        $result_check_like = mysqli_query($conn, $sql_check_like);
        if (mysqli_num_rows($result_check_like) == 0) {
            // Jika belum melike, simpan like ke database
            $sql_insert_like = "INSERT INTO likefoto (FotoID, UserID, TanggalLike) VALUES ('$fotoID', '$userID', '$tanggalLike')";
            if (mysqli_query($conn, $sql_insert_like)) {
                echo "Like berhasil ditambahkan.";
            } else {
                echo "Error: " . $sql_insert_like . "<br>" . mysqli_error($conn);
            }
        } else {
            // Jika sudah melike, berikan pesan
            echo "Anda sudah melike foto ini sebelumnya.";
        }
    } else {
        echo "Anda harus login untuk melakukan like.";
    }
}
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body style="background-image: url(../../img/meja.jpg)" class="bg-fixed h-full">
    <div class="bg-black bg-opacity-70 h-screen">
      <!--Navbar-->
      <div class="w-full bg-transparent border shadow-lg fixed border-slate-700">
        <nav name="navbar" class="px-10 py-6 font-sans flex justify-between backdrop-blur-md">
          <div>
            <a href="#" class="font-bold text-2xl bg-gradient-to-r from-slate-700 via-indigo-600 to-amber-500 bg-clip-text text-transparent">Galeri Skuy</a>
          </div>
          <div class="items-center mx-auto">
            <a href="../one.php" class="font-semibold text-lg text-slate-900 hover:text-slate-90">Back To First</a>
          </div>
          <div class="inline-block">
            <a href="../../login/log.php" class="px-2 py-2 hover:px-4 hover:py-4 border border-slate-600 rounded-xl shadow-lg font-semibold text-sm uppercase text-slate-700 hover:bg-gray-300 hover:text-slate-700 duration-200">Log Out</a>
          </div>
        </nav>
      </div>

      <!--Body-->
      <div class="container px-4 mx-auto font-sans pt-32 grid sm:grid-cols-1 md:grid-2 lg:grid-cols-3 gap-5">
          <?php
          // Mulai sesi
          // Sambungkan ke database
          include "../../config/config.php";

          // Pastikan pengguna sudah login
          if (isset($_SESSION['user_id'])) {
              $userID = $_SESSION['user_id'];

              // Ambil daftar foto yang disukai oleh pengguna
              $sql_liked_photos = "SELECT FotoID FROM likefoto WHERE UserID='$userID'";
              $result_liked_photos = mysqli_query($conn, $sql_liked_photos);

              // Periksa apakah ada foto yang disukai
              if (mysqli_num_rows($result_liked_photos) > 0) {
                  $liked_photos = array();
                  // Loop untuk mengumpulkan FotoID yang disukai ke dalam array
                  while ($row_liked_photos = mysqli_fetch_assoc($result_liked_photos)) {
                      $liked_photos[] = $row_liked_photos['FotoID'];
                  }

                  // Ubah array FotoID menjadi string
                  $liked_photos_string = implode(',', $liked_photos);

                  // Ambil informasi foto yang disukai dari database
                  $sql_photos = "SELECT * FROM foto WHERE FotoID IN ($liked_photos_string)";
                  $result_photos = mysqli_query($conn, $sql_photos);

                  // Tampilkan foto yang disukai
                  if (mysqli_num_rows($result_photos) > 0) {
                      while ($row_photos = mysqli_fetch_assoc($result_photos)) {
                          // Tampilkan foto disini sesuai kebutuhan tampilan
                        echo "<div class='rounded-md shadow-xl overflow-hidden mb-10 bg-white pt-5'>";
                          echo "<div class=''>";
                            echo "<div class='w-auto'>";
                              echo "<img src='../../uploads/{$row_photos['LokasiFile']}' width='200px' height='200px' class='mx-auto' />";
                            echo "</div>";
                            echo "<div class='w-auto'>";
                          // Tampilkan judul foto, deskripsi, dan informasi lainnya jika diperlukan
                              echo "<div class='px-6 py-4'>";
                                echo "<div class='font-semibold text-xl mb-2'>{$row_photos['JudulFoto']}</div>";
                                  echo "<p class='text-slate-700 text-sm'>{$row_photos['DeskripsiFoto']}</p>";
                                echo "</div>";
                              echo "</div>";
                            echo "</div>";
                          echo "</div>";
                      }
                  } else {
                      echo "<p class='text-white flex justify-center items-center h-[90vh]'>Belum ada foto yang disukai.</p>";
                  }
              } else {
                  echo "<p class='text-white flex justify-center items-center h-[70vh]'>Anda belum menyukai foto apapun.</p>";
              }
          } else {
              echo "<p class='text-white flex justify-center items-center h-[90vh]'>Silakan login untuk melihat foto yang disukai.</p>";
          }

          // Tutup koneksi database
          mysqli_close($conn);
          ?>
      </div>
      <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100 ">
        <a href="./post.php" class="m-auto text-slate-700 flex font-sans">Kembali</a>
      </div>
    </div>
  </body>
</html>