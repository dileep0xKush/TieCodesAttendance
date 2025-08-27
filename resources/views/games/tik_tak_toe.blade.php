<!DOCTYPE html>
<html>

<head>
    <title>Tie Codes</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Asap:400,700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Asap, sans-serif;
            background: rgb(30, 40, 48);
        }

        #title {
            background: #f7f7f7;
            padding: 20px;
            color: rgb(30, 40, 48)
        }

        #title>h1 {
            text-align: center;
        }

        #Login {
            height: 250px;
            width: 360px;
            margin: 50px auto;
            background: #f7f7f7;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
            position: relative;
        }

        #name {
            font-family: Asap, sans-serif;
            text-align: center;
            font-size: 20px;
            display: block;
            width: 70%;
            position: absolute;
            top: 75px;
            left: 15%;
            background: none;
            border: none;
            border-bottom: 2px solid rgb(30, 40, 48, 0.3);
            color: rgb(30, 40, 48, 0.9)
        }

        button {
            font-family: Asap, sans-serif;
            text-transform: uppercase;
            font-weight: bold;
            display: block;
            background: #AD133A;
            border-radius: 10px;
            width: 50%;
            height: 50px;
            font-size: 17px;
            color: #f7f7f7;
            position: absolute;
            top: 125px;
            left: 25%;
            border: none;
            transition: all 0.3s ease;
        }

        button:hover {
            background: #4c2827;
            border-bottom-color: #111;
            color: #AD133A;
            background: #f7f7f7;
        }

        #scoreboard {
            text-align: center;
            margin-top: 50px;
            border: 1px solid #f7f7f7;
            position: relative;
            width: 20%;
            left: 40%;
        }

        .score {
            display: inline-block;
            color: #f7f7f7;
        }

        #Playerid {
            display: block;
            position: absolute;
            background: #AD133A;
            border-radius: 5px;
            padding: 5px;
            font-size: 20px;
            width: 120%;
            height: 30px;
            left: -130%;
            top: 20%;
        }

        #Playerscore {
            font-size: 50px;
        }

        #slash {
            font-size: 50px;
        }

        #Computerscore {
            font-size: 50px;
        }

        #Computerid {
            display: block;
            position: absolute;
            background: rgb(30, 40, 48);
            border-radius: 5px;
            padding: 5px;
            font-size: 20px;
            width: 120%;
            left: 110%;
            top: 20%;
        }

        .grid-container {
            display: grid;
            grid-template-columns: auto auto auto;
            width: 80%;
            left: 10%;
            margin: 50px auto;
        }

        .grid-item {
            background-color: none;
            padding: 35px;
            font-size: 50px;
            text-align: center;
            color: #f7f7f7;
            font-weight: bold;
        }

        #grid11 {
            border-bottom: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;
        }

        #grid12 {
            border-bottom: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;

            border-left: 2px solid #f7f7f7;
        }

        #grid13 {
            border-bottom: 2px solid #f7f7f7;
            border-left: 2px solid #f7f7f7;
        }

        #grid21 {
            border-bottom: 2px solid #f7f7f7;
            border-top: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;
        }

        #grid22 {
            border-bottom: 2px solid #f7f7f7;
            border-top: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;
            border-left: 2px solid #f7f7f7;
        }

        #grid23 {
            border-bottom: 2px solid #f7f7f7;
            border-top: 2px solid #f7f7f7;
            border-left: 2px solid #f7f7f7;
        }

        #grid31 {
            border-top: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;
        }

        #grid32 {
            border-top: 2px solid #f7f7f7;
            border-right: 2px solid #f7f7f7;
            border-left: 2px solid #f7f7f7;
        }

        #grid33 {
            border-top: 2px solid #f7f7f7;
            border-left: 2px solid #f7f7f7;
        }
    </style>
</head>

