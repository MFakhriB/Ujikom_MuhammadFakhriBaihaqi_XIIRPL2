<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Gallery</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <div style="background-image: url(../img/meja.jpg)" class="bg-fixed">
    <!-- Navbar -->
    <div class="w-full bg-transparent border shadow-lg fixed border-slate-700">
      <nav name="navbar" class="px-10 py-6 font-sans flex justify-between backdrop-blur-md">
        <div>
          <a href="#" class="font-bold text-2xl bg-gradient-to-r from-slate-700 via-indigo-600 to-amber-500 bg-clip-text text-transparent">Galeri Skuy</a>
        </div>
        <div class="items-center mx-auto">
          <a href="./one.php" class="font-semibold text-lg text-slate-900 hover:text-slate-90">Back To First</a>
        </div>
        <div class="inline-block">
          <a href="../login/reg.php" class="px-2 py-2 hover:px-4 hover:py-4 border border-slate-600 rounded-xl shadow-lg font-semibold text-sm uppercase text-slate-700 hover:bg-gray-300 hover:text-slate-700 duration-200">Log Out</a>
        </div>
      </nav>
    </div>

    <!-- Body -->
    <form action="../page/add.php" method="post" enctype="multipart/form-data">
      <div class="container mx-auto justify-center pb-16">
        <div class="mx-auto container pt-32">
          <div class="flex-1 text-center pb-20">
            <h2 class="text-4xl font-semibold text-slate-800">Tambahkan Galerimu Disini</h2>
          </div>
        </div>
        <div class="mx-auto max-w-sm p-2 shadow-lg rounded-lg hover:bg-slate-300 duration-150 flex backdrop-blur-2xl">
          <svg width="48px" height="48px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000">
            <path d="M21 3.6V20.4C21 20.7314 20.7314 21 20.4 21H3.6C3.26863 21 3 20.7314 3 20.4V3.6C3 3.26863 3.26863 3 3.6 3H20.4C20.7314 3 21 3.26863 21 3.6Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M3 16L10 13L21 18" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M16 10C14.8954 10 14 9.10457 14 8C14 6.89543 14.8954 6 16 6C17.1046 6 18 6.89543 18 8C18 9.10457 17.1046 10 16 10Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
          <div class="justify-center mx-auto">
            <h1 class="text-2xl text-slate-700 font-sans text-center pt-2 font-semibold"><a href="../page/view/post.php">Tambah Galeri</a></h1>
          </div>
        </div>
      </div>
    </form>

    <!--Content-->
    <div class="mx-auto max-w-full container rounded-t-3xl bg-gradient-to-b from-slate-300 to-white mt-60">
      <div class="p-5 mx-auto pt-10">
        <h2 class="text-slate-700 font-semibold text-center font-sans text-3xl">Collect Your Gallery!</h2>
      </div>
      <div class="max-w-full my-10 border border-slate-400 hover:bg-slate-600 rounded-xl p-5 shadow-md font-inter mx-16 bg-slate-700">
        <h5 class="font-bold text-slate-100 text-lg mb-3 group-hover:text-white">Hello</h5>
        <p class="text-slate-100 group-hover:text-white first-letter:text-7xl first-letter:float-left font-serif first-letter:mr-3">
          Web galeri adalah sebuah platform daring yang memungkinkan pengguna untuk menyimpan, mengelola, dan berbagi koleksi gambar atau media visual secara online. Dengan adanya web galeri, pengguna dapat dengan mudah membuat album,
          mengatur foto-foto, dan memberikan akses kepada orang lain untuk melihat karya-karya mereka. Keberadaan web galeri juga memudahkan proses berbagi kenangan atau karya seni dengan teman, keluarga, atau masyarakat luas.
        </p>
      </div>
      <div class="container mx-auto px-7 py-4 sm:max-w-sm md:max-w-lg lg:max-w-full font-sans mb-40 mt-20 grid grid-cols-4">
        <div class="mx-auto rounded-lg shadow-md">
          <img src="https://source.unsplash.com/1900x2000" alt="" width="300px" class=" rounded-lg shadow-md">
        </div>
        <div class="mx-auto rounded-lg shadow-md">
          <img src="https://source.unsplash.com/1901x2000" alt="" width="300px" class=" rounded-lg shadow-md">
        </div>
        <div class="mx-auto rounded-lg shadow-md">
          <img src="https://source.unsplash.com/1902x2000" alt="" width="300px" class=" rounded-lg shadow-md">
        </div>
        <div class="mx-auto rounded-lg shadow-md">
          <img src="https://source.unsplash.com/1903x2000" alt="" width="300px" class=" rounded-lg shadow-md">
        </div>
      </div>
      <?php
        include ("../php/footer.php")
      ?>
    </div>
  </div>
</body>
</html>