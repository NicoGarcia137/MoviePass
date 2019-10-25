create database MoviePass;
USE MoviePass;

create table Cines (
Id int auto_increment,
Name varchar (50) not null ,
Address varchar (100) not null ,
Capacity int not null , 
Value int not null,
constraint pk_IdCine primary key (Id)
);

create table Rooms (
    Id int auto_increment ,
    Capacity int not null , 
    Name varchar(50) not null unique,
    CineId int not null, 
    constraint pk_Id primary key (Id) ,
    constraint fk_CineId foreign key (CineId) references Cines (Id) 
);

create table Shows (
    Id int auto_increment ,
    DateTime varchar(20) not null , 
    MovieId int , 
    Tickets int,
    RoomId int not null,
    constraint pk_Id primary key (Id) ,
    constraint fk_MovieId foreign key (MovieId) references Movies (Id),
    constraint fk_RoomId foreign key (RoomId) references Room (Id)    
);

create table Movies (
     Id int DEFAULT '0',
     Name varchar (60) not null ,
     Duration int not null ,
     Language varchar (50) not null ,
     Image varchar (200) not null , 
     constraint pk_MovieId primary key (Id) 
);

create table Genres 
(
    Id int ,
    Description varchar (50) not null ,
    constraint pk_Id primary key (Id) 
);

create table MovieXGenres
(  
    Id int auto_increment , 
    MovieId int not null,
    GenreId int not null,
   constraint pk_MovieIdXGenre primary key (Id),
   constraint fk_MovieId foreign key (MovieId) references Movie (Id), 
   constraint fk_GenreId foreign key (GenreId) references Genre (Id) 
);


--echo "<script>if(confirm('echo $query'));</script>";