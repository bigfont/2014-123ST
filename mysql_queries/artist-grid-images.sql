# this lists the photos that each member has uploaded
select p.studio_name, i.*
from images i
join profiles p on i.profiles_id = p.id
where studio_name in 
(
	"The Gallery on Garner"
    ,"Donna Horn Fine Arts"
    ,"Abara Designs"
    ,"Gillian Gandossi Fine Art Painting"
    ,"Salt Spring Tweed"
);

# this lists the photos that show up on the front end
select name, tour_number, view_Order, Id, grid_thumb, grid_photo
from artists
where name in 
(
	"The Gallery on Garner"
    ,"Donna Horn Fine Arts"
    ,"Abara Designs"
    ,"Gillian Gandossi Fine Art Painting"
);

# this updates the photos on the front end
update artists 
set grid_thumb = lower(concat(replace(name, " ", "-"),"_small.jpg")), grid_photo = lower(concat(replace(name, " ", "-"),".jpg"))
where name in 
(
	"The Gallery on Garner"
    ,"Donna Horn Fine Arts"
    ,"Abara Designs"
    ,"Gillian Gandossi Fine Art Painting"
);