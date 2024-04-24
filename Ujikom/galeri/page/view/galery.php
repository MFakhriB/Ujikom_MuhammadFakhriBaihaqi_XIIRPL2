<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  echo "<div class='mx-auto text-center text-lg font-semibold'>Maaf, Anda masuk tanpa LogIn. Mohon login terlebih dahulu.</div>";
  // header("Location: login.php");
  // exit();
} else {
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
        echo "Anda harus login untuk melakukan like.";
    }
}

if (isset($_GET['foto_id'])) {
  $delete_foto_id = $_GET['foto_id'];
  
  // Hapus komentar terkait dengan foto yang akan dihapus
  $delete_comments_query = "DELETE FROM komentarfoto WHERE FotoID = '$delete_foto_id'";
  if (mysqli_query($conn, $delete_comments_query)) {
      // Hapus entri dari tabel likefoto
      $delete_like_query = "DELETE FROM likefoto WHERE FotoID = '$delete_foto_id'";
      if (mysqli_query($conn, $delete_like_query)) {
          // Hapus entri foto dari tabel foto
          $delete_query = "DELETE FROM foto WHERE FotoID = '$delete_foto_id' AND UserID = '$UserID'";
          if (mysqli_query($conn, $delete_query)) {
              echo "<div class='hidden'>Foto dan komentar-komentarnya berhasil dihapus.</div>";
          } else {
              echo "Error: " . $delete_query . "<br>" . mysqli_error($conn);
          }
      } else {
          echo "Error: " . $delete_like_query . "<br>" . mysqli_error($conn);
      }
  } else {
      echo "Error: " . $delete_comments_query . "<br>" . mysqli_error($conn);
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
  </head>
  </head>
  <body style="background-image: url(../../img/meja.jpg)" class="bg-fixed h-full">
    <div class="bg-black bg-opacity-70 h-full">
      <!-- Navbar -->
      <div class="w-full bg-transparent border shadow-lg fixed border-slate-700">
        <nav name="navbar" class="px-10 py-6 font-sans flex justify-between backdrop-blur-md bg-white opacity-50">
          <div>
            <a href="#" class="font-bold text-2xl bg-gradient-to-r from-slate-700 via-indigo-600 to-amber-500 bg-clip-text text-transparent">Galeri Skuy</a>
          </div>
          <div class="items-center mx-auto">
            <a href="../one.php" class="font-semibold text-lg text-slate-900 hover:text-slate-90">Back To First</a>
          </div>
          <div class="inline-block">
            <a href="../../login/log.php" class="px-2 py-2 hover:px-4 hover:py-4 border border-slate-600 rounded-xl shadow-lg font-semibold text-sm uppercase text-slate-700 hover:bg-gray-300 hover:text-slate-700 duration-200">LogOut</a>
          </div>
        </nav>
      </div>
      <div class="flex-1 text-center pt-32">
        <h2 class="text-4xl font-semibold text-slate-200">Profile Account</h2>
        <?php if (!empty($UserID)) : ?>
          <?php
          // Query untuk mendapatkan nama pengguna
          $query_username = "SELECT Username FROM user WHERE UserID='$UserID'";
          $result_username = mysqli_query($conn, $query_username);
          $username = mysqli_fetch_assoc($result_username)['Username'];
          ?>
          <p class="text-lg text-slate-300 mt-3">Just Only Uppload By: <a href="#" class="text-green-600 font-sans font-semibold"><?= $username ?></a></p>
        <?php endif; ?>
      </div>
      <?php
        $sql = "SELECT foto.*, user.Username FROM foto INNER JOIN user ON foto.UserID = user.UserID WHERE foto.UserID='$UserID' ORDER BY user.Username ASC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
      ?>
      <!--Body-->
      <div class="container px-4 mx-auto font-sans pt-14 pb-20 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-5">
        <?php foreach ($result as $row) : ?>
        <div class="rounded-md shadow-2xl overflow-hidden bg-gray-200 pt-5">
          <div>
            <div class="w-auto">
              <img src="../../uploads/<?= $row['LokasiFile'] ?>" width="300px" height="300px" class="mx-auto" />
            </div>
          </div>
          <div class="flex justify-between">
            <div class="px-6 py-5 flex justify-between items-end">
              <p class="text-slate-700 text-sm"><?= date('Y-m-d', strtotime($row['TanggalUnggah'])); ?></p>
            </div>
            <div class="px-6 py-5 flex justify-between items-end gap-2">
              <a href="./show.php?foto_id=<?= $row['FotoID']; ?>" class="items-center shadow-md rounded-lg bg-blue-200 hover:bg-blue-300 text-slate-700 cursor-pointerfont-sans p-2 hover:p-3 duration-100 text-sm">Show</a>
              <a href="./edit.php?foto_id=<?= $row['FotoID']; ?>" class="items-center shadow-md rounded-lg bg-blue-200 hover:bg-blue-300 text-slate-700 cursor-pointerfont-sans p-2 hover:p-3 duration-100 text-sm">Edit</a>
              <a href="?foto_id=<?= $row['FotoID']; ?>" class="items-center shadow-md rounded-lg bg-red-200 hover:bg-red-300 text-slate-700 cursor-pointerfont-sans p-2 hover:p-3 duration-100 text-sm">Delete</a>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php
        } else {
            echo "<h1 class='text-white flex justify-center items-center h-[90vh]'>Tidak ada data foto.</h1>";
        }
        mysqli_close($conn);
      ?>
      <div class="">
        <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100">
          <a href="../addgaleri/adding.php" class="m-auto text-slate-700 flex font-sans"><p class="pr-3 text-md font-bold">+</p>Add New Picture</a>
        </div>
        <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-52 fixed cursor-pointer px-4 hover:px-5 duration-100">
          <a href="./like.php" class="m-auto text-slate-700 flex font-sans">Show Your Like</a>
        </div>
        <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 left-5 fixed cursor-pointer px-4 hover:px-5 duration-100">
          <a href="./post.php" class="m-auto text-slate-700 flex font-sans">Show All Picture</a>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
  function likePhoto(fotoID) {
    // Kirim AJAX request ke like.php dengan parameter FotoID
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "like.php?fotoID=" + fotoID, true);
    xhr.send();
  }
</script>
