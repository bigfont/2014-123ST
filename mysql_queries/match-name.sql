SET @count = 0;

SET @valid_studios =
	concat_ws(","
		,"Sacred Mountain Lavender"
        ,"Bite Me! Treats"
        ,"Salt Spring Island Ales"
        ,"Salt Spring Vineyards"
        ,"Cherry Blossom Design"
        ,"Sonia Studio"
		,"Studio Coney"
		,"Islandweaver Design"
        ,"Sunset Farm"
		,"Blue Horse Folk Art Gallery"
        ,"Soul Path Shoes"
        ,"Tufted Puffin Gallery"
        ,"Julie MacKinnon Ceramics"
        ,"Serendipity Studio"
        ,"Elf Works"
        ,"Moonstruck Organic Cheese"
        ,"The Farmhouse Gallery"
        ,"Salt Spring Island Cheese"
        ,"Test Account"        
		,"Ulrieke Benner -- Art You Wear"
        ,"CSM Gallery and Studio"
        ,"Stark Natural Herbs"
        ,"French Country Fabrics"        
		,"Salt Spring Tweed" 
        ,"The Gallery on Garner"
        ,"Donna Horn Fine Arts"     
        ,"Abara Designs" 
        ,"Gillian Gandossi Fine Art Painting" 
        ,"The Glass Foundry" 
        ); 

SET @count = 0;

SELECT x.*,
@count:=@count+1 as count

FROM
(
SELECT
	p.studio_name as "p.studio_name", a.name as "a.name"
    ,p.contact_name as "p.contact_name", a.artist as "a.artist"
    ,p.info_description as "p.info_description", a.blurb as "a.blurb"
	FROM artists a
	RIGHT JOIN profiles p ON a.name = p.studio_name
	WHERE FIND_IN_SET(p.studio_name, @valid_studios)
UNION    
SELECT 
	p.studio_name as "p.studio_name", a.name as "a.name"
    ,p.contact_name as "p.contact_name", a.artist as "a.artist"
    ,p.info_description as "p.info_description", a.blurb as "a.blurb"
	FROM artists a
	LEFT JOIN profiles p ON a.name = p.studio_name
) as x;