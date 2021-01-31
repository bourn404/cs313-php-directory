

drop table if exists organizations;
create table organizations (id serial not null primary key
,org_name varchar(255) not null
,website varchar(255)
,notes TEXT
,address1 varchar(255)
,address2 varchar(255)
,city varchar(50)
,state varchar(10)
,zip varchar(15)
,logo_path varchar(255)
,is_interested boolean
);

drop table if exists program_types;
create table program_types (id serial not null primary key
,label varchar(255) not null
);

drop table if exists programs;
create table programs (id serial not null primary key
,program_type_id int not null references program_types(id)
,organization_id int not null references organizations(id)
,program_name varchar(255) not null
,program_frequency varchar(25)
,next_date date
,software_competitor varchar(50)
,software_annual_cost money
,notes TEXT
);


drop table if exists contacts;
create table contacts (id serial not null primary key
,organization_id int not null references organizations(id)
,is_primary_contact boolean
,first_name varchar(50) not null
,last_name varchar(50) not null
,title varchar(50)
,email varchar(255)
,phone varchar(15)
,photo_path varchar(255)
,notes TEXT
);