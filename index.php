<?php

define('DSN','mysql:host=db;dbname=pet_shop;charset=utf8;');
define('USER','staff');
define('PASSWORD','9999');

try {
    $dbh = new PDO(DSN, USER, PASSWORD);

} catch (PDOException $e) {
    // 接続がうまくいかない場合こちらの処理がなされる
    echo $e->getMessage();
    exit;
}

if($_GET['keyword'] === ''){
    $sql = 'SELECT * FROM animals';
    $stmt = $dbh->prepare($sql);

}else{
    $keyword = $_GET["keyword"];
    $keyword = '%' . $_GET["keyword"] . '%';
    $sql = 'SELECT * FROM animals WHERE description LIKE :keyword';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
}

$stmt->execute();
$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang = "ja">

<head>
    <meta charaset = "UTF-8">
    <title>ペットショップ</title>
</head>

<body>
    <h1>本日のご紹介ペット！</h1>
    <form action="index.php" method="get">
        <label>キーワード:</label>
        <input type="text" name="comment" placeholder="キーワードの入力">
        <input type="submit" name="submit" value="検索">
    </form>
        
    <?php foreach ($animals as $animal) :?>
        <?= $animal['type'] . 'の' . $animal['classifcation'] . 'ちゃん' ?><br>
        <?= $animal['description'] ?><br> 
        <?= $animal['birthday'] . '生まれ' ?><br> 
        <?= '出身地' . $animal['birthplace'] ?>
        <hr>
    <?php endforeach; ?>
</body>
</html>
=======
<?php

define('DSN','mysql:host=db;dbname=pet_shop;charset=utf8;');
define('USER','staff');
define('PASSWORD','9999');


try {
    $dbh = new PDO(DSN, USER, PASSWORD);
} catch (PDOException $e) {
    // 接続がうまくいかない場合こちらの処理がなされる
    echo $e->getMessage();
    exit;
}

$sql = 'SELECT * FROM animals';

$stmt = $dbh->prepare($sql);

$stmt->execute();

$animals = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($animals as $animal) {
echo $animal['type'] . 'の' . 
    $animal['classifcation'] . 'ちゃん  <br>'.
    $animal['description'] . "<br>" .
    $animal['birthday'] . '生まれ<br>' .
    '出身地' . $animal['birthplace'] . "<hr>";
}