<?php
    require_once('db_inc.php');

    $uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
    $sid = strtoupper($uid); //学籍番号（ユーザIDの大文字変換）を求める

    // 変数の初期化。新規登録か編集かにより異なる。
    $act = 'insert';// 新規登録の場合
    $pid = 0;
    $reason = '';

    // 現在の希望を調べ、変数$pid、$reasonに代入
    $sql = "SELECT * FROM tbl_wish WHERE sid='{$sid}'";
    $rs = $conn->query($sql);
    $row= $rs->fetch_assoc();
    if ($row){ 
        $act = 'update';
        $pid = $row['pid'];
        $reason = $row['reason'];
    }
?>
<?php
    echo "<form action='?do=eps_save' method='post'>";
    echo "<p>配属希望<br>";
    
    $pid1Checked = ($pid == 1) ? 'checked' : ''; // $pidが1の場合にchecked属性を設定
    $pid2Checked = ($pid == 2) ? 'checked' : ''; // $pidが2の場合にchecked属性を設定
    
    echo "<input type='radio' name='pid' value='1' $pid1Checked>総合教育プログラム<br>";
    echo "<input type='radio' name='pid' value='2' $pid2Checked>応用教育プログラム";
    
    echo "</p>";
    echo "<p>希望理由<br>";
    echo "<textarea id='reason' name='reason' rows='5' cols='50'>$reason</textarea>";
    echo "</p>";
    echo "<input type='submit' value='送信'><input type='reset' value='取消'>";
    echo "</form>";
?>