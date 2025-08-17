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
                        <a href="<?php echo site_url('/orders/create'); ?>" class="btn btn-primary">Add Order</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th>ID User</th>
                            <th>ID Item</th>
                        </tr>
                        <?php if ($order_data): ?>
                            <?php
                            foreach ($order_data as $order) :
                            ?>

                                <tr>

                                    <td><?= $order["id_user"] ?></td>
                                    <td> <?= $order["id_item"] ?></td>

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

</body>

</html>
<style>
    .pagination li a {
        position: relative;
        display: block;
        padding: .5rem .75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    .pagination li.active a {
        z-index: 1;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>
<script>
    function delete_data(id) {
        if (confirm("Are you sure you want to remove it?")) {
            window.location.href = "<?php echo base_url(); ?>/items/delete/" + id;
        }
        return false;
    }
</script>