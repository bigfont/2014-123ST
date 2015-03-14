SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.website as websiteA, p.website
	FROM artists a
	LEFT JOIN profiles p ON p.website = a.website
UNION 
SELECT
	a.website as websiteA, p.website
	FROM artists a
	RIGHT JOIN profiles p ON p.website = a.website
) as x