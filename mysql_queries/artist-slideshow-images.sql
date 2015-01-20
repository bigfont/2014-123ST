select a.name, s.* 
from slideshow s
join artists a on s.artist_id = a.id
where a.name like '%horn%'
