SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.address, p.studio_address
	FROM artists a
	LEFT JOIN profiles p ON p.studio_address = a.address
UNION 
SELECT
	a.address, p.studio_address
	FROM artists a
	RIGHT JOIN profiles p ON p.studio_address = a.address
) as x