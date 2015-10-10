<!-- [QUESTION] -->
<form action="">
   <div class="form-group question col-md-offset-3 col-md-9">

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

   </div>
</form>
<!-- [END QUESTION] -->

<!-- POINTS -->
<div class="row">
   <div class="points col-md-offset-3 col-md-9">
      <h3 class="points__title">Правильных ответов: <span class="points__value"></span></h3>
   </div>
</div>
<!-- END POINTS-->