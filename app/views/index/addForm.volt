<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Добавить нового сотрудника</h4>
            </div>
            <div class="modal-body">
                <form action="/index/add" id="addForm" name="addForm" method="post" role="form">

                    <div class="form-group">
                        <label>Имя</label>
                        <input value="" type="text" class="form-control" name="firstname" id="firstname" placeholder="Укажите имя">
                    </div>

                    <div class="form-group">
                        <label>Фамилия</label>
                        <input value="" type="text" class="form-control" name="lastname" id="lastname" placeholder="Укажите фамилию">
                    </div>

                    <div class="form-group">
                        <label>Должность</label>
                        <input value="" type="text" class="form-control" name="position" id="position" placeholder="Укажите должность">
                    </div>

                    <div class="form-group">
                        <label>Начальник</label>
                        <select name="parent" class="form-control">
                            <option value="0">Без начальника</option>
                            {% for p in parent %}
                                <option value="{{ p['id'] }}">
                                    {{ p['firstname'] }} {{ p['lastname'] }}
                                </option>
                            {% endfor %}
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Телефон</label>
                        <input value="" type="text" class="form-control" name="phone" id="phone" placeholder="Укажите телефон">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input value="" type="text" class="form-control" name="email" id="email" placeholder="Укажите Email">
                    </div>

                    <div class="form-group">
                        <label>Заметки</label>
                        <textarea id="notes" name="notes" class="form-control" rows="4"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отменить</button>
                <button onclick="submitForm('addForm')" type="button" class="btn btn-primary">Добавить</button>
            </div>
        </div>
    </div>
</div>



<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
    Добавить нового сотрудника
</button>

<script>
    function submitForm(formName)
    {
        $( "#"+formName+"" ).submit();
    }
</script>