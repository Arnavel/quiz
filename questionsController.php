<?php

session_start();

require_once __DIR__ . '/models/question.php';

const RESULT_OK            = 1;
const RESULT_WRONG         = 2;
const RESULT_ERROR         = 3;
const RESULT_LIMIT_REACHED = 4;

function addPoints($amount) {
   ++$_SESSION['points'];
}

function getPoints() {
   return is_null($_SESSION['points']) ? 0 : $_SESSION['points'];
}

function clearPoints() {
   $_SESSION['points'] = 0;
}

function checkAnswer() {

   $answerId = $_POST['id'];

   if (is_null($answerId)) {
      echo RESULT_ERROR;
      exit;
   }

   if ($_SESSION['answer'] == $answerId) {
      addPoints(1);
      echo RESULT_OK;
   } else {
      $_SESSION['gameResult'] = RESULT_WRONG;
      echo RESULT_WRONG;
   }
}

$method = $_POST['method'];
if (is_null($method)) {
   exit;
}

switch ($method) {
   case 'getQuestion':
      $question = getQuestion();
      if ($question !== false) {
         include __DIR__ . '/Views/question.php';
      } else {
         $_SESSION['gameResult'] = RESULT_OK;
         echo RESULT_LIMIT_REACHED;
      }
      break;

   case 'getPoints':
      echo getPoints();
      break;

   case 'checkAnswer':
      checkAnswer();
      break;

   case 'endGame':
      $points = getPoints();
      clearPoints();
      $_SESSION['givenQuestions'] = [];
      include __DIR__ . '/Views/gameResult.php';
      break;
}

