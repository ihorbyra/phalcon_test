{% for em in employees %}
    <li class="list-group-item">
        {{ em['firstname'] }} {{ em['lastname'] }}
        <a href="index/editForm/{{ em['id'] }}" class="btn btn-primary btn-xs">
            <span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
        </a>
        <a href="index/delete/{{ em['id'] }}" class="btn btn-danger btn-xs">
            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
        </a>

        {% if em['childs'] != null and em['childs'] is iterable %}
            <ul class="list-group">
                {% include "index/childs" with [ 'employees': em['childs'] ] %}
            </ul>
        {% endif %}
    </li>
{% endfor %}