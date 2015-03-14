set sql_safe_updates = 0;
update artists
set peak_sun = replace(peak_sun, 'or', 'and');

select peak_sun
from artists
where peak_sun like '%and%';


set sql_safe_updates = 0;
update artists
set peak_mon = replace(peak_mon, 'or', 'and');

select peak_mon
from artists
where peak_mon like '%and%';


set sql_safe_updates = 0;
update artists
set peak_tue = replace(peak_tue, 'or', 'and');

select peak_tue
from artists
where peak_tue like '%and%';


set sql_safe_updates = 0;
update artists
set peak_wed = replace(peak_wed, 'or', 'and');

select peak_wed
from artists
where peak_wed like '%and%';


set sql_safe_updates = 0;
update artists
set peak_thu = replace(peak_thu, 'or', 'and');

select peak_thu
from artists
where peak_thu like '%and%';


set sql_safe_updates = 0;
update artists
set peak_fri = replace(peak_fri, 'or', 'and');

select peak_fri
from artists
where peak_fri like '%and%';



set sql_safe_updates = 0;
update artists
set peak_sat = replace(peak_sat, 'or', 'and');

select peak_sat
from artists
where peak_sat like '%and%';



set sql_safe_updates = 0;
update artists
set  off_sun = replace( off_sun, 'or by', 'and by');

select  off_sun
from artists
where  off_sun like '%and%';




set sql_safe_updates = 0;
update artists
set  off_mon = replace( off_mon, 'or by', 'and by');

select  off_mon
from artists
where  off_mon like '%and%';



set sql_safe_updates = 0;
update artists
set  off_tue = replace( off_tue, 'or by', 'and by');

select  off_tue
from artists
where  off_tue like '%and%';



set sql_safe_updates = 0;
update artists
set  off_wed = replace( off_wed, 'or by', 'and by');

select  off_wed
from artists
where  off_wed like '%and%';



set sql_safe_updates = 0;
update artists
set  off_thu = replace( off_thu, 'or by', 'and by');

select  off_thu
from artists
where  off_thu like '%and%';



set sql_safe_updates = 0;
update artists
set  off_fri = replace( off_fri, 'or', 'and');

select  off_fri
from artists
where  off_fri like '%or%';



set sql_safe_updates = 0;
update artists
set  off_sat = replace( off_sat, 'or at the', 'and at the');

select  off_sat
from artists
where  off_sat like '%and%';
