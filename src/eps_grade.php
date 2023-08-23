<h3>成績確認</h3>
<?php
    require_once('db_inc.php');
    $uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
    $sid = strtoupper($uid); //ユーザIDを大文字に変換し学籍番号を求める

    //データベースへ問合せのSQL文($sql)を実行する
    $sql = "SELECT sid, sname, sex, gpa, credit FROM tbl_student WHERE sid='{$sid}'";
    $rs = $conn->query($sql);
    if (!$rs) die('エラー： '. $conn->error);
    $row = $rs->fetch_assoc();
    $i = $row['sex'];
    $usex = array(1=>'男', 2=>'女');
    echo "<table border='1'><tr align='center'><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>取得単位数</th></tr>".
         "<tr align='center'><td>". $row['sid']. "</td><td>". $row['sname']. "</td><td>". $usex[$i]. "</td><td>". $row['gpa'], "</td><td>". $row['credit']. "</td></tr></table>";
?>