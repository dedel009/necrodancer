<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>	
	<style type="text/css">
		#play_game_logo{
			position: fixed;
			top: 40%; left: 39%;
		}
		#score_logo{
			position: fixed;
			top: 55%; left: 44%;
		}
		#menu_border{
			position: fixed;
			width: 60%; height: 100%;
			top:3%; left: 18%;
		}
		#nickname_space{
			color: white;
		}
		#bg_s{
			position: fixed;
			width: 5%;height: 12%;
			right: 0%;
		}

		#bgm{
			position: fixed;
			top: 20%; right: 0%;
		}		
		#arrow1{
			position: fixed;
			width: 4%; height: 7%;
			top: 40%; left: 30%;
    		animation: blink_animation 1.0s steps(3, start) infinite alternate;
    		-webkit-animation: blink_animation 1.0s steps(3, start) infinite alternate;			
		}
		#arrow2{
			position: fixed;
			width: 4%; height: 7%;
			top: 54%; left: 30%;
    		animation: blink_animation 1.0s steps(3, start) infinite alternate;
    		-webkit-animation: blink_animation 1.0s steps(3, start) infinite alternate;	
		}		
		body{
			background-color: black;
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

	<?php
	   $nickname = $_POST['nickname'];

	?>

	<script type="text/javascript">

	$(function(){


		$('#arrow1').hide();
		$('#arrow2').hide();
		$('#bgm').hide();
		$('#play_game_logo').hover(function(){
			$('#arrow1').show();
			$('#arrow2').hide();
		},function(){
			$('#arrow1').hide();
			$('#arrow2').hide();
		})
		$('#score_logo').hover(function(){
			$('#arrow2').show();
			$('#arrow1').hide();
		},function(){
			$('#arrow1').hide();
			$('#arrow2').hide();			
		})
		$('#bg_s').click(function(){
			$('#bgm').toggle();
		})


	});	

	function onClick_Ranking() {
		location.href="ranking.php";
		document.form_nickname.submit();

	}
	</script>
</head>
<body>

<img id='menu_border' src="Image\menu_border.png">
<a href="tutorial.php"><img id='play_game_logo' src="Image\play_game_logo.png"></a>
<a href="#" onclick="onClick_Ranking()"><img id='score_logo' src="Image\score_logo.png"></a>
<a href="#"><img id='bg_s' src="Image\BG_S_ICON2.png"></a>
<img id='arrow1' src="Image/arrow.png">
<img id='arrow2' src="Image/arrow.png">
<p id='nickname_space'>
<audio id="bgm" autoplay controls loop>
	<source src="Sound/배경음/zone1_1.mp3" type="audio/mp3" >
</audio>
<?php
echo "nickname : ".$nickname;
?>
</p>

<form name="form_nickname" action="ranking.php" method="post">
	<input type="hidden" name="nickname" value="<?=$nickname?>">
</form>

</body>
</html>
