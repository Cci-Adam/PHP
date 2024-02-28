<header>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'home') echo 'active'; ?>" aria-current="page" href="?page=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'galerie') echo 'active'; ?>" href="?page=galerie">Galerie</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php if(isset($_GET['page']) && $_GET['page'] == 'contact') echo 'active'; ?>" href="?page=contact">Contact</a>
            </li>
        </ul>
        </ul>
        </div>
    </div>
</nav>
</header>