<body>
    <div id='title'>
        <h1>Tik Tak Toe</h1>
    </div>
    <div id='Login'>
        <input id="name" type="text" placeholder="Player Name">
        <button type="button" id="Start">Start!</button>
    </div>
    <div id='scoreboard'>
        <div class='score' id='Playerid'>Player Name</div>
        <div class='score' id='Playerscore'>0</div>
        <div class='score' id='slash'>-</div>
        <div class='score' id='Computerscore'>0</div>
        <div class='score' id='Computerid'>Computer</div>
    </div>
    <div class="grid-container" id='game'>
        <div class="grid-item" id='grid11'>&#8192</div>
        <div class="grid-item" id='grid12'>&#8192</div>
        <div class="grid-item" id='grid13'>&#8192</div>
        <div class="grid-item" id='grid21'>&#8192</div>
        <div class="grid-item" id='grid22'>&#8192</div>
        <div class="grid-item" id='grid23'>&#8192</div>
        <div class="grid-item" id='grid31'>&#8192</div>
        <div class="grid-item" id='grid32'>&#8192</div>
        <div class="grid-item" id='grid33'>&#8192</div>
    </div>
    <script>
        function HideLogin() {
            document.getElementById("Login").style.display = "none";

        }

        let Playerid_span = document.getElementById("Playerid");
        let Playerscore_span = document.getElementById("Playerscore");
        let Computerscore_span = document.getElementById("Computerscore");
        let grid11 = document.getElementById("grid11");
        let grid12 = document.getElementById("grid12");
        let grid13 = document.getElementById("grid13");
        let grid21 = document.getElementById("grid21");
        let grid22 = document.getElementById("grid22");
        let grid23 = document.getElementById("grid23");
        let grid31 = document.getElementById("grid31");
        let grid32 = document.getElementById("grid32");
        let grid33 = document.getElementById("grid33");
        document.getElementById("scoreboard").style.display = "none";
        document.getElementById("game").style.display = "none";

        let Playerscore = 0;
        let Computerscore = 0;
        let grid = [grid11, grid12, grid13, grid21, grid22, grid23, grid31, grid32, grid33];
        let random = 0;
        let h1 = ''
        let h2 = ''
        let h3 = ''
        let v1 = ''
        let v2 = ''
        let v3 = ''
        let i1 = ''
        let i2 = ''

        function ComputerTurn() {
            if (grid.length >= 1) {
                random = Math.floor(Math.random() * grid.length)
                grid[random].innerHTML = 'O';
                grid.splice(grid.indexOf(grid[random]), 1);
            }
        };

        function PlayerTurn(choice) {
            choice.innerHTML = 'X';
            grid.splice(grid.indexOf(choice), 1);
        }

        function clear() {
            grid = [grid11, grid12, grid13, grid21, grid22, grid23, grid31, grid32, grid33];
            grid.map((item) => item.innerHTML = ' ');
            if ((Playerscore + Computerscore) % 2 != '0') {
                ComputerTurn();
            }
        }

        function win() {
            Playerscore++;
            Playerscore_span.innerHTML = Playerscore;
            clear();
        }

        function lose() {
            Computerscore++;
            Computerscore_span.innerHTML = Computerscore;
            clear();
        }


        function game(choice) {
            if (choice.innerHTML === ' ') {
                PlayerTurn(choice);
                ComputerTurn();
            }
            h1 = grid11.innerHTML + grid12.innerHTML + grid13.innerHTML;
            h2 = grid21.innerHTML + grid22.innerHTML + grid23.innerHTML;
            h3 = grid31.innerHTML + grid32.innerHTML + grid33.innerHTML;
            v1 = grid11.innerHTML + grid21.innerHTML + grid31.innerHTML;
            v2 = grid12.innerHTML + grid22.innerHTML + grid32.innerHTML;
            v3 = grid13.innerHTML + grid23.innerHTML + grid33.innerHTML;
            i1 = grid11.innerHTML + grid22.innerHTML + grid33.innerHTML;
            i2 = grid13.innerHTML + grid22.innerHTML + grid31.innerHTML;
            if (h1 === 'XXX' || h2 === 'XXX' || h3 === 'XXX' || v1 === 'XXX' || v2 === 'XXX' || v3 === 'XXX' || i1 ===
                'XXX' || i2 === 'XXX') {
                win();
            } else if (h1 === 'OOO' || h2 === 'OOO' || h3 === 'OOO' || v1 === 'OOO' || v2 === 'OOO' || v3 === 'OOO' ||
                i1 === 'OOO' || i2 === 'OOO') {
                lose();
            }
        };

        document.getElementById("Start").onclick = function() {
            let name = document.getElementById("name").value;
            HideLogin();
            document.getElementById("scoreboard").style.display = "";
            document.getElementById("game").style.display = "";
            Playerid_span.innerHTML = name;
        };

        grid11.addEventListener('click', function() {
            game(grid11);
        });
        grid12.addEventListener('click', function() {
            game(grid12);
        });
        grid13.addEventListener('click', function() {
            game(grid13);
        });
        grid21.addEventListener('click', function() {
            game(grid21);
        });
        grid22.addEventListener('click', function() {
            game(grid22);
        });
        grid23.addEventListener('click', function() {
            game(grid23);
        });
        grid31.addEventListener('click', function() {
            game(grid31);
        });
        grid32.addEventListener('click', function() {
            game(grid32);
        });
        grid33.addEventListener('click', function() {
            game(grid33);
        });
    </script>
</body>

</html>
