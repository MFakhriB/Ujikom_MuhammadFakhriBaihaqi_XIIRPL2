<?php
session_start();


include '../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Memastikan koneksi ke database berhasil
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
  
    // Mendapatkan UserID dari sesi
    $userID = $_SESSION['user_id'];
  
    // Mengambil nilai dari form
    $judulFoto = $_POST['JudulFoto'];
    $deskripsiFoto = $_POST['DeskripsiFoto'];
    $tanggalUnggah = date('Y-m-d');
    $albumID = 1; // Harap sesuaikan dengan ID album yang sesuai
  
    // Mendapatkan nama file yang diunggah
    $lokasiFile = $_FILES['LokasiFile']['name'];
    $lokasiSementara = $_FILES['LokasiFile']['tmp_name'];
    $targetDirektori = "../../uploads/"; // Sesuaikan dengan direktori tempat menyimpan file
  
    // Pindahkan file yang diunggah ke direktori tujuan
    $tujuanFile = $targetDirektori . basename($lokasiFile);
    move_uploaded_file($lokasiSementara, $tujuanFile);
  
    // Query untuk menyimpan data foto ke database
    $sql = "INSERT INTO foto (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFile, UserID) VALUES ('$judulFoto', '$deskripsiFoto', '$tanggalUnggah', '$lokasiFile', $userID)";
  
    // Eksekusi query dan tangkap pesan kesalahan jika terjadi
    if (mysqli_query($conn, $sql)) {
        echo "Foto berhasil diunggah";
        // Redirect kembali ke halaman add.php setelah berhasil
        header('location:../view/galery.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    // Tutup koneksi
    mysqli_close($conn);
}
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
            <label for="JudulFoto">Judul Foto</label>
            <div class="">
              <input type="text" name="JudulFoto" id="JudulFoto" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required/>
            </div>
          </div>
          <div class="my-3">
            <label for="DeskripsiFoto">Deskripsi Foto</label>
            <div class="">
              <input type="text" name="DeskripsiFoto" id="DeskripsiFoto" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required/>
            </div>
          </div>
          <!-- Bagian HTML Form -->
          <div class="my-3">
            <label for="LokasiFoto">Simpan Foto</label>
            <div class="">
              <input type="file" id="LokasiFile" name="LokasiFile" class="mt-1 p-2 w-full border rounded-md text-sm border-gray-300 focus:border-blue-500 bg-transparent" required/>
            </div>
          </div>
          <div class="flex justify-center items-center mt-4">
            <input type="submit" name="btn" id="submit" value="Unggah" class="inline-block px-5 py-3 bg-purple-300 hover:bg-purple-400 text-slate-800 rounded-lg shadow-lg uppercase font-semibold text-sm" />
          </div>
        </div>
      </div>
      <div class="w-auto h-12 bg-orange-200 hover:bg-orange-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 hover:px-5 duration-100 ">
        <a href="../view/galery.php" class="m-auto text-slate-700 flex font-sans">Kembali</a>
      </div>
    </form>
  </body>
</html>
