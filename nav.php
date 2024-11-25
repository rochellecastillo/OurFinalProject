<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand">TF</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <?php
          if($_SESSION['role']=='admin'){
        ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">HR Management</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="main.php">Add New HR</a></li>
            <li><a class="dropdown-item" href="view.php">View HR Info</a></li>

          </ul>
        </li>
        <?php
          }else if($_SESSION['role']=='hr'){
          ?>
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Employee Management</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="main.php">Add New Employee</a></li>
            <li><a class="dropdown-item" href="view.hr.php">View Employee Info</a></li>
          </ul>
        </li>
        <?php
          }
        ?>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>