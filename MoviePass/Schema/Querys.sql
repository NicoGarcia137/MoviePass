--GetAllMovies;
Select 
m.Id as MovieId,
m.Name,
m.Duration,
m.Language,
m.Image,
g.Id as GenreId,
g.Description
from moviexgenres as mg
Join movies as m 
on m.Id=mg.MovieId
join genres as g
on g.Id=mg.GenreId
order by m.Id desc;

--GetAllCines;
Select 
c.Id as CineId,
c.Name as CineName,
c.Address,
c.Capacity as CineCapacity,
c.Value,
r.Id as RoomId,
r.Capacity as RoomCapacity,
r.Name as RoomName,
s.Id as ShowId,
s.DateTime,
s.Tickets,
m.Id as MovieId,
m.Name as MovieName,
m.Duration,
m.Language,
m.Image,
g.Description as Genre,
g.Id as GenreId
from Cines as c
left join Rooms as r
on r.CineId=c.Id
left join Shows as s
on s.RoomId=r.Id
left join Movies as m
on s.MovieId=m.Id
left join MovieXGenres as mg
on mg.MovieId=m.Id
left join Genres as g
on mg.GenreId = g.Id
order by c.Id ,r.Id,s.Id,m.Id,g.Id;

--GetCineById
Select 
c.Id as CineId,
c.Name as CineName,
c.Address,
c.Capacity as CineCapacity,
c.Value,
r.Id as RoomId,
r.Capacity as RoomCapacity,
r.Name as RoomName,
s.Id as ShowId,
s.DateTime,
s.Tickets,
m.Id as MovieId,
m.Name as MovieName,
m.Duration,
m.Language,
m.Image,
g.Description as Genre,
g.Id as GenreId
from Cines as c
left join Rooms as r
on r.CineId=c.Id
left join Shows as s
on s.RoomId=r.Id
left join Movies as m
on s.MovieId=m.Id
left join MovieXGenres as mg
on mg.MovieId=m.Id
left join Genres as g
on mg.GenreId = g.Id
where c.Id = 2
order by c.Id ,r.Id,s.Id,m.Id,g.Id;


--GetAllRoomsByCineId;
Select 
r.Id as RoomId,
r.Capacity as RoomCapacity,
r.Name as RoomName,
s.Id as ShowId,
s.DateTime,
s.Tickets,
m.Id as MovieId,
m.Name as MovieName,
m.Duration,
m.Language,
g.Description as Genre,
g.Id as GenreId
from Rooms as r
left join Shows as s
on s.RoomId=r.Id
left join Movies as m
on s.MovieId=m.Id
left join MovieXGenres as mg
on mg.MovieId=m.Id
left join Genres as g
on mg.GenreId = g.Id;

--GetRoomById;
select
r.Id as RoomId,
r.Capacity as RoomCapacity,
r.Name as RoomName,
s.Id as ShowId,
s.DateTime,
s.Tickets,
m.Id as MovieId,
m.Name as MovieName,
m.Duration,
m.Language,
m.Image,
g.Description as Genre,
g.Id as GenreId
from Rooms as r
left join Shows as s
on s.RoomId=r.Id
left join Movies as m
on s.MovieId=m.Id
left join MovieXGenres as mg
on mg.MovieId=m.Id
left join Genres as g
on mg.GenreId = g.Id
where r.Id = 2
order by r.Id,s.Id,m.Id,g.Id;

--GetShowById;
select
s.Id as ShowId,
s.DateTime,
s.Tickets,
m.Id as MovieId,
m.Name as MovieName,
m.Duration,
m.Language,
m.Image,
g.Description as Genre,
g.Id as GenreId
from Shows as s
left join Movies as m
on s.MovieId=m.Id
left join MovieXGenres as mg
on mg.MovieId=m.Id
left join Genres as g
on mg.GenreId = g.Id
where s.Id = 1
order by s.Id,m.Id,g.Id;

update Shows set MovieId=475557;








            