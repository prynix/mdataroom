create database adserver;
use adserver;

create table user(
    id int not null auto_increment,
    primary key(id),
    username varchar(20) not null,
    password varchar(50) not null,
    full_name varchar(80),
    email varchar(80),
    user_role enum('advertiser', 'admin', 'user') not null default 'advertiser',
    constraint username_constraint unique(username),
    index user_index(id)
) engine=innodb;


insert into user(username,password,user_role) values('admin',md5('admin'),'admin');

create table advertiser (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    address varchar(200),
    email varchar(80),
    contact_no varchar(20),
    user_id int not null,
    foreign key (user_id) references user(id) on delete cascade on update cascade,
    index advertiser_index(id)
) engine=innodb;


create table brand (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    advertiser_id int not null,
    foreign key (advertiser_id) references advertiser(id) on delete cascade on update cascade,
    index brand_index(id)
) engine=innodb;

create table variant (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    brand_id int not null,
    foreign key (brand_id) references brand (id) on delete cascade on update cascade,
    index variant_index(id)
) engine=innodb;

create table campaign (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    start_date date,
    end_date date,
    budget numeric(15,2),
    variant_id int not null,
    foreign key (variant_id) references variant(id) on delete cascade on update cascade,
    index campaign_index(id)
) engine=innodb;


create table payment(
    id int not null auto_increment,
    primary key(id),
    amount numeric(15,2),
    payment_date date,
    campaign_id int not null,
    foreign key (campaign_id) references campaign(id) on delete cascade on update cascade,
    index payment_index(id)
) engine=innodb;

create table device(
    id int not null auto_increment,
    primary key(id),
    name varchar(40) not null,
    index device_index(id)
) engine=innodb;


create table banner_type (
    id int not null auto_increment,
    primary key(id),
    name varchar(20) not null,
    index banner_type_index(id)
) engine=innodb;

create table banner(
    id int not null auto_increment,
    primary key(id),
    url varchar(400),
    caption varchar(200),
    campaign_id int not null,
    foreign key (campaign_id) references campaign(id) on delete cascade on update cascade,
    banner_type_id int not null,
    foreign key (banner_type_id) references banner_type(id) on delete cascade on update cascade,
    device_id int not null default 9,
    foreign key (device_id) references device(id) on delete cascade on update cascade,
    link varchar(400),
    constraint bannercaption_constraint unique(caption),
    index banner_index(id)
) engine=innodb;

create table publisher (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    address varchar(200),
    email varchar(80),
    contact_no varchar(20),
    index publisher_index(id)
) engine=innodb;

create table placement(
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    position varchar(100),
    width int,
    height int,
    default_banner_id int,
    foreign key (default_banner_id) references banner(id) on delete cascade on update cascade,
    publisher_id int not null,
    foreign key (publisher_id) references publisher(id) on delete cascade on update cascade,
    index placement_index(id)
) engine=innodb;

create table ad_report_summary(
    id int not null auto_increment,
    primary key(id),
    summary_date date,
    click int,
    impression int,
    request int,
    placement_id int not null,
    foreign key (placement_id) references placement(id) on delete cascade on update cascade,
    banner_id int not null,
    foreign key (banner_id) references banner(id) on delete cascade on update cascade,
    index ad_report_summary_index(id)
) engine=innodb;

create table ad_record(
    id bigint not null auto_increment,
    primary key(id),
    click_impression tinyint(1),
    time timestamp,
    source varchar(200),
    ip varchar(20),
    session_id varchar(100),
    cookie_id varchar(100),
    placement_id int not null,
    foreign key (placement_id) references placement(id) on delete cascade on update cascade,
    banner_id int not null,
    foreign key (banner_id) references banner(id) on delete cascade on update cascade,
    index ad_record_index(id)
) engine=innodb;

create table banner_placement (
    id int not null auto_increment,
    primary key(id),
    impression_ratio int,
    banner_id int not null,
    foreign key (banner_id) references banner(id) on delete cascade on update cascade,
    placement_id int not null,
    start_time timestamp,
    end_time timestamp,
    device_id int not null default 9,
    ad_publishing_cost_method enum('CPM', 'CPC') not null,
    per_unit_ad_publishing_cost int not null,
    ad_serving_cost_method enum('CPM', 'CPC') not null,
    per_unit_ad_serving_cost int not null,
    active tinyint(1) not null default 1,
    foreign key (device_id) references device(id) on delete cascade on update cascade,
    foreign key (placement_id) references placement(id) on delete cascade on update cascade,
    index banner_placement_index(id)
) engine=innodb;