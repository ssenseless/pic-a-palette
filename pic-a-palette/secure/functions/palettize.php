<?php 

class palettize {

    public $w, $h;
    public $sample_w = 0;
    public $sample_h = 0;

    private $image;
    private $callback = NULL;
    private $initialized = FALSE;
    private $percent = 5;
    private $steps = 10;

    public function __construct($filepath) {
        if(!$this->image = imagecreatefromjpeg($filepath)) {
            die("Error loading image: {$filepath}");
        }
        $this->w = imagesx($this->image);
        $this->h = imagesy($this->image);
    }

    public function set_percent($percent) {
        $percent = intval($percent);
        if(($percent < 1) || ($percent > 50)) {
            die("Percent val between 1 and 50");
        }
        $this->percent = $percent;
    }

    public function set_steps($steps) {
      $steps = intval($steps);
      if(($steps < 1) || ($steps > 50)) {
        die("Step val between 1 and 50");
      }
      $this->steps = $steps;
    }

    private function set_callback($callback) {
        $this->callback = $callback;
    }

    public function init() {
        $this->sample_w = $this->w / $this->steps;
        $this->sample_h = $this->h / $this->steps;
        $this->initialized = TRUE;
    }

    private function get_pixel_color($x, $y) {
        $rgb = imagecolorat($this->image, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        return [$r, $g, $b];
    }

    public function sample($callback = NULL) {
        if(($this->sample_w < 2) || ($this->sample_h < 2)) {
            die("Your sampling size is too small for this image - reduce the \$steps value.");
        }

        if($callback) {
            $this->set_callback($callback);
        }

        $sample_size = round($this->sample_w * $this->sample_h * $this->percent / 100);

        for($i = 0, $y = 0; $i < $this->steps; $i++, $y += $this->sample_h) {
            $flag = FALSE;
            $row_retval = [];

            for($j = 0, $x = 0; $j < $this->steps; $j++, $x += $this->sample_w) {
                $total_r = $total_g = $total_b = 0;

                for($k = 0; $k < $sample_size; $k++) {
                    $pixel_x = $x + rand(0, $this->sample_w-1);
                    $pixel_y = $y + rand(0, $this->sample_h-1);
                    list($r, $g, $b) = $this->get_pixel_color($pixel_x, $pixel_y);
                    $total_r += $r;
                    $total_g += $g;
                    $total_b += $b;
                }

                $avg_r = round($total_r/$sample_size);
                $avg_g = round($total_g/$sample_size);
                $avg_b = round($total_b/$sample_size);

                if($this->callback) {
                    call_user_func_array($this->callback, [$avg_r, $avg_g, $avg_b, !$flag]);
                }
                $row_retval[] = [$avg_r, $avg_g, $avg_b];
                $flag = TRUE;
            }
            $retval[] = $row_retval;
        }
        return $retval;
    }
}