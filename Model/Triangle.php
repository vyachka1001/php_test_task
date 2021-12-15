<?php

class Triangle
{
    public Dot $a;
    public Dot $b;
    public Dot $c;

    public function __construct(Dot $a, Dot $b, Dot $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
}