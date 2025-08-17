<?= $this->extend('layout/content') ?>

<?= $this->section('content') ?>
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
            <form method="post" action="<?php echo base_url("/users/store") ?>">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" />
                    <?php
                    if ($validation->getError('name')) {
                        echo '<div class="alert alert-danger mt-2">' . $validation->getError('name') . '</div>';
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" />
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
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" />
                    <?php
                    if ($validation->getError('password')) {
                        echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('password') . "
                            </div>
                            ";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>

<?= $this->endSection() ?>