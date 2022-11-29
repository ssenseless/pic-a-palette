<?php

class color {
    public $r, $g, $b,
           $h, $s, $v,
           $hex,
           $type,
           $heat_type,
           $light_type,
           $neut_type = "n";
           

    public function __construct($r, $g, $b, $hex) {
        //if hex exists, use it instead
        if ((($r == $g) && ($g == $b) && ($b == -1))) {
            list($r, $g, $b) = sscanf($hex, "#%02X%02X%02X");
            $this->r = $r;
            $this->g = $g;
            $this->b = $b;

            $this->hex = $hex;
        }
        //otherwise assign RGB values as usual
        else {
            $this->r = $r;
            $this->g = $g;
            $this->b = $b;
            //calculate and assign HEX value (string)
            $this->hex = sprintf(sprintf("#%02X%02X%02X", $this->r, $this->g, $this->b));
        }

        //calculate and assign HSV value
        $this->rgbtohsv();

        //assign boolean values for mixing
        $this->assignbool();
    }

    public function rgbtohsv() {
        $r_percent = $this->r / 255;
        $g_percent = $this->g / 255;
        $b_percent = $this->b / 255;

        $max = max([$r_percent, $g_percent, $b_percent]);
        $min = min([$r_percent, $g_percent, $b_percent]);

        $diff = $max - $min;

        //obvious
        if ($diff == 0) {
            $this->h = 0;
        } else {
            //this mathematically works out, don't ask me why
            if ($max === $r_percent) {
                $this->h = (60 * (($g_percent - $b_percent) / $diff) + 360) % 360;
            }
            else if ($max === $g_percent) {
                $this->h = (60 * (($b_percent - $r_percent) / $diff) + 120) % 360;
            }
            else {
                $this->h = (60 * (($r_percent - $g_percent) / $diff) + 240) % 360;
            }
        }

        if ($max == 0) {
            $this->s = 0;
        } 
        else {
            $this->s = $diff / $max;
        }

    
        $this->v = $max;
    }

    public function assignbool() {
        //cool or warm
        if ($this->h >= 100 && $this->h <= 260) {
            $this->heat_type = "c";
        } 
        else if ($this->h >= 280 || $this->h <= 80) {
            $this->heat_type = "w";
        } 
        else {
            $this->heat_type = "m";
        }

        //dark or light
        if ($this->v <= 0.30) {
            $this->light_type = "d";
        }
        else if ($this->v <= 0.50) {
            $this->light_type = "m";
        }
        else {
            $this->light_type = "l";
        }

        //neutral
        if ($this->v <= 0.12) {
            $this->neut_type = "y";
        }
        else if ($this->s <= 0.25) {
            $this->neut_type = "y";
        }

        $this->type = $this->heat_type . $this->light_type . $this->neut_type;
    }
}