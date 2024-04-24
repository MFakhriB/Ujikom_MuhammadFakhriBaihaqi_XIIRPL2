<?php
session_start();

// Lakukan koneksi ke database
include '../config/config.php';

// Proses form pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $NamaLengkap = $_POST['NamaLengkap'];
    $Alamat = $_POST['Alamat'];

    // Eksekusi query untuk menyimpan data ke database
    $sql = "INSERT INTO user (Username, Password, Email, NamaLengkap, Alamat) 
            VALUES ('$Username', '$Password', '$Email', '$NamaLengkap', '$Alamat')";
    
    // Cek apakah query berhasil dieksekusi
    if (mysqli_query($conn, $sql)) {
      // Jika berhasil, arahkan ke halaman lain
      header("Location: log.php");
      exit(); // Pastikan untuk keluar dari skrip setelah header() dijalankan
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    // Tutup koneksi ke database
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>  
  </head>
  <body class="pt-20 bg-gradient-to-b from-purple-200 via-blue-200 to-stone-300 h-screen">
    <form action="../login/reg.php" method="post">
    <div class="mx-auto max-w-md border p-8 rounded-lg shadow-lg bg-slate-200 backdrop-blur-lg">
      <div class="text-center mb-3">
        <h2 class="text-3xl font-sans font-semibold bg-gradient-to-t from-red-600 via-blue-400 to-orange-600 pb-2 bg-clip-text text-transparent">Sign Up</h2>
      </div>
      <div class="mx-10">
        <div class="my-3">
          <label for="Username">Username</label>
          <div class="">
            <input type="text" name="Username" id="Username" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required />
          </div>
        </div>
        <div class="my-3">
          <label for="Password">Password</label>
          <div class="">
            <input type="password" name="Password" id="Password" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required />
          </div>
        </div>
        <div class="my-3">
          <label for="Email">Email</label>
          <div class="">
            <input type="email" name="Email" id="Email" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required />
          </div>
        </div>
        <div class="my-3">
          <label for="NamaLengkap">Full Name</label>
          <div class="">
            <input type="text" name="NamaLengkap" id="NamaLengkap" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required />
          </div>
        </div>
        <div class="my-3">
          <label for="Alamat">Alamat</label>
          <div class="">
            <input type="text" name="Alamat" id="Alamat" class="w-full border border-slate-400 shadow-sm rounded-md px-4 py-2" required />
          </div>
        </div>
        <div class="flex justify-center items-center mt-4">
          <input type="submit" name="btn" id="submit" value="Sign In" class="inline-block px-5 py-3 bg-purple-300 hover:bg-purple-400 text-slate-800 rounded-lg shadow-lg uppercase font-semibold text-sm">
        </div>
        <div class="mx-autotext-sm mt-2">
          <p class="font-sans text-center">Sudah punya akun? <a href="../login/log.php" class="text-indigo-500">Log In</a></p>
        </div>
      </div>
    </div>
    </form>
  </body>
</html>
