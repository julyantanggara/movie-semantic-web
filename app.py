#module framework flask
from flask import Flask, render_template,request
#module untuk keperluan web scrapping
import requests
from bs4 import BeautifulSoup
#module rdflib dan sparqlwrapper
from rdflib import Graph, Namespace
from SPARQLWrapper import SPARQLWrapper, JSON

app = Flask(__name__)

# deklarasi namespace untuk rdflib
dbo = Namespace("http://dbpedia.org/ontology/")
dbpedia = Namespace ("http://dbpedia.org/property/")
dbr = Namespace ("http://dbpedia.org/resource/")
movie = Namespace ("https://example.org/schema/movie")
dbp = Namespace ("http://dbpedia.org/property/")
rdf = Namespace ("http://www.w3.org/1999/02/22-rdf-syntax-ns#")
rdfs= Namespace ("http://www.w3.org/2000/01/rdf-schema#")
foaf = Namespace("http://xmlns.com/foaf/0.1/")
prov = Namespace("http://www.w3.org/ns/prov#") 

#deklarasi prefix untuk jena fuseki
prefixes = """
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>
    PREFIX movie: <https://example.org/schema/movie>
"""

#untuk mova.rdf
g = Graph()
g.parse("mova.rdf", format="xml")

#untuk mencegah tidak terbacanya prefix
g.bind("dbo", dbo)
g.bind("rdfs", rdfs)
g.bind("prov",prov)

#set up SPARQL endpoint dbpedia & apache jena fuseki
sparql = SPARQLWrapper("http://dbpedia.org/sparql")
sparql.setReturnFormat(JSON)
jena = SPARQLWrapper("http://localhost:3030/Tubes_WS/sparql")
jena.setReturnFormat(JSON)

#mendapatkan OGP menggunakan metode web scrapping
def get_wikilink_image_url(wikilink):
    url = wikilink
    response = requests.get(url)
    soup = BeautifulSoup(response.text, 'html.parser')

    # Extract informasi OGP
    og_image_tag = soup.find('meta', property='og:image')

    if og_image_tag:
        image_url = og_image_tag.get('content')
        return image_url
    else:
        return None

def split_comma(place):
    name_place = place.split(", ")
    final = name_place[0]
    return final

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
    
    # query utk menghitung banyaknya movie
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

    #membuat array untuk menyimpan data hasil query diatas 
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
        #dari data wiki, memanggil function untuk scrapping image di situs tsb
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
    result_writer = sparql.query().convert()
    writer = [row['writer']['value'].replace("http://dbpedia.org/resource/", "") for row in result_writer["results"]["bindings"]]

    # query starring
    starring_query = '''
        SELECT DISTINCT ?starring WHERE {
            ?movie rdfs:label "'''+moviename+'''"@en .
            ?movie dbo:starring ?starring .
        }
    '''
    sparql.setQuery(starring_query)
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

    display = {
        "profile_details": [],
    }

    if role == 'director':
        dbo_name = 'director'
    elif role == 'actor':
        dbo_name = 'starring'
    else:
        dbo_name = 'writer'

    profile_query = '''
            SELECT DISTINCT * WHERE {
            ?movie dbo:'''+dbo_name+''' ?profile.
                ?profile rdfs:label "'''+converted_string+'''"@en;
                dbo:abstract ?abstract;
                prov:wasDerivedFrom ?wiki.
            ?movie rdfs:label ?movieLabel.
            OPTIONAL{?profile dbo:birthDate ?birthDate}
            OPTIONAL{?profile dbp:birthPlace ?birthPlace}
            OPTIONAL{?profile dbo:birthName ?birthName}
            OPTIONAL{?movie dbo:releaseDate ?movieRelease}
            FILTER (lang(?abstract) = "en" && lang(?movieLabel) = "en")
            }
            GROUP BY ?movieLabel
            LIMIT 5
    '''
    sparql.setQuery(profile_query)
    result_profile = sparql.query().convert()
    profile_details = []
    for row in result_profile["results"]["bindings"]:
        profile_detail = {
                "abstract": row.get("abstract", {}).get("value", ""),
                "birthDate": row.get("birthDate", {}).get("value", ""),
                "birthPlace": row.get("birthPlace", {}).get("value", ""),
                "birthName": row.get("birthName", {}).get("value", ""),
                "movieLabel": row.get("movieLabel", {}).get("value", ""),
                "movieRelease": row.get("movieRelease", {}).get("value", ""),
                "wiki": row.get("wiki", {}).get("value", ""),
        }
        if profile_detail['birthPlace']:
                place = profile_detail['birthPlace']
                map_place = split_comma(place)
                profile_detail['location'] = map_place.replace("http://dbpedia.org/resource/", "")

                location_query ='''
                        SELECT ?longitude ?latitude WHERE{
                            ?location rdfs:label "'''+profile_detail['location']+'''"@en;
                                geo:lat ?latitude;
                                geo:long ?longitude.
                        }
                    '''
                sparql.setQuery(location_query)
                result_location = sparql.query().convert()
                for row in result_location["results"]["bindings"]:
                    location_detail= {
                    "longitude": row.get("longitude",{}).get("value", ""),
                    "latitude": row.get("latitude",{}).get("value", "")
                    }
                    profile_detail.update(location_detail)

        if profile_detail["wiki"]:
                wiki_url = profile_detail["wiki"]
                image_url = get_wikilink_image_url(wiki_url)
                profile_detail["image_url"] = image_url

        profile_details.append(profile_detail)
    display["profile_details"] = profile_details
    return render_template('profile.html', display=display,role=role,name=converted_string)

