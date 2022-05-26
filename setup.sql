.open database.sqlite

DROP TABLE if exists pets;
CREATE TABLE pets(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  owner_id INT NOT NULL,
  name TEXT NOT NULL,
  type INT NOT NULL,
  birthday INT NOT NULL,
  dead INT NOT NULL DEFAULT 0,
  imortal INT NOT NULL DEFAULT 0
);
INSERT INTO pets (owner_id, name, type, birthday) VALUES (1, "twenty seven", 2, 1652981087);

DROP TABLE if exists actions;
CREATE TABLE actions (
  pet_id INT NOT NULL,
  action_type TEXT NOT NULL,
  date_time INT NOT NULL
);

DROP TABLE if exists petTypes;
CREATE TABLE petTypes (
  id INT NOT NULL,
  healthy_weight INT NOT NULL,
  name TEXT NOT NULL
);
INSERT INTO petTypes (id, name, healthy_weight) VALUES (1,"dog",30000);
INSERT INTO petTypes (id, name, healthy_weight) VALUES (2,"cat",10000);
INSERT INTO petTypes (id, name, healthy_weight) VALUES (3,"parrot",300);
INSERT INTO petTypes (id, name, healthy_weight) VALUES (4,"snake",5000);
INSERT INTO petTypes (id, name, healthy_weight) VALUES (5,"other",1000);