create database MoviePass;
USE MoviePass;

create table Cines (
Id int auto_increment,
Name_Cine varchar (50) not null ,
Address_Cine varchar (100) not null ,
Capacity int not null , 
Value int not null,
constraint pk_IdCine primary key (Id)
);
create table Funciones (
    Id_funcion int auto_increment ,
    Fecha datetime not null , 
    Pelicula int not null , 
    Entradas int not null  ,
    Cine varchar (50) not null ,
    constraint pk_Id_funcion primary key (Id_funcion) ,
    constraint fk_Cine foreign key (Cine) references Cines (Id) 
);

create table Pelicula 
(
    Id int auto_increment;
      Name_Pelicula varchar (60) not null ,
      Duracion int not null ,
    language_pelicula varchar (50) not null ,
     imagen varchar (200) not null , 
     constraint pk_Id_Pelicula primary key (Id) 
);

create table generos 
(
    Id_genero int auto_increment ,
    nombre_genero varchar (50) not null ,
    constraint pk_Id_genero primary key (Id_genero) 
);

create table generoxPelicula 
(  Name_Pelicula varchar (60) not null,
   Id_genero int not null , 
   constraint pk_Id_genero_pelicula primary key (Name_Pelicula , Id_genero),
   constraint fk_Name_Pelicula foreign key (Name_Pelicula) references Pelicula (Id), 
   constraint fk_Id_genero foreign key (Id_genero) references generos (Id_genero) 
);
create table PeliculaxFunciones 
(
    Id_funcion int not null ,
    Name_Pelicula varchar(60), 
    constraint pk_Id_funcion_Name_Pelicula primary key (Name_Pelicula, Id_funcion),
    constraint fk_Name_Pelicula foreign key (Name_Pelicula) references Pelicula (Id),
    constraint fk_Id_funcion foreign key (Id_funcion) references Funciones (Id_funcion)
);


--echo "<script>if(confirm('echo $query'));</script>";