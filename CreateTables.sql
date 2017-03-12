CREATE TABLE loyalty (
    loyalty varchar(255) NOT NULL,
    PRIMARY KEY (loyalty)
);

INSERT INTO loyalty(loyalty) values
("Imperium"), ("Chaos"), ("Rogue");

CREATE TABLE primarchs (
    primarchName varchar(255) NOT NULL,
    PRIMARY KEY (primarchName),
    UNIQUE KEY (primarchName)
);

INSERT INTO primarchs(primarchName) values
("Lion El'Johnson"), ("Fulgrim"), ("Perturabo"), ("Jaghatat Kahn"), ("Leman Russ"),
("Rogal Dorn"), ("Konrad Curze"), ("Sanguinius"), ("Ferrus Manus"), ("Angron"),
("Roboute Guilliman"), ("Mortarion"), ("Magnus the Red"), ("Horus Lupercal"), 
("Lorgar Aurelian"), ("Vulkan"), ("Corvus Corax"), ("Alpharius Omegon");

CREATE TABLE areas (
    id int NOT NULL AUTO_INCREMENT,
    areaName varchar(255),
    PRIMARY KEY(id),
    UNIQUE KEY(areaName)
);

CREATE TABLE theatreOfOperations(
    id int NOT NULL AUTO_INCREMENT,
    PRIMARY KEY(id)
);

CREATE TABLE chapters (
    id int NOT NULL AUTO_INCREMENT,
    chapterName varchar(255) NOT NULL,
    chapterPrimarch varchar(255),
    loyalty varchar(255) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (chapterName),
    FOREIGN KEY (loyalty) REFERENCES loyalty(loyalty),
    FOREIGN KEY (chapterPrimarch) REFERENCES primarchs(primarchName)
);

INSERT INTO chapters (chapterName, chapterPrimarch, loyalty) values
("Dark Angels", "Lion El'Johnson", "Imperium"),
("Ultramarines", "Roboute Guilliman", "Imperium"),
("Thousand Sons", "Magnus the Red", "Chaos"),
("Death Guard", "Mortarion", "Chaos");
