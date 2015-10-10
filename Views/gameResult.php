<div class="col-md-offset-3 col-md-9">
   <h2>Игра завершилась <?= $_SESSION['gameResult'] == RESULT_OK ? 'победой' : 'поражением' ?></h2>
   <h3>Ваш результат: <?= $points ?></h3>
   <a href="/index.html" class="btn btn-primary btn-lg">Новая игра</a>
</div>