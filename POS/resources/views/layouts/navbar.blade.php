<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link" onclick="document.getElementById('logout_form').submit()">Log Out</a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->


<form action="{{ route('logout') }}" method="post" id="logout_form" class="d-none">
  @csrf
</form>