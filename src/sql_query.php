<?php
    function sql_to_assoc($sql) {
        require('db_inc.php');
        $rs = $conn->query($sql);
        if (!$rs) die('エラー： '. $conn->error);
        return  $rs->fetch_assoc();
    }

    


?>