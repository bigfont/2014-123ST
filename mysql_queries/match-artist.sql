SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.artist, p.contact_name 
	FROM artists a
	LEFT JOIN profiles p ON a.artist = p.contact_name
UNION 
SELECT
	a.artist, p.contact_name
	FROM artists a
	RIGHT JOIN profiles p ON a.artist = p.contact_name
) as x