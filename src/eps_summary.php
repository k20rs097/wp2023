<h3>希望状況集計</h3>
<?php
    require_once('db_inc.php');
    require_once('sql_query.php');
    $usex = array(1=>'男', 2=>'女');
    $pname = array(1=>"総合教育", 2=>"応用教育");

    // 一覧データを検索するSQL文
    $sql = "SELECT pid, COUNT(*) as people FROM tbl_wish GROUP BY pid UNION
    SELECT pid, 0 as people FROM tbl_program WHERE pid NOT IN (SELECT pid FROM tbl_wish)
    ORDER BY pid";
    $result = $conn->query($sql);
    $pname = array(1=>"総合教育プログラム", 2=>"応用教育プログラム");

    echo "<table border='1'>";
    echo "<tr align='center'>";
    echo "<th>プログラム名</th>";
    echo "<th>希望人数</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $i = $row['pid'];
        echo "<tr align='center'>";
        echo "<td>". $pname[$i]. "</td>";
        echo "<td>". $row['people']. "</td></tr>";
    }
    echo "</table>";

?>