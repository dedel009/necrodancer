<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>

        <link rel="stylesheet" href="ranking_css.css">
        <meta charset="utf-8">
        <title>Ranking</title>
        <?php
        //select num from members where rownum <= 5
        $con = mysqli_connect("localhost", "user1", "12345", "sample");
        $sql = "select * from members order by num desc";
        $result = mysqli_query($con, $sql);
        $num_record = mysqli_num_rows($result);
        $id = array('','','','','');
        $num = array(0,0,0,0,0);
        for($i = 0; $i < 5; $i++) {
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $id[$i] = $row["id"];
            $num[$i] = $row["num"];

        }
        mysqli_close($con);

        ?>

    </head>
    <?php
    $nickname = $_POST['nickname'];
    if(empty($nickname)) {
        echo "<script>alert('off')</script>";
    }
    else {
        echo "<script>alert('on')</script>";

    }
     ?>
    <body>

        <img id= "ranking" src = "Image\rank_border.png">
        <img id="num1" src="Image\1.png">
        <img id="num2" src="Image\2.png">
        <img id="num3" src="Image\3.png">
        <img id="num4" src="Image\4.png">
        <img id="num5" src="Image\5.png">
        <div class="name">
            <p id="rank1">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$id[0]?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$num[0]?></p>
            <p id="rank2">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$id[1]?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$num[1]?></p>
            <p id="rank3">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$id[2]?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$num[2]?></p>
            <p id="rank4">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$id[3]?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$num[3]?></p>
            <p id="rank5">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$id[4]?>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$num[4]?><?=$nickname?></p>

        </div>

        <script type="text/javascript">
            window.onkeydown = function()   {
                if(event.keyCode){
                    location.href="wait.php";
                    document.form_nickname.submit();
                }
            };
        </script>


        <form name="form_nickname" action="wait.php" method="post">
            <input type="hidden" name="nickname" value="<?=$nickname?>">

        </form>

    </body>
</html>
