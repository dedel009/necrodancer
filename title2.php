<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <style>
            html:hover #screen{
                width: 100%; height: 100%;
                left:0; right:0; top:0; bottom: 0;
                margin:auto; overflow: auto; position: fixed;
                visibility:visible;
                opacity:1.0;
            }
            html:hover #startlogo{
                position:fixed;
                top: 80%; left: 35%;
                width: 500px; height: 200px;
                animation: blink_animation 1.0s steps(3, start) infinite alternate;
                -webkit-animation: blink_animation 1.0s steps(3, start) infinite alternate;
            }
            body{
                background-color: black;
            }
            #screen{
                width: 100%; height: 100%;
                left:0; right:0; top:0; bottom: 0;
                position: fixed;
                visibility:hidden;
                opacity:0;
                transition:visibility 0.3s, opacity 10s;
            }
            #startlogo{
                position:fixed;
                top: 80%; left: 35%;
                width: 500px; height: 200px;
            }
            @keyframes blink_animation {
                    from {
                        visibility: visibility;
                    }
                    to {
                        visibility: hidden;
                    }
            }
            @-webkit-keyframes blink_animation {
                    from {
                        visibility: visibility;
                    }
                    to {
                        visibility: hidden;
                    }
            }

        </style>

        <meta charset="utf-8">
        <title>대기화면</title>
    </head>
    <body>
        <script type="text/javascript">
            window.onkeydown = function()   {
                if(event.keyCode == 27){
                    alert('esc');
                    self.close();
                }else if(event.keyCode != 8 && event.keyCode != 116){
                    location.href="wait.php";
                    document.form_nickname.submit();
                }
            };

        </script>
        <img id="screen" src="Image\wait_screen.png"/>
        <img id='startlogo' src="Image\key.png"/>
        <?php
            $nickname = $_POST["nickname"];
        ?>
        <form name='form_nickname' action="wait.php" method="post" >
            <input type="hidden" name="nickname" value="<?=$nickname?>">
        </form>

    </body>
</html>
