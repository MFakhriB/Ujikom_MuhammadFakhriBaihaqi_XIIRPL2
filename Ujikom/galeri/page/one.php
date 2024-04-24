
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Introducing</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body>
    <div style="background-image: url(../img/meja.jpg)" class="bg-fixed">
      <div class="w-full bg-transparent border shadow-lg fixed border-slate-700">
        <nav name="navbar" class="px-10 py-6 font-sans flex justify-evenly backdrop-blur-md">
          <div>
            <a href="#" class="font-bold text-2xl bg-gradient-to-r from-slate-700 via-indigo-600 to-amber-500 bg-clip-text text-transparent">Galeri Skuy</a>
          </div>
          <div class="items-center mx-auto">
            <a href="./add.php" class="font-semibold text-lg text-slate-900 hover:text-slate-90">Add Gallery</a>
          </div>
          <div class="inline-block">
            <a href="../login/reg.php" class="px-2 py-2 hover:px-4 hover:py-4 border border-slate-600 rounded-xl shadow-lg font-semibold text-sm uppercase text-slate-300 hover:bg-gray-300 hover:text-slate-700 duration-200">Log Out</a>
          </div>
        </nav>
      </div>
      <!-- Navbar -->

      <!-- Content -->
      <div class="mx-auto container p-12 pt-32">
        <div class="flex-1 text-center pb-20">
          <h2 class="text-4xl font-semibold text-slate-800">Selamat Datang</h2>
          <p class="text-lg text-slate-700 mt-3">Di Web Galeri Muhammad Fakhri Baihaqi</p>
        </div>
        <div class="border shadow-xl rounded-lg mx-auto p-3 hover:bg-slate-300 duration-100">
          <img src="../img/laptop-1.jpeg" width="100" alt="laptop" class="float-left mr-4 rounded-xl" />
          <p class="text-lg text-slate-800">
            Web galeri adalah sebuah platform daring yang memungkinkan pengguna untuk menyimpan, mengelola, dan berbagi koleksi gambar atau media visual secara online. Dengan adanya web galeri, pengguna dapat dengan mudah membuat album,
            mengatur foto-foto, dan memberikan akses kepada orang lain untuk melihat karya-karya mereka. Keberadaan web galeri juga memudahkan proses berbagi kenangan atau karya seni dengan teman, keluarga, atau masyarakat luas.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident omnis adipisci officia maiores quae nesciunt, rem cum in assumenda totam itaque quos quo harum modi facere repudiandae consectetur libero dicta sunt, nihil animi iure quidem. Dolor tenetur consequatur deleniti aspernatur tempore quod perferendis, commodi accusantium dicta illo, enim voluptatum aperiam?
          </p>
        </div>
      </div>

      <!--Content 2-->
      <div class="mx-auto max-w-full container rounded-t-3xl bg-gradient-to-b from-slate-300 to-white mt-72">
        <div class="p-5 mx-auto pt-10">
          <h2 class="text-slate-700 font-semibold text-center font-sans text-3xl">About Gallery!</h2>
        </div>
        <div class="max-w-full my-10 border border-slate-400 hover:bg-blue-200 rounded-xl p-5 shadow-md font-inter mx-16">
          <h5 class="font-bold text-slate-700 text-lg mb-3 group-hover:text-white">Hello</h5>
          <p class="text-slate-600 group-hover:text-white first-letter:text-7xl first-letter:float-left font-serif first-letter:mr-3">
            Web galeri adalah sebuah platform daring yang memungkinkan pengguna untuk menyimpan, mengelola, dan berbagi koleksi gambar atau media visual secara online. Dengan adanya web galeri, pengguna dapat dengan mudah membuat album,
            mengatur foto-foto, dan memberikan akses kepada orang lain untuk melihat karya-karya mereka. Keberadaan web galeri juga memudahkan proses berbagi kenangan atau karya seni dengan teman, keluarga, atau masyarakat luas.
          </p>
        </div>
        <div class="container mx-auto pl-7 py-4 sm:max-w-sm md:max-w-lg lg:max-w-full font-sans flex mb-40 mt-20">
          <div class="flex-1">
            <h3 class="font-bold text-2xl">Seni dalam Setiap Piksel, Cerita dalam Setiap Klik.</h3>
            <p class="text-slate-700 mt-3">
              Secara keseluruhan, web galeri menjadi alat yang penting dalam era digital ini, memberikan kemudahan dalam berbagi dan mengelola karya visual serta menjadi tempat inspirasi dan apresiasi bagi komunitas seni online.
            </p>
            <div class="mt-4 sm:mt-6">
              <a href="../page/add.php" class="inline-block px-5 py-3 bg-red-400 text-white rounded-lg shadow-lg uppercase font-semibold text-sm">Coba Upload</a>
            </div>
          </div>
          <div class="w-20 md:w-56 lg:w-80 ml-5">
            <img src="../img/laptop-1.jpeg" alt="" class="rounded-l-xl shadow-lg shadow-slate-500 mr-0" />
          </div>
        </div>
        <?php
          include ("../php/footer.php")
        ?>
      </div>
    </div>
  </body>
</html>
