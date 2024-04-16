<!DOCTYPE html>
<html>
<head>
    <title>Calculator App</title>
    <link type="text/css" rel="stylesheet" href="/dashboard/cal.css"/>
<body>
    <h1 style="color: white;">Welcome to my Calculator</h1>
    <div id="calculator">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
            <input type="text" name="display" id="display" readonly>
            <div class="buttons">
                <button type="button" id="numberbuttons" onclick="addToDisplay('7')">7</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('8')">8</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('9')">9</button>
                <button type="button" id="operationbuttons" onclick="addToDisplay('+')">+</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('4')">4</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('5')">5</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('6')">6</button>
                <button type="button" id="operationbuttons" onclick="addToDisplay('-')">-</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('1')">1</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('2')">2</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('3')">3</button>
                <button type="button" id="operationbuttons" onclick="addToDisplay('*')">*</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('0')">0</button>
                <button type="button" id="numberbuttons" onclick="addToDisplay('.')">.</button>
                <button type="submit" id="numberbuttons" onclick="clearDisplay()">C</button>
                <button type="button" id="operationbuttons" onclick="addToDisplay('/')">/</button>
            </div>
            <button type="submit" id="submitbutton" name="submit">=</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $expression = $_POST["display"];
            // Remove any unwanted characters
            $expression = preg_replace('/[^0-9+\-*.\/\^\(\)\s]/', '', $expression);
            // Evaluate the expression and display the result
            if (!empty($expression)) {
                eval("\$result = ($expression);");
            }
        } else {
            $result = "";
        }
        ?>
        <div class="result" style="color: white;">
            <?php echo isset($result) ? $result : ''; ?>
        </div>
    </div>
    <script>
        function addToDisplay(value) {
            document.getElementById("display").value += value;
        }

        function clearDisplay() {
            document.getElementById("display").value = "";
        }
    </script>
</body>
</html>