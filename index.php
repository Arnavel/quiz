<?php

//require_once __DIR__ . '/Models/Question.php';

function getQuestion()
{
   return [
         'question' => 'Сколько будет 2+2?',
         'answers'  => ['1', '22', '4', '2+2'],
   ];
}
$question = getQuestion();

?>

<!doctype html>
<html lang="ru">
<head>
   <title>Quiz Game</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width initial-scale=1.0">
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
   <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
</head>

<body>

   <div class="container">

      <!-- [QUESTION] -->
      <div class="row">
         <?php
            include __DIR__ . '/Views/question.php';
         ?>
      </div>
      <!-- [END QUESTION] -->

   </div>

   <!-- [SCRIPTS] -->
   <script src="/js/app.js"></script>

</body>
</html>
