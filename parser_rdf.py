from flask import Flask, render_template
from rdflib import Graph
import requests
from bs4 import BeautifulSoup
from rdflib import Namespace
from SPARQLWrapper import SPARQLWrapper, JSON

app = Flask(__name__)

# deklarasi namespace
dbo = Namespace("http://dbpedia.org/ontology/")
dbc = Namespace ("http://dbpedia.org/resource/Category:")
dbpedia = Namespace ("http://dbpedia.org/property/")
dbr = Namespace ("http://dbpedia.org/resource/")
movie = Namespace ("https://example.org/schema/movie")
gold = Namespace ("http://purl.org/linguistics/gold/")
dbp = Namespace ("http://dbpedia.org/property/")
rdf = Namespace ("http://www.w3.org/1999/02/22-rdf-syntax-ns#")
rdfs= Namespace ("http://www.w3.org/2000/01/rdf-schema#")
foaf = Namespace("http://xmlns.com/foaf/0.1/")
prov = Namespace("http://www.w3.org/ns/prov#") 

#untuk mova.rdf
g = Graph()
g.parse("mova.rdf", format="xml")

#untuk mencegah tidak terbacanya prefix
g.bind("dbo", dbo)
g.bind("rdfs", rdfs)
g.bind("prov",prov)

#set up SPARQL endpoint dbpedia
sparql = SPARQLWrapper("http://dbpedia.org/sparql")


# web scrapping menggunakan module BeautifulSoup
def get_wikilink_image_url(wikilink):
    response = requests.get(wikilink)
    wikipedia_content = response.text

    soup = BeautifulSoup(wikipedia_content, 'html.parser')

    img_element = soup.find('img', class_="mw-file-element")
    if img_element:
        image_url = img_element['src']
        return image_url 
#route awal
@app.route('/')
def display_index():
    return render_template('index.html')

#route home
@app.route('/home')
def display_rdf_data():
    # query semua movie
    query = """
    SELECT DISTINCT * WHERE {
        ?movie rdf:type movie:search;
            rdfs:label ?moviename;
            movie:abstract ?abstract;
            movie:wiki ?wiki;
            movie:rating ?rating;
            movie:category ?category;
            movie:year ?year;
            movie:country ?country.
    } ORDER BY DESC(?rating)
    """
    #query movie genre action
    movie_action_query = """
    SELECT DISTINCT * WHERE {
        ?movie rdf:type movie:search;
            movie:genre "Action";
            rdfs:label ?moviename;
            movie:wiki ?wiki;
            movie:rating ?rating;
            movie:category ?category;
            movie:year ?year;
            movie:country ?country.
    } ORDER BY DESC(?rating)
    """
    #query movie genre drama
    movie_drama_query = """
    SELECT DISTINCT * WHERE {
        ?movie rdf:type movie:search;
            movie:genre "Drama";
            rdfs:label ?moviename;
            movie:wiki ?wiki;
            movie:rating ?rating;
            movie:category ?category;
            movie:year ?year;
            movie:country ?country.
    } ORDER BY DESC(?rating)
    """

    # query utk menampilkan semua genre
    genre_all_query = """
    SELECT DISTINCT ?genre WHERE {
        ?movie rdf:type movie:search;
            movie:genre ?genre.
    }
    """
    
    # query utk jumlahin movie
    movie_count_query = """
    SELECT DISTINCT (COUNT(*) AS ?jumlah) WHERE {
        ?movie rdf:type movie:search.
    }
    """

    # eksekusi query
    results = g.query(query)
    movies_action = g.query(movie_action_query)
    movies_drama = g.query(movie_drama_query)
    genres = g.query(genre_all_query)
    movie_count_results = g.query(movie_count_query)

    #menghitung jumlah movie
    moviecount = 0
    for res in movie_count_results:
        moviecount = res['jumlah']

    #krn banyak row, declare menjadi array terlebih dahulu
    data_to_display = {
        'movies_all': [],
        'movies_action': [],
        'movies_drama': [],
        'genres': [row['genre'] for row in genres],
        'moviecount': moviecount,
    }

    #berasal dari 1 query, pisahkan masing2 menjadi sebuah variable
    for row in results:
        moviename = row['moviename']
        abstract = row['abstract']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_all'].append({
            'moviename': moviename,
            'abstract': abstract,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    for row in movies_action:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_action'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    for row in movies_drama:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_drama'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    return render_template('home.html', data=data_to_display)


