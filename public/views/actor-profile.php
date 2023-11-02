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

<body class="font-Work transition-colors bg-semiWhite">
    
    <div class="w-full bg-mainColor">
        <?php include './components/navbar.php'?>
    </div>
    
    <div class="profile-radius bg-mainColor h-[50vh] flex flex-col gap-8 justify-center items-center">
        <img class="rounded-full w-40 h-40 object-cover"
        src="https://akcdn.detik.net.id/visual/2019/09/11/762f1f2b-443b-41d8-9646-ad94598c2339_43.jpeg?w=360&q=90" alt="">
        <div class="flex flex-col items-center gap-2 relative w-full">
            <p class="text-4xl text-semiWhite font-bold">Chris Evans</p>
            <p class="text-xl text-semiWhite opacity-50">Actor</p>
            <p class="text-lg text-semiWhite opacity-50 flex items-center gap-1 cursor-pointer" id="location"><i class="fa-solid fa-location-dot"></i> USA</p>

            <div class="absolute -bottom-40 right-60 bg-transparent justify-end hidden w-[500px]" id="map">
                <div class="bg-semiWhite p-2 shadow-lg rounded-md ">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d21227025.39328672!2d-103.285865!3d49.499813!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sAmerika%20Serikat!5e0!3m2!1sid!2sid!4v1698634959917!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-72 py-8 flex flex-col gap-14">
        <div class="gap-4 flex flex-col">
            <div class="text-mainColor flex gap-2 items-center text-3xl">
                <i class="fa-solid fa-grip-lines-vertical gradient-text-light"></i>
                <p class="font-bold">Mini Bio</p>
            </div>
        
            <div class="">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero et voluptatibus inventore, maiores autem similique est animi voluptas, vero, corporis deleniti rerum tenetur nemo iste aut veritatis illum! Aliquam, cupiditate! Consectetur, deserunt libero assumenda sit mollitia accusantium architecto ipsum inventore quae sunt excepturi totam voluptatem voluptate? Consequatur minus tempore quod?</p>
            </div>        
        </div>
        
        <div class="gap-4 flex flex-col">
            <div class="text-mainColor flex gap-2 items-center text-3xl">
                <i class="fa-solid fa-grip-lines-vertical gradient-text-light"></i>
                <p class="font-bold">Overview</p>
            </div>
        
            <div class="">
                <div class="border-bottom flex gap-4 h-[50px]">
                    <p class="font-bold">Born</p>
                    <p class="name">June 13, 1981 · Boston, Massachusetts, USA</p>
                </div>
                <div class="border-bottom flex gap-4 h-[50px]">
                    <p class="font-bold">Birth name</p>
                    <p class="name">Christopher Robert Evans</p>
                </div>
                <div class="border-bottom flex gap-4 h-[50px]">
                    <p class="font-bold">Nickname</p>
                    <p class="name">Cevans</p>
                </div>
                <div class="border-bottom flex gap-4 h-[50px]">
                    <p class="font-bold">Age</p>
                    <p class="name">42</p>
                </div>
                <div class="border-bottom flex gap-4 h-[50px]">
                    <p class="font-bold">Height</p>
                    <p class="name">6′ (1.83 m)</p>
                </div>
            </div>        
        </div>
        
        <div class="gap-4 flex flex-col">
            <div class="text-mainColor flex gap-2 items-center text-3xl">
                <i class="fa-solid fa-grip-lines-vertical gradient-text-light"></i>
                <p class="font-bold">Movies</p>
            </div>

            <div class="">
                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Captain America: The Winter Soldier</a>
                    <p class="name">2014</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">The Avengers</a>
                    <p class="name">2012</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Captain America: Civil War</a>
                    <p class="name">2016</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Snowpiercer</a>
                    <p class="name">2013</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Scott Pilgrim vs. The World</a>
                    <p class="name">2010</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Knives Out</a>
                    <p class="name">2019</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Captain America: The First Avenger</a>
                    <p class="name">2011</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Avengers: Endgame</a>
                    <p class="name">2019</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Fantastic Four</a>
                    <p class="name">2005</p>
                </div>

                <div class="border-bottom flex gap-4 h-[50px] justify-between">
                    <a href="./detail-movie.php" class="font-bold hover:underline">Sunshine</a>
                    <p class="name">2007</p>
                </div>
            </div>        
        </div>

        
    </div>
    
    <div class="text-mainColor">
        <?php include './components/footer.php'?>
    </div>

    <script>
        const location = document.getElementById('location');
        const map = document.getElementById('map');

        location.addEventListener('mouseover', () => {
            map.classList.remove('hidden');
        });

        location.addEventListener('mouseout', () => {
            map.classList.add('hidden');
        });
    </script>
    <script src="../js/main.js"></script>
</body>
</html>