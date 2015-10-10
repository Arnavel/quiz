<?php

require_once __DIR__ . '/models/question.php';

$method = $_POST['method'];
if (is_null($method)) {
   exit;
}

if ($method == 'getQuestion') {
   $question = getQuestion();
}
function getQuestion()
{
   return [
      'question' => 'Сколько будет 2+2?',
      'answers'  => ['1', '22', '4', '2+2'],
   ];
}


?>

<h3 class="question__text"><?= $question['question'] ?></h3>

<?php foreach ($question['answers'] as $id => $answer): ?>
   <div class="radio">
      <label>
         <input class="question__answer" type="radio" name="answers" id="<?= $id ?>">
         <?= $answer ?>
      </label>
   </div>
<?php endforeach ?>

<div class="row">
   <div class="col-md-9">
      <button type="submit" class="question__submit-btn btn btn-primary">Ответить</button>
   </div>
</div>