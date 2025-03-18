<?php
session_start();

$display = '';
$result = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['num'])) {
       
        if (isset($_SESSION['operator'])) {
            $_SESSION['num2'] = ($_SESSION['num2'] ?? '') . $_POST['num'];
        } 
        else {
        
            $_SESSION['num1'] = ($_SESSION['num1'] ?? '') . $_POST['num'];
        }
    } 
    
    elseif (isset($_POST['operator'])) {
        $_SESSION['operator'] = $_POST['operator'];
    } 
    
    elseif (isset($_POST['answer'])) {
    
        if (isset($_SESSION['num1']) && isset($_SESSION['operator']) && isset($_SESSION['num2'])) {
            $num1 = $_SESSION['num1'];
            $operator = $_SESSION['operator'];
            $num2 = $_SESSION['num2'];

            switch ($operator) {
                case '+':
                    $result = $num1 + $num2;
                    break;
                case '-':
                    $result = $num1 - $num2;
                    break;
                case '*':
                    $result = $num1 * $num2;
                    break;
                case '/':
                    $result = $num1 / $num2;
                    break;
            }

            unset($_SESSION['num1']);
            unset($_SESSION['operator']);
            unset($_SESSION['num2']);
        }
    } 
    elseif (isset($_POST['clear'])) {
        $display = '';
        $result = '';
        unset($_SESSION['num1']);
        unset($_SESSION['operator']);
        unset($_SESSION['num2']);
    }

    if (isset($_SESSION['num1'])) {
        $display .= $_SESSION['num1'];
    }
    if (isset($_SESSION['operator'])) {
        $display .= ' ' . $_SESSION['operator'] . ' ';
    }
    if (isset($_SESSION['num2'])) {
        $display .= $_SESSION['num2'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: white;
        margin-top: 20px;
    }

    .calculator {
        text-align: center;
        border: 4px solid black;
        padding: 20px;
    }

    .btn {
        display: grid;
        grid-template-columns: repeat(4, 90px);
        gap: 10px;
        height: 400px;
    }

    .btn input {
        font-size: 25px;
        border-radius: 15px;
    }

    #output input {
        margin-bottom: 20px;
        padding: 15px;
        width: auto;
        font-size: 25px;
        border: 2px solid black;
        border-radius: 10px;
    }

    .btn :hover {
        background-color: red;
    }
    </style>
</head>

<body>
    <form method="post">
        <div class="calculator">
            <h1>Calculator</h1>
            <div id="output">
                <input type="text" id="result" name="result" value="<?php echo $result !== '' ? $result : $display; ?>">
            </div>

            <div class="btn">

                <input type="submit" value="1" name="num">
                <input type="submit" value="2" name="num">
                <input type="submit" value="3" name="num">
                <input type="submit" value="4" name="num">
                <input type="submit" value="5" name="num">
                <input type="submit" value="6" name="num">
                <input type="submit" value="7" name="num">
                <input type="submit" value="8" name="num">
                <input type="submit" value="9" name="num">
                <input type="submit" value="0" name="num">
                <input type="submit" value="/" name="operator">
                <input type="submit" value="*" name="operator">
                <input type="submit" value="+" name="operator">
                <input type="submit" value="-" name="operator">
                <input type="submit" value="c" name="clear">
                <input type="submit" value="=" name="answer">
            </div>
        </div>
    </form>
</body>

</html>