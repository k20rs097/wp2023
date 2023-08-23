<?php
    require_once('db_inc.php');
    $sid = $_GET['sid'];
    $pid = 0;
    $reason = '';

    // 学生の希望状況を調べ、変数に$pid, $reasonに代入
    $sql = "SELECT * FROM tbl_wish WHERE sid='{$sid}'";
    $rs = $conn->query($sql);
    $row= $rs->fetch_assoc();
    if ($row){
        $pid = $row['pid'];
        $reason = $row['reason'];
    }

    // 学生情報を検索するSQL文
    $sql = "SELECT * FROM tbl_student WHERE sid='{$sid}'";
    $rs = $conn->query($sql);
    // 問合せ結果を表形式で出力する。
    //学籍番号(sid)、氏名(sname)、性別(sex)、GPA(gpa)、修得単位数(credit), 本人希望($pid)の一覧表示
    ?>
    <table border=1>
    <tr><th>学籍番号</th><th>氏名</th><th>性別</th><th>GPA</th><th>修得単位数</th><th>本人希望</th><th>操作</th></tr>
    <form action="?do=eps_decide_save" method="post">
    <input type="hidden" name="sid" value="<?=$sid?>">
    <?php 
        // 配属決定のラジオボタン(name="decided")
        $row2 = $rs->fetch_assoc();
        if ($row2){ // 最大1行しかないので、while文の代わり、if文を使う
            echo '<tr>';
            echo '<td>' . $row2['sid'] . '</td>';
            echo '<td>' . $row2['sname'] . '</td>';
            echo '<td>' . $row2['sex'] . '</td>';
            echo '<td>' . $row2['gpa'] . '</td>';
            echo '<td>' . $row2['credit'] . '</td>';
            echo '<td>' . $pid . '</td>';
            echo '<td>';
            // foreach文で選択肢となるラジオボタンを出力する
            $decided= $row2['decided'];
            $codes = array(
                1=>'総合教育', 
                2=>'応用教育', 
            );
            foreach($codes as $code => $label) {
                echo '<label>';
                echo '<input type="radio" name="decided" value="' . $code . '"';
                if ($decided == $code) {
                    echo ' checked';
                }
                echo '>';
                echo $label;
                echo'</label>';
            }
            
            echo '</td>';
            echo '</tr>';
        }
?>

<tr>
<td ><button><a href="?do=eps_list">戻る</a></button></td><td colspan="5"></td>
<td><input type="submit" value="送信">&nbsp;<input type="reset" value="取消"></td>
</tr>
</form>
</table>