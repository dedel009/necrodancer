<!DOCTYPE html>
<html>
<head>
	<title>튜토리얼</title>
	<style type="text/css">
		#canv{

                left:30%; right:0; top:10%; bottom: 0;
                margin:auto; overflow: auto; position: fixed;
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
		body{
			background-color: black;
		}
	</style>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>		
	<script type="text/javascript">
var ctx = null;
var gameMap = [
	0, 0, 0, 0, 0, 0, 0, 6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
	0, 2, 2, 2, 2, 1, 0, 6, 6, 0, 1, 1, 0, 1, 1, 1, 0, 4, 3, 0,
	0, 2, 2, 2, 2, 1, 0, 6, 6, 0, 1, 0, 0, 1, 1, 1, 0, 3, 4, 0,
	0, 2, 2, 2, 2, 2, 0, 6, 6, 0, 2, 0, 0, 0, 0, 2, 2, 2, 2, 0,
	0, 2, 2, 2, 2, 2, 0, 6, 6, 0, 2, 2, 1, 1, 2, 1, 0, 0, 0, 0,
	0, 2, 2, 2, 2, 2, 0, 6, 6, 0, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0,
	0, 1, 1, 1, 1, 2, 0, 6, 6, 0, 1, 0, 6, 6, 0, 1, 0, 0, 0, 0,
	0, 0, 0, 1, 0, 0, 0, 6, 6, 0, 1, 0, 6, 6, 0, 1, 0, 6, 6, 0,
	6, 6, 0, 1, 0, 6, 6, 6, 6, 0, 2, 0, 6, 6, 0, 2, 0, 6, 6, 0,
	0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0,
	0, 2, 2, 1, 2, 2, 1, 2, 1, 1, 2, 1, 1, 1, 1, 1, 0, 6, 6, 0,
	0, 1, 2, 3, 3, 2, 0, 2, 0, 0, 2, 0, 0, 0, 0, 1, 0, 0, 0, 0,
	0, 2, 2, 3, 3, 2, 0, 2, 6, 6, 1, 0, 2, 0, 1, 1, 1, 2, 3, 0,
	0, 2, 2, 3, 4, 2, 0, 0, 6, 6, 1, 1, 1, 0, 1, 0, 0, 2, 3, 0,
	0, 1, 2, 3, 4, 2, 0, 2, 6, 6, 2, 0, 1, 0, 1, 0, 0, 2, 3, 0,
	0, 1, 2, 3, 4, 2, 0, 2, 6, 6, 1, 0, 0, 0, 1, 0, 0, 2, 3, 0,
	0, 0, 2, 3, 4, 2, 0, 2, 6, 6, 1, 1, 1, 0, 1, 0, 0, 2, 3, 0,
	6, 0, 2, 3, 3, 2, 0, 2, 6, 6, 2, 0, 0, 0, 0, 0, 3, 2, 3, 0,
	6, 0, 1, 3, 4, 1, 1, 1, 6, 6, 2, 0, 6, 6, 0, 0, 3, 1, 5, 0,
	6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
];
var tileW = 40, tileH = 40;
var mapW = 20, mapH = 20;
var currentSecond = 0, frameCount = 0, framesLastSecond = 0, lastFrameTime = 0;

var tileset = null, tilesetURL = "Image/tile_char.png", tilesetLoaded = false;

var floorTypes = {
	solid	: 0,
	path	: 1,
	fire	: 2,
	door    : 3,
	dark    : 4
};
var tileTypes = {
	0 : {  floor:floorTypes.solid, sprite:[{x:182,y:26,w:25,h:25}]	},
	1 : {  floor:floorTypes.path,	sprite:[{x:0,y:0,w:25,h:25}]    },
	2 : {  floor:floorTypes.path,	sprite:[{x:26,y:0,w:25,h:25}]	},
	3 : {  floor:floorTypes.solid,	sprite:[{x:286,y:0,w:25,h:25}]	},
	4 : {  floor:floorTypes.fire,	sprite:[{x:286,y:0,w:25,h:25}]    },
	5 : {  floor:floorTypes.door,  sprite:[{x:208,y:52,w:25,h:25}]  },
	6 : {  floor:floorTypes.dark,  sprite:[{x:208,y:78,w:25,h:25}]  }
};

var directions = {
	up		: 0,
	right	: 1,
	down	: 2,
	left	: 3
};

