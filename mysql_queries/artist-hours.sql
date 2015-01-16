select studio_name, summer_hours, winter_hours
from profiles
where studio_name like "%garner%" or studio_name like "%tweed%";

select * 
from artists
where name like "%garner%" or name like "%tweed%";