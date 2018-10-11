// based on a twig form -- REMVE all "{% %}"
// ** Use FormBuilder class ********** to remake this
// noValue - attribs that have no val e.g. 'required' ?>
{% xxx extends 'templates/xxapp.twigxxmain.php' -> main.php %}

{% block content %}
<!-- create form -->
<!-- form top NOW IN  partials/form_top ******* -->

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="">
				<div class="panel-heading">Sign up</div>
				<div class="panel-body">
<!-- end form top ****** -->

<!-- form declaration ******* -->
<form action="{{ path_for('****auth.signup')}}" method="post" autocomplete="off">
   {{ csrf_field() }}
  <!-- end form declation ******* -->

  <!-- form fields ***** -->
	<div class="form-group">
	  <label for="email">Email</label>
    <input type="email" name="email" id="email" placeholder="u@dom.com" class="form-control">
  </div>
	<div class="form-group">
	  <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control">
  </div>
	<div class="form-group">
	  <label for="password">Password</label>
    <input type="password" name="password" id="password" class="form-control">
  </div>
<!-- end form fields ****** -->

<!-- end form NOW IN  partials/form_bottom**** -->
  <!-- form button **** -->
  <button type="submit" class="btn btn-default">Sign Up</button>
  <!-- end form button **** -->

</form>
</div>
			</div>
		</div>
	</div>
<!-- END of end form **** -->
{% endblock %}
