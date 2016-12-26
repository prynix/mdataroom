use adserver;
insert into user(id, username,password) values(2,'unilever',md5('unilever'));
insert into user(id, username,password) values(3,'robi',md5('robi'));
insert into advertiser (id, name, address, email, contact_no, user_id) values (1, 'Unilever Bangladesh', 'ZN Tower (Ground Floor), Plot-2, Road-8, Bir Uttam Mir Shawkat Sarak, Dhaka 1212, Bangladesh', 'info@unilever.com', '+880 1745-576878', 2);
insert into advertiser (id, name, address, email, contact_no, user_id) values (2, 'Robi Axiata Limited', '53 Gulshan South Avenue Gulshan 1', 'info@robi.com.bd', '+88 02 9887146-52', 3);
/*insert into advertiser (id, name, address, email, contact_no) values ('', '', '', '');
insert into advertiser (id, name, address, email, contact_no) values ('', '', '', '');*/

insert into brand (id, name, advertiser_id) values (1, 'Closeup', 1);
insert into brand (id, name, advertiser_id) values (2, 'Clear', 1);
insert into brand (id, name, advertiser_id) values (3, 'Pureit', 1);
insert into brand (id, name, advertiser_id) values (4, 'Robi 3G', 2);
insert into brand (id, name, advertiser_id) values (5, 'Robi Internet', 2);


insert into variant (id, name, brand_id) values (1, 'Closeup Papermint Splash', 1);
insert into variant (id, name, brand_id) values (2, 'Clear Anti Hair Fall', 2);
insert into variant (id, name, brand_id) values (3, 'Pureit Classic Blue', 3);
insert into variant (id, name, brand_id) values (4, 'Robi 3G', 4);
insert into variant (id, name, brand_id) values (5, 'Robi Internet', 5);


INSERT INTO campaign (id, name, start_date, end_date, budget, variant_id) VALUES
(1, 'Clear Eid Special', '2015-07-08', '2015-07-23', '10000000.00', 2),
(2, 'Closeup Eid Special', '2015-07-03', '2015-07-24', '20000000.00', 1),
(3, 'Pureit Eid Special', '2015-07-11', '2015-07-22', '15000000.00', 3);


INSERT INTO payment (id, amount, payment_date, campaign_id) VALUES
(1, '1000000.00', '2015-07-23', 1),
(2, '5000000.00', '2015-07-05', 2),
(3, '6000000.00', '2015-07-05', 3);


insert into device (id, name) values (0, 'desktop');
insert into device (id, name) values (1, 'mobile');
insert into device (id, name) values (2, 'tablet');
insert into device (id, name) values (9,'all');


insert into banner_type(name) values ("image");
insert into banner_type(name) values ("flash");


insert into publisher (name, address, email, contact_no) values ('Prothom Alo', 'The Institute of Chartered Accountants of Bangladesh, 100 Kazi Nazrul Islam Ave, Dhaka 1215, Bangladesh', 'info@prothom-alo.info', '+880 2-8110081');