var keysDown = {
	37 : false,
	38 : false,
	39 : false,
	40 : false
};

var viewport = {
	screen		: [0,0],
	startTile	: [0,0],
	endTile		: [0,0],
	offset		: [0,0],
	update		: function(px, py) {
		this.offset[0] = Math.floor((this.screen[0]/2) - px);
		this.offset[1] = Math.floor((this.screen[1]/2) - py);

		var tile = [ Math.floor(px/tileW), Math.floor(py/tileH) ];

		this.startTile[0] = tile[0] - 1 - Math.ceil((this.screen[0]/2) / tileW);
		this.startTile[1] = tile[1] - 1 - Math.ceil((this.screen[1]/2) / tileH);

		if(this.startTile[0] < 0) { this.startTile[0] = 0; }
		if(this.startTile[1] < 0) { this.startTile[1] = 0; }

		this.endTile[0] = tile[0] + 1 + Math.ceil((this.screen[0]/2) / tileW);
		this.endTile[1] = tile[1] + 1 + Math.ceil((this.screen[1]/2) / tileH);

		if(this.endTile[0] >= mapW) { this.endTile[0] = mapW-1; }
		if(this.endTile[1] >= mapH) { this.endTile[1] = mapH-1; }
	}
};

var player = new Character();

function Character()
{
	this.tileFrom	= [1,1];
	this.tileTo		= [1,1];
	this.timeMoved	= 0;
	this.dimensions	= [30,30];
	this.position	= [45,45];
	this.delayMove	= 100;

	this.direction	= directions.up;
	this.sprites = {};
	this.sprites[directions.up]		= [{x:286,y:26,w:25,h:25}];
	this.sprites[directions.right]	= [{x:286,y:26,w:25,h:25}];
	this.sprites[directions.down]	= [{x:286,y:26,w:25,h:25}];
	this.sprites[directions.left]	= [{x:312,y:26,w:25,h:25}];
}
Character.prototype.placeAt = function(x, y)
{
	this.tileFrom	= [x,y];
	this.tileTo		= [x,y];
	this.position	= [((tileW*x)+((tileW-this.dimensions[0])/2)),
		((tileH*y)+((tileH-this.dimensions[1])/2))];
};
Character.prototype.processMovement = function(t)
{
	if(this.tileFrom[0]==this.tileTo[0] && this.tileFrom[1]==this.tileTo[1]) { return false; }

	if((t-this.timeMoved)>=this.delayMove)
	{
		this.placeAt(this.tileTo[0], this.tileTo[1]);
	}
	else
	{
		this.position[0] = (this.tileFrom[0] * tileW) + ((tileW-this.dimensions[0])/2);
		this.position[1] = (this.tileFrom[1] * tileH) + ((tileH-this.dimensions[1])/2);

		if(this.tileTo[0] != this.tileFrom[0])
		{
			var diff = (tileW / this.delayMove) * (t-this.timeMoved);
			this.position[0]+= (this.tileTo[0]<this.tileFrom[0] ? 0 - diff : diff);
		}
		if(this.tileTo[1] != this.tileFrom[1])
		{
			var diff = (tileH / this.delayMove) * (t-this.timeMoved);
			this.position[1]+= (this.tileTo[1]<this.tileFrom[1] ? 0 - diff : diff);
		}

		this.position[0] = Math.round(this.position[0]);
		this.position[1] = Math.round(this.position[1]);
	}

	return true;
}
Character.prototype.canMoveTo = function(x, y)
{
	if(x < 0 || x >= mapW || y < 0 || y >= mapH) { return false; }
	if(tileTypes[gameMap[toIndex(x,y)]].floor!=floorTypes.path && tileTypes[gameMap[toIndex(x,y)]].floor!=floorTypes.door) { return false; }
	if(tileTypes[gameMap[toIndex(x,y)]].floor==floorTypes.door){
		location.href = "ranking.php";
	}
	return true;
};
Character.prototype.canMoveUp		= function() { return this.canMoveTo(this.tileFrom[0], this.tileFrom[1]-1); };
Character.prototype.canMoveDown 	= function() { return this.canMoveTo(this.tileFrom[0], this.tileFrom[1]+1); };
Character.prototype.canMoveLeft 	= function() { return this.canMoveTo(this.tileFrom[0]-1, this.tileFrom[1]); };
Character.prototype.canMoveRight 	= function() { return this.canMoveTo(this.tileFrom[0]+1, this.tileFrom[1]); };

