<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 bg-gradient-dark shadow-none border-radius-xl mb-2 mt-4" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-5" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group input-group-outline-info">
              <label class="form-label"></label>
              
            </div>
          </div>
          
        </div>
        
      <div class="nav-item dropdown  me-sm-5">
          <a class="nav-link dropdown-toggle float-end text-success" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['auth_user']['name'];?>
          </a>
         <div class="dropdown-menu">
            <li><a class="dropdown-item" href="../index.php">Home</a></li>
              <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="my-profile.php">My Profile</a></li>
              <hr class="dropdown-divider">
            <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
         </div>
      </div>
          
    </div>
  </div>
</nav>