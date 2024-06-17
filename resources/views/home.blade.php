<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <style>
            #list1 .form-control {
                border-color: transparent;
            }
            #list1 .form-control:focus {
                border-color: transparent;
                box-shadow: none;
            }
            #list1 .select-input.form-control[readonly]:not([disabled]) {
                background-color: #fbfbfb;
            }
        </style>

        <title>Home page</title>

    </head>
    <body>
        <div style="margin: 10px;">
            <h1>Welcome, <?php echo session('user_name'); ?></h1>
            <div><a href="/logout" class="link-primary">Log out</a></div>
            <div><a href="/delete/<?php echo session('user_id'); ?>" class="link-danger">Delete</a></div>
        </div>
        

        <section class="">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
                    <div class="card-body py-4 px-4 px-md-5">

                        <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                        <i class="fas fa-check-square me-1"></i>
                        <u>My Todo-s</u>
                        </p>

                        <div class="pb-2">
                        <div class="card">
                            <div class="card-body">
                            <form action="task/" method="post" enctype="multipart/form-data" class="d-flex flex-row align-items-center">
                            @csrf
                                <input type="text" class="form-control form-control-lg" id="content" placeholder="Add new..." name="content" required>
                                <!-- <a href="#!" data-mdb-tooltip-init title="Set due date">
                                    <i class="fas fa-calendar-alt fa-lg me-3"></i>
                                </a> -->
                                <div>
                                    <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Add</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

                        <hr class="my-4">
                        <?php 
                            foreach ($tasks as $task)
                                echo
                                '    <ul class="list-group list-group-horizontal rounded-0 mb-2">
                                    <li
                                        class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                                        <a href="task/' . $task->id . '" class="link-primary">Delete</a>
                                    </li>
                                    <li
                                        class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                                        <p class="lead fw-normal mb-0 bg-body-tertiary w-100 ms-n2 ps-2 py-1 rounded">' . $task->content . '
                                        </p>
                                    </li>
                                    <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                                        <div class="d-flex flex-row justify-content-end mb-1">
                                        <a href="#!" class="text-danger" data-mdb-tooltip-init title="Delete todo"><i
                                            class="fas fa-trash-alt"></i></a>
                                        </div>
                                        <div class="text-end text-muted">
                                        <a href="#!" class="text-muted" data-mdb-tooltip-init title="Created date">
                                            <p class="small mb-0"><i class="fas fa-info-circle me-2"></i>' . $task->created_at . '</p>
                                        </a>
                                        </div>
                                    </li>
                                    </ul>';
                        ?>
                        
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </body>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>
