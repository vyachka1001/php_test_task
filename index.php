<?php

include 'Model\Triangle.php';
include 'Model\Dot.php';
include 'Utils\Checker.php';
include 'Utils\Validator.php';

main();

function main()
{
    $filePath = "tria-pt.txt";
    $data = readDataFromFile($filePath);
    checkingDotsForBelonging($data);
}

function checkingDotsForBelonging($data)
{
    $dotNumber = 0;
    $separator = ',';

    for ($i = 0; $i < count($data); $i += 4)
    {
        $dotNumber++;
        echo $dotNumber.": ";

        $dots = array($data[$i], $data[$i + 1], $data[$i + 2], $data[$i + 3]);
        if (Validator::isValidDataset($dots, $separator, $i))
        {
            $dots[$i] = parseStringIntoDot($data[$i], $separator);
            $dots[$i + 1] = parseStringIntoDot($data[$i + 1], $separator);
            $dots[$i + 2] = parseStringIntoDot($data[$i + 2], $separator);
            $dots[$i + 3] = parseStringIntoDot($data[$i + 3], $separator);

            $triangle = new Triangle($dots[$i], $dots[$i + 1], $dots[$i + 2]);
            $dot = $dots[$i + 3];

            if (Checker::isDotBelongToTriangle($triangle, $dot))
            {
                echo "да<br/>";
            }
            else
            {
                echo "нет<br/>";
            }
        }
    }
}

function parseStringIntoDot(string $coordsString, $separator) : Dot
{
    $coords = explode($separator, $coordsString);
    return new Dot($coords[0], $coords[1]);
}

function readDataFromFile($filePath) : array
{
    $file = fopen($filePath, 'r');
    $data = array();

    while(!feof($file))
    {
        $data[] = fgets($file);
    }

    return $data;
}