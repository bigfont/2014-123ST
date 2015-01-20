#get the artist id
select * 
from artists
where name like "%salt spring island cheese%";

# run insert statements here
insert into slideshow (artist_id, view_order, image) values (32,0,"salt-spring-island-cheese-0.jpg");
insert into slideshow (artist_id, view_order, image) values (32,1,"salt-spring-island-cheese-1.jpg");
insert into slideshow (artist_id, view_order, image) values (32,1,"salt-spring-island-cheese-2.jpg");
insert into slideshow (artist_id, view_order, image) values (32,1,"salt-spring-island-cheese-3.jpg");
insert into slideshow (artist_id, view_order, image) values (32,1,"salt-spring-island-cheese-4.jpg");
insert into slideshow (artist_id, view_order, image) values (32,1,"salt-spring-island-cheese-5.jpg");

# delete previous images

SET SQL_SAFE_UPDATES = 0;
delete from slideshow
where artist_id = 32
and image not like "%salt-spring-island-cheese-"