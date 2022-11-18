<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test doank</title>
</head>

<body>

    <?php
    echo ucfirst("hello world!");
    echo "<br>";
    echo ucwords("hello world!");
    echo "<br>";
    echo lcfirst("hello world!");
    echo "<br>";
    echo strtolower("hello world!");
    echo "<br>";
    echo strtoupper("hello world!");
    echo "<br>";
    echo substr_replace("Hello", "world", 0);
    echo "<br>";
    ?>

    <?php
    $str = "Hello Worlds!";
    echo $str . "<br>";
    echo chop($str, "Hello");
    echo "<br>";
    ?>

    <?php
    $str = bin2hex("a Hello World!");
    echo ($str);
    echo "<br>";
    ?>

    <?php
    $str = addslashes('What "does yolo mean"?');
    echo ($str);
    echo "<br>";
    ?>

    <?php
    $str = addcslashes("Hello World!", "d");
    echo ($str);
    echo "<br>";
    ?>

    <?php
    $str = "Hello world. It's a beautiful day.";
    print_r(explode(" ", $str));
    echo "<br>";
    ?>

    <?php
    $number = 9;
    $str = "Beijing";
    $txt = vsprintf("There are %u million bicycles in %s.", array($number, $str));
    echo $txt;
    echo "<br>";
    ?>

    <?php
    $number = 9;
    $str = "Beijing";
    vprintf("There are %u million bicycles in %s.", array($number, $str));
    echo "<br>";
    ?>

    <?php
    $str = "An example of a long word is: Supercalifragulistic";
    echo wordwrap($str, 15, "<br>\n");
    ?>

</body>

</html>