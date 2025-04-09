<?php
$db = new PDO('sqlite:db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//create table if not exists
$db->exec("CREATE TABLE IF NOT EXISTS questions (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  question TEXT
)");

$db->exec("CREATE TABLE IF NOT EXISTS answers (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  question_id INTEGER,
  text TEXT,
  correct INTEGER
)");

$questions = [];

$qStmt = $db->query("SELECT * FROM questions");
while ($row = $qStmt->fetch(PDO::FETCH_ASSOC)) {
  $aStmt = $db->prepare("SELECT text, correct FROM answers WHERE question_id = ?");
  $aStmt->execute([$row['id']]);
  $answers = $aStmt->fetchAll(PDO::FETCH_ASSOC);
  $questions[] = [
    'question' => $row['question'],
    'answers' => $answers
  ];
}

header('Content-Type: application/json');
echo json_encode($questions);
