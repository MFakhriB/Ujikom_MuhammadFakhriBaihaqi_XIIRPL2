<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  echo "<div class='mx-auto text-center text-lg font-semibold'>Maaf, Anda mengedit tanpa LogIn. Mohon login terlebih dahulu untuk edit foto.</div>";
  // header("Location: login.php");
  // exit();
} else {
  $Username = $_SESSION['Username'];
  $UserID = $_SESSION['user_id'];
}

include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_SESSION['user_id'])) {
    if (isset($_POST['edit_judul'])) {
      // Ambil data dari form untuk mengedit judul
      $fotoID = $_POST['foto_id'];
      $newJudul = $_POST['new_judul'];

      // Query untuk mengupdate judul foto
      $sql_update_judul = "UPDATE foto SET JudulFoto='$newJudul' WHERE FotoID='$fotoID'";

      if (mysqli_query($conn, $sql_update_judul)) {
        echo "Judul berhasil diperbarui.";
        // Redirect kembali ke halaman sebelumnya
        header("Location: ./edit.php?foto_id=$fotoID");
        exit();
      } else {
        echo "Error: " . $sql_update_judul . "<br>" . mysqli_error($conn);
      }
    } elseif (isset($_POST['edit_deskripsi'])) {
      // Ambil data dari form untuk mengedit deskripsi
      $fotoID = $_POST['foto_id'];
      $newDeskripsi = $_POST['new_deskripsi'];

      // Query untuk mengupdate deskripsi foto
      $sql_update_deskripsi = "UPDATE foto SET DeskripsiFoto='$newDeskripsi' WHERE FotoID='$fotoID'";

      if (mysqli_query($conn, $sql_update_deskripsi)) {
        echo "Deskripsi berhasil diperbarui.";
        // Redirect kembali ke halaman sebelumnya
        header("Location: ./edit.php?foto_id=$fotoID");
        exit();
      } else {
        echo "Error: " . $sql_update_deskripsi . "<br>" . mysqli_error($conn);
      }
    } elseif (isset($_POST['edit_image'])) {
      // Ambil data dari form untuk mengedit gambar
      $fotoID = $_POST['foto_id'];

      // Lokasi file sementara gambar yang diunggah
      $file_tmp = $_FILES["new_image"]["tmp_name"];
      // Nama file gambar yang diunggah
      $file_name = basename($_FILES["new_image"]["name"]);
      // Lokasi baru file gambar setelah diunggah
      $file_destination = "../../uploads/" . $file_name;

      // Pindahkan file gambar ke lokasi yang ditentukan
      if (move_uploaded_file($file_tmp, $file_destination)) {
        // Query untuk mengupdate lokasi file gambar dalam database
        $sql_update_image = "UPDATE foto SET LokasiFile='$file_name' WHERE FotoID='$fotoID'";
        if (mysqli_query($conn, $sql_update_image)) {
          echo "Foto berhasil diperbarui.";
          // Redirect kembali ke halaman sebelumnya
          header("Location: ./edit.php?foto_id=$fotoID");
          exit();
        } else {
          echo "Error: " . $sql_update_image . "<br>" . mysqli_error($conn);
        }
      } else {
        echo "Error uploading file.";
      }
    }
  } else {
    echo "Anda harus login untuk melakukan edit.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Foto</title>
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
                <!-- Form untuk mengedit judul -->
                <form action="" method="post" class="mt-2">
                  <div>
                    <input type="hidden" name="foto_id" value="<?= $row['FotoID']; ?>">
                    <p class="mr-2 text-slate-900 font-sans font-semibold">Edit Judul:</p>
                    <input type="text" name="new_judul" placeholder="Judul baru" class="border w-max border-slate-400 shadow-sm rounded-md px-4 py-2" required>
                    <input type="submit" name="edit_judul" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                  </div>
                </form>
                <!-- Form untuk mengedit deskripsi -->
                <form action="" method="post" class="mt-2">
                  <input type="hidden" name="foto_id" value="<?= $row['FotoID']; ?>">
                  <p class="mr-2 text-slate-900 font-sans font-semibold">Edit Deskripsi:</p>
                  <input type="text" name="new_deskripsi" placeholder="Deskripsi baru" class="border w-max border-slate-400 shadow-sm rounded-md px-4 py-2" required>
                  <input type="submit" name="edit_deskripsi" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                </form>
                <!-- Form untuk mengedit gambar -->
                <form action="" method="post" enctype="multipart/form-data" class="mt-2">
                  <input type="hidden" name="foto_id" value="<?= $row['FotoID']; ?>">
                  <p class="mr-2 text-slate-900 font-sans font-semibold">Ganti Foto:</p>
                  <input type="file" name="new_image" accept="image/*" class="border w-max border-slate-400 shadow-sm rounded-md px-4 py-2" required>
                  <input type="submit" name="edit_image" value="Submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                </form>
              </div>
            </div>
            <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100 ">
              <a href="./galery.php" class="m-auto text-slate-700 flex font-sans">Kembali</a>
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
