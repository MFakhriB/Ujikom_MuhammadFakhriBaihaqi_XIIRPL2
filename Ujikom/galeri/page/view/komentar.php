<?php
session_start();
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah $_SESSION['user_id'] sudah diatur
    if (!isset($_SESSION['user_id'])) {
        echo "<div class='mx-auto text-center text-lg font-semibold'>Maaf, Anda tidak diizinkan mengirim komentar tanpa login. Silakan login terlebih dahulu.</div>";
        // Anda juga dapat melakukan redirect ke halaman login jika diperlukan
        // header("Location: login.php");
        // exit();
    } else {
        $userID = $_SESSION['user_id'];
        $fotoID = $_POST['foto_id'];
        $komentar = mysqli_real_escape_string($conn, $_POST['komentar']);
        $tanggalKomentar = date('Y-m-d H:i:s'); // Tanggal dan waktu saat ini

        $sql = "INSERT INTO komentarfoto (FotoID, UserID, IsiKomentar, TanggalKomentar) VALUES ('$fotoID', '$userID', '$komentar', '$tanggalKomentar')";

        if (mysqli_query($conn, $sql)) {
            header("Location: ./post.php"); // Redirect kembali ke galeri.php setelah sukses menyimpan komentar
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
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
      <div class=" w-full bg-transparent border shadow-lg fixed border-slate-700">
        <nav name="navbar" class="px-10 py-6 font-sans flex justify-between backdrop-blur-md bg-white opacity-50">
          <div>
            <a href="#" class="font-bold text-2xl bg-gradient-to-r from-slate-700 via-indigo-600 to-amber-500 bg-clip-text text-transparent">Galeri Skuy</a>
          </div>
          <div class="items-center mx-auto">
            <a href="../one.php" class="font-semibold text-lg text-slate-900 hover:text-slate-700 duration-150">Back To First</a>
          </div>
          <div class="inline-block">
            <a href="../../login/log.php" class="px-2 py-2 hover:px-4 hover:py-4 border border-slate-600 rounded-xl shadow-lg font-semibold text-sm uppercase text-slate-700 hover:bg-gray-300 hover:text-slate-700 duration-200">Log Out</a>
          </div>
        </nav>
      </div>
      <?php
        include("../../config/config.php");

        if(isset($_GET['foto_id'])) {
          $fotoID = $_GET['foto_id'];
          $sql = "SELECT * FROM foto WHERE FotoID='$fotoID'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
                // Lakukan sesuatu dengan $row untuk menampilkan foto
          }
        } else {
            echo "FotoID tidak ditemukan.";
        }
        mysqli_close($conn);
      ?>
      <form action="" method="post">
        <div class="container sm:px-80 md:px-96 lg:px-96 mx-auto font-sans pt-32 ">
          <?php foreach ($result as $row) : ?>
            <div class="rounded-md shadow-xl overflow-hidden mb-10 bg-gray-200 pt-5">
              <div class="">
                <div class="w-auto">
                  <img src="../../uploads/<?= $row['LokasiFile']?>" width="300px" height="300px" class="mx-auto" />
                </div>
                <div class="w-auto">
                  <div class="px-6 pt-4 pb-2">
                    <div class="font-semibold text-xl mb-2"><?= $row['JudulFoto']; ?></div>
                    <p class="text-slate-700 text-sm"><?= $row['DeskripsiFoto']; ?></p>
                  </div>
                  <div class="px-6 pb-2 gap-3 flex sm:flex-1">
                    <input type="hidden" name="foto_id" value="<?= $row['FotoID']; ?>">
                    <input type="text" name="komentar" id="IsiKomentar" placeholder="Isi Komentar" class="sm:w-20 lg:w-full border border-slate-400 shadow-sm rounded-md px-4 py-2">
                    <input type="submit" name="btn" id="submit" value="Unggah" class="inline-block px-5 py-3 bg-purple-300 hover:bg-purple-400 text-slate-800 rounded-lg shadow-lg uppercase font-semibold text-sm" />
                  </div>
                  <div class="px-6 pb-5">
                    <p class="text-slate-700 text-sm"><?= date('Y-m-d', strtotime($row['TanggalUnggah'])); ?></p>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </form>
      <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100 ">
        <a href="./show.php?foto_id=<?= $row['FotoID']; ?>." class="m-auto text-slate-700 flex font-sans">Kembali</a>
      </div>
      <!--Body-->
    </div>
  </body>
</html>
