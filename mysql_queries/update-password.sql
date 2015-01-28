SET SQL_SAFE_UPDATES = 0;
update profiles
set password = "<some password>"
where studio_name like "%sacred%" 