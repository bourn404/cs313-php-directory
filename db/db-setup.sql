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

insert into organizations (org_name, website, address1, city, state, zip) values 
('Canyons Education Foundation','https://foundation.canyonsdistrict.org','9361 S. 300 East','Sandy','UT','84070'),
('Jordan Education Foundation','https://jordaneducationfoundation.org','7387 Campus View Drive','West Jordan','UT','84084'),
('Alpine Education Foundation','https://foundation.alpineschools.org','575 N 100 E','American Fork','UT','84003');

drop table if exists program_types;
create table program_types (id serial not null primary key
,label varchar(255) not null
);

insert into program_types (label) values
('Golf Tournament'),
('Gala'),
('Scholarship'),
('Cash Fundraiser'),
('Auction'),
('Grant'),
('In-Kind Donation Drive'),
('Fun Run');


drop table if exists programs;
create table programs (id serial not null primary key
,program_type_id int not null references program_types(id) ON DELETE CASCADE
,organization_id int not null references organizations(id) ON DELETE CASCADE
,program_name varchar(255) not null
,program_frequency varchar(25)
,next_date date
,software_competitor varchar(50)
,software_annual_cost money
,notes TEXT
);

insert into programs (program_type_id, organization_id, program_name, program_frequency,next_date,notes) values
((select id from program_types where label = 'Golf Tournament'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Foundation Golf Tournament','Annual',TO_DATE('09/22/2021','MM/DD/YYYY'),null),
((select id from program_types where label = 'Gala'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Foundation Gala','Annual',null,null),
((select id from program_types where label = 'Scholarship'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Bright Star / Rising Star Scholarship','Annual',TO_DATE('03/23/2021','MM/DD/YYYY'),'For high school seniors who show improvement or exemplary effort in working toward the goal of post-secondary education.'),
((select id from program_types where label = 'Scholarship'),(select id from organizations where org_name = 'Canyons Education Foundation'),'my529 Savings Scholarship','Annual',TO_DATE('03/10/2021','MM/DD/YYYY'),'For 7th graders whose parents did not graduate from college.'),
((select id from program_types where label = 'Grant'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Teacher Innovation Grants','Annual',null,null),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Peachjar e-Flyers','Continuous',null,null),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Banner Sales','Continuous',null,null),
((select id from program_types where label = 'Auction'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Gathering for Good','Annual',null,'Internal auction for employees immediately prior to winter break'),
((select id from program_types where label = 'In-Kind Donation Drive'),(select id from organizations where org_name = 'Canyons Education Foundation'),'Teacher of the Year','Annual',null,null),
((select id from program_types where label = 'Golf Tournament'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Swing for the Stars Golf Tournament','Annual',null,'Benefits literacy initiatives'),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Caring at Christmas','Annual',null,'(Sub for Santa)'),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Alpine Education Foundation'),'SIMS Program','Continuous',null,'Summertime reading and math program for students entering 7th grade who perform below grade level'),
((select id from program_types where label = 'In-Kind Donation Drive'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Kids CLoset','Continuous',null,'Providing clothes to students in-need'),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Principals Pantry','Continuous',null,'Providing food to students in-need'),
((select id from program_types where label = 'In-Kind Donation Drive'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Accent on Excellence Awards','Annual',null,'Awards ceremony honoring exemplary teachers and staff.'),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Alpine Education Foundation'),'Christa Mcauliffe Space Center','Continuous',null,'Accumulating funds to build a planetarium in their existing outerspace education facility'),
((select id from program_types where label = 'In-Kind Donation Drive'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Tools for Schools','Continuous',null,'School supplies and backpacks for students in-need.'),
((select id from program_types where label = 'Scholarship'),(select id from organizations where org_name = 'Jordan Education Foundation'),'JEF Turnaround Scholarship','Annual',TO_DATE('03/13/2021','MM/DD/YYYY'),'Principals nominate one high school senior who has overcome personal hardship, shown marked improvement, and committed to higher education.'),
((select id from program_types where label = 'Scholarship'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Bingham Canyon Lions Club Scholarship','Annual',TO_DATE('03/31/2021','MM/DD/YYYY'),'Available to all high-school senior Copperton residents'),
((select id from program_types where label = 'Scholarship'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Registered Physical Therapists (RPT) Scholarship','Annual',TO_DATE('04/20/2021','MM/DD/YYYY'),'For athlete students who express interest in the healthcare industry'),
((select id from program_types where label = 'Grant'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Classroom Grants','Annual',null,null),
((select id from program_types where label = 'Cash Fundraiser'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Peachjar e-Flyers','Continuous',null,null),
((select id from program_types where label = 'Golf Tournament'),(select id from organizations where org_name = 'Jordan Education Foundation'),'Links to Schools Golf Classic','Annual',null,null);


drop table if exists contacts;
create table contacts (id serial not null primary key
,organization_id int not null references organizations(id) ON DELETE CASCADE
,is_primary_contact boolean
,first_name varchar(50) not null
,last_name varchar(50) not null
,title varchar(50)
,email varchar(255)
,phone varchar(15)
,photo_path varchar(255)
,notes TEXT
);

insert into contacts (organization_id,is_primary_contact,first_name,last_name,title,email,phone) values 
((select id from organizations where org_name = 'Canyons Education Foundation'),true,'Denise','Haycock','Development Officer','denise.haycock@canyonsdistrict.org','801-826-5178'),
((select id from organizations where org_name = 'Canyons Education Foundation'),true,'Susan','Edwards','Public Engagement Coordinator','susan.edwards@canyonsdistrict.org','801-826-5194'),
((select id from organizations where org_name = 'Jordan Education Foundation'),true,'Steven','Hall','Executive Director','steven.hall@jordandistrict.org',null),
((select id from organizations where org_name = 'Jordan Education Foundation'),true,'Anne','Gould',null,'anne.gould@jordandistrict.org',null),
((select id from organizations where org_name = 'Alpine Education Foundation'),true,'Tyler','Vigue','Executive Director','tvigue@alpinedistrict.org','801-610-8425');