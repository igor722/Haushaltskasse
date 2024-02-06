CREATE TABLE users_inputs (
	user_id int REFERENCES users(user_id) NOT NULL,
	input_id int REFERENCES inputs(input_id) NOT NULL,
    PRIMARY KEY (user_id, input_id)
);

Für SQL Kreuztabelle, ich muss wahrscheinlich alle Datensätze erst löschen


<p>Hallo, <?php echo $greetingName ?></p>