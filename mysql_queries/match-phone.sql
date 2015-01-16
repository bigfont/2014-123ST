SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.phone as phoneA, p.phone
	FROM artists a
	LEFT JOIN profiles p ON p.phone = a.phone
UNION 
SELECT
	a.phone as phoneA, p.phone
	FROM artists a
	RIGHT JOIN profiles p ON p.phone = a.phone
) as x