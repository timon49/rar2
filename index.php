<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google</title>
    <meta name="viewport"
          content="width=device-width, height=device-height, initial-scale=1, minimum-scale=1.0, maximum-scale=1"/>
    <meta name="theme-color" content="#000">
    <style>
        /* oswald-regular - latin */
        @font-face {
            font-family: 'Oswald';
            font-style: normal;
            font-weight: 400;
            src: url('resources/oswald-v16-latin-regular.eot'); /* IE9 Compat Modes */
            src: local('Oswald Regular'), local('Oswald-Regular'),
            url('resources/oswald-v16-latin-regular.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('resources/oswald-v16-latin-regular.woff2') format('woff2'), /* Super Modern Browsers */ url('resources/oswald-v16-latin-regular.woff') format('woff'), /* Modern Browsers */ url('resources/oswald-v16-latin-regular.ttf') format('truetype'), /* Safari, Android, iOS */ url('resources/oswald-v16-latin-regular.svg#Oswald') format('svg'); /* Legacy iOS */
        }

        html, body {
            padding: 0;
            margin: 0;

        }

        canvas {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1;
        }

        .control {
            position: absolute;

            left: 0;
            right: 0;
            bottom: 0;
            z-index: 10;
        }

        .debug {
            position: absolute;
            top: 0;
            left: 0;

            color: #FFF;
            z-index: 2;
        }

        .popupinfo {
            position: absolute;
            bottom: 20%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 5000;
            background: rgba(22, 22, 22, 1);
            color: #FFF;
            padding: 5px 10px;
            border-radius: 10px;
            display: none;;
        }

        @media screen and (orientation: portrait) {

            .toolbar.top {
                display: flex;
            }

            .toolbar.left {
                display: none;
            }

            .toolbar.bottom {
                display: flex;
            }

            .toolbar.right {
                display: none;
            }

            #expand {
                bottom: 100px;
                left: 10px;
            }

            #follownorth {
                bottom: 140px;
                left: 10px;
            }

            #quickreset {
                bottom: 180px;
                left: 10px;
            }

            #filter {
                bottom: 100px;
                right: 10px;
            }

            #iconmode {
                bottom: 140px;
                right: 10px;
            }

            #iconsize {
                bottom: 180px;
                right: 10px;
            }

        }

        @media screen and (orientation: landscape) {

            .toolbar.top {
                display: none;
            }

            .toolbar.bottom {
                display: none;
            }

            .toolbar.left {
                display: flex;
            }

            .toolbar.right {
                display: flex;
            }

            #follownorth {
                bottom: 10px;
                left: 190px;

            }

            #expand {
                bottom: 10px;
                left: 150px;

            }

            #quickreset {
                bottom: 10px;
                left: 230px;
            }

            #filter {
                bottom: 10px;
                right: 150px;
            }

            #iconmode {
                bottom: 10px;
                right: 190px;
            }

            #iconsize {
                bottom: 10px;
                right: 230px;
            }

        }

        .toolbar.left {
            bottom: 0;
            top: 0;
            left: 0;
            flex-direction: column;
            align-items: stretch;
        }

        .toolbar.left > div {
            overflow: hidden;
            align-items: center;
            display: flex;
            height: 100%;
        }

        .toolbar.left img {

            max-height: 100%;
            width: auto;
            opacity: 0.5;
        }

        .toolbar.right {
            bottom: 0;
            top: 0;
            right: 10px;
            flex-direction: column;
            align-items: stretch;
        }

        .toolbar.right > div {
            overflow: hidden;
            align-items: center;
            display: flex;
            height: 100%;
        }

        .toolbar.right img {
            width: 40px;
            height: 40px;

            opacity: 0.4;
        }

        .toolbar.right img:active {
            opacity: 1;
        }

        .toolbar.bottom img:active {
            opacity: 1;
        }

        .toolbar.top {
            left: 0;
            right: 0;
            top: 0;
            flex-direction: row;
        }

        .toolbar.top img {
            opacity: 0.5;
            max-width: 100%;
        }

        .toolbar.bottom {
            left: 0;
            right: 0;
            bottom: 10px;
            flex-direction: row;
        }

        .toolbar.bottom > div {
            width: 20%;
            text-align: center;
        }

        .toolbar.bottom img {
            width: 40px;
            height: 40px;
            opacity: 0.4;
        }

        .toolbar img {
            cursor: pointer;
            outline: none;
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        }

        .toolbar {
            z-index: 1000;
            position: absolute;
        }

        #expand, #filter, #follownorth, #iconmode, #iconsize, #quickreset {
            z-index: 1001;
            position: absolute;
            width: 20px;
            height: 20px;
            opacity: 0.5;
            outline: none;
            -webkit-tap-highlight-color: #777;
            cursor: pointer;

        }

        #expand:active, #filter:active, #follownorth:active, #iconmode:active, #iconsize:active, #quickreset:active {
            opacity: 1;

        }

        #customfilter {
            z-index: 2000;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.8);
            overflow: scroll;
            padding: 30px;
            color: #FFF;
            display: none;

        }

        #customfilter h4 {
            text-transform: uppercase;
        }

        #customfilter label {
            margin-right: 10px;
            display: inline-block;
            line-height: 30px;
        }

        #customfilter button, #reconnect, #resetserver, #setversion {

            margin-top: 20px;
            background: #333;
            color: #FFF;
            border: none;
            border-bottom: solid 1px #000;
            border-right: solid 1px #000;

            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            outline: none;
            -webkit-tap-highlight-color: #777;
            cursor: pointer;

        }

        .filteroff {
            opacity: 0.25 !important;
            -webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
            filter: grayscale(100%);

        }

        .logo {
            width: 200px;
            height: auto;
        }

        .statuscontainer {
            position: absolute;
            left: 0;
            top: 0;
            display: flex;
            flex-direction: column; /* NEW */
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            right: 0;
            bottom: 0;
            z-index: 2500;
            background: #000;

        }

        .waitingforgame {
            position: absolute;
            left: 0;

            display: block;
            text-align: center;
            right: 0;
            bottom: 20px;
            z-index: 3;

        }

        .statuscontainer > div {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .statuscontainer .progress {
            width: 200px;
            margin-bottom: 15px;

        }

        .statustext {
            font-size: 12px;
            color: #fff;
        }

        .waitingforgame h4 {
            color: #fff;
            font-size: 16px;
        }

        #textCanvas {
            pointer-events: none;
            z-index: 20;
        }

    </style>
    <script src="js/three.min.js"></script>
    <script src="js/stats.min.js"></script>
    <script src="js/Detector.js"></script>
    <script src="js/GeometryUtils.js"></script>
    <script src="js/TTFLoader.js"></script>
    <script src="js/opentype.min.js"></script>
    <script src="js/tween.min.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/js.cookie.js"></script>
    <script src="js/d3.v4.min.js"></script>
    <script src="js/NoSleep.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link rel="icon" type="image/png" href="images/favicons/favicon-32x32.png" sizes="32x32">
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all">
</head>
<body>
<script>
    var noSleep = new NoSleep();
    noSleep.enable();
