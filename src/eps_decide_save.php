<?php
    require_once('db_inc.php');

    // 入力フォームからデータを受け取り、変数$decided, $sidに代入
    $decided = $_POST['decided'];
    $sid = $_POST['sid'];

    // 配属結果をtbl_studentに登録するSQL文
    $sql = "UPDATE tbl_student SET decided='{$decided}' WHERE sid='{$sid}'";

    $result = $conn->query($sql);

    if ($result) {
        header("Location: ?do=eps_list"); // 希望状況一覧画面へ自動遷移
        exit();
    } else {
        echo "配属決定の保存に失敗しました。";
    }
?>