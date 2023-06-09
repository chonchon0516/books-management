<?php

$dbUserName = 'root';
$dbPassword = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=booksmanagement; charset=utf8',
    $dbUserName,
    $dbPassword
);

$impressions = filter_input(INPUT_POST, 'impressions');
$title = filter_input(INPUT_POST, 'title');


// [解説！]ガード節になっている
if (!empty($title) && !empty($impressions)) {
    $sql = 'INSERT INTO `books`(`title`, `impressions`) VALUES(:title, :impressions)';
    $statement = $pdo->prepare($sql);
    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':impressions', $impressions, PDO::PARAM_STR);
    $statement->execute();

    // [解説！]リダイレクト処理
    header('Location: ./index.php');
    // [解説！]リダイレクトしても処理が一番下まで続いてしまうので「exit」しておこう！！！
    exit();
}
$error = 'タイトルまたは感想が入力されていません';
?>

<body>
  <div>
    <p><?php echo $error . "\n"; ?></p>
    <a href="./index.php">
        <p>トップページへ</p>
    </a>
  </div>
</body>