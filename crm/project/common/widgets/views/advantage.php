<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
?>
<ul class="advantage">
<?php foreach ($slides as $slide){ ?>
    <li><img src="/uploads/images/<?=$slide->imageFile?>" alt=""><?=$slide->title?></li>
<?php } ?>
</ul>