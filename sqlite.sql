/*
CREATE TABLE User (ID integer NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, Name text NOT NULL,MatchType integer NOT NULL, Sex text NOT NULL,Age integer NOT NULL,IDCard text NOT NULL, Email text NOT NULL, Region integer NOT NULL, Address text NOT NULL,Phone integer NOT NULL,Contact text NOT NULL,ContactPhone integer NOT NULL,"Date" timestamp NOT NULL);
*/
CREATE TABLE User (ID integer NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, Name text NOT NULL, Sex text NOT NULL,Age integer NOT NULL,IDCard text NOT NULL, Email text NOT NULL, Region integer NOT NULL, Address text NOT NULL,Phone integer NOT NULL,Contact text NOT NULL,ContactPhone integer NOT NULL,"Date" timestamp NOT NULL);
CREATE TABLE Comment (ID integer NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE, Name text NOT NULL,Comment Text NOT NULL,Phone integer NOT NULL,"Date" timestamp NOT NULL);
