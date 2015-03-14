SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.email as emailA, p.email
	FROM artists a
	LEFT JOIN profiles p ON p.email = a.email
UNION 
SELECT
	a.email as emailA, p.email
	FROM artists a
	RIGHT JOIN profiles p ON p.email = a.email
) as x