select studio_name, winter_hours, summer_hours
from profiles
where studio_name like "%horn%" or studio_name like "%tweed%";

select * 
from artists
where name like "%garner%" or name like "%tweed%";