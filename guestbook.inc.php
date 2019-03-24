
<?
//конфигурация

define ('DB_HOST', 'localhost');
define ('DB_LOGIN', 'root');
define ('DB_PASSWORD', '');
define ('DB_NAME', 'guestbook');
$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_NAME); 
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL,"<br>";
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL,"<br>";
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL,"<br>";
    exit;
}
echo "Соединение с MySQL установлено!" . PHP_EOL,"<br>";
?>

<h3>Оставьте запись в нашей Гостевой книге</h3>

<form method="post" action="<?= $_SERVER['REQUEST_URI']?>">
Имя: <br /><input type="text" name="username" /><br />
Email: <br /><input type="text" name="email" /><br />
Сообщение: <br /><textarea name="msg"></textarea><br />

<br />

<input type="submit" value="Отправить!" />

</form>

<?php
//запрос создания записи


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$usname = mysqli_real_escape_string($link, trim(strip_tags($_POST['username'])));
	$email = mysqli_real_escape_string($link, trim(strip_tags($_POST['email'])));
	$msg = mysqli_real_escape_string($link, trim(strip_tags($_POST['msg'])));

$sql = "INSERT INTO msgs (username, email, msg) VALUES ('$usname', '$email', '$msg')";
      mysqli_query($link, $sql);
        if (mysqli_query($link, $sql) === TRUE) {
    printf("Запрос успешно выполнен!\n");
}
header('Location: '.$_SERVER['REQUEST_URI']);
}
echo $name, $email, $msg;
if ($mysqli->connect_errno) {
    printf("Не удалось подключиться: %s\n", $mysqli->connect_error);
    exit();
}
?>

<?
//вывод записи

$sql = "SELECT id, username, email, msg, UNIX_TIMESTAMP(datetime) as dt FROM msgs ORDER BY id DESC";


    
$res = mysqli_query($link, $sql)
 echo "Всего записей в гостевой книге:".mysqli_num_rows($res);
$result = mysqli_fetch_all($res,MYSQLI_ASSOC);
foreach ($result as $row) {
    $dt = date('d-m-Y в H:i:s', $row['dt']);
    echo "<p style='border: 1px solid #ccc!important;'><a href='mailto:{$row['email']}'>{$row['username']}</a> $dt написал <br /> {$row['msg']}</p>";
    echo "<p align='right'><a href='http://mysite.local/index.php?id=guestbook&del={$row['id']}'>Удалить</a></p>";
}
?>
<form method="post" action="guestbook.inc.php">
    <input type="submit" name="del" value="Удалить запись" />
    </form>


<?
//удаление записи

if(isset($_GET['del'])) {
    $del = abs((int)$_GET['del']);
    if($del){
        $sql = 'DELETE FROM msgs WHERE id='.$del;
        mysqli_query($link, $sql);
    }
}
?>