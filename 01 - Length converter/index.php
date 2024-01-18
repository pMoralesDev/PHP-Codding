<?php
$value="";
$from="";
$to="";
/**
 * En primer lugar convertimos la información del usuario a metros para trabajar con ello
 */
function convert_to_meter($value, $unit_from){
    switch ($unit_from){
        case 'Milimeter':
            return $value/1000;
        break;
        case 'Centimeter':
            return $value/100;
        break;
        case 'Decimeter':
            return $value/10;
        break;
        case 'Meter':
            return $value;
        break;
        case 'Decameter':
            return $value*10;
        break;
        case 'Hectometer':
            return $value*100;
        break;
        case 'Kilometer':
            return $value*1000;
        break;
        default:
            return "Unsupported measurement unit";
        break;
    }
}
/**
 * Creamos una función que convierta de metros a la unidad que quiere el usuario
 */
function convert_to_user_measure($value, $unit_to){
    switch ($unit_to){
        case 'Milimeter':
            return $value*1000;
        break;
        case 'Centimeter':
            return $value*100;
        break;
        case 'Decimeter':
            return $value*10;
        break;
        case 'Meter':
            return $value;
        break;
        case 'Decameter':
            return $value/10;
        break;
        case 'Hectometer':
            return $value/100;
        break;
        case 'Kilometer':
            return $value/1000;
        break;
        default:
            return "Unsupported measurement unit";
        break;
    }
}
/**
 * Capturamos los valores que envia el usuario y los pasamos por el proceso de conversión
 */
if(isset($_POST["convert"])){
    $value = $_POST['value'];
    $from = $_POST['from'];
    $to = $_POST["to"];
    $value_from = convert_to_meter($value,$from);
    $result = number_format(convert_to_user_measure($value_from, $to),2);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>#1.- Length Converter</title>
</head>
<body>
    <div class="container">
        <h1>Length Converter</h1>
        <form method="POST">
            <div class="row">

                <div class="col">
                    <div>
                        <label for="value" class="form-label">Value:</label>
                        <input type="number" name="value" class="form-control" value="">
                    </div>
                </div>

                <div class="col">
                    <label for="from" class="form-label">From:</label>
                    <select name="from" class="form-select">
                        <option value="">--Select a measurement unit--</option>
                        <option value="Milimeter">Milimeter</option>
                        <option value="Centimeter">Centimeter</option>
                        <option value="Decimeter">Decimeter</option>
                        <option value="Meter">Meter</option>
                        <option value="Decameter">Decameter</option>
                        <option value="Hectometer">Hectometer</option>
                        <option value="Kilometer">Kilometer</option>
                    </select>
                </div>

                <div class="col">
                    <label for="to" class="form-label">To:</label>
                    <select name="to" class="form-select">
                        <option value="">--Select a measurement unit--</option>
                        <option value="Milimeter">Milimeter</option>
                        <option value="Centimeter">Centimeter</option>
                        <option value="Decimeter">Decimeter</option>
                        <option value="Meter">Meter</option>
                        <option value="Decameter">Decameter</option>
                        <option value="Hectometer">Hectometer</option>
                        <option value="Kilometer">Kilometer</option>
                    </select>
                </div>
            </div>

            <div class="row">

                <div class="col">
                    <button type="submit" name="convert" class="btn">Convert</button>
                </div>

                <div class="col">
                    <div class="mb">
                        <label for="result" class="form-label">Result:</label>
                        <input type="text" name="result" class="form-control" value="<?php if(isset($result)) echo $result; ?>">
                    </div>
                </div>
            </div>

        </form>

    </div>
</body>
</html>