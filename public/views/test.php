<?php 
// Setup some additional prefixes for DBpedia
require_once "../../vendor/autoload.php";
\EasyRdf\RdfNamespace::set('dbc', 'http://dbpedia.org/resource/Category:');
\EasyRdf\RdfNamespace::set('dbo', 'http://dbpedia.org/ontology/');
\EasyRdf\RdfNamespace::set('dbpedia', 'http://dbpedia.org/property/');
\EasyRdf\RdfNamespace::set('dbr', 'http://dbpedia.org/resource/');
\EasyRdf\RdfNamespace::set('gold', 'http://purl.org/linguistics/gold/');
\EasyRdf\RdfNamespace::set('dbp', 'http://dbpedia.org/property/');




$sparql = new \EasyRdf\Sparql\Client('http://dbpedia.org/sparql'); ?>

<html>
<head>
<title>EasyRdf Basic Sparql Example</title>

<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<?php
    $result=0;
    $resCountry=$sparql->query(
        'SELECT DISTINCT   ?country   WHERE {'.
        '?country rdf:type yago:WikicatMemberStatesOfTheUnitedNations .'.
        '} ORDER BY ?country '
    );

?>
<body>
<h1>EasyRdf Basic Sparql Example</h1>
<div>
    <h1>List of Countries</h1>
    <form id="" method="GET">
        <input type="text" name="country">
        <input type="submit">
    </form>
</div>


<?php
    if(isset($_GET['country'])){
        $getCountry=$_GET['country'];
        $getCountry=str_replace(' ','_',ucwords($getCountry));
        $result = $sparql->query(
            'SELECT DISTINCT ?movie  WHERE {'.
            '  dbr:' . $getCountry . ' rdf:type dbo:Person ;'.
            '  dbp:birthPlace ?movie .'.
            'FILTER langMatches (lang(?movie),"EN")'.
            '}'
        );
    }
?>

<?php
    if($result):
?>
<h2>List of University</h2>

<h2><?=$getCountry?></h2>


<div class=" mb-3 mt-3" style="width:80% ; margin:auto;">
<table  style="width:100%;  font-weight:bold; " class="table table-striped table-bordered mydatatable">
    <thead style="font-size: 20px;" >
    <tr>
        <td>No</td>
        <td>Name</td>
        <td>Actor</td>
        <td>Action</td>
    </tr>
    </thead>
    <tbody>
        <?php 
        $id=1;
        foreach ($result as $row):
            // print_r($row);
            if($row->movie !=""):
        ?>
    <tr>
        <td><?= $id ?></td>
        <td><?=$row->movie?></td>
        <td><?=$row->actor?></td>
        <td>Action</td>
    </tr>
    <?php $id++;?>
    <?php endif;?>
    <?php endforeach;?>
        
    </tbody>
    <tfoot>
    <tr>
        <td>No</td>
        <td>Country</td>
        <td>Action</td>
    </tr>
    </tfoot>
        
    </table>
    <?php else:?>

    <?php endif;?>
</div>




    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script >
        $(".mydatatable").DataTable();
    </script>

</body>
</html>