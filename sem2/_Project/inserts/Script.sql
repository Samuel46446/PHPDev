CREATE TABLE Tutorials(
                          tno SERIAL,
                          title TEXT,
                          version TEXT,
                          about TEXT,
                          description TEXT,
                          finalDesc TEXT,
                          PRIMARY KEY(tno)
);

CREATE TABLE Loaders(
                        lno INT,
                        name VARCHAR(50),
                        icon VARCHAR(50),
                        PRIMARY KEY(lno)
);

CREATE TABLE Users(
                      uno SERIAL,
                      name TEXT UNIQUE NOT NULL,
                      email TEXT UNIQUE NOT NULL,
                      password TEXT,
                      phone TEXT,
                      PRIMARY KEY(uno)
);

CREATE TABLE Components(
                           cno TEXT,
                           description TEXT,
                           code TEXT,
                           lno INT NOT NULL,
                           PRIMARY KEY(cno, lno),
                           FOREIGN KEY(lno) REFERENCES Loaders(lno)
);

CREATE TABLE Post(
                      pno INT,
                      title TEXT,
                      description TEXT,
                      version TEXT,
                      uno INT NOT NULL,
                      lno INT NOT NULL,
                      PRIMARY KEY(pno),
                      FOREIGN KEY(uno) REFERENCES Users(uno),
                      FOREIGN KEY(lno) REFERENCES Loaders(lno)
);

CREATE TABLE Reponse(
    rno INT,
    msg TEXT,
    pno INT NOT NULL,
    uno INT NOT NULL,
    PRIMARY KEY(rno),
    FOREIGN KEY(uno) REFERENCES Users(uno),
    FOREIGN KEY(pno) REFERENCES Post(pno)
);

CREATE TABLE LoaderTuto(
                           tno INT,
                           lno INT,
                           PRIMARY KEY(tno, lno),
                           FOREIGN KEY(tno) REFERENCES Tutorials(tno),
                           FOREIGN KEY(lno) REFERENCES Loaders(lno)
);

--Deprecated CREATE TABLE Gets(
--                      tno INT,
--                      cno TEXT,
--                      PRIMARY KEY(tno, cno),
--                      FOREIGN KEY(tno) REFERENCES Tutorials(tno),
--                      FOREIGN KEY(cno) REFERENCES Components(cno)
-- );

INSERT INTO loaders(lno, name, icon) VALUES (1, 'forge', 'logo_forge');
INSERT INTO loaders(lno, name, icon) VALUES (2, 'fabric', 'logo_fabric');
INSERT INTO loaders(lno, name, icon) VALUES (3, 'neoforge', 'logo_neoforge');
INSERT INTO loaders(lno, name, icon) VALUES (4, 'minecraft', 'logo_minecraft');

INSERT INTO Users(name, email, password, phone) VALUES ('GarsDexemple', 'garsexemple@gmail.com', 'exemple', '05002155');
INSERT INTO Users(name, email, password, phone) VALUES ('Sam', 'sam@gmail.com', 'spacetoad', '06902848');

INSERT INTO Post(pno, title, description, version, uno, lno) VALUES (1, 'Comment créer de la nourriture à effet',
'Bonjour je cherche à savoir comment créer une nourriture à effet pour Minecraft Neoforge 1.21.4.', '1.21.4',
1, 3);

INSERT INTO Reponse(rno, msg, pno, uno) VALUES (1,
'Salut, a tu regarder du coté des properties des items, il y a une fonction effect qui permet de faire cela.',
1, 2);


INSERT INTO Reponse(rno, msg, pno, uno) VALUES (2,
'A Merci 👍 !',
1, 1);

INSERT INTO Post(pno, title, description, version, uno, lno) VALUES (2, 'Comment créer une armure',
                                                                     'Bonjour je cherche à savoir comment créer une armure pour Minecraft Fabric 1.21.4.', '1.21.4',
                                                                     2, 2);


