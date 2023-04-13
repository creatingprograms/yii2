
<table class="table table-striped table-bordered">
    <tbody class="all-filters">
        <?php
        die($filters);

        if($filters){
            foreach ($filters as $filter){ ?>
            <li class="list-group-item"><?= $filter->title ?></li>

        <?php }}else{ ?>
            <li class="list-group-item">Нет атрибутов</li>
        <?php } ?>
    </tbody>
</table>