Character.prototype.moveLeft	= function(t) { this.tileTo[0]-=1; this.timeMoved = t; this.direction = directions.left; };
Character.prototype.moveRight	= function(t) { this.tileTo[0]+=1; this.timeMoved = t; this.direction = directions.right; };
Character.prototype.moveUp		= function(t) { this.tileTo[1]-=1; this.timeMoved = t; this.direction = directions.up; };
Character.prototype.moveDown	= function(t) { this.tileTo[1]+=1; this.timeMoved = t; this.direction = directions.down; };

function toIndex(x, y)
{
	return((y * mapW) + x);
}


window.onload = function()
{
	ctx = document.getElementById('game').getContext("2d");
	requestAnimationFrame(drawGame);
	ctx.font = "bold 10pt sans-serif";

	window.addEventListener("keydown", function(e) {
		if(e.keyCode>=37 && e.keyCode<=40) { keysDown[e.keyCode] = true; }
	});
	window.addEventListener("keyup", function(e) {
		if(e.keyCode>=37 && e.keyCode<=40) { keysDown[e.keyCode] = false; }
	});

	viewport.screen = [document.getElementById('game').width,
		document.getElementById('game').height];

	tileset = new Image();
	tileset.onerror = function()
	{
		ctx = null;
		alert("Failed loading tileset.");
	};
	tileset.onload = function() { tilesetLoaded = true; };
	tileset.src = tilesetURL;


	$('#bgm').hide();
	$('#bg_s').click(function(){
		$('#bgm').toggle();
	})

	
};

function drawGame()
{
	if(ctx==null) { return; }
	if(!tilesetLoaded) { requestAnimationFrame(drawGame); return; }

	var currentFrameTime = Date.now();
	var timeElapsed = currentFrameTime - lastFrameTime;

	var sec = Math.floor(Date.now()/1000);
	if(sec!=currentSecond)
	{
		currentSecond = sec;
		framesLastSecond = frameCount;
		frameCount = 1;
	}
	else { frameCount++; }

	if(!player.processMovement(currentFrameTime))
	{
		if(keysDown[38] && player.canMoveUp())			{ player.moveUp(currentFrameTime); }
		else if(keysDown[40] && player.canMoveDown())	{ player.moveDown(currentFrameTime); }
		else if(keysDown[37] && player.canMoveLeft())	{ player.moveLeft(currentFrameTime); }
		else if(keysDown[39] && player.canMoveRight())	{ player.moveRight(currentFrameTime); }
	}

	viewport.update(player.position[0] + (player.dimensions[0]/2),
		player.position[1] + (player.dimensions[1]/2));

	ctx.fillStyle = "#000000";
	ctx.fillRect(0, 0, viewport.screen[0], viewport.screen[1]);

	for(var y = viewport.startTile[1]; y <= viewport.endTile[1]; ++y)
	{
		for(var x = viewport.startTile[0]; x <= viewport.endTile[0]; ++x)
		{
			var tile = tileTypes[gameMap[toIndex(x,y)]];
			ctx.drawImage(tileset,
				tile.sprite[0].x, tile.sprite[0].y, tile.sprite[0].w, tile.sprite[0].h,
				viewport.offset[0] + (x*tileW), viewport.offset[1] + (y*tileH),
				tileW, tileH);
		}
	}

	var sprite = player.sprites[player.direction];
	ctx.drawImage(tileset,
		sprite[0].x, sprite[0].y, sprite[0].w, sprite[0].h,
		viewport.offset[0] + player.position[0], viewport.offset[1] + player.position[1],
		player.dimensions[0], player.dimensions[1]);

	ctx.fillStyle = "#ff0000";
	ctx.fillText("FPS: " + framesLastSecond, 10, 20);

	lastFrameTime = currentFrameTime;
	requestAnimationFrame(drawGame);
}
	
	</script>
</head>
<body>

<div id="canv">
	<canvas id="game" width="400" height="400"></canvas>
</div>
<a href="#"><img id='bg_s' src="Image\BG_S_ICON2.png"></a>
<audio id="bgm" autoplay controls loop>
	<source src="Sound/배경음/zone1_1.mp3" type="audio/mp3" >
</audio>
</body>
</html>

