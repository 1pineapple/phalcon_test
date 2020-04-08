<h2>List Users</h2>
{{ link_to("users/new","Add new user",'class':'btn btn-success mb-3 d-none add-button') }}
{{ partial('users/patial_table') }}



{{ javascript_include('js/table.js') }}
