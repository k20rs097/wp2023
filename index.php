<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>教育プログラムWebシステム</title>
</head>
<body>
    <?php
        session_start();
        include('src/pg_header.php');
        $action = 'eps_home'; //ホームページ (eps_home)をデフォルト機能とする
        if (isset($_GET['do'])) {//index.php?do=に続くパラメータで実行する機能を指定
        $action = $_GET['do'];
        }
        include('src/' . $action . '.php'); //指定されたファイルを読み込む
        include('src/pg_footer.php');  
    ?>
</body>
</html>