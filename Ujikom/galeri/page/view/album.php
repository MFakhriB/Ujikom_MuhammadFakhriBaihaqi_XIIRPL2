<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div>

      <!--Navbar-->
      <div class=" w-full bg-transparent border shadow-lg fixed border-slate-700">
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
      <!--Body-->
      <div class="container px-4 mx-auto font-sans pt-32 grid sm:grid-cols-1 md:grid-2 lg:grid-cols-3 gap-5">
        <?php
        include("../../config/config.php");
        session_start();
        $userID = $_SESSION['user_id'];
        $sql = "SELECT * FROM album WHERE UserID='$userID'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $albumID = $row['AlbumID'];
            $albumName = $row['NamaAlbum'];
            $albumDescription = $row['Deskripsi'];
            $albumDate = $row['TanggalDibuat'];

            // Query to get photos for each album
            $sql_photos = "SELECT * FROM foto WHERE AlbumID='$albumID'";
            $result_photos = mysqli_query($conn, $sql_photos);
        ?>
        <div class="rounded-md shadow-xl overflow-hidden mb-10 px-4">
          <div class="">
            <div class="w-auto">
            <!-- Display album information -->
              <h2 class="text-xl font-semibold"><?= $albumName ?></h2>
                <p><?= $albumDescription ?></p>
                <p>Created: <?= $albumDate ?></p>
            </div>
            <!-- Display photos for each album -->
            <div class="flex flex-wrap justify-center mt-4">
            <?php
              while ($photo_row = mysqli_fetch_assoc($result_photos)) {
            ?>
              <div class="m-2">
                <img src="../../uploads/<?= $photo_row['LokasiFile'] ?>" width="150" height="150" alt="<?= $photo_row['JudulFoto'] ?>" />
              </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
        <?php
            }
          } else {
            echo "<h1 class='mx-auto'>Tidak ada album yang tersedia.</h1>";
          }
          mysqli_close($conn);
        ?>
      </div>
      <div class="w-auto h-12 bg-pink-200 hover:bg-pink-300 rounded-full flex bottom-5 right-5 fixed cursor-pointer px-4 ">
        <a href="../addgaleri/addalbum.php" class="m-auto text-slate-700 flex font-sans"><p class="pr-3 text-md font-bold">+</p> Add New Album</a>
      </div>
    </div>
  </body>
</html>
