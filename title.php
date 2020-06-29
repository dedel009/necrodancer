<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <link rel="stylesheet" href="title_css.css">
        <style media="screen">
        html:hover  #crypt_logo {
            visibility:visible;
            opacity:1.0;

        }

        html:hover  #of_the_logo {
            visibility:visible;
            opacity:1.0;

        }

        html:hover  #necrodancer_logo {
            visibility:visible;
            opacity:1.0;

        }

        html:hover  #bone_logo_left {
            visibility:visible;
            opacity:1.0;

        }

        html:hover  #bone_logo_right {
            visibility:visible;
            opacity:1.0;

        }

        </style>
        <meta charset="utf-8">
        <title>NecroDancer</title>

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

               document.member_form.submit();
           }

        </script>
    </head>

    <body>
        <img id="productor_logo" src="Image\productor_logo.png" alt="" width = 15% height = 15%>

        <img id="crypt_logo" src="Image\crypt_logo.png" width = 12% height = 8%>
        <img id="of_the_logo" src="Image\of_the_logo.png" width = 8% height = 4%>
        <img id="necrodancer_logo" src="Image\necrodancer_logo.png" width = 30% height = 14%>

        <img id="bone_logo_left" src="Image\bone_logo_left.png" width = 5% height = 5%>
        <img id="bone_logo_right" src="Image\bone_logo_right.png" width = 5% height = 5%>


        <form action="title2.php" method="post">
            <div id="nickname"> nickname :
                <input type="text" name="nickname" value="Your_nickname" >
                <input type="submit" value = "확인" onclick="check_input()">
            </div>
        </form>
    </body>

</html>