#fungsinya sama seperti movie?=... 
@app.route('/detail-movie/<string:moviename>')
def movie_detail(moviename):
    # query director
    director_query = '''
        SELECT DISTINCT ?director WHERE {
            ?movie rdfs:label "'''+moviename+'''"@en;
                dbo:director ?director .
        }
    '''
    sparql.setQuery(director_query)
    sparql.setReturnFormat(JSON)
    results_director = sparql.query().convert()

    director = [row['director']['value'].replace("http://dbpedia.org/resource/", "") for row in results_director["results"]["bindings"]]

    # query writer
    writer_query = '''
        SELECT DISTINCT ?writer WHERE {
            ?movie rdfs:label "'''+moviename+'''"@en;
                   dbo:writer ?writer .
        }
    '''
    sparql.setQuery(writer_query)
    sparql.setReturnFormat(JSON)
    result_writer = sparql.query().convert()
    writer = [row['writer']['value'].replace("http://dbpedia.org/resource/", "") for row in result_writer["results"]["bindings"]]

    # query writer
    starring_query = '''
        SELECT DISTINCT ?starring WHERE {
            ?movie rdfs:label "'''+moviename+'''"@en .
            ?movie dbo:starring ?starring .
        }
    '''
    sparql.setQuery(starring_query)
    sparql.setReturnFormat(JSON)
    result_starring = sparql.query().convert()
    starring = [row['starring']['value'].replace("http://dbpedia.org/resource/", "") for row in result_starring["results"]["bindings"]]

    #krn genre bisa banyak, maka declare sebagai array terlebih dahulu
    genre=[]
    main_query = '''
        SELECT DISTINCT * WHERE {
            ?movie rdf:type movie:search;
                rdfs:label "'''+moviename+'''";
                movie:abstract ?abstract;
                movie:wiki ?wiki ; 
                movie:rating ?rating ;
                movie:category ?category ;
                movie:country ?country ;
                foaf:trailer ?trailer ;
                movie:year ?year ;
                movie:time ?time ;
                movie:genre ?genre .
        }
    '''

    result_all = g.query(main_query)
    for row in result_all:
        abstract = row['abstract']
        rating = row['rating']
        category = row['category']
        genre.append(row['genre'])
        wiki = row['wiki']
        trailer = row['trailer']
        country = row['country']
        year = row['year']
        time = row['time']

    
    details = {
        "moviename": moviename,
        "director": director,
        "abstract": abstract,
        "writer": writer,
        "starring": starring,
        "rating": rating,
        "category": category,
        "genre": genre,
        "wiki": wiki,
        "trailer": trailer,
        "country": country,
        "year": year,
        "time": time,
        "image_url": get_wikilink_image_url(wiki) if wiki else None,
    }

    return render_template('detail-movie.html', details=details)

