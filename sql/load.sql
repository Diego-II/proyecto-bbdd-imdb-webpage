/*Tabla peliculas: Contiene peliculas, cortos y documentales:
Id_movie (primary key), tipo (short, movie), titulo, ano*/
CREATE TABLE cc3201.MovieAux(
       id VARCHAR(80) NOT NULL,
       mtype VARCHAR(40),
       title VARCHAR(300) NOT NULL,
       year INT,
       PRIMARY KEY(id)
);

/*Tabla auxiliar para llenar la tabla de peliculas con los ratings. */
CREATE TABLE cc3201.MovieRating(
       m_id VARCHAR(80) NOT NULL,
       rating REAL
);

COPY cc3201.MovieAux FROM '/home/cc3201/to_server/movies_basic.csv'
WITH NULL '\N' CSV;

COPY cc3201.MovieRating FROM '/home/cc3201/to_server/movies_rating.csv'
WITH NULL '\N' CSV;

INSERT INTO cc3201.Movie
SELECT MovieAux.id, MovieAux.mtype, MovieAux.title, MovieAux.year, MovieRating.rating 
FROM cc3201.movieaux INNER JOIN cc3201.movierating on id = m_id;

-- Botamos las tablas auxiliares por ahorro de memoria en el servidor
DROP TABLE cc3201.MovieAux, cc3201.MovieRating;
--

COPY cc3201.Person FROM '/home/cc3201/to_server/actors.csv'
WITH NULL '\N' CSV;
     
CREATE TABLE cc3201.MovDirectorAux(
       m_id VARCHAR(80) NOT NULL,
       d_id VARCHAR(80) NOT NULL
);

COPY cc3201.MovDirectorAux FROM '/home/cc3201/to_server/dir_movies.csv'
WITH NULL '\N' CSV;

INSERT INTO cc3201.MovDirector
SELECT Movie.id, MovDirectorAux.d_id
FROM cc3201.movie 
INNER JOIN cc3201.MovDirectorAux 
	on id = m_id
	where MovDirectorAux.d_id in (select distinct id from cc3201.person);
     
DROP TABLE cc3201.MovDirectorAux;
	 
CREATE TABLE cc3201.MovieGenreAux(
       m_id VARCHAR(80) NOT NULL,
       genre VARCHAR(80) NOT NULL
);

COPY cc3201.MovieGenreAux FROM '/home/cc3201/to_server/movies_genres.csv'
WITH NULL '\N' CSV;

INSERT INTO cc3201.MovieGenre
SELECT Movie.id, MovieGenreAux.genre
FROM cc3201.movie 
INNER JOIN cc3201.MovieGenreAux
	on id = m_id;
	
DROP TABLE cc3201.MovieGenreAux;

CREATE TABLE cc3201.MovieActorAux(
       m_id VARCHAR(80) NOT NULL,
       a_id VARCHAR(80) NOT NULL,
       role VARCHAR(300)
);

COPY cc3201.MovieActorAux FROM '/home/cc3201/to_server/actors_rol.csv'
WITH NULL '\N' CSV;

INSERT INTO cc3201.MovieActor
SELECT MovieActorAux.m_id, MovieActorAux.a_id, MovieActorAux.role
FROM cc3201.MovieActorAux 
	WHERE MovieActorAux.m_id in (select distinct (id) from cc3201.movie)
	and MovieActorAux.a_id in (select distinct (id) from cc3201.person);

DROP TABLE cc3201.MovieActorAux;

CREATE TABLE cc3201.MovieCrewAux(
       c_id VARCHAR(80) NOT NULL,  
       m_id VARCHAR(80) NOT NULL
);

COPY cc3201.MovieCrewAux FROM '/home/cc3201/to_server/actors_movies.csv'
WITH NULL '\N' CSV;

INSERT INTO cc3201.MovieCrew
SELECT MovieCrewAux.c_id, MovieCrewAux.m_id
FROM cc3201.MovieCrewAux
	WHERE MovieCrewAux.m_id in (select distinct (id) from cc3201.movie)
	and MovieCrewAux.c_id in (select distinct (id) from cc3201.person);

DROP TABLE cc3201.MovieCrewAux;

/* Creacion de indices*/
CREATE INDEX movie_id ON cc3201.Movie USING btree (id);

CREATE INDEX movie_name ON cc3201.Movie USING btree (title);

CREATE INDEX person_name ON cc3201.Person USING btree (pname);