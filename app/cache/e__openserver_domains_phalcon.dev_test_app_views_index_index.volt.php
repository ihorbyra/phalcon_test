<h2>Сотрудники</h2>
<?php $this->partial('index/addForm', ['parent' => $allEmployees]); ?>
<br><br>
<ul class="list-group">
    <?php $this->partial('index/childs', ['employees' => $employees->items]); ?>
</ul>

<a href="/">Первая</a>
<a href="?page=<?= $employees->before ?>">Предыдущая</a>
<a href="?page=<?= $employees->next ?>">Следующая</a>
<a href="?page=<?= $employees->last ?>">Последняя</a>
<br>
Вы на странице  <?= $employees->current ?> из  <?= $employees->total_pages ?>
