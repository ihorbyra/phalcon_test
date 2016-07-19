<h2>Редактирование сотрудника</h2>
<form action="/index/edit/<?= $employee->id ?>" id="addForm" name="addForm" method="post" role="form">
    <input type="hidden" name="id" id="id" value="<?= $employee->id ?>">

    <div class="form-group">
        <label>Имя</label>
        <input value="<?= $employee->firstname ?>" type="text" class="form-control" name="firstname" id="firstname" placeholder="Укажите имя">
    </div>

    <div class="form-group">
        <label>Фамилия</label>
        <input value="<?= $employee->lastname ?>" type="text" class="form-control" name="lastname" id="lastname" placeholder="Укажите фамилию">
    </div>

    <div class="form-group">
        <label>Должность</label>
        <input value="<?= $employee->position ?>" type="text" class="form-control" name="position" id="position" placeholder="Укажите должность">
    </div>

    <div class="form-group">
        <label>Начальник</label>
        <select name="parent" class="form-control">
            <option value="0">Без начальника</option>
            <?php foreach ($parent as $p) { ?>
                <?php if ($p['id'] == $employee->id) { ?>
                    <?php continue; ?>
                <?php } ?>
                <option value="<?= $p['id'] ?>">
                    <?= $p['firstname'] ?> <?= $p['lastname'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label>Телефон</label>
        <input value="<?= $employee->phone ?>" type="text" class="form-control" name="phone" id="phone" placeholder="Укажите телефон">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input value="<?= $employee->email ?>" type="text" class="form-control" name="email" id="email" placeholder="Укажите Email">
    </div>

    <div class="form-group">
        <label>Заметки</label>
        <textarea id="notes" name="notes" class="form-control" rows="4"><?= $employee->notes ?></textarea>
    </div>

    <button onclick="submitForm('addForm')" type="button" class="btn btn-primary">Сохранить</button>
</form>

<script>
    function submitForm(formName)
    {
        $( "#"+formName+"" ).submit();
    }
</script>