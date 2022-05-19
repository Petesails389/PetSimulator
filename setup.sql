.open database.sqlite

DROP TABLE if exists pets;
CREATE TABLE pets(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  owner_id INT NOT NULL,
  name TEXT NOT NULL,
  type INT NOT NULL,
  birthday INT NOT NULL
);

DROP TABLE if exists actions;
CREATE TABLE actions (
  pet_id INT NOT NULL,
  action_type TEXT NOT NULL,
  date_time INT NOT NULL
);

DROP TABLE if exists petTypes;
CREATE TABLE petTypes (
  id INT NOT NULL,
  name TEXT NOT NULL
);
INSERT INTO petTypes (id, name) VALUES (1,"dog");
INSERT INTO petTypes (id, name) VALUES (2,"cat");
INSERT INTO petTypes (id, name) VALUES (3,"parrot");
INSERT INTO petTypes (id, name) VALUES (4,"snake");
INSERT INTO petTypes (id, name) VALUES (5,"other");