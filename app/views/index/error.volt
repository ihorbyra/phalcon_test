<h4>К сожалению, возникли следующие проблемы: </h4>
<ul>
{% for mess in error %}
    <li>{{ mess }}</li>
{% endfor %}
</ul>

<a href="/" class="btn btn-primary">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"> Вернуться</span>
</a>