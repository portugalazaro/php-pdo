<?php


$pdo = new PDO('sqlite:' . __DIR__.  '/banco.sqlite');

// $sql = "INSERT INTO phones (area_code, number, student_id) VALUES ('47','97891287',2)";

// exit();


$sql = 'CREATE TABLE IF NOT EXISTS phones (
	id INTEGER PRIMARY KEY,
	area_code TEXT,
	number TEXT,
	student_id INTEGER,
	FOREIGN KEY (student_id) REFERENCES students(id)
);';

$pdo->exec($sql);