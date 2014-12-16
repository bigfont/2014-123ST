SET SQL_SAFE_UPDATES = 0;

DELETE FROM `studiowp`.`profiles`
WHERE tour_number IN (
	 5  -- Lan's Hands Pottery
    ,6  -- Paperockscissors Design
    ,8  -- Bohemian Arts Mixed Media
    ,10 -- Lori Davies Textiles
    ,21 -- Bob McKay Fine Woodturning
    ,29 -- Salt Spring Island Bread Co.
    ,30 -- Copper Wood Gallery
);

INSERT INTO `studiowp`.`profiles`
(tour_number, studio_name, contact_name, studio_address, password) VALUES
(5, 'Salt Spring Tweed', 'Cheyenne Goh', '225 Charlesworth', 'rS2pUV4E');

INSERT INTO `studiowp`.`profiles`
(tour_number, studio_name, contact_name, studio_address, password) VALUES
(6, 'The Gallery on Garner', 'Trish Brown', '131 Garner Road', 'nR4fuypC');

INSERT INTO `studiowp`.`profiles`
(tour_number, studio_name, contact_name, studio_address, password) VALUES
(8, 'Donna Horn Fine Arts', 'Donna Horn', '104 Teal Place', 'kYfUnDV8');

INSERT INTO `studiowp`.`profiles`
(tour_number, studio_name, contact_name, studio_address, password) VALUES
(10, 'Abara Designs', 'Barbara Clarke', '151 Morningside', 'wQ5rAQA9');

INSERT INTO `studiowp`.`profiles`
(tour_number, studio_name, contact_name, studio_address, password) VALUES
(21, 'Gillian Gandossi Fine Art Painting', 'Gillian Gandossi', 'Long Harbour Road', 'hA3kGupw');