@app.route('/detail/<string:role>/<string:name>')
def detail_page(role, name):
    original_string = name
    converted_string = original_string.replace('_', ' ')

    display = {}

    if role == "director":
        director_query = '''
            SELECT DISTINCT * WHERE {
                ?director rdfs:label "'''+converted_string+'''"@en;
                dbo:abstract ?abstract;
                dbo:birthDate ?birthDate;
                dbp:birthPlace ?birthPlace;
                prov:wasDerivedFrom ?wiki
            FILTER langMatches (lang(?abstract),"EN")
            }
        '''
        sparql.setQuery(director_query)
        sparql.setReturnFormat(JSON)
        result_director = sparql.query().convert()
        director_details = []
        for row in result_director["results"]["bindings"]:
            director_detail = {
                "abstract": row.get("abstract", {}).get("value", ""),
                "birthDate": row.get("birthDate", {}).get("value", ""),
                "birthPlace": row.get("birthPlace", {}).get("value", ""),
                "wiki": row.get("wiki", {}).get("value", ""),
            }

            if director_detail["wiki"]:
                wiki_url = director_detail["wiki"]
                image_url = get_wikilink_image_url(wiki_url)
                director_detail["image_url"] = image_url

            director_details.append(director_detail)
        display["director_details"] = director_details

    elif role == "actor":
        actor_query = '''
            SELECT DISTINCT * WHERE {
            ?actor rdfs:label "'''+converted_string+'''"@en;
                dbo:abstract ?abstract;
                dbo:birthDate ?birthDate;
                dbp:birthPlace ?birthPlace;
                prov:wasDerivedFrom ?wiki
            FILTER langMatches (lang(?abstract),"EN")
            }
        '''
        sparql.setQuery(actor_query)
        sparql.setReturnFormat(JSON)
        result_actor = sparql.query().convert()

        # Extracting the actor details
        actor_details = []
        for row in result_actor["results"]["bindings"]:
            actor_detail = {
                "abstract": row.get("abstract", {}).get("value", ""),
                "birthDate": row.get("birthDate", {}).get("value", ""),
                "birthPlace": row.get("birthPlace", {}).get("value", ""),
                "wiki": row.get("wiki", {}).get("value", ""),
            }
            if actor_detail["wiki"]:
                wiki_url = actor_detail["wiki"]
                image_url = get_wikilink_image_url(wiki_url)
                actor_detail["image_url"] = image_url

            actor_details.append(actor_detail)
        display["actor_details"] = actor_details

    elif role == "writer":
        writer_query = '''
            SELECT DISTINCT * WHERE {
            ?writer rdfs:label "'''+converted_string+'''"@en;
                dbo:abstract ?abstract;
                dbo:birthDate ?birthDate;
                dbp:birthPlace ?birthPlace;
                prov:wasDerivedFrom ?wiki
            FILTER langMatches (lang(?abstract),"EN")
            }
        '''
        sparql.setQuery(writer_query)
        sparql.setReturnFormat(JSON)
        result_writer = sparql.query().convert()

        # Extracting the actor details
        writer_details = []
        for row in result_writer["results"]["bindings"]:
            writer_detail = {
                "abstract": row.get("abstract", {}).get("value", ""),
                "birthDate": row.get("birthDate", {}).get("value", ""),
                "birthPlace": row.get("birthPlace", {}).get("value", ""),
                "wiki": row.get("wiki", {}).get("value", ""),
            }
            if writer_detail["wiki"]:
                wiki_url = writer_detail["wiki"]
                image_url = get_wikilink_image_url(wiki_url)
                writer_detail["image_url"] = image_url

            writer_details.append(writer_detail)
        display["writer_details"] = writer_details
    return render_template('profile.html', display=display,role=role,name=converted_string)

@app.route('/filter?<string:type>=<string:desc>')
def filter(type,desc):
    if type == "search":
        search_query = '''
        SELECT DISTINCT * WHERE {
            ?movie rdf:type movie:search;
                movie:keyword "''' +desc+'''";
                rdfs:label ?moviename;
                movie:wiki ?wiki
        }
        '''

        search_movie = g.query(search_query)
    elif type == "genre":
        filter_query = '''
        SELECT DISTINCT * WHERE {
            ?movie rdf:type movie:search;
                movie:genre "'''+desc+'''"
        }
        '''

        genre_filter = g.query(filter_query)
        movies_drama = g.query(movie_drama_query)
        genres = g.query(genre_all_query)
        movie_count_results = g.query(movie_count_query)

    #menghitung jumlah movie
    moviecount = 0
    for res in movie_count_results:
        moviecount = res['jumlah']

    #krn banyak row, declare menjadi array terlebih dahulu
    data_to_display = {
        'movies_all': [],
        'movies_action': [],
        'movies_drama': [],
        'genres': [row['genre'] for row in genres],
        'moviecount': moviecount,
    }

    #berasal dari 1 query, pisahkan masing2 menjadi sebuah variable
    for row in results:
        moviename = row['moviename']
        abstract = row['abstract']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_all'].append({
            'moviename': moviename,
            'abstract': abstract,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    for row in movies_action:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_action'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    for row in movies_drama:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']

        image_url = get_wikilink_image_url(wiki)

        data_to_display['movies_drama'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })
    return render_template('filter.html',filtering=filtering)
if __name__ == '__main__':
    app.run()
