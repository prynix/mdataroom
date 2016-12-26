create database adserver;
use adserver;

create table advertiser (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    address varchar(200),
    email varchar(80),
    contact_no varchar(20),
    index advertiser_index(id)
) engine=innodb;


create table brand (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    advertiser_id int not null,
    foreign key (advertiser_id) references advertiser(id),
    index brand_index(id)
) engine=innodb;

create table variant (
    id int not null auto_increment,
    primary key(id),
    name varchar(100),
    brand_id int not null,
    foreign key (brand_id) references brand (id),
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
    foreign key (variant_id) references variant(id),
    index campaign_index(id)
) engine=innodb;


create table payment(
    id int not null auto_increment,
    primary key(id),
    amount numeric(15,2),
    payment_date date,
    campaign_id int not null,
    foreign key (campaign_id) references campaign(id),
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
    foreign key (campaign_id) references campaign(id),
    banner_type_id int not null,
    foreign key (banner_type_id) references banner_type(id),
    device_id int not null,
    foreign key (device_id) references device(id),
    link varchar(400),
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
    publisher_id int not null,
    foreign key (publisher_id) references publisher(id),
    index placement_index(id)
) engine=innodb;

create table ad_report_summary(
    id int not null auto_increment,
    primary key(id),
    summary_date date,
    click int,
    impression int,
    placement_id int not null,
    foreign key (placement_id) references placement(id),
    banner_id int not null,
    foreign key (banner_id) references banner(id),
    index ad_report_summary_index(id)
) engine=innodb;

create table ad_record(
    id bigint not null auto_increment,
    primary key(id),
    click_impression tinyint(1),
    time timestamp,
    source varchar(200),
    placement_id int not null,
    foreign key (placement_id) references placement(id),
    index ad_record_index(id)
) engine=innodb;

create table banner_placement (
    id int not null auto_increment,
    primary key(id),
    impression_ratio int,
    banner_id int not null,
    foreign key (banner_id) references banner(id),
    placement_id int not null,
    start_time timestamp,
    end_time timestamp,
    device_id int not null,
    foreign key (device_id) references device(id),
    foreign key (placement_id) references placement(id),
    index banner_placement_index(id)
) engine=innodb;

create table user(
    id int not null auto_increment,
    primary key(id),
    username varchar(20) not null,
    password varchar(50) not null,
    full_name varchar(80),
    email varchar(80),
    constraint username_constraint unique(username),
    index user_index(id)
) engine=innodb;


insert into user(username,password) values('admin',md5('admin'));