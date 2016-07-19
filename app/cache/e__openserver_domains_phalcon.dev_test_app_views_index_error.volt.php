<h4>К сожалению, возникли следующие проблемы: </h4>
<ul>
<?php foreach ($error as $mess) { ?>
    <li><?= $mess ?></li>
<?php } ?>
</ul>

<a href="/" class="btn btn-primary">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> Вернуться</span>
</a>