<?= $this->extend('layout/content') ?>

<?= $this->section('content') ?>
<div class="container">

    <h2 class="text-center mt-4 mb-4">Codeigniter 4 Crud Application</h2>

    <?php

    $session = \Config\Services::session();

    if ($session->getFlashdata('success')) {
        echo '
            <div class="alert alert-success">' . $session->getFlashdata("success") . '</div>
            ';
    }

    ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">Sample Data</div>
                <div class="col text-right">
                    <a href="<?php echo site_url('items/create'); ?>" class="btn btn-primary">Add Item</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>ID</th>
                        <th class="">Title</th>
                        <th>Description</th>
                        <th>Show</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php if ($item_data): ?>
                        <?php
                        foreach ($item_data as $item) :
                        ?>

                            <tr>
                                <td><?= $item["id"] ?></td>
                                <td><?= $item["title"] ?></td>
                                <td> <?= $item["description"] ?></td>
                                <td><a href="<?= site_url('items/' . $item['id']) ?>" class="btn btn-info btn-sm">Show</a></td>
                                <td><a href="<?= site_url('items/edit/' . $item['id']) ?>" class="btn btn-warning btn-sm">Edit</a></td>
                                <td><button onclick="delete_data(<?= $item['id'] ?>)" class="btn btn-danger btn-sm">Delete</button></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No Data Found</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
            <div>
                <?php

                if ($pagination_link) {
                    $pagination_link->setPath('users');

                    echo $pagination_link->links();
                }

                ?>

            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    function delete_data(id) {
        if (confirm("Are you sure you want to remove it?")) {
            window.location.href = "<?php echo base_url(); ?>/items/delete/" + id;
        }
        return false;
    }
</script>

<?= $this->endSection() ?>