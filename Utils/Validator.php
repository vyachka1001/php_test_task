<?php

class Validator
{
    const LEFT_INTERVAL_BORDER = -10.0;
    const RIGHT_INTERVAL_BORDER = 10.0;
    const DECIMAL_PLACES = 6;

    //determine if the entire dataset is valid
    public static function isValidDataset($data, $separator, $ind) : bool
    {
        $result = true;
        for ($i = 0; $i < count($data); $i++)
        {
            if (!self::isDotCoordsAreValid($data[$i], $separator, $ind + $i))
            {
                $result = false;
            }
        }

        return $result;
    }

    //determine if (x;y) coords fit the conditions
    private static function isDotCoordsAreValid(string $coordsString, string $separator, $ind) : bool
    {
        $result = true;
        $coords = explode($separator, $coordsString);

        if(!self::isDotValid($coords[0], $ind))
        {
            $result = false;
        }

        if(!self::isDotValid($coords[1], $ind))
        {
            $result = false;
        }

        return $result;
    }

    //determine if the single dot fits the conditions
    private static function isDotValid($coordinate, $ind) : bool
    {
        return self::isDotCoordinateFloat($coordinate, $ind) && self::isDotCoordinateInInterval($coordinate, $ind) &&
            self::isCoordinateHasAllowableDecimalPlaces($coordinate, $ind);
    }

    //check for real number
    private static function isDotCoordinateFloat($coordinate, $ind) : bool
    {
        if (!is_numeric($coordinate))
        {
            echo "Координата должна быть вещественным числом в диапазоне [".self::LEFT_INTERVAL_BORDER."; ".self::RIGHT_INTERVAL_BORDER
                ."] и с числом знаков после запятой < ".(self::DECIMAL_PLACES + 1)."<br/> Обнаружено на строке ".($ind + 1)
                ." исходного файла: " .$coordinate."<br/>";
           return false;
        }

        return true;
    }

    //check if dot belongs to the interval
    private static function isDotCoordinateInInterval($coordinate, $ind) : bool
    {
        if ($coordinate < self::LEFT_INTERVAL_BORDER || $coordinate > self::RIGHT_INTERVAL_BORDER)
        {
            echo "Координата должна быть вещественным числом в диапазоне [".self::LEFT_INTERVAL_BORDER."; ".self::RIGHT_INTERVAL_BORDER
                ."]<br/>Обнаружено на строке ".($ind + 1)." исходного файла: ".$coordinate."<br/>";
            return false;
        }

        return true;
    }

    //check if dot has right amount of decimal places
    private static function isCoordinateHasAllowableDecimalPlaces($coordinate, $ind) : bool
    {
        if (strpos($coordinate, '.'))
        {
            $decimalPlacesAmount = strlen($coordinate) - strpos($coordinate, '.') - 1;
            if ($decimalPlacesAmount > self::DECIMAL_PLACES)
            {
                echo "Координата должна быть вещественным числом с числом знаком после запятой < ".(self::DECIMAL_PLACES + 1)
                    ."<br/>Обнаружено на строке ".($ind + 1)." исходного файла: ".$coordinate."<br/>";
                return false;
            }
        }

        return true;
    }
}