<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?php echo time(); ?>"/>
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
    <title>Judul Movie</title>
</head>

<body class="font-Work transition-colors bg-mainColor relative">
    
    <div class="w-full">
        <?php include './components/navbar.php'?>
    </div>
    
    <!-- BACKGROUND START -->
    <img src="https://media.comicbook.com/2018/03/avengers-infinity-war-poster-1093756.jpeg" class="w-[400px] absolute top-0 left-[570px] -z-50" alt="">
    <div class="absolute top-0 -z-40 h-[100vh] w-full bg-mainColor bg-opacity-30 backdrop-blur-[150px]"></div>
    <!-- BACKGROUND END -->

    <div class="w-full mb-16 px-56 py-8 flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="flex flex-col gap-4">
                <p class="text-5xl font-bold text-semiWhite">Avengers: Infinity War</p>
                <div class="text-sm font-light text-semiWhite flex gap-2">
                    <p>2018</p>
                    <span>&#x2022;</span>
                    <p>PG-13</p>
                    <span>&#x2022;</span>
                    <p>2h 29m</p>
                </div>
            </div>
            <div class="flex gap-2 pr-1 pt-1">
                <i class="fa-solid fa-star text-2xl" style="color: #f6ca2a;"></i>
                <div class="text-semiWhite flex flex-col">
                    <p><span class="font-bold text-2xl">8.4</span> <span class="opacity-80 text-lg">/ 10 </span> </p>
                </div>
            </div>
        </div>
        
        <div class="flex gap-2">
            <img src="../img/avengersHD.jpg" class="w-[278.27px] h-[414.68px] rounded-md" alt="">

            <iframe class="rounded-md shadow-md" width="800" height="414.68" src="https://www.youtube.com/embed/6ZfuNTqbHE8?si=xPPWVnO7LSEXto64&mute=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <div class="flex gap-2 text-semiWhite">
            <a href="" class="border border-semiWhite rounded-full px-2 py-1 opacity-100 hover:opacity-70 transition-opacity duration-300">Action</a>
            <a href="" class="border border-semiWhite rounded-full px-2 py-1 opacity-100 hover:opacity-70 transition-opacity duration-300">Adventure</a>
            <a href="" class="border border-semiWhite rounded-full px-2 py-1 opacity-100 hover:opacity-70 transition-opacity duration-300">Sci-Fi</a>
        </div>

        <p class="text-semiWhite text-lg">The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.</p>
       
        <div class="">
            <div class="flex gap-4 text-semiWhite border-top">
                <b class="w-[100px]">Directors</b>
                <p class="name">Anthony Russo</p>
                <span>&#x2022;</span>
                <p class="name">Joe Russo</p>
            </div>

            <div class="flex gap-4 text-semiWhite border-top">
                <b class="w-[100px]">Writers</b>
                <p class="name">Christopher Markus</p>
                <span>&#x2022;</span>
                <p class="name">Stephen McFeely</p>
                <span>&#x2022;</span>
                <p class="name">Stan Lee</p>
            </div>

            <div class="flex gap-4 text-semiWhite border-top relative">
                <b class="w-[100px]">Casts</b>
                <div class="w-[972px] flex flex-wrap gap-4 absolute right-0 top-0 pt-4">
                    <a href="./actor-profile.php" class="name">Robert Downey Jr.</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Chris Hemsworth</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Mark Ruffalo</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Chris Evans</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Scarlett Johansson</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Don Cheadle</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Benedict Cumberbatch</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Tom Holland</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Chadwick Boseman</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Elizabeth Olsen</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Paul Bettany</a>
                    <span>&#x2022;</span>
                    <a href="./actor-profile.php" class="name">Tom Hiddleston</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-semiWhite">
        <?php include './components/footer.php'?>
    </div>

    <script src="../js/main.js"></script>
</body>
</html>