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
            <form method="post" action="<?php echo base_url("/items/store") ?>">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" />
                    <?php
                    if ($validation->getError('title')) {
                        echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('title') . "
                            </div>
                            ";
                    }
                    ?>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                    <?php
                    if ($validation->getError('description')) {
                        echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('description') . "
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
<script>

</script>

<?= $this->endSection() ?>