<h3>配属結果確認</h3>
<?php
    require_once('db_inc.php');
    require_once('sql_query.php');

    $uid = $_SESSION['uid']; //ログイン中のユーザのIDを取得
    $sid = strtoupper($uid); //学生であれば、学籍番号（ユーザIDの大文字変換）を求める
    $pid = 0; // 希望の配属先を格納する変数 希望なしの場合は0
    // コードを名称に変換する連想配列
    $usex = array(1=>'男', 2=>'女');
    $pname = array(0=>"希望なし", 1=>"総合教育", 2=>"応用教育");

    // 一覧データを検索するSQL文
    $sql = "SELECT sid, sname, sex, gpa, credit, pid, decided
            FROM tbl_student NATURAL JOIN tbl_wish
            WHERE sid='{$sid}'";
    $row = sql_to_assoc($sql);
    $i = $row['sex'];
    $pid = $row['pid'];
    $decided = $row['decided'];
    if ($decided == 0) {
        $pname[0] = "未決定";
    }
    // 学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit)、本人希望($pid)、配属結果(decided)を表示
    echo "<table border='1'><tr align='center'><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>取得単位数</th><th>本人希望</th><th>配属結果</th></tr>".
    "<tr align='center'><td>". $row['sid']. "</td><td>". $row['sname']. "</td><td>". $row['sex']. "</td><td>". $row['gpa'], "</td><td>". $row['credit']. "</td><td>". $pname[$pid]. "</td><td>". $pname[$decided]. "</td></tr></table>";
?>