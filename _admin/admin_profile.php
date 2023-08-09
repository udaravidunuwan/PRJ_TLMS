<!DOCTYPE html>
<html lang ="en" data-bs-theme="auto">
    <head>
        <script src="./admin_assets/js/admin_profile.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <base href="http://localhost/tlms/"> -->

        <title>TLMS/ Admin</title>

        <!-- css load with absolute path -->
        <link rel="stylesheet" href="./admin_assets/css/admin_profile.css">

        <!-- BOOTSTRAP ICONS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

        <!-- favicon -->
        <link rel="shortcut icon" type="image/png" sizes="16x16" href="../_assets/favicon_io/favicon-16x16.png">

        <!-- boostrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" 
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

        <meta name="theme-color" content="#f8f8fb">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>

    <body class="py-0 bg-body-tertiary">
        
        <header class="container-fluid">
            <div class="row">

                <!-- navbar -->
                <nav class="navbar navbar-expand-sm navbar-expand-lg bg-secondary-subtle">
                    <div class="container-fluid">
                        <div>
                            <button 
                                class="btn btn-outline-secondary border-1" 
                                type="button" 
                                data-bs-toggle="offcanvas" 
                                data-bs-target="#offcanvasMenu" 
                                aria-controls="offcanvasMenu">
                                    <i class="bi bi-list"></i>
                            </button>
                        </div>
                        <div>
                            <a class="navbar-brand ms-3" href="#">
                                TLMS
                            </a>
                        </div>
                        
                        <div>
                            <button 
                                class="btn btn-outline-secondary border-1 position-relative" 
                                type="button">
                                <i class="bi bi-bell" style="position: relative; top: 1px;"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary notification-count">1</span>
                            </button>
                     
                        </div>
                    </div>
                </nav>

                <!-- Offcanvas Left Sidebar -->
                <div class="offcanvas offcanvas-start rounded-4 rounded-start" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel" aria-modal="true" role="dialog">
                    <div class="offcanvas-header d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-top">
                            <img src="./admin_assets/img/blur/bg_blur11.jpg" alt="Profile Pic" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; margin-right: 10px;">
                            <div>
                                <p class="h6 offcanvas-title ms-2" id="offcanvasProfileLabel">Sandaruwan Samaraweera</p>
                                <p class="ms-2 text-body-secondary" id="offcanvasProfileLabel">system role</p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr class="mt-0 mb-1">
                    
                    <div class="offcanvas-body d-flex flex-column">

                        

                    <div class="list-group list-group-sm">
                            <a href="./admin_dashboard.php " class="list-group-item list-group-item-action" id="tab_dashboard"><i class="bi bi-speedometer2"></i>&nbsp;&nbsp;Dashboard</a>
                            <a href="./admin_users.php" class="list-group-item list-group-item-action" id="tab_users"><i class="bi bi-person-workspace"></i>&nbsp;&nbsp;Users</a>
                            <a href="./admin_customers.php" class="list-group-item list-group-item-action" id="tab_customers"><i class="bi bi-people"></i>&nbsp;&nbsp;Customers</a>
                            <a href="./admin_jobs.php" class="list-group-item list-group-item-action" id="tab_jobs"><i class="bi bi-file-earmark-code"></i>&nbsp;&nbsp;Jobs</a>
                        </div>
                        <hr class="mt-2 mb-4">
                        
                        <div class="list-group list-group-sm">
                            <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-graph-up"></i>&nbsp;&nbsp;Reports</a>
                        </div>
                        <!-- <hr class="mt-2 mb-4"> -->
                        
                        <div class="flex-fill">
                        </div>
                        <div class="list-group list-group-sm">
                            <a href="./admin_profile.php" class="list-group-item list-group-item-action"><i class="bi bi-person"></i>&nbsp;&nbsp;Profile</a>
                        </div>
                        <div class="list-group list-group-sm">
                            <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-gear-wide-connected"></i>&nbsp;&nbsp;Settings</a>
                            <a href="../signout.php" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-right"></i>&nbsp;&nbsp;Sign Out</a>
                        </div>   
                    </div>

                </div>
    
                
            </div>
        </header>

        <main class="content-page">
            <div class="content">
                <!-- start content -->
                <div class="container-fluid">
                    <!-- start Page title -->
                    <div class="row">
                        <div class="px-md-4">
                            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                                <h1 class="h2">Profile</h1>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <!-- start breadcrumb -->
                    <div class="row">
                        <div class="px-md-4">
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">System Admin</li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!-- end breadcrumb -->
                    <!-- start show profile -->
                    <!-- end show profile -->
                    
                </div>
                <!-- end content -->
            </div>
        </main>

        

        <!-- Theme SVG Images -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <!-- Dropdown Sign in the Theme Button -->
            <symbol id="check2" viewBox="0 0 16 16">
                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
            </symbol>
            <symbol id="circle-half" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
            </symbol>
            <symbol id="moon-stars-fill" viewBox="0 0 16 16">
                <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
                <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
            </symbol>
            <symbol id="sun-fill" viewBox="0 0 16 16">
                <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
            </symbol>
        </svg>

        <!-- Theme selection Dropdown -->
        <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
            <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
                    id="bd-theme"
                    type="button"
                    aria-expanded="false"
                    data-bs-toggle="dropdown"
                    aria-label="Toggle theme (auto)">
                <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
                <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                        Light
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                        Dark
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                        <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em"><use href="#circle-half"></use></svg>
                        Auto
                        <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
                    </button>
                </li>
            </ul>
        </div>
        <!--------------------------Profile-------------->

        <div class="container-xl px-4 mt-4">
            <!-- Account page navigation-->
            <ul class="nav nav-tabs" role="tablist" id="nav_tabs">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active"
                        id="profile-tab"
                        data-bs-toggle="tab"
                        href="#profile_tab"
                        role="tab"
                        aria-controls="profile_tab"
                        aria-selected="true"
                        >Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link"
                        id="security-tab"
                        data-bs-toggle="tab"
                        href="#security_tab"
                        role="tab"
                        aria-controls="security_tab"
                        aria-selected="false"
                        >Security</a>
                    </li>
            </ul>
            <!-- end nav -->
            <hr class="mt-0 mb-4">
            
            
            <div class="tab-content">
                <!-- Profile Tab Cantent -->
                <div class="tab-pane fade show active" id="profile_tab" role="tabpanel" aria-labelledby="profile_tab">
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Profile picture card-->
                            <div class="card mb-4 mb-xl-0">
                                <div class="card-header">Profile Picture</div>
                                <div class="card-body text-center">
                                    <!-- Profile picture image-->
                                    <img class="img-account-profile rounded-circle mb-2" src="../_assets/blank_profile_pics/blank_profile_pic.jpg" alt="">
                                    <!-- Profile picture help block-->
                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                                    <!-- Profile picture upload button-->
                                    <button class="btn btn-primary" type="button">Upload new image</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <!-- Account details card-->
                            <div class="card mb-4">
                                <div class="card-header">Account Details</div>
                                <div class="card-body">
                                    <form>
                                        <!-- Form Group (username)-->
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputUsername">Username (how your name will appear to other users on the site)</label>
                                            <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="">
                                        </div>
                                        <!-- Form Row-->
                                        <div class="row gx-3 mb-3">
                                            <!-- Form Group (first name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputFirstName">First name</label>
                                                <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" value="">
                                            </div>
                                            <!-- Form Group (last name)-->
                                            <div class="col-md-6">
                                                <label class="small mb-1" for="inputLastName">Last name</label>
                                                <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name" value="">
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="">
                                        </div>
                                        <!-- Save changes button-->
                                        <button class="btn btn-primary" type="button">Save changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Profile  -->
                <!-- Security Tab Content -->
                <div class="tab-pane fade" id="security_tab" role="tabpanel" aria-labelledby="security_tab">
                    <div class="col-lg-8">
                        <!-- Change password card-->
                        <div class="card mb-4">
                            <div class="card-header">Change Password</div>
                            <div class="card-body">
                                <form>
                                    <!-- Form Group (current password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="currentPassword">Current Password</label>
                                        <input class="form-control" id="currentPassword" type="password" placeholder="Enter current password">
                                    </div>
                                    <!-- Form Group (new password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="newPassword">New Password</label>
                                        <input class="form-control" id="newPassword" type="password" placeholder="Enter new password">
                                    </div>
                                    <!-- Form Group (confirm password)-->
                                    <div class="mb-3">
                                        <label class="small mb-1" for="confirmPassword">Confirm Password</label>
                                        <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm new password">
                                    </div>
                                    <button class="btn btn-primary" type="button">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Security  -->
            </div>
            <!-- ENd of Tab Content -->

            

        </div>

        

        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" 
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
        
    </body>

</html> 