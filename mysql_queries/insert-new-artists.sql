INSERT INTO artists (
	name, view_order, artist, blurb, craft, tour_number, address, postal_code, phone, email, website, grid_thumb, grid_photo, copy
    ,hours_sun, hours_mon, hours_tue, hours_wed, hours_thu, hours_fri, hours_sat, lat, lng
    )
SELECT 
	studio_name, -1, contact_name, info_description, "", tour_number, studio_address, "", phone, email, website, "grid_thumb", "grid_photo", bookleft_1
    ,"hours_sun", "hours_mon", "hours_tue", "hours_wed", "hours_thu", "hours_fri", "hours_sat", "lat", "lng"
FROM profiles
WHERE studio_name NOT IN (SELECT name FROM artists)
AND studio_name NOT LIKE "%test%";