</script>
<div class="popupinfo"></div>
<div class="statuscontainer">
    <div>
        <img src="images/xRadar.png" class="logo">
        <div class="progress">
            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0"
                 aria-valuemax="100">0%
            </div>
        </div>
        <div class="statustext">Initializing...</div>
        <button type="button" id="reconnect" style="display: none">Reconnect</button>
    </div>
</div>
<div class="waitingforgame">
    <h4 style="text-align: center" id="waitingforgame">Waiting for new game session</h4>
    <h4 style="text-align: center" id="gameversion"></h4>
    <button type="button" id="resetserver" onclick="reset()">Reset Server</button>

    <div style="font-size: 11px; color:#CCC; text-align: center">If radar doens't detect you joining new game:<br/>1.
        Exit to lobby 2. Click Reset Server 3. Join a new game
    </div>
</div>
</div>
<div class="toolbar top gamecontroller">
    <div class="slide"><img class="changefilter" data-code="weapon" src="images/weapon_on.png"></div>
    <div class="slide"><img src="images/mods_on.png" class="changefilter" data-code="mods"></div>
    <div class="slide"><img src="images/scope_on.png" class="changefilter" data-code="scope"></div>
    <div class="slide"><img src="images/ammo_on.png" class="changefilter" data-code="ammo"></div>
    <div class="slide"><img src="images/equip_on.png" class="changefilter" data-code="equip"></div>
    <div class="slide"><img src="images/heal_on.png" class="changefilter" data-code="heal"></div>
    <div class="slide"><img src="images/grenade_on.png" class="changefilter" data-code="grenade"></div>
