<?php
$db = new PDO('sqlite:db.sqlite');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $question = $_POST['question'];
  $answers = $_POST['answer'];
  $correctIndex = intval($_POST['correct']) - 1;

  $stmt = $db->prepare("INSERT INTO questions (question) VALUES (?)");
  $stmt->execute([$question]);
  $qid = $db->lastInsertId();

  $aStmt = $db->prepare("INSERT INTO answers (question_id, text, correct) VALUES (?, ?, ?)");
  foreach ($answers as $i => $text) {
    $aStmt->execute([$qid, $text, $i === $correctIndex ? 1 : 0]);
  }

  header("Location: add_question.php");
  exit();
}
