<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home | Movie</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css?php echo time(); ?>"/>
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Work transition-color bg-mainColor relative">
    
    <div class="absolute w-full z-40">
        <?php include './components/navbar.php'?>
    </div>

    <!-- CONTENT START -->
    <main class="">
        <div class="flex flex-col">
            <a href="./detail-movie.php">
                <div class="w-[100vw] h-[65vh] relative">
                    <video class="absolute top-0 -z-50 w-[100vw] brightness-50" data-uia="our-story-card-video" autoplay="" playsinline="" muted="" loop=""><source src="../img/IWTrailer.mp4" type="video/mp4"></video> 

                    <div class="absolute left-8 -bottom-32 z-20 flex items-end justify-between gap-8">
                        <img src="../img/avengersHD.jpg" class="w-56 shadow-md shadow-semiBlack" alt="">

                        <div class="flex flex-col gap-2 z-50">
                            <p class="text-5xl text-[#f5f6f8] font-semibold gradient-text-light">Avengers: Infinity War</p>
                            <div class="flex gap-4 gradient-text-light font-semibold">
                                <div class="flex items-center gap-2 ">
                                    <i class="fa-solid fa-star"></i> 
                                    <p>8.4</p>
                                </div>
                                <p>PG-13</p>
                                <p>2018</p>
                                <p>Action</p>
                                <p>Adventure</p>
                                <p>Sci-Fi</p>
                            </div>
                            <p class="text-[#f5f6f8] w-[50vw]">The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.</p>
                        </div>
                    </div>
                </div>
            </a>
            
            <div class="w-[100vw] h-[150px] half-gradient pl-[310px] rounded-custom"></div>

            <div class="w-[100vw] flex flex-col pt-4 pl-9 gap-12">
                
                <!-- POPULAR MOVIES START -->
                <p class="text-4xl text-white font-semibold">Popular Movies</p>
                <div class="w-full relative">
                    <div class="flex overflow-x-scroll pb-10 hide-scroll-bar">
                        <button class="scroll-button left bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollLeft">
                            <i class="text-white text-2xl fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="scroll-button right bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollRight">
                            <i class="text-white text-2xl fa-solid fa-chevron-right"></i>
                        </button>
                        <div class="flex flex-nowrap lg:ml-10 md:ml-10 ml-0">
                            <?php for ($i = 0; $i < 15; $i++) { ?>
                            <div class="inline-block px-3">
                                <a href="./detail-movie.php">
                                    <div class="w-64 h-[370px] max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                        <img src="../img/avengersHD.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- POPULAR MOVIES END -->

                <?php
                    $genres = [
                        "Action",
                        "Comedy",
                        "Drama",
                        "Horror",
                        "Romance",
                        "Science Fiction",
                        "Fantasy",
                        "Thriller",
                        "Animation",
                        "Crime",
                        "Adventure",
                        "Mystery",
                        "Family",
                        "Documentary",
                        "Musical",
                        "Western",
                        "Historical",
                        "Superhero",
                        "War"
                    ];
                ?>

                <!-- GENRE START -->
                <div class="flex flex-col items-center gap-10">
                    <p class="text-4xl text-white font-semibold">Genre</p>
                    <div class="flex flex-wrap gap-4 items-center justify-center w-[80%]">
                        <?php
                            foreach ($genres as $genre) {   
                        ?>
                        <a class="py-3 px-5 text-xl bg-mainColor text-white font-semibold border-2 border-white rounded-full hover:bg-white hover:text-mainColor transition-colors duration-300 ease-in-out cursor-pointer"><?= $genre ?></a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <!-- GENRE END -->
                        
                <!-- ACTION MOVIES START -->
                <p class="text-4xl text-white font-semibold">Action Movies</p>
                <div class="w-full relative">
                    <div class="flex overflow-x-scroll2 pb-10 hide-scroll-bar">
                        <button class="scroll-button left bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollLeft2">
                            <i class="text-white text-2xl fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="scroll-button right bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollRight2">
                            <i class="text-white text-2xl fa-solid fa-chevron-right"></i>
                        </button>
                        <div class="flex flex-nowrap lg:ml-10 md:ml-10 ml-0">
                            <?php for ($i = 0; $i < 15; $i++) { ?>
                            <div class="inline-block px-3">
                                <a href="./detail-movie.php">
                                    <div class="w-64 h-[370px] max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                        <img src="../img/avengersHD.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- ACTION MOVIES END -->
                
                <!-- HORROR MOVIES START -->
                <p class="text-4xl text-white font-semibold">Horror Movies</p>
                <div class="w-full relative">
                    <div class="flex overflow-x-scroll3 pb-10 hide-scroll-bar">
                        <button class="scroll-button left bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollLeft3">
                            <i class="text-white text-2xl fa-solid fa-chevron-left"></i>
                        </button>
                        <button class="scroll-button right bg-mainColor bg-opacity-60 h-full flex items-center justify-center" id="scrollRight3">
                            <i class="text-white text-2xl fa-solid fa-chevron-right"></i>
                        </button>
                        <div class="flex flex-nowrap lg:ml-10 md:ml-10 ml-0">
                            <?php for ($i = 0; $i < 15; $i++) { ?>
                            <div class="inline-block px-3">
                                <a href="./detail-movie.php">
                                    <div class="w-64 h-[370px] max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                        <img src="../img/avengersHD.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <!-- HORROR MOVIES END -->

            </div>

            <div class="h-[60vh] flex flex-col items-center justify-center">
                <!--  -->
                <div class="text-semiWhite text-6xl font-bold flex gap-4">
                    <p class="box" data-duration="3000"> 4000</p>
                    <p>Data</p>
                </div>
                <i class="text-semiWhite">insert text here</i>
                <!--  -->
            </div>
        </div>
    </main>
    <!-- CONTENT END -->
    
    <div class="text-semiWhite">
        <?php include './components/footer.php'?>
    </div>
    
    <script
        src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
        crossorigin="anonymous">
    </script>
    <script src="../js/main.js"></script>
    <script src="../js/dataCounter.js"></script>
</body>

</html>