<?php

class Checker
{
    public static function isDotBelongToTriangle(Triangle $triangle, Dot $dot) : bool
    {
        return self::areDotsOnTheSameSideOfTheLine($dot, $triangle->a, $triangle->b, $triangle->c) &&
            self::areDotsOnTheSameSideOfTheLine($dot, $triangle->b, $triangle->a, $triangle->c) &&
                self::areDotsOnTheSameSideOfTheLine($dot, $triangle->c, $triangle->a, $triangle->b);
    }

    //determine is dot to be checked on the same side that dot C relatively to the triangle line AB
    private static function areDotsOnTheSameSideOfTheLine(Dot $dot1, Dot $dot2, Dot $a, Dot $b) : bool
    {
        return self::determineDotPositionRelativelyToLine($dot1, $a, $b) *
            self::determineDotPositionRelativelyToLine($dot2, $a, $b) >= 0;
    }

    //determine dot position relatively to line(0 if dot belongs to the line)
    private static function determineDotPositionRelativelyToLine(Dot $dot, Dot $a, Dot $b) : float
    {
        return ($dot->x - $a->x) * ($b->y - $a->y) - ($dot->y - $a->y) * ($b->x - $a->x);
    }
}