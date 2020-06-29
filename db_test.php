<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>

        <script>
           function check_input()
           {

               <?php
               $id_get = $_GET["id"];
               $con = mysqli_connect("localhost", "user1", "12345", "sample");
               $sql = "select * from members where id = '$id_get'";
               $result = mysqli_query($con, $sql);
               $num_record = mysqli_num_rows($result);

               if($num_record) {
                   $sql = "delete from members where id = '$id_get'";
                   $result = mysqli_query($con, $sql);
               }

                   $id   = $_POST["id"];
               	   $sql = "insert into members(num, id)";
               	   $sql .= "values(0, '$id')";

               	   mysqli_query($con, $sql);
                   mysqli_close($con);
               ?>
                alert("버튼1을 누르셨습니다.");

              document.member_form.submit();
           }

        </script>
    </head>
    <body>
        	<form name="member_form" action="db_next.php" method="post">
                id: <input type="text" name="id">
                <input type="submit" name="check" value="확인" onclick="check_input()">

            </form>
    </body>
</html>
