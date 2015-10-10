<?php

session_start();

const RESULT_OK    = 1;
const RESULT_WRONG = 2;
const RESULT_ERROR = 3;

$answerId = $_POST['id'];

if (is_null($answerId)) {
   echo RESULT_ERROR;
   exit;
}

if ($_SESSION['answer'] == $answerId) {
   echo RESULT_OK;
} else {
   echo RESULT_WRONG;
}