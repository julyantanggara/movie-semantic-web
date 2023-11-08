<?php 
// require_once "../../vendor/autoload.php";
require_once realpath(__DIR__ . '../../../') . "/vendor/autoload.php";

// Setup some additional prefixes for DBpedia
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('movie', 'https://example.org/schema/movie');
\EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('rdf', 'http://www.w3.org/1999/02/22-rdf-syntax-ns#');
\EasyRdf\RdfNamespace::set('rdfs', 'http://www.w3.org/2000/01/rdf-schema#');
\EasyRdf\RdfNamespace::set('foaf', 'http://xmlns.com/foaf/0.1/');

$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql');
$sparql_jena = new \EasyRdf\Sparql\Client('http://localhost:3030/Tubes_WS/sparql');

$q='SELECT DISTINCT * WHERE {' .
    '?movie rdf:type movie:search;' .
    '				rdfs:label ?moviename;' .
    '				movie:abstract ?abstract;' .
		'				movie:wiki ?wiki;'.
		'				movie:rating ?rating;'.
		'				movie:category ?category;' .
		// '				movie:genre ?genre;'.
		'				movie:country ?country'.
    '}';

  $result_all = $sparql_jena->query($q);



	// foreach ($result as $row) {
	// 	$wiki = $sparql->query(
	// 		'SELECT DISTINCT * WHERE {' .
	// 		'?movie rdfs:label "' . $row->moviename . '" ;'.
	// 		' 			foaf:isPrimaryTopicOf ?wiki' .
	// 		'}'
	// 		);
	// }

?>

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
					<!-- movie First-->
					<?php foreach($result_all as $res) :
						\EasyRdf\RdfNamespace::setDefault('og');
						$wiki= \EasyRdf\Graph::newAndLoad($res->wiki);
						$foto_url =$wiki->image;

						$genre='SELECT DISTINCT ?genre WHERE {' .
							'?movie rdf:type movie:search;' .
							'				rdfs:label "'. $res->moviename .'" ;' .
							'				movie:genre ?genre;'.
							'}';
					
						$result_genre = $sparql_jena->query($genre);
						print_r($result_genre);
					?>
            <a href="./detail-movie.php?movie=<?= $res->moviename ?>">
                <div class="w-[100vw] h-[65vh] relative">
                    <div class="absolute left-8 -bottom-32 z-20 flex items-end justify-between gap-8">
                        <img src="<?= $foto_url ?>" class="w-56 shadow-md shadow-semiBlack" alt="">

                        <div class="flex flex-col gap-2 z-50">
                            <p class="text-5xl text-[#f5f6f8] font-semibold gradient-text-light"><?= $res->moviename ?></p>
                            <div class="flex gap-4 gradient-text-light font-semibold">
                                <div class="flex items-center gap-2 ">
                                    <i class="fa-solid fa-star"></i> 
                                    <p><?= $res->rating ?></p>
                                </div>
                                <p><?= $res->category ?></p>
																<?php foreach($result_genre as $genre) : ?>
                                <p><?= $genre->genre ?></p>
																<?php endforeach?>
                            </div>
                            <p class="text-[#f5f6f8] w-[50vw]"><?= substr($res->abstract, 0, 250) . "..." ?></p>
                        </div>
                    </div>
                </div>
            </a>
						<?php break; 
						endforeach ?>
						<!-- movie first -->
            
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
                            <?php foreach($result_all as $res) :
																\EasyRdf\RdfNamespace::setDefault('og');
																$wiki= \EasyRdf\Graph::newAndLoad($res->wiki);
																$foto_url =$wiki->image;
															?>

                            <div class="inline-block px-3">
                                <a href="./detail-movie.php?movie=<?= $res->moviename ?>">
                                    <div class="w-64 h-[370px] max-w-xs overflow-hidden rounded-lg shadow-md bg-white hover:shadow-xl transition-shadow duration-300 ease-in-out">
                                        <img src="<?= $foto_url ?>" alt="" width="100%">
                                    </div>
                                </a>
                            </div>
                            <?php endforeach ?>
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