CREATE TABLE Loaders(
   lno INT,
   name VARCHAR(50),
   icon VARCHAR(50),
   PRIMARY KEY(lno)
);

CREATE TABLE Users(
   uno INT,
   name TEXT,
   email TEXT NOT NULL,
   phone TEXT,
   PRIMARY KEY(uno)
);

CREATE TABLE Vars(
   pno INT,
   FunctionName TEXT,
   ObjectReturned TEXT,
   Description TEXT,
   PRIMARY KEY(pno)
);

CREATE TABLE Tutorials(
   tno INT,
   title TEXT,
   version VARCHAR(50),
   description1 TEXT,
   code1 TEXT,
   pno INT NOT NULL,
   lno INT NOT NULL,
   PRIMARY KEY(tno),
   FOREIGN KEY(pno) REFERENCES Vars(pno),
   FOREIGN KEY(lno) REFERENCES Loaders(lno)
);

CREATE TABLE Posts(
   fno INT,
   title TEXT,
   description TEXT,
   uno INT NOT NULL,
   lno INT NOT NULL,
   PRIMARY KEY(fno),
   FOREIGN KEY(uno) REFERENCES Users(uno),
   FOREIGN KEY(lno) REFERENCES Loaders(lno)
);

INSERT INTO loaders(lno, name, icon) VALUE (1, 'forge', 'logo_forge');
INSERT INTO loaders(lno, name, icon) VALUE (2, 'fabric', 'logo_fabric');
INSERT INTO loaders(lno, name, icon) VALUE (3, 'neoforge', 'logo_neoforge');
INSERT INTO loaders(lno, name, icon) VALUE (4, 'default', 'logo_default');
