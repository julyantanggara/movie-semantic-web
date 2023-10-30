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
    </style>
</head>

<body class="font-Work bg-mainColor text-[#f5f6f8]">

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
                        class="rounded-md text-\[\#f5f6f8\]] h-10 px-4 py-1 w-64 bg-lightGray">

                    <button onclick="showGenreDropdown()" type="button"
                        class="text-\[\#f5f6f8\]] w-40 h-10 px-4 py-2 bg-lightGray rounded-md relative">
                        <div class="flex justify-between w-full items-center">
                            Genre <i id="GenreDropdownIcon" class="fa-solid fa-caret-down"></i>
                        </div>
                        <!-- GENRE DROPDOWN START -->
                        <div id="GenreFilterDropdown"
                            class="w-[350px] overflow-hidden p-4 absolute hidden left-0 top-12 rounded-md bg-lightGray flex flex-wrap shadow-md">
                            <label for="drama" class="dropdown flex gap-2 cursor-pointer w-[150px] items-center">
                                <input type="checkbox" name="genre" class="genre-checkbox" id="drama" value="drama">
                                <div class="bg-white w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="bg-gradient-to-r from-pink-600 to-purple-600 rounded-full w-3 h-3 hidden"></div>
                                </div>
                                <p>Drama</p>
                            </label>
                            <label for="horror" class="dropdown flex gap-2 cursor-pointer w-[150px] items-center">
                                <input type="checkbox" name="genre" class="genre-checkbox" id="horror">
                                <div class="bg-white w-4 h-4 flex justify-center items-center rounded-full">
                                    <div class="bg-gradient-to-r from-pink-600 to-purple-600 rounded-full w-3 h-3"></div>
                                </div>
                                <p>Horror</p>
                            </label>
                        </div>
                        <!-- GENRE DROPDOWN END -->
                    </button>

                    <button onclick="showCountryDropdown()" type="button"
                        class="text-\[\#f5f6f8\]] w-40 h-10 px-4 py-2 bg-lightGray rounded-md relative">
                        <div class="flex justify-between w-full items-center">
                            Country <i id="CountryDropdownIcon" class="fa-solid fa-caret-down"></i>
                        </div>
                        <!-- COUNTRY DROPDOWN START -->
                        <div id="CountryFilterDropdown"
                            class="w-[350px] overflow-hidden p-4 absolute hidden left-0 top-12 rounded-md bg-lightGray flex flex-wrap shadow-md">
                            <input type="checkbox" name="" id="australia">
                            <label for="australia" class="dropdown flex gap-2 cursor-pointer w-[150px]">
                                <p>Australia</p>
                            </label>
                            <label for="brazil" class="dropdown flex gap-2 cursor-pointer w-[150px]">
                                <input type="checkbox" name="" id="brazil">
                                <p>Brazil</p>
                            </label>
                        </div>
                        <!-- COUNTRY DROPDOWN END -->
                    </button>

                    <button onclick="showYearDropdown()" type="button"
                        class="text-\[\#f5f6f8\]] w-40 h-10 px-4 py-2 bg-lightGray rounded-md relative">
                        <div class="flex justify-between w-full items-center">
                            Year <i id="YearDropdownIcon" class="fa-solid fa-caret-down"></i>
                        </div>
                        <!-- YEAR DROPDOWN START -->
                        <div id="YearFilterDropdown"
                            class="w-[420px] overflow-hidden p-4 absolute hidden left-0 top-12 rounded-md bg-lightGray flex flex-wrap shadow-md">
                            <label for="2023" class="flex gap-2 cursor-pointer w-[115px] dropdown">
                                <input type="checkbox" name="" id="2023">
                                <p>2023</p>
                            </label>
                            <label for="2022" class="flex gap-2 cursor-pointer w-[115px] dropdown">
                                <input type="checkbox" id="checkbox2022" name="">
                                <p>2022</p>
                            </label>
                        </div>
                        <!-- YEAR DROPDOWN END -->
                    </button>

                    <button onclick="showRatingDropdown()" type="button"
                        class="text-\[\#f5f6f8\]] w-40 h-10 px-4 py-2 bg-lightGray rounded-md relative">
                        <div class="flex justify-between w-full items-center">
                            Rating <i id="RatingDropdownIcon" class="fa-solid fa-caret-down"></i>
                        </div>
                        <!-- RATING DROPDOWN START -->
                        <div id="RatingFilterDropdown"
                            class="w-[420px] overflow-hidden p-4 absolute hidden left-0 top-12 rounded-md bg-lightGray flex flex-wrap shadow-md">
                            <label for="12" class="flex gap-2 cursor-pointer w-[115px] dropdown">
                                <input type="checkbox" name="" id="12">
                                <p>12</p>
                            </label>
                            <label for="13plus" class="flex gap-2 cursor-pointer w-[115px] dropdown">
                                <input type="checkbox" name="" id="13plus">
                                <p>13+</p>
                            </label>
                        </div>
                        <!-- RATING DROPDOWN END -->
                    </button>

                    <button type="submit"
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
                    <a href="./detail-movie.php" class="w-[200px] relative z-10">
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
                    <a href="./detail-movie.php" class="flex h-[80px] w-full gap-2 bg-lightGray rounded-md mb-4 overflow-hidden hover:bg-darkGray transition-colors duration-200 ease-in-out">
                        <img src="../img/avengersHD.jpg" height="80" alt="">

                        <div class="flex flex-col justify-center">
                            <p class="font-light text-sm opacity-50">8.4 / Action / PG-13</p>
                            <p class="font-semibold">Avengers: Infinity War</p>
                        </div>
                    </a>
                    
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

    <?php include './components/footer.php'?>

    <script src="../js/main.js"></script>
</body>

</html>