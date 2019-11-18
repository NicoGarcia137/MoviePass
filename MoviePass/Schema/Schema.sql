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

create table Movies (
     Id int DEFAULT '0',
     Name varchar (60) not null ,
     Duration int not null ,
     Language varchar (50) not null ,
     Image varchar (200) not null , 
     constraint pk_MovieId primary key (Id) 
);


create table Shows (
    Id int auto_increment ,
    DateTime DateTime not null , 
    MovieId int , 
    RoomId int not null,
    Active boolean default true,
    constraint pk_Id primary key (Id) ,
    constraint fk_MovieId foreign key (MovieId) references Movies (Id),
    constraint fk_RoomId foreign key (RoomId) references Rooms (Id) ON DELETE CASCADE 
) ;

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
   constraint fk_MovieXGenre_MovieId foreign key (MovieId) references Movies (Id), 
   constraint fk_MovieXGenre_GenreId foreign key (GenreId) references Genres (Id) 
);

create table Purchases(
    Id int auto_increment,
    UserEmail varchar(100) not null,
    CineId int not null,
    DateTime DateTime not null,
    TotalValue float not null,
    constraint pk_Purchase primary key (Id),
    constraint fk_Purchase_Cine foreign key (CineId) references Cines (Id)
);

create table Tickets(
    Id int auto_increment,
    ShowId int not null,
    PurchaseId int not null,
    Seat int not null,
    Value float not null,
    constraint pk_Purchase primary key (Id),
    constraint fk_Tickets_Purchase foreign key (PurchaseId) references Purchases (Id),
    constraint fk_Tickets_Show foreign key (ShowId) references Shows (Id)
);

create table ShowTimes(
    ShowTime varchar(10),
    CineId int,
    constraint pk_ShowTimes primary key(showTime,CineId),
    constraint fk_CineId foreign key (CineId) references Cines (Id) ON DELETE CASCADE 
);



--echo "<script>if(confirm('echo $query'));</script>";