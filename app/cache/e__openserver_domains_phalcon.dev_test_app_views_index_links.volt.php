<?php foreach ($employees as $em) { ?>
    <li class="list-group-item">
        <?= $em['firstname'] ?> <?= $em['lastname'] ?>
        <?php if ($em['childs'] != null && (is_array($em['childs']) || ($em['childs']) instanceof Traversable)) { ?>
            <ul class="list-group">
                <?php $this->partial('index/links', ['employees' => $em['childs']]); ?>
            </ul>
        <?php } ?>
    </li>
<?php } ?>