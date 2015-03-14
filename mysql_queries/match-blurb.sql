SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.blurb, p.info_description
	FROM artists a
	LEFT JOIN profiles p ON a.blurb = p.info_description
UNION 
SELECT
	a.blurb, p.info_description
	FROM artists a
	RIGHT JOIN profiles p ON a.blurb = p.info_description
) as x