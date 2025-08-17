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
                            <th>Pieces</th>
                            <th>Price</th>
                        </tr>
                        <?php if ($order_data): ?>
                            <?php
                            foreach ($order_data as $order) :
                            ?>

                                <tr>

                                    <td><?= $order["id_user"] ?></td>
                                    <td> <?= $order["id_item"] ?></td>
                                    <td> <?= $order["pieces"] ?></td>
                                    <td> <?= $order["price"] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2" class="text-center">No Data Found</td>
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
 
</script>

<?= $this->endSection() ?>