</div>
<div class="toolbar left gamecontroller">
    <div class="slide"><img class="changefilter" data-code="weapon" src="images/weapon_on.png"></div>
    <div class="slide"><img src="images/mods_on.png" class="changefilter" data-code="mods"></div>
    <div class="slide"><img src="images/scope_on.png" class="changefilter" data-code="scope"></div>
    <div class="slide"><img src="images/ammo_on.png" class="changefilter" data-code="ammo"></div>
    <div class="slide"><img src="images/equip_on.png" class="changefilter" data-code="equip"></div>
    <div class="slide"><img src="images/heal_on.png" class="changefilter" data-code="heal"></div>
    <div class="slide"><img src="images/grenade_on.png" class="changefilter" data-code="grenade"></div>
</div>
<div class="toolbar bottom gamecontroller">
    <div class="slide"><img src="images/plus.png" class="zoomin"></div>
    <div class="slide"><img src="images/zoom1.png" class="zoom" data-scale="2.5"></div>
    <div class="slide"><img src="images/zoom2.png" class="zoom" data-scale="0.4"></div>
    <div class="slide"><img src="images/zoom3.png" class="zoom" data-scale="0.2"></div>
    <div class="slide"><img src="images/minus.png" class="zoomout"></div>
</div>
<div class="toolbar right gamecontroller">
    <div class="slide"><img src="images/plus.png" class="zoomin"></div>
    <div class="slide"><img src="images/zoom1.png" class="zoom" data-scale="2.5"></div>
    <div class="slide"><img src="images/zoom2.png" class="zoom" data-scale="0.4"></div>
    <div class="slide"><img src="images/zoom3.png" class="zoom" data-scale="0.2"></div>
    <div class="slide"><img src="images/minus.png" class="zoomout"></div>
</div>
<div id="customfilter">
    <div class="options">
    </div>
    <button type="button" id="saveFilter">Save</button>
</div>
<img id="iconmode" class="gamecontroller" onclick="toggleiconmode()" src="images/picture.png">
<img id="follownorth" class="gamecontroller" onclick="togglefollownorth()" src="images/compass.png">
<img id="iconsize" class="gamecontroller" onclick="changeitemsize()" src="images/highlighter.png">
<img id="expand" class="gamecontroller" onclick="fullscreen()" src="images/expand.png">
<img id="filter" class="gamecontroller" src="images/filter.png">
<img id="quickreset" class="gamecontroller"
     onclick="if (confirm('Are you sure you want to reset the server? only do this if your radar has frozen because you will need to rejoin the match!')) reset();"
     src="images/recycle.png">
<canvas id="textCanvas">
</canvas>
<canvas id="mapCanvas">
</canvas>
<script>
    var serverIP = "";
    var product_name = "xRaydar";
    var webglfail = "Your browser does not support WebGL, please upgrade to latest Chrome.";
    var lang_noversion = "Waiting for game launch, please open the game.";
    var lang_detectedversion = "Game Version: ";
</script>
<script src="radar_o3.js"></script>
</body>
</html>
