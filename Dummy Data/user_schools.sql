insert into school (idSchool, School_Name, Phone, Email, Principal_ID,  Address_Id,School_Admin_Id ) 
            values (1, 'Jefferson Middle School','334-211-2197', 'jeffersonmiddleschool@gmail.com', '1000',1, 21 );

insert into school (idSchool, School_Name, Phone, Email, Principal_ID,  Address_Id,School_Admin_Id ) 
	    values (2, 'Lincoln High School','640-500-2967', 'lincolnhighschool@gmail.com', '2000',2, 22 );

insert into school (idSchool, School_Name, Phone, Email, Principal_ID,  Address_Id,School_Admin_Id ) 
	    values (3, 'Washington Elementary School','557-105-9161', 'washingtonelementary@gmail.com', '3000',3, 23 );

insert into school (idSchool, School_Name, Phone, Email, Principal_ID,  Address_Id,School_Admin_Id ) 
	    values (4, 'New Arc High School','116-544-2311', 'newarchighschool@gmail.com', '4000',4, 24 );



#INSERT SCHOOL ADMIN

insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (21, 'YOMAMAMOTO', 'legen1', 'Yomama', 'Moto', 69, 'yomamamoto@gmail.com', 1, '100', 2, 2, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (22, 'JOMAMAKOTO', 'legen2', 'Jomama', 'Koto', 50, 'jomamaKoto@gmail.com', 1, '101', 1, 2, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (23, 'KOMAMABOTO', 'legen3', 'Komama', 'Boto', 38, 'komamaboto@gmail.com', 1, '102', 0, 2, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (24, 'JOHNFOSO', 'legen4', 'John', 'Foso', 43, 'johnfoso@gmail.com', 1, '103', 0, 2, 4);

#INSERT ADMIN

insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (31,'AmbrosiusYandle', 'admin1', 'Ambrosius', 'Yandle', 52, 'AmbrosiusYandle@gmail.com', 1, '104', 1, 3, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (32,'SalomonHelstrom', 'admin2', 'Salomon', 'Helstrom', 53, 'SalomonHelstrom@gmail.com', 1, '105', 0, 3, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (33,'WilhelminaHechlin', 'admin3', 'Wilhelmina', 'Hechlin', 54, 'WilhelminaHechlin@gmail.com', 1, '106', 0, 3, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (34,'GiffordPitrollo', 'admin4', 'Gifford', 'Pitrollo', 55, 'GiffordPitrollo@gmail.com', 1, '107', 2, 3, 4);

#INSERT TEACHER

insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (10,'OphelieSoutherton', 'teacher1', 'Ophelie', 'Southerton', 50, 'OphelieSoutherton@gmail.com', 1, '108', 1, 1, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (11,'RandieBoyet', 'teacher2', 'Randie', 'Boyet', 40, 'RandieBoyet@gmail.com', 1, '109', 0, 1, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (12,'MauritsWiddicombe', 'teacher3', 'Maurits', 'Widdicombe', 41, 'MauritsWiddicombe@gmail.com', 1, '110', 2, 1, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (13,'MaximoMityushkin', 'teacher4', 'Maximo', 'Mityushkin', 42, 'MaximoMityushkin@gmail.com', 1, '111', 0, 1, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (14,'TrentCreffield', 'teacher5', 'Trent', 'Creffield', 43, 'TrentCreffield@gmail.com', 1, '112', 1, 1, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (15,'DionneBrute', 'teacher6', 'Dionne', 'Brute', 44, 'DionneBrute@gmail.com', 1, '113', 1, 1, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (16,'LanieClayborn', 'teacher7', 'Lanie', 'Clayborn', 45, 'LanieClayborn@gmail.com', 1, '114', 0, 1, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (17,'ErnestusMeigh', 'teacher8', 'Ernestus', 'Meigh', 46, 'ErnestusMeigh@gmail.com', 1, '115', 2, 1, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (18,'SheldenHeeney', 'teacher9', 'Shelden', 'Heeney', 47, 'SheldenHeeney@gmail.com', 1, '116', 0, 1, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (19,'BerniceGirardengo', 'teacher10', 'Bernice', 'Girardengo', 48, 'BerniceGirardengo@gmail.com', 1, '117', 1, 1, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (20,'LouiseMulqueeny', 'teacher11', 'Louise', 'Mulqueeny', 49, 'LouiseMulqueeny@gmail.com', 1, '118', 1, 1, 4);

#INSERT STUDENTS
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (50,'RafaCorps', 'student1', 'Rafa', 'Corps', 12, 'RafaCorps@gmail.com', 1, '119', 2, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (51,'ArchibaldNeising', 'student2', 'Archibald', 'Neising', 13, 'ArchibaldNeising@gmail.com', 1, '120', 1, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (52,'StephanWaddams', 'student3', 'Stephan', 'Waddams', 14, 'StephanWaddams@gmail.com', 1, '121', 0, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (53,'BingMarsters', 'student4', 'Bing', 'Marsters', 15, 'BingMarsters@gmail.com', 1, '122', 2, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (54,'SiegfriedBreeds', 'student5', 'Siegfried', 'Breeds', 16, 'SiegfriedBreeds@gmail.com', 1, '123', 0, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (55,'VeroniqueShafto', 'student6', 'Veronique', 'Shafto', 17, 'VeroniqueShafto@gmail.com', 1, '124', 2, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (56,'CalypsoWhordley', 'student7', 'Calypso', 'Whordley', 18, 'CalypsoWhordley@gmail.com', 1, '125', 0, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (57,'DeinaWippermann', 'student8', 'Deina', 'Wippermann', 12, 'DeinaWippermann@gmail.com', 1, '126', 1, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (58,'PatenStarbuck', 'student9', 'Paten', 'Starbuck', 13, 'PatenStarbuck@gmail.com', 1, '127', 0, 0, 1);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (59,'LucilaGregolotti', 'student10', 'Lucila', 'Gregolotti', 14, 'LucilaGregolotti@gmail.com', 1, '128', 2, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (60,'WrennieSantori', 'student11', 'Wrennie', 'Santori', 15, 'WrennieSantori@gmail.com', 1, '129', 1, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (61,'EloiseHeadrick', 'student12', 'Eloise', 'Headrick', 16, 'EloiseHeadrick@gmail.com', 1, '130', 0, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (62,'ValliVasyunin', 'student13', 'Valli', 'Vasyunin', 17, 'ValliVasyunin@gmail.com', 1, '131', 0, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (63,'AntonettaGeipel', 'student14', 'Antonetta', 'Geipel', 18, 'AntonettaGeipel@gmail.com', 1, '132', 1, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (64, 'ClaudettaBattaille', 'student15',  'Claudetta', 'Battaille', 12, 'ClaudettaBattaille@gmail.com', 1, '133', 2, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (65, 'WinnieRobelin', 'student16',  'Winnie', 'Robelin', 13, 'WinnieRobelin@gmail.com', 1, '134', 2, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (66, 'VassilyGillitt', 'student17',  'Vassily', 'Gillitt', 14, 'VassilyGillitt@gmail.com', 1, '135', 0, 0, 2);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (67, 'BenettaTempleman', 'student18',  'Benetta', 'Templeman', 15, 'BenettaTempleman@gmail.com', 1, '136', 2, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (68, 'AshelyBranchflower', 'student19',  'Ashely', 'Branchflower', 16, 'AshelyBranchflower@gmail.com', 1, '137', 2, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (69, 'TraceyLeLeu', 'student20',  'Tracey', 'Le Leu', 17, 'TraceyLeLeu@gmail.com', 1, '138', 0, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (70, 'ZsazsaCaswall', 'student21', 'Zsazsa', 'Caswall', 12, 'ZsazsaCaswall@gmail.com', 1, '139', 1, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (71, 'MikaelaPieper', 'student22', 'Mikaela', 'Pieper', 13, 'MikaelaPieper@gmail.com', 1, '140', 0, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (72, 'DalstonGibbie', 'student23', 'Dalston', 'Gibbie', 14, 'DalstonGibbie@gmail.com', 1, '141', 2, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (73, 'VeraTimblett', 'student24', 'Vera', 'Timblett', 15, 'VeraTimblett@gmail.com', 1, '142', 0, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (74, 'RaimundBransom', 'student25','Raimund', 'Bransom', 16, 'RaimundBransom@gmail.com', 1, '143', 1, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (75, 'NolanaCosten', 'student26','Nolana', 'Costen', 16, 'NolanaCosten@gmail.com', 1, '144', 0, 0, 3);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (76, 'EldenStanlake', 'student27','Elden', 'Stanlake', 17, 'EldenStanlake@gmail.com', 1, '145', 2, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (77, 'AngeliIglesiaz', 'student28','Angeli', 'Iglesiaz', 12, 'AngeliIglesiaz@gmail.com', 1, '146', 2, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (78, 'CherylShippey', 'student29','Cheryl', 'Shippey', 13, 'CherylShippey@gmail.com', 1, '147', 1, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (79, 'NealeExon', 'student30','Neale', 'Exon', 14, 'NealeExon@gmail.com', 1, '148', 0, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (80,'MartiBarti', 'student31','Marti', 'Barti', 15, 'MartiBarti@gmail.com', 1, '149', 2, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (81, 'EzekielPickerin', 'student32', 'Ezekiel', 'Pickerin', 17, 'EzekielPickerin@gmail.com', 1, '150', 0, 0, 4);
insert into users (User_ID, Username, Password , First_Name, Last_Name, Age, email, Registration_Status, Borrowred_Card_Number, Number_Of_Loaned_Books , Type, School_Id )
          values (82,'DorolicePetrescu', 'student33','Dorolice', 'Petrescu', 16, 'DorolicePetrescu@gmail.com', 1, '151', 1, 0, 4);

