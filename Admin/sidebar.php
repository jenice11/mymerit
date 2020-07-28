<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" ><?php echo $_SESSION['adminUsername'] ?></a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="dashboard.php"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">                
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            

                            <div class="sb-sidenav-menu-heading">Event</div>
                            <a class="nav-link" href="adminIndex.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Event List
                            </a>
                            <a class="nav-link" href="approved.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Approve Events 
                            </a>
                            <a class="nav-link" href="rejected.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Reject Event
                            </a>
                            

                            <div class="sb-sidenav-menu-heading">Merit</div>
                            <a class="nav-link" href="meritAdd.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Add Merit
                            </a>
                            <a class="nav-link" href="meritList.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Merit List 
                            </a>


                            <div class="sb-sidenav-menu-heading">Coordinator</div>
                            <a class="nav-link" href="admin_add.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Add Coordinator
                            </a>
                          
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                      Administrator
                    </div>
</div>



