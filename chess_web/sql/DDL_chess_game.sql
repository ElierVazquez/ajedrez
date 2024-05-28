DROP SCHEMA IF EXISTS chess_game;
CREATE SCHEMA chess_game;

USE chess_game;

CREATE TABLE T_Players(
ID int primary key auto_increment,
name varchar(30) unique not null,
email varchar(50) UNIQUE not null,
password varchar(255) not null,
premium boolean not null
);

CREATE TABLE T_Matches(
ID int primary key auto_increment,
title varchar(50) not null,
white int not null,
black int not null,
startDate datetime not null,
endDate datetime,
winner varchar(10),
state varchar(20) not null default("En curso"),
    FOREIGN KEY (white) REFERENCES T_Players(ID),
    FOREIGN KEY (black) REFERENCES T_Players(ID)
);

CREATE TABLE T_Board_Status(
ID int auto_increment, 
IDGame int,
board varchar(500), /* Modificar si es necesario */
turn int,
primary key(ID,IDGame),
FOREIGN KEY (IDGame) REFERENCES T_Matches(ID)
);

DELIMITER $$
CREATE TRIGGER insert_new_status
AFTER INSERT ON T_Matches
FOR EACH ROW
BEGIN
    INSERT INTO T_Board_Status (IDGame, board, turn) values (new.ID, "ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH", 0);
END $$
DELIMITER ;


/* INSERT INTO T_Players(name, email, password, premium) 
    values
("Elier", "eliervazquezdelvalle2002@gmail.com", "12345678", true),
("lokuelo23", "elloko@gmail.com", "MeGustaElAjedrez", false); */ -- -> Hay que hashear las contraseñas, por el momento hay que crear a los usuarios por la página de registro.

/* insert into T_Matches(title, startDate, state, white, black) 
	values 
("Gámbito de dama", NOW(), "En curso", 1, 2);

insert into T_Matches(title, startDate, state, white, black) 
	values 
("Prueba", NOW(), "En curso", 2, 1);

insert into T_Board_Status(IDGame, turn, board) values (1, 0,
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");

insert into T_Board_Status(IDGame, turn, board) values (1, 1, 
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,PAWH,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,0,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");

insert into T_Board_Status(IDGame, turn, board) values (1, 2, 
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,0,PABL,PABL,PABL_0,0,0,0,PABL,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,PAWH,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,0,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");

insert into T_Board_Status(IDGame, turn, board) values (1, 3, 
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,0,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,PABL,0,0,0,0_0,0,0,PAWH,PAWH,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,0,0,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");

insert into T_Board_Status(IDGame, turn, board) values (2, 0,
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");

insert into T_Board_Status(IDGame, turn, board) values (2, 1,
"ROBL,KNBL,BIBL,QUBL,KIBL,BIBL,KNBL,ROBL_PABL,PABL,PABL,PABL,PABL,PABL,PABL,PABL_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,0,0,0,0_0,0,0,0,PAWH,0,0,0_PAWH,PAWH,PAWH,PAWH,0,PAWH,PAWH,PAWH_ROWH,KNWH,BIWH,QUWH,KIWH,BIWH,KNWH,ROWH");
*/