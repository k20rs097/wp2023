<h3>希望状況一覧</h3>
<?php
    require_once('db_inc.php');
    require_once('sql_query.php');
    // コードを名称に変換する連想配列
    $usex = array(1=>'男', 2=>'女');
    $pname = array(1=>"総合教育", 2=>"応用教育");

    // 一覧データを検索するSQL文
    $sql = "SELECT s.*, w.pid FROM tbl_student s LEFT JOIN tbl_wish w ON s.sid = w.sid ORDER BY s.sid";
    $result = $conn->query($sql);

    // データを表示
    echo "<table border='1'>";
    echo "<tr align='center'>";
    echo "<th>学籍番号</th>";
    echo "<th>氏名</th>"; 
    echo "<th>性別</th>";
    echo "<th>GPA</th>";
    echo "<th>取得単位数</th>";
    echo "<th>本人希望</th>";
    echo "<th>配属決定</th>";
    echo "</tr>";

    while($row = $result->fetch_assoc()){
        $i = $row['pid'];
        echo "<tr align='center'><td>". $row['sid']. "</td>";
        echo "<td>". $row['sname']. "</td>";
        echo "<td>". $usex[$row['sex']]. "</td>";
        echo "<td>". $row['gpa']. "</td>";
        echo "<td>". $row['credit']. "</td>";
        echo "<td>". ($i ? $pname[$i] : "未提出") . "</td>";
        echo "<td>";
        if ($row['decided'] != 0) {
            echo "配属済み";
        } else {
            echo "<a href='?do=eps_decide&sid=" . $row['sid'] . "'>配属決定</a>";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
?>
