<?php 
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

$director='SELECT DISTINCT ?director WHERE {' .
    '?movie rdfs:label "'. $_GET['movie'] .'"@en .' .
    '?movie dbo:director ?director .'.
    '}';

$result_director = $sparql->query($director);

$writer='SELECT DISTINCT ?writer WHERE {' .
    '?movie rdfs:label "'. $_GET['movie'] .'"@en .' .
    '?movie dbo:writer ?writer .'.
    '}';

$result_writer = $sparql->query($writer);

$starring='SELECT DISTINCT ?starring WHERE {' .
    '?movie rdfs:label "'. $_GET['movie'] .'"@en .' .
    '?movie dbo:starring ?starring .'.
    '}';

$result_starring = $sparql->query($starring);

    $q='SELECT DISTINCT * WHERE {' .
        '?movie rdf:type movie:search;' .
        '	    rdfs:label "'. $_GET['movie'] .'";' .
        '		movie:abstract ?abstract;' .
        '		movie:wiki ?wiki;'.
        '		movie:rating ?rating;'.
        '		movie:category ?category;' .
        '		movie:country ?country;'.
        '       foaf:trailer ?trailer' .
        // '		movie:genre ?genre;'.
        '}';

    $result_all = $sparql_jena->query($q);

    $details = [];

    foreach ($result_all as $row) {
        $details = [
            "moviename" => $_GET['movie']??null,
            "rating" => $row->rating ?? null,
            "category"=>$row->category??null,
            "wiki"=>$row->wiki ??null ,
            "trailer"=>$row->trailer ??null,
            "abstract"=>$row->abstract??null,
            "country"=>$row->country??null,
        ];
        break;
    }

    \EasyRdf\RdfNamespace::setDefault('og');
    $wiki= \EasyRdf\Graph::newAndLoad($details['wiki']);
    $foto_url =$wiki->image;

    $genre='SELECT DISTINCT ?genre WHERE {' .
        '?movie rdf:type movie:search ;' .
        '		rdfs:label "'. $details['moviename'] .'" ;' .
        '		movie:genre ?genre;'.
        '}';
    $result_genre = $sparql_jena->query($genre);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css?php echo time(); ?>"/>
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
    <title><?= $details['moviename'] ?></title>
</head>

<body class="font-Work transition-colors bg-mainColor relative">
    
    <div class="w-full">
        <?php include './components/navbar.php'?>
    </div>
    
    <!-- BACKGROUND START -->
    <img src="<?= $foto_url ?>" class="w-[400px] absolute top-0 left-[570px] -z-50" alt="">
    <div class="absolute top-0 -z-40 h-[100vh] w-full bg-mainColor bg-opacity-30 backdrop-blur-[150px]"></div>
    <!-- BACKGROUND END -->

    <div class="w-full mb-16 px-56 py-8 flex flex-col gap-4">
        <div class="flex justify-between">
            <div class="flex flex-col gap-4">
                <p class="text-5xl font-bold text-semiWhite"><?= $details['moviename'] ?></p>
                <div class="text-sm font-light text-semiWhite flex gap-2">
                    <p>2018</p>
                    <span>&#x2022;</span>
                    <p><?= $details['category'] ?></p>
                    <span>&#x2022;</span>
                    <p>2h 29m</p>
                    <span>&#x2022;</span>
                    <p><?= $details['country'] ?></p>
                </div>
            </div>
            <div class="flex gap-2 pr-1 pt-1">
                <i class="fa-solid fa-star text-2xl" style="color: #f6ca2a;"></i>
                <div class="text-semiWhite flex flex-col">
                    <p><span class="font-bold text-2xl"><?= $details['rating'] ?></span> <span class="opacity-80 text-lg">/ 10 </span> </p>
                </div>
            </div>
        </div>
        
        <div class="flex gap-2">
            <img src="<?= $foto_url ?>" class="w-[278.27px] h-[414.68px] rounded-md" alt="">

            <iframe class="rounded-md shadow-md" width="800" height="414.68" src="<?= $details['trailer'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>

        <div class="flex gap-2 text-semiWhite">
            <?php foreach($result_genre as $genre): ?>
            <a href="" class="border border-semiWhite rounded-full px-2 py-1 opacity-100 hover:opacity-70 transition-opacity duration-300"><?= $genre->genre ?></a>
            <?php endforeach ?>
        </div>

        <p class="text-semiWhite text-lg"><?= $details['abstract'] ?></p>

        <div class="">
            <div class="flex gap-4 text-semiWhite border-top">
                <b class="w-[100px]">Directors</b>
                <?php foreach($result_director as $director): ?>
                <span>&#x2022;</span>
                <p class="name"><?= str_replace("http://dbpedia.org/resource/", "",$director->director) ?></p>
                <?php endforeach ?>
            </div>

            <div class="flex gap-4 text-semiWhite border-top">
                <b class="w-[100px]">Writers</b>
                <?php foreach($result_writer as $writer): ?>
                <span>&#x2022;</span>
                <p class="name"><?= str_replace("http://dbpedia.org/resource/", "",$writer->writer) ?></p>
                <?php endforeach ?>
            </div>

            <div class="flex gap-4 text-semiWhite border-top relative">
                <b class="w-[100px]">Casts</b>
                <div class="w-[972px] flex flex-wrap gap-4 absolute right-0 top-0 pt-4">
                <?php foreach($result_starring as $starring): ?>
                <span>&#x2022;</span>
                <p class="name"><?= str_replace("http://dbpedia.org/resource/", "",$starring->starring) ?></p>
                <?php endforeach ?>
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