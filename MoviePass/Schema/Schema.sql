create database MoviePass;
USE MoviePass;

create table cines (
Id int auto_increment,
name_cine varchar (50) not null ,
address_cine varchar (100) not null ,
capacity int not null , 
value int not null,
constraint pk_IdCine primary key (Id)
);
create table funciones (
    id_funcion int auto_increment ,
    fecha datetime not null , 
    peliculas int not null , 
    entradas int not null  ,
    cine varchar (50) not null ,
    constraint pk_id_funcion primary key (id_funcion) ,
    constraint fk_cine foreign key (cine) references cines (Id) 
);

create table peliculas 
(
    Id int auto_increment;
      name_pelicula varchar (60) not null ,
      duracion int not null ,
    language_pelicula varchar (50) not null ,
     imagen varchar (200) not null , 
     constraint pk_Id_Pelicula primary key (Id) 
);

create table generos 
(
    id_genero int auto_increment ,
    nombre_genero varchar (50) not null ,
    constraint pk_id_genero primary key (id_genero) 
);

create table generoxPelicula 
(  name_pelicula varchar (60) not null,
   id_genero int not null , 
   constraint pk_id_genero_pelicula primary key (name_pelicula , id_genero),
   constraint fk_name_pelicula foreign key (name_pelicula) references peliculas (Id), 
   constraint fk_id_genero foreign key (id_genero) references generos (id_genero) 
);
create table peliculasxfunciones 
(
    id_funcion int not null ,
    name_pelicula varchar(60), 
    constraint pk_id_funcion_name_pelicula primary key (name_pelicula, id_funcion),
    constraint fk_name_pelicula foreign key (name_pelicula) references peliculas (Id),
    constraint fk_id_funcion foreign key (id_funcion) references funciones (id_funcion)
);


--echo "<script>if(confirm('echo $query'));</script>";