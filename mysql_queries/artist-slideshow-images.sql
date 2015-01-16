select a.name, s.* 
from slideshow s
join artists a on s.artist_id = a.id
order by a.name
