<?php foreach ($employees as $em) { ?>
    <li class="list-group-item">
        <?= $em['firstname'] ?> <?= $em['lastname'] ?>
        <a href="index/editForm/<?= $em['id'] ?>" class="btn btn-primary btn-xs">
            <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
        <a href="index/delete/<?= $em['id'] ?>" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </a>

        <?php if ($em['childs'] != null && (is_array($em['childs']) || ($em['childs']) instanceof Traversable)) { ?>
            <ul class="list-group">
                <?php $this->partial('index/childs', ['employees' => $em['childs']]); ?>
            </ul>
        <?php } ?>
    </li>
<?php } ?>