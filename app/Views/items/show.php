<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, user-scalable=yes">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Codeigniter 4 Crud Application</title>
    <!--  -->
</head>

<body>
    <div class="container">

        <h2 class="text-center mt-4 mb-4">Codeigniter 4 Crud Application</h2>

        <?php

        $validation = \Config\Services::validation();

        ?>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">Sample Data</div>
                    <div class="col text-right">

                    </div>
                </div>
            </div>
            <div class="card-body">

                <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="<?= $user['name'] ?>" />
                    <?php
                    if ($validation->getError('name')) {
                        echo '<div class="alert alert-danger mt-2">' . $validation->getError('name') . '</div>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="<?= $user['email'] ?>" />
                    <?php
                    if ($validation->getError('email')) {
                        echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('email') . "
                            </div>
                            ";
                    }
                    ?>
                </div>


                <div class="form-group">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Undo</button>
                </div>

            </div>
        </div>

    </div>

</body>

</html>