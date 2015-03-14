select * 
from artists
where name like '%Salt Spring Island Cheese%';

SET SQL_SAFE_UPDATES = 0;
update artists
set off_sun = "test"
where name like '%Salt Spring Island Cheese%';