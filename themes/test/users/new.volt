<div class="messages" style="display:none"></div>
<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>Add new user</h2>
    </div>
</div>

<form action="/users/create" role="form" method="post" id="create-form">
    {% for element in form %}
        {% if is_a(element, 'Phalcon\Forms\Element\Hidden') %}
            {{ element }}
        {% else %}
            <div class="form-group">
                {{ element.label() }}
                <div class="controls">
                    {{ element.setAttribute("class", "form-control") }}
                    <div class="error" style="display:none;color:red"></div>
                </div>
            </div>
        {% endif %}
    {% endfor %}
     <div class="form-group">
     <label for="terms">Roles:</label>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="create" name="create">
          <label class="custom-control-label" for="create">Create</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="update" name="update">
          <label class="custom-control-label" for="update">Update</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="list" name="list">
          <label class="custom-control-label" for="list">List</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="delete" name="delete">
          <label class="custom-control-label" for="delete">Delete</label>
        </div>
    </div>

    {{ submit_button("Create", "class": "btn btn-primary") }}
    {{ link_to("users/index","Back to list",'class':'btn btn-success ml-3 float-right') }}
</form>

{{ javascript_include('js/from.js') }}