@app.route('/query', methods=['GET','POST'])
def process_form():
    user_input = request.args.get('search', '').title()
    search_query = '''
        SELECT DISTINCT * WHERE {
            ?movie rdf:type movie:search;
                movie:keyword "''' + user_input + '''";
                rdfs:label ?moviename;
                movie:wiki ?wiki;
                movie:rating ?rating;
                movie:category ?category;
                movie:year ?year;
                movie:country ?country.
        }
    '''
    search_result = g.query(search_query)

    keyword = {
        'movie_filter' : [],
        'popular_movie' : [],
    }
    for row in search_result:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']
        image_url = get_wikilink_image_url(wiki)

        keyword['movie_filter'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })

    popular_query = '''
    '''+prefixes+''' 
    SELECT ?number ?moviename ?wiki ?rating ?category ?year (GROUP_CONCAT(?genre; separator=" / ") as ?genres)
    WHERE {
        ?movie rdf:type movie:search;
            movie:number ?number;
            rdfs:label ?moviename;
            movie:wiki ?wiki;
            movie:rating ?rating;
            movie:category ?category;
            movie:year ?year;
            movie:genre ?genre.
        FILTER (?moviename != "" && xsd:integer(?number) > 5)
    }
    GROUP BY ?number ?moviename ?wiki ?rating ?category ?year
    ORDER BY DESC(xsd:integer(?number))
    LIMIT 5
    '''

    jena.setQuery(popular_query)
    popular_result = jena.query().convert()
    pop_movies = []
    for result in popular_result["results"]["bindings"]:
        pop_movie = {
            "moviename": result.get("moviename", {}).get("value", ""),
            "wiki": result.get("wiki", {}).get("value", ""),
            "rating": result.get("rating", {}).get("value", ""),
            "category": result.get("category", {}).get("value", ""),
            "year": result.get("year", {}).get("value", ""),
            "number": result.get("number", {}).get("value", ""),
            "genre": result.get("genres", {}).get("value", ""), 
        }

        if pop_movie["wiki"]:
            wiki_url = pop_movie["wiki"]
            image_url = get_wikilink_image_url(wiki_url)
            pop_movie["image_url"] = image_url
        pop_movies.append(pop_movie)

    keyword["popular_movie"] = pop_movies

    return render_template('filter.html', search_query=search_query,data=keyword,desc=user_input)

@app.route('/filter/<string:type>=<string:desc>')
def filter(type,desc):
    all_genre_query = '''
    SELECT DISTINCT ?genre WHERE {
        ?movie rdf:type movie:search;
            movie:genre ?genre.
    }
    '''
    genres = g.query(all_genre_query)

    data = {
        'genres': [row['genre'] for row in genres],
        'movie_filter' : [],
        'popular_movie' : []
    }

    
    filter_query = '''
        SELECT DISTINCT * WHERE {
            ?movie rdf:type movie:search;
                movie:genre "'''+desc+'''";
                rdfs:label ?moviename;
                movie:wiki ?wiki;
                movie:rating ?rating;
                movie:category ?category;
                movie:year ?year;
                movie:country ?country.
        }
        '''

    filter_result = g.query(filter_query)

    for row in filter_result:
        moviename = row['moviename']
        wiki = row['wiki']
        rating = row['rating']
        category = row['category']
        year = row['year']
        country = row['country']
        image_url = get_wikilink_image_url(wiki)

        data['movie_filter'].append({
            'moviename': moviename,
            'wiki': wiki,
            'rating': rating,
            'category': category,
            'year': year,
            'country': country,
            'image_url': image_url
        })
    
    popular_query = '''
    '''+prefixes+''' 
    SELECT ?number ?moviename ?wiki ?rating ?category ?year (GROUP_CONCAT(?genre; separator=" / ") as ?genres)
    WHERE {
        ?movie rdf:type movie:search;
            movie:number ?number;
            rdfs:label ?moviename;
            movie:wiki ?wiki;
            movie:rating ?rating;
            movie:category ?category;
            movie:year ?year;
            movie:genre ?genre.
        FILTER (?moviename != "" && xsd:integer(?number) > 5)
    }
    GROUP BY ?number ?moviename ?wiki ?rating ?category ?year
    ORDER BY DESC(xsd:integer(?number))
    LIMIT 5
    '''

    jena.setQuery(popular_query)
    popular_result = jena.query().convert()
    pop_movies = []
    for result in popular_result["results"]["bindings"]:
        pop_movie = {
            "moviename": result.get("moviename", {}).get("value", ""),
            "wiki": result.get("wiki", {}).get("value", ""),
            "rating": result.get("rating", {}).get("value", ""),
            "category": result.get("category", {}).get("value", ""),
            "year": result.get("year", {}).get("value", ""),
            "number": result.get("number", {}).get("value", ""),
            "genre": result.get("genres", {}).get("value", ""), 
        }

        if pop_movie["wiki"]:
            wiki_url = pop_movie["wiki"]
            image_url = get_wikilink_image_url(wiki_url)
            pop_movie["image_url"] = image_url
        pop_movies.append(pop_movie)

    data["popular_movie"] = pop_movies

    return render_template('filter.html',desc=desc,data=data)

if __name__ == '__main__':
    app.run()
