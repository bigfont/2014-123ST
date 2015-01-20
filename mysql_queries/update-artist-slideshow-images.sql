#get the artist id
select * 
from artists
where name like "%abara%";

# run insert statements here
insert into slideshow (artist_id, view_order, image) values (90,25,"abara-designs-0.jpg");

