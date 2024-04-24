<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "<div class='mx-auto text-center text-lg font-semibold'>Maaf, Anda masuk tanpa LogIn. Mohon login terlebih dahulu.</div>";
  // header("Location: login.php");
  // exit();
} else {
  $Username = $_SESSION['Username'];
  $UserID = $_SESSION['user_id'];
}

include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_SESSION['user_id'])) {
      // Ambil data dari form
      $fotoID = $_POST['foto_id'];
      $userID = $_SESSION['user_id'];
      $tanggalLike = date('Y-m-d H:i:s'); // Tanggal dan waktu saat ini

      // Query untuk menyimpan data ke dalam tabel likefoto
      $sql = "INSERT INTO likefoto (FotoID, UserID, TanggalLike) VALUES ('$fotoID', '$userID', '$tanggalLike')";

      if (mysqli_query($conn, $sql)) {
        // Tambahkan FotoID ke dalam session yang menyimpan foto yang dilike
        $_SESSION['liked_photos'][] = $fotoID;
        echo "Like berhasil ditambahkan.";
        header('location:./like.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  } else {
      echo "<div class='mx-auto text-center text-lg font-semibold'>Anda harus login untuk melakukan like.</div>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      function showFullDescription(id, fullDescription) {
        document.getElementById(id).innerText = fullDescription;
      }
    </script>
  </head>
  <body style="background-image: url(../../img/meja.jpg)" class="bg-fixed h-full">
    <div class="bg-black bg-opacity-70 h-full">
      <!--Navbar-->
      <div class="w-full bg-transparent border shadow-lg fixed border-slate-700">
        <nav name="navbar" class="px-10 py-6 font-sans flex justify-between backdrop-blur-md bg-white opacity-50">
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
      <?php
        if(isset($_GET['foto_id'])) {
          $fotoID = $_GET['foto_id'];
          $sql = "SELECT * FROM foto WHERE FotoID='$fotoID'";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              // Lakukan sesuatu dengan $row untuk menampilkan foto
      ?>
      <div class="container sm:px-80 md:px-96 lg:px-96 mx-auto font-sans pt-32 pb-5">
        <div class="rounded-md shadow-xl overflow-hidden mb-10 bg-white pt-5">
          <div>
            <div class="w-auto">
              <img src="../../uploads/<?= $row['LokasiFile']?>" width="400px" height="400px" class="mx-auto" />
            </div>
            <div>
              <div class="px-6 pb-1 pt-4 gap-3 flex">
                <form action="" method="post">
                  <input type="hidden" name="foto_id" value="<?= $row['FotoID']; ?>">
                  <button type="submit"><img src="../../img/like_PNG61.png" alt="" width="35px" class="shadow-md items-center rounded-lg bg-purple-200 hover:bg-purple-300 text-slate-700 font-sans text-sm p-2"></button>
                </form>
                  <a href="./komentar.php?foto_id=<?= $row['FotoID']; ?>" class="items-center shadow-md rounded-lg bg-purple-200 hover:bg-purple-300 text-slate-700 cursor-pointerfont-sans p-2 text-sm">Comment</a>
              </div>
              <div class="px-6 py-4">
                <div class="font-semibold text-xl mb-2"><?= $row['JudulFoto']; ?></div>
                  <?php
                    $max_length = 100; // Panjang maksimum deskripsi sebelum menampilkan "Baca Selengkapnya"
                    $deskripsi = $row['DeskripsiFoto'];
                    $deskripsi_lengkap = $deskripsi;
                    $deskripsi_id = 'deskripsi_' . $row['FotoID'];
                    if (strlen($deskripsi) > $max_length) {
                      $deskripsi = substr($deskripsi, 0, $max_length) . "...";
                      echo "<p class='text-slate-700 text-sm' id='$deskripsi_id'>$deskripsi <a href='#' onclick='showFullDescription(\"$deskripsi_id\", \"$deskripsi_lengkap\")' class='text-blue-400'>Baca Selengkapnya</a></p>";
                    } else {
                      echo "<p class='text-slate-700 text-sm' id='$deskripsi_id'>$deskripsi</p>";
                    }
                  ?>
                </div>
                <div class="px-6 pb-1 pt-1 gap-3 flex flex-col overflow-y-scroll max-h-20 shadow-md rounded-lg bg-slate-100">
                  <?php
                    $sql_komentar = "SELECT komentarfoto.*, user.Username FROM komentarfoto INNER JOIN user ON komentarfoto.UserID = user.UserID WHERE komentarfoto.FotoID='$fotoID'";
                    $result_komentar = mysqli_query($conn, $sql_komentar);
                    
                    if (mysqli_num_rows($result_komentar) > 0) {
                        while ($komentar = mysqli_fetch_assoc($result_komentar)) {
                            // Tampilkan isi komentar dan info pengguna yang melakukan komentar
                    ?>
                    <div class='pb-2'>
                        <p><strong><?= $komentar['Username'] ?>:</strong> <?= $komentar['IsiKomentar'] ?></p>
                    </div>
                    <?php
                        }
                    } else {
                        echo "<p class='text-slate-400'>Tidak ada komentar untuk foto ini.</p>";
                    }
                    ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100 ">
              <a href="./post.php" class="m-auto text-slate-700 flex font-sans">Kembali</a>
            </div>
            <?php
                  }
                }
              }
              mysqli_close($conn);
            ?>
      <!--Body-->
    </div>
  </body>
</html>
