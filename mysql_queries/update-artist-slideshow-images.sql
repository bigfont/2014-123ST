#get the artist id
select * 
from artists
where name like "%soul%";

select * from slideshow where artist_id = 82 order by image;

# run insert statements here
insert into slideshow (artist_id, view_order, image) values (82,0,"soul-path-shoes-0.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-1.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-2.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-3.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-4.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-5.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-6.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-7.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-8.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-9.jpg");

insert into slideshow (artist_id, view_order, image) values (82,0,"soul-path-shoes-10.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-11.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-12.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-13.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-14.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-15.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-16.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-17.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-18.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-19.jpg");

insert into slideshow (artist_id, view_order, image) values (82,0,"soul-path-shoes-20.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-21.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-22.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-23.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-24.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-25.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-26.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-27.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-28.jpg");
insert into slideshow (artist_id, view_order, image) values (82,1,"soul-path-shoes-82.jpg");

# delete previous images

SET SQL_SAFE_UPDATES = 0;
update slideshow
set image = "soul-path-shoes--"

SET SQL_SAFE_UPDATES = 0;
delete from slideshow
where artist_id = 82
and image not like "%-0.%"
and image not like "%-1.%"
and image not like "%-2.%"
and image not like "%-3.%"
and image not like "%-4.%"
and image not like "%-5.%"
and image not like "%-6.%"
and image not like "%-7.%"
and image not like "%-8.%"
and image not like "%-9.%"
and image not like "%-10.%"
and image not like "%-11.%"
and image not like "%-12.%"
and image not like "%-13.%"
and image not like "%-14.%"
and image not like "%-15.%"
and image not like "%-16.%"
and image not like "%-17.%"
and image not like "%-18.%"
and image not like "%-19.%"
and image not like "%-20.%"
and image not like "%-21.%"