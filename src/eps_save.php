<?php
    require_once('db_inc.php');
    $uid = $_SESSION['uid']; // ログイン中のユーザのIDを取得
    $sid = strtoupper($uid); // 学籍番号（ユーザIDの大文字変換）を求める

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { // POSTリクエストの場合のみ処理を実行
        // 入力フォームからデータを受け取り、変数$pid, $reasonに代入
        $pid = $_POST['pid'];
        $reason = $_POST['reason'];

        $sql = ""; // SQL文の初期化

        // 現在の希望が存在するかチェック
        $checkSql = "SELECT * FROM tbl_wish WHERE sid='{$sid}'";
        $checkResult = $conn->query($checkSql);
        $row = $checkResult->fetch_assoc();

        if ($row) { // 現在の希望が存在する場合はUPDATE文を作成
            $sql = "UPDATE tbl_wish SET pid={$pid}, reason='{$reason}', updated_at=NOW() WHERE sid='{$sid}'";
        } else { // 現在の希望が存在しない場合はINSERT文を作成
            $sql = "INSERT INTO tbl_wish (sid, pid, reason, updated_at) VALUES ('{$sid}', {$pid}, '{$reason}', NOW())";
        }

        $result = $conn->query($sql);

        if ($result) {
            echo "登録完了。";
        } else {
            echo "登録に失敗しました。";
        }
    }
?>