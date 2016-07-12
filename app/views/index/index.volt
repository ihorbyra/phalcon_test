<h2>Сотрудники</h2>

{% include "index/addForm" with ['parent': allEmployees] %}
<br><br>
<ul class="list-group">
    {% include "index/childs" with ['employees': employees]  %}
</ul>
