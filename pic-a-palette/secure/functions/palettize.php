<?php 

require_once "color.php";

class palettize {

    public $w, $h;
    public $sample_w = 0;
    public $sample_h = 0;
    public $sample_size = 20;
    public $color;

    private $image;
    private $steps = 20;

    public function __construct($filepath) {
        if(!$this->image = imagecreatefromjpeg($filepath)) {
            die("Error loading image: {$filepath}");
        }
        $this->w = imagesx($this->image);
        $this->h = imagesy($this->image);
        $this->sample();
    }

    public function init() {
        $this->sample_w = $this->w / $this->steps;
        $this->sample_h = $this->h / $this->steps;
        $this->initialized = TRUE;
    }

    public function sample() {
        $this->init();

        if(($this->sample_w < 2) || ($this->sample_h < 2)) {
            die("Your sampling size is too small for this image - reduce the steps value.");
        }

        $random[rand(0, $this->steps - 1)][rand(0, $this->steps - 1)] = 1;
        for ($i = 0; $i < 5; $i++) {
            $seed_1 = rand(0, $this->steps - 1);
            $seed_2 = rand(0, $this->steps - 1);
            if (array_key_exists($seed_1, $random)) {
                if (array_key_exists($seed_2, $random[$seed_1])) {
                    $i--;
                }
            }
            $random[$seed_1][$seed_2] = 1;
        }

        for($i = 0, $y = 0; $i < $this->steps; $i++, $y += $this->sample_h) {
            if (!array_key_exists($i, $random)) {
                continue;
            }

            for($j = 0, $x = 0; $j < $this->steps; $j++, $x += $this->sample_w) {
                if (!array_key_exists($j, $random[$i])) {
                    continue;
                }

                $r_total = 0; 
                $g_total = 0;
                $b_total = 0;

                for($k = 0; $k < $this->sample_size; $k++) {
                    $x_rand = $x + rand(0, $this->sample_w-1);
                    $y_rand = $y + rand(0, $this->sample_h-1);

                    $rgb = imagecolorat($this->image, $x_rand, $y_rand);

                    $r_total += ($rgb >> 16) & 0xFF;
                    $b_total += ($rgb >> 8) & 0xFF;
                    $g_total +=  $rgb & 0xFF;
                }

                $r_avg = round($r_total / $this->sample_size);
                $g_avg = round($g_total / $this->sample_size);
                $b_avg = round($b_total / $this->sample_size);

                if (array_key_exists($i, $random)) {
                    if (array_key_exists($j, $random[$i])) {
                        $this->color[] = new color($r_avg, $b_avg, $g_avg, null);
                    }
                }
            }
        }
    }
}
?>