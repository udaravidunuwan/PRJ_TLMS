<?php
require './admin_signin_functions.php';
require './admin_users_functions.php';

// Check if the session variable is set and non-empty
if (isset($_SESSION["session_id"]) && !empty($_SESSION["session_id"])) {
    // Sanitize the session ID to prevent SQL injection
    $session_id = mysqli_real_escape_string($connection, $_SESSION["session_id"]);

    // Prepare the SQL statement to retrieve admin information
    $stmt = mysqli_prepare($connection, "SELECT * FROM tlms_admin WHERE tlms_admin_id = ?");
    mysqli_stmt_bind_param($stmt, "s", $session_id);
    mysqli_stmt_execute($stmt);
    // Get the result of the query
    $result = mysqli_stmt_get_result($stmt);
    // Fetch admin data as an associative array
    $admin = mysqli_fetch_assoc($result);
    // Close the prepared statement
    mysqli_stmt_close($stmt);
    // Check if an admin was found
    if (!$admin) {
        // Redirect to index.php if admin not found
        header("Location: ../index.php");
        exit(); // Make sure to exit after sending the redirect header
    }

    // Table fetch
    // Fetch data from tlms_system_users table using prepared statement
    $query = "SELECT tlms_system_users_id, tlms_system_users_first_name, tlms_system_users_last_name, tlms_system_users_user_role, tlms_system_users_email FROM tlms_system_users";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Generate table rows
    $rows = '';
    while ($row = mysqli_fetch_assoc($result)) {
        $rows .= '<tr>
                    <td>' . htmlspecialchars($row['tlms_system_users_id']) . '</td>
                    <td>' . htmlspecialchars($row['tlms_system_users_first_name']) . ' ' . htmlspecialchars($row['tlms_system_users_last_name']) . '</td>
                    <td>' . htmlspecialchars($row['tlms_system_users_user_role']) . '</td>
                    <td>' . htmlspecialchars($row['tlms_system_users_email']) . '</td>
                    <td>
                        <button class="btn btn-sm ms-2 me-2 edit-user-button" type="button" data-bs-toggle="modal" data-bs-target="#users_edit_modal" data-user-id="' . htmlspecialchars($row['tlms_system_users_id']) . '"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-sm ms-2 me-2 delete-user-button" type="button" data-bs-toggle="modal" data-bs-target="#users_delete_modal" data-user-id="' . htmlspecialchars($row['tlms_system_users_id']) . '"><i class="bi bi-trash3"></i></button>
                    </td>
                </tr>';
    }

    mysqli_stmt_close($stmt);
    // End Table fetch
} else {
    // Redirect to index.php if session_id is not set
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TLMS/ Admin</title>

    <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="./admin_assets/css/admin_users.css">
    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" sizes="16x16" href="../_assets/favicon_io/favicon-16x16.png">
    <!-- boostrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- DataTable CSS import -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- DataTable JS Import -->
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="./admin_assets/js/admin_users.js"></script>


    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

    <meta name="theme-color" content="#f8f8fb">

</head>

<body class="py-0 bg-body-tertiary">

    <header class="container-fluid">
        <div class="row">

            <!-- navbar -->
            <nav class="navbar navbar-expand-sm navbar-expand-lg bg-secondary-subtle">
                <div class="container-fluid">
                    <div>
                        <button class="btn btn-outline-secondary border-1" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>
                    <div>
                        <a class="navbar-brand ms-3" href="#">
                            TLMS
                        </a>
                    </div>

                    <div>
                        <button class="btn btn-outline-secondary border-1 position-relative" type="button">
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
                            <h1 class="h2">Users</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <button id="admin_users_addNewUsers" type="button" class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#users_new_modal">Add New User</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- start breadcrumb -->
                <div class="row">
                    <div class="px-md-4">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">System Administrator</li>
                                <li class="breadcrumb-item active" aria-current="page">Users</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end of Breadcrumb -->
                <!-- start table -->
                <div class="row mt-3">
                    <div class="px-md-4">
                        <!-- <h3>Users Table</h3> -->
                        <table id="admin_users_table" class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Name</th>
                                    <th>User Role</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $rows; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end table -->
            </div>
            <!-- end content -->
        </div>
    </main>


    <!-- Modal Insert -->
    <div class="modal fade" id="users_new_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New User</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Insert Form -->
                    <form autocomplete="on" action="" method="post">
                        <input type="hidden" id="actionAddNewUser" value="actionAddNewUser">
                        <div class="row">
                            <div class="col">
                                <input id="admin_users_addNewUser_firstName" type="text" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <input id="admin_users_addNewUser_lastName" type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <select id="admin_users_addNewUser_userRole" class="form-select" label="User Role" aria-label="User Role">
                                    <option selected disabled>User Role</option>
                                    <option>Admin</option>
                                    <option>Manager</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input id="admin_users_addNewUser_email" type="email" class="form-control" placeholder="name@example.com" aria-label="name@example.com">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input id="admin_users_addNewUser_temp_password_input" class="form-control" type="text" value="Temp Password" aria-label="readonly input example" readonly>
                            </div>
                        </div>
                    </form>
                    <!-- End of Insert Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="admin_users_addNewUser_btn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL INSERT -->

    <!-- Modal Edit -->
    <div class="modal fade" id="users_edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form autocomplete="on" action="" method="post">
                        <input type="hidden" id="actionEditUser" value="actionEditUser">
                        <div class="row">
                            <div class="col">
                                <input id="admin_users_editUser_firstName" type="text" class="form-control" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <input id="admin_users_editUser_lastName" type="text" class="form-control" placeholder="Last name" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <!-- <input id="admin_users_editUser_userRole" class="form-control" placeholder="User Role" aria-label="readonly input User Role" readonly> -->
                                <select id="admin_users_editUser_userRole" class="form-select" label="User Role" aria-label="User Role">
                                    <option selected disabled>User Role</option>
                                    <option>Admin</option>
                                    <option>Manager</option>
                                    <option>User</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col">
                                <input id="admin_users_editUser_email" type="email" class="form-control" placeholder="name@example.com" aria-label="readonly input name@example.com" readonly>
                            </div>
                        </div>
                    </form>
                    <!-- End of Edit Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="admin_users_editUser_btn">Save</button>
                    <button type="button" class="btn btn-secondary" id="admin_users_editUser_btn-NO" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL EDIT -->

    <!-- Modal Delete -->
    <div class="modal fade" id="users_delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    Are you sure to delete the field?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary delete-button" id="admin_users_deleteUser_btn">Yes</button>
                    <button type="button" class="btn btn-secondary" id="admin_users_deleteUser_btn-NO" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL DELETE -->

    <!-- Processes Toast -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="processToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto"><i class="bi bi-exclamation-circle"></i> Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>
    <!-- End of Toast -->

    <!-- Theme SVG Images -->
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <!-- Dropdown Sign in the Theme Button -->
        <symbol id="check2" viewBox="0 0 16 16">
            <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
        </symbol>
        <symbol id="circle-half" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z" />
        </symbol>
        <symbol id="moon-stars-fill" viewBox="0 0 16 16">
            <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z" />
            <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z" />
        </symbol>
        <symbol id="sun-fill" viewBox="0 0 16 16">
            <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z" />
        </symbol>
    </svg>

    <!-- Theme selection Dropdown -->
    <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center" id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
            <svg class="bi my-1 theme-icon-active" width="1em" height="1em">
                <use href="#circle-half"></use>
            </svg>
            <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#sun-fill"></use>
                    </svg>
                    Light
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#moon-stars-fill"></use>
                    </svg>
                    Dark
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
            <li>
                <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                    <svg class="bi me-2 opacity-50 theme-icon" width="1em" height="1em">
                        <use href="#circle-half"></use>
                    </svg>
                    Auto
                    <svg class="bi ms-auto d-none" width="1em" height="1em">
                        <use href="#check2"></use>
                    </svg>
                </button>
            </li>
        </ul>
    </div>


    <!-- Script to pass data to Ajax -->
    <?php
    require './admin_signin_scripts.php';
    require './admin_users_scripts.php';
    ?>


</body>

</html>