<?
//Соединение с базой данных
function db_connect()
{
    $dsn = 'mysql:host=127.0.0.1; dbname=quiz_games; charset=utf8';
    $opt = array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    );
    $connect = new PDO($dsn, 'root', '', $opt);
    return $connect;
}
/**/
function SelectQuestion($count)
{
    $pdo = db_connect();
    $sql = $pdo->prepare('SELECT * FROM data LIMIT :count');
    $sql->execute([':count' => $count]);
    return $sql;
}


