.open database.sqlite

DROP TABLE if exists pets;
CREATE TABLE pets(
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  owner_id INT NOT NULL,
  name TEXT NOT NULL,
  type TEXT NOT NULL,
  birthday INT NOT NULL
);

DROP TABLE if exists actions;
CREATE TABLE actions (
  pet_id INT NOT NULL,
  action_type TEXT NOT NULL,
  date_time INT NOT NULL
);