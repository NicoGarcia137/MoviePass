--GetAllMovies;
Select 
m.Id as MovieId,
m.Name,
m.Duration,
m.Language,
m.Image,
mg.Id,
g.Id as GenreId,
g.Description
from moviexgenres as mg
Join movies as m 
on m.Id=mg.MovieId
join genres as g
on g.Id=mg.GenreId
order by m.Id desc;
