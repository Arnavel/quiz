<?
require __DIR__ . '/../functions/database.php';
session_start ();

/**/
function SelectQuestion($count = '50')
{
    $pdo = db_connect ();
    $sql = $pdo->prepare ('SELECT * FROM data LIMIT :count');
    $sql->execute ([':count' => $count]);
    return $sql;
}

//Функция обрабатывает результат запроса к базе, приводя его к нужному массиву
function UpdateQuestion()
{
    $select = SelectQuestion ();
    $new_array = [];
    $count = 0;
    while ($row = $select->fetch ()) {
        $new_array[$count]['id'] = $row['id'];
        $new_array[$count]['question'] = $row['question'];
        $new_array[$count]['answers'] = [
            0 => $row['answer_0'],
            1 => $row['answer_1'],
            2 => $row['answer_2'],
            3 => $row['answer_3']
        ];
        $count++;
    }
    return $new_array;
}


function getQuestion($id = 0){
    $question_array = UpdateQuestion ();
    $one_question = $question_array[$id];

    if ($_SESSION['givenQuestions'] == null) {
        $_SESSION['givenQuestions'] = [];
    }
    if (count($_SESSION['givenQuestions']) === count ($question_array)){
        return false;
    }

    if (array_search ($id, $_SESSION['givenQuestions']) !== false) {
        $id++;
        return getQuestion ($id);
    } else {
        $_SESSION['givenQuestions'][] = $id;
        $correct = $one_question['answers'][0];
        shuffle($one_question['answers']);
        $_SESSION['answer'] = array_search($correct, $one_question['answers']);
        return $one_question;
    }


}
