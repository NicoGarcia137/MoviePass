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
create table Funciones (
    Id int auto_increment ,
    Fecha datetime not null , 
    Movie int not null , 
    Entradas int not null  ,
    Cine varchar (50) not null ,
    constraint pk_Id primary key (Id) ,
    constraint fk_Cine foreign key (Cine) references Cines (Id) 
);

create table Movies (
     Id int DEFAULT '0',
     Name varchar (60) not null ,
     Duration int not null ,
     Language varchar (50) not null ,
     Image varchar (200) not null , 
     Genre int,
     constraint pk_Id_Movie primary key (Id) 
);

create table generos 
(
    Id int auto_increment ,
    Name varchar (50) not null ,
    constraint pk_Id primary key (Id) 
);

create table generoxMovie 
(  Name varchar (60) not null,
   Id int not null , 
   constraint pk_Id_Movie primary key (Name , Id),
   constraint fk_Name foreign key (Name) references Movie (Id), 
   constraint fk_Id foreign key (Id) references generos (Id) 
);
create table MoviexFunciones 
(
    Id int not null ,
    Name varchar(60), 
    constraint pk_Id_Name primary key (Name, Id),
    constraint fk_Name foreign key (Name) references Movie (Id),
    constraint fk_Id foreign key (Id) references Funciones (Id)
);


--echo "<script>if(confirm('echo $query'));</script>";