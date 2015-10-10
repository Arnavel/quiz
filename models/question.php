<?
require __DIR__ . '/../functions/database.php';

function getQuestions($count){
    $select = SelectQuestion($count);
    $new_array = [];
    $count = 0;
    while ($row = $select->fetch()) {
        $new_array[$count]['id'] = $row['id'];
        $new_array[$count]['question'] = $row['question'];
        $new_array[$count]['answers'] = [
            [0 => $row['answer_0']],
            [1 => $row['answer_1']],
            [2 => $row['answer_2']],
            [3 => $row['answer_3']]
        ];
        $count++;
    }
    return $new_array;
}
$new = getQuestions(2);
print_r($new);

