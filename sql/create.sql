/*Tabla  peliculas: Contiene peliculas, cortos y documentales:
Id_movie (primary key), tipo (short, movie), titulo, ano, rating*/
CREATE TABLE cc3201.Movie(
       id VARCHAR(80) NOT NULL,
       mtype VARCHAR(40),
       title VARCHAR(300) NOT NULL,
       year INT,
       rating REAL,
       PRIMARY KEY(id)
);

/*Tabla con todos los actores y personas en general. Pueden ser tanto 
actores como directores, etc...:
Id_Actor (primary key), Nombre, Fecha nacimiento.*/
CREATE TABLE cc3201.Person(
       id VARCHAR(80) NOT NULL,
       pname VARCHAR(200) NOT NULL,
       dob INT,
       PRIMARY KEY(id)
);

/*Tabla que asocia pelicula y codigo de director.*/
CREATE TABLE cc3201.MovDirector(
       m_id VARCHAR(80) NOT NULL,
       d_id VARCHAR(80) NOT NULL,
       FOREIGN KEY(m_id) REFERENCES cc3201.Movie(id),
       FOREIGN KEY(d_id) REFERENCES cc3201.Person(id)
);

/*Genero de la pelicula: asocia el id de la 
pelicula con los generos identificados:
Id_movie, genre. EJ:
Id_movie,     genre
tt0000634,    Drama
tt0000634,    History
tt0000634,    Romance
*/
CREATE TABLE cc3201.MovieGenre(
       m_id VARCHAR(80) NOT NULL,
       genre VARCHAR(80) NOT NULL,
       FOREIGN KEY(m_id) REFERENCES cc3201.Movie(id)
);

/*Pelicula en la que actuo cierto actor y el nombre del 
personaje si estaba disponible. Corresponde a los principales miembros
del elenco segun IMDB. Ejemplo:
ID_Movie, ID_actor, rol
tt0000005,nm0443482,Blacksmith
tt0000005,nm0653042,Assistant*/
CREATE TABLE cc3201.MovieActor(
       m_id VARCHAR(80) NOT NULL,
       a_id VARCHAR(80) NOT NULL,
       role VARCHAR(300),
       FOREIGN KEY(m_id) REFERENCES cc3201.Movie(id),
       FOREIGN KEY(a_id) REFERENCES cc3201.Person(id)
);

/*Tabla con todo el cast y equipo de la pelicula. 
No incluye el tipo de cargo. Ejemplo:
nm0000001,tt0050419
nm0000001,tt0053137
nm0000001,tt0072308
nm0000001,tt0031983*/
CREATE TABLE cc3201.MovieCrew(
       c_id VARCHAR(80) NOT NULL,
       m_id VARCHAR(80) NOT NULL,
       FOREIGN KEY(m_id) REFERENCES cc3201.Movie(id),
       FOREIGN KEY(c_id) REFERENCES cc3201.Person(id)
);
