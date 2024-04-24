<?php

session_start();

include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if (isset($_POST['Username']) && isset($_POST['Password'])) {
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
  } else {
    $Username = '';
    $Password = '';
  }

  $sql = "SELECT * FROM user WHERE Username = '$Username' AND Password = '$Password' ORDER BY UserID DESC LIMIT 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      $_SESSION['user_id'] = $row['UserID'];
      $_SESSION['Username'] = $row['Username'];
      $_SESSION['submit'] = true;     
        header('location: ../page/one.php');
        exit();
    }
  } else {
    $error =  "Invalid Username or Password";
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="pt-52 bg-gradient-to-b from-purple-200 via-blue-200 to-stone-300 h-screen">
    <form action="../login/log.php" method="post">
      <div class="mx-auto max-w-md border p-8 rounded-lg shadow-lg bg-slate-200 backdrop-blur-lg">
        <div class="text-center mb-3">
          <h2 class="text-3xl font-sans font-semibold bg-gradient-to-t from-red-600 via-blue-400 to-orange-600 pb-2 bg-clip-text text-transparent">Log In</h2>
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
          <div class="flex justify-center items-center mt-4">
            <input type="submit" name="btn" id="submit" value="Log In" class="inline-block px-5 py-3 bg-purple-300 hover:bg-purple-400 text-slate-800 rounded-lg shadow-lg uppercase font-semibold text-sm">
          </div>
          <div class="mx-auto text-sm mt-2">
            <p class="font-sans text-center">Belom punya akun? <a href="../login/reg.php" class="text-indigo-500">Sign Up</a></p>
            <p class="font-sans text-center">Masuk Tanpa akun? <a href="../page/one.php" class="text-indigo-500">Click</a></p>
          </div>
        </div>
      </div>
    </form>
  </body>
</html>