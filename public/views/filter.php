<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css?php echo time(); ?>"/>
    <style>
        .dropdown input:checked + p {
            color: black;
        }
        .dropdownCheck div {
            display: none
        }

        .dropdown input:checked + .dropdownCheck div,
        .dropdown2 input:checked + .dropdownCheck div {
            display: block;
        }

        input[type="text"]:focus {
            outline: none;
        }
    </style>
    </style>
</head>

<body class="font-Work bg-mainColor text-[#f5f6f8] relative">

    <?php include './components/navbar.php'?>

    <div class="flex">
        <div class="flex flex-col gap-6 w-[73%]">
        <!-- FILTER START -->
            <div class="pl-8 pr-6 pt-10 flex flex-col gap-6">
                <div class="flex items-center gap-2">
                    <i class="text-2xl gradient-text-light fa-solid fa-sliders"></i>
                    <p class="font-semibold text-2xl">FILTER</p>
                </div>
                <form action="" method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Search..." autocomplete="off"
                        class="rounded-md text-\[\#f5f6f8\]] h-10 px-4 py-1 w-[900px] bg-lightGray">

                    <button type="button" onclick="showFilter()" 
                    class="bg-gradient-to-r from-pink-600 to-purple-600 font-semibold px-2 py-1 rounded-md flex gap-1 items-center h-10 w-32">
                        <i class="fa-solid fa-plus"></i>ADD FILTER
                    </button>
                </form>
                <!-- FILTER ADDED START -->
                <div class="flex flex-wrap gap-2">
                    <button
                        class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">Action
                        <span class="text-xl">&times;</span></button>
                    <button
                        class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">South
                        Korea <span class="text-xl">&times;</span></button>
                    <button
                        class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">Indonesia
                        <span class="text-xl">&times;</span></button>
                    <button
                        class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">2022
                        <span class="text-xl">&times;</span></button>
                    <button
                        class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">2023
                        <span class="text-xl">&times;</span></button>
                    <button class="border-2 border-white font-medium text-sm px-2 py-1 rounded-md flex items-center gap-2">R
                        <span class="text-xl">&times;</span></button>
                    <button class="underline">Reset Filter</button>
                </div>
                <!-- FILTER ADDED END -->
            </div>
            <!-- FILTER END -->

            <!-- CONTENT START -->
            <div class="flex flex-col pl-9 pr-4 gap-6">
                <div class="flex justify-between w-full items-center">
                    <p class="text-3xl font-semibold text-semiWhite relative -z-10">Showing result for "Avengers"</p>
                </div>
                <div class="flex w-[100%] flex-wrap gap-y-6 gap-x-4">
                    <!--  -->
                    <?php for ($i=0; $i < 10; $i++) { ?>
                    <a href="./detail-movie.php" class="w-[200px] relative z-2">
                        <img class="rounded-md shadow-md" src="../img/avengersHD.jpg" width="200" alt="">
                        <div class="min-h-16 h-fit max-w-full">
                            <div class="flex text-sm gap-2">
                                <p class="border border-1 border-semiWhite px-1 rounded-md">2018</p>
                                <p class="border border-1 border-semiWhite px-1 rounded-md">PG-13</p>
                            </div>
                            <p class="font-semibold">Avengers: Infinity War</p>
                        </div>
                        <p class="absolute -top-2 left-1/2 transform -translate-x-1/2 bg-green-600 px-2 rounded-full font-semibold">8.0</p>
                    </a>
                    <?php } ?>
                    <!--  -->       
                </div>
            </div>
        </div>
        <!-- CONTENT END -->

        <!-- RECENTLY UPDATED START -->
        <div class="w-[27%] h-[100vh]">
            <div class="py-10 pr-8 w-full h-full flex flex-col gap-6">
                <div class="flex gap-2 items-center">
                    <i class="gradient-text-light text-2xl fa-solid fa-rss"></i>
                    <p class="font-bold text-2xl">RECENTLY UPDATED</p>
                </div>
                <div class="h-[100vh] w-full rounded-md">
                    <!--  -->
                    <?php for ($i=0; $i < 9; $i++) { ?>
                    <a href="./detail-movie.php" class="flex h-[80px] w-full gap-2 bg-lightGray rounded-md mb-4 overflow-hidden hover:bg-darkGray transition-colors duration-200 ease-in-out">
                        <img src="../img/avengersHD.jpg" height="80" alt="">

                        <div class="flex flex-col justify-center">
                            <p class="font-light text-sm opacity-50">8.4 / Action / PG-13</p>
                            <p class="font-semibold">Avengers: Infinity War</p>
                        </div>
                    </a>
                    <?php } ?>
                    <!--  -->  
                </div>
            </div>
        </div>
        <!-- RECENTLY UPDATED END -->
    </div>
    
    <!-- PAGINATION START -->
    <div class="w-full flex justify-center items-center h-[20vh]">
        <div class="flex gap-8 items-center">
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                <i class="fa-solid fa-chevron-left"></i>
            </a>
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">1</a>
            <!-- class pageActive untuk page yang sedang dibuka -->
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out pageActive">2</a>
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out ">3</a>
            <p class="unselectable">...</p>
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">7</a>
            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                <i class="fa-solid fa-chevron-right"></i>
            </a>
        </div>
    </div>
    <!-- PAGINATION END -->
    
    <div class="text-semiWhite">    
        <?php include './components/footer.php'?>
    </div>

    <!-- MODAL START -->
    <div class="flex justify-center items-center absolute top-0 left-0 h-[100vh] w-[100vw] backdrop-blur-md  transition-opacity duration-300 ease-in-out z-50 hidden opacity-0" id="modalFilter">
        <div class="bg-lightGray w-[70vw] h-[75vh] p-6 rounded-md shadow-md">
            <div class= "w-full h-full flex flex-col gap-4">
                <p class="text-3xl text-semiWhite font-bold">Advanced Search</p>
                <form action="" method="GET">
                    <div class="flex flex-col gap-4">
                        <p class="text-xl text-semiWhite font-bold">Genre</p>
                        <div  class="flex gap-4 flex-wrap px-4">
                            <?php for ($i=1; $i < 20; $i++) { ?>
                            <label for="genre<?= $i ?>" class="flex gap-4 items-center cursor-pointer">
                                <div class="bg-semiWhite w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-pink-600 to-purple-600 hidden checkedBox"></div>
                                </div>
                                <input type="checkbox" id="genre<?= $i ?>" value="drama" name="genre" class="hidden">
                                <p class="unselectable">Action</p>
                            </label>
                            <?php }  ?>
                        </div>
                        
                        <p class="text-xl text-semiWhite font-bold">Country</p>
                        <div  class="flex gap-4 flex-wrap px-4">
                            <?php for ($i=1; $i < 10; $i++) { ?>
                            <label for="genre<?= $i ?>" class="flex gap-4 items-center cursor-pointer">
                                <div class="bg-semiWhite w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-pink-600 to-purple-600 hidden checkedBox"></div>
                                </div>
                                <input type="checkbox" id="genre<?= $i ?>" value="drama" name="genre" class="hidden">
                                <p class="unselectable">Indonesia</p>
                            </label>
                            <?php }  ?>
                        </div>
                        
                        <p class="text-xl text-semiWhite font-bold">Rating</p>
                        <div  class="flex gap-4 flex-wrap px-4">
                            <?php for ($i=1; $i < 10; $i++) { ?>
                            <label for="genre<?= $i ?>" class="flex gap-4 items-center cursor-pointer">
                                <div class="bg-semiWhite w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-pink-600 to-purple-600 hidden checkedBox"></div>
                                </div>
                                <input type="checkbox" id="genre<?= $i ?>" value="drama" name="genre" class="hidden">
                                <p class="unselectable">5.0</p>
                            </label>
                            <?php }  ?>
                        </div>
                        
                        <p class="text-xl text-semiWhite font-bold">Rating</p>
                        <div  class="flex gap-4 flex-wrap px-4">
                            <?php for ($i=1; $i < 10; $i++) { ?>
                            <label for="genre<?= $i ?>" class="flex gap-4 items-center cursor-pointer">
                                <div class="bg-semiWhite w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="w-3 h-3 rounded-full bg-gradient-to-r from-pink-600 to-purple-600 hidden checkedBox"></div>
                                </div>
                                <input type="checkbox" id="genre<?= $i ?>" value="drama" name="genre" class="hidden">
                                <p class="unselectable">PG-13</p>
                            </label>
                            <?php }  ?>
                        </div>
                        
                        <div class="flex items-center justify-end w-full px-2 gap-4">
                            <button onclick="showFilter()" class="border-2 border-gradient-to-r from-pink-600 to-purple-600 px-4 py-1 font-semibold shadow-sm hover:shadow-md shadow-semiBlack hover:shadow-semiBlack  rounded-lg">Cancel</button>

                            <button type="submit" class="bg-gradient-to-r from-pink-600 to-purple-600 px-4 py-1 font-semibold shadow-sm hover:shadow-md shadow-semiBlack hover:shadow-semiBlack  rounded-lg">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- <button onclick="showFilter()" class=" text-semiWhite absolute top-10 right-10 ">
            <i class="fa-solid fa-xmark"></i>
        </button> -->
    </div>
    <!-- MODAL END -->

    <script src="../js/main.js"></script>
</body>

</html>