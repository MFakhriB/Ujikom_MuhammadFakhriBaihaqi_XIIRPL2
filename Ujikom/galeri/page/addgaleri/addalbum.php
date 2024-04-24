<?php
session_start();
include("../../config/config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $albumName = $_POST['NamaAlbum'];
    $albumDescription = $_POST['Deskripsi'];
    $albumDate = date('Y-m-d');
    $userID = $_SESSION['user_id'];
    
    // Query untuk menyimpan album baru ke dalam database
    $sql = "INSERT INTO album (NamaAlbum, Deskripsi, TanggalDibuat, UserID) VALUES ('$albumName', '$albumDescription', '$albumDate', '$userID')";
    
    if (mysqli_query($conn, $sql)) {
        // Jika berhasil ditambahkan, arahkan kembali ke halaman album.php
        header("Location:../view/album.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Upload Foto</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body style="background-image: url(../../img/meja.jpg)" class="bg-fixed pt-52 bg-gradient-to-b from-zinc-200 to-stone-300 h-screen">
    <form action="" method="post" enctype="multipart/form-data">
      <div class="mx-auto max-w-md border p-8 rounded-lg shadow-lg backdrop-blur-2xl">
        <div class="text-center mb-3">
          <h2 class="text-3xl font-sans font-semibold bg-slate-800 pb-2 bg-clip-text text-transparent">Upload Foto</h2>
        </div>
        <div class="mx-10">
          <div class="my-3">
            <label for="NamaAlbum">Judul Album</label>
            <div class="">
              <input type="text" name="NamaAlbum" id="NamaAlbum" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required/>
            </div>
          </div>
          <div class="my-3">
            <label for="Deskripsi">Deskripsi Album</label>
            <div class="">
              <input type="text" name="Deskripsi" id="Deskripsi" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required/>
            </div>
          </div>
          <div class="flex justify-center items-center mt-4">
            <input type="submit" name="btn" id="submit" value="Unggah" class="inline-block px-5 py-3 bg-purple-300 hover:bg-purple-400 text-slate-800 rounded-lg shadow-lg uppercase font-semibold text-sm" />
          </div>
        </div>
      </div>
    </form>
  </body>
</html>
