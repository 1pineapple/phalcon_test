<div class="messages" style="display:none"></div>
<div class="row mb-3">
    <div class="col-xs-12 col-md-6">
        <h2>Edit user</h2>
    </div>
</div>

<form action="/users/save" role="form" method="post" id="save-form">
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
          <input type="checkbox" class="custom-control-input" id="create" name="create" <?php echo strpos($roles,"create")?"checked":null; ?>>
          <label class="custom-control-label" for="create">Create</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="update" name="update" <?php echo strpos($roles,"update")?"checked":null; ?>>
          <label class="custom-control-label" for="update">Update</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="list" name="list" <?php echo strpos($roles,"list")?"checked":null; ?>>
          <label class="custom-control-label" for="list">List</label>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="delete" name="delete" <?php echo strpos($roles,"delete")?"checked":null; ?>>
          <label class="custom-control-label" for="delete">Delete</label>
        </div>
    </div>

    {{ submit_button("Save", "class": "btn btn-primary") }}
    {{ link_to("users/index","Back to list",'class':'btn btn-success ml-3 float-right') }}
</form>

{{ javascript_include('js/from.js') }}