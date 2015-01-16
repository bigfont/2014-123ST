SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT 
	a.tour_number as TNA, p.tour_number
	FROM artists a
	LEFT JOIN profiles p ON Lower(a.tour_number) = p.tour_number
UNION 
SELECT
	a.tour_number as TNA, p.tour_number
	FROM artists a
	RIGHT JOIN profiles p ON a.tour_number = p.tour_number
) as x