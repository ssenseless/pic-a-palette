<?php
    require "../../secure/functions/palettize.php";
    $sampler = new palettize("../../secure/data/permanent/1.jpg");
    $sampler->set_percent(10);
    $sampler->set_steps(2);
    $sampler->init();
?>

<style>

    .samples div {
        float: left;
        width: <?= $sampler->sample_w ?>px;
        height: <?= $sampler->sample_h ?>px;
    }

</style>

<div class="samples">

<?php
    $sampler_callback = function($r, $g, $b, $new_row) {
        echo "<div style=\"";
        if($new_row) {
        echo "clear: left; ";
        }
        echo "background: rgb($r,$g,$b);\"></div>\n";
    };
    $sampler->sample($sampler_callback);
?>

</div>
<div style="clear: both;"></div>