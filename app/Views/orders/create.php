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
                <form method="post" action="<?php echo base_url("/orders/store") ?>">

                    <div class="form-group">
                        <label for="title">ผู้ใช้งาน</label>
                        <select id="inputState" name="id_user" class="form-control">
                            <option selected>Choose...</option>
                            <?php foreach ($user_data as $user): ?>
                                <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php
                        if ($validation->getError('id_user')) {
                            echo "
                            <div class='alert alert-danger mt-2'>
                            " . $validation->getError('id_user') . "
                            </div>
                            ";
                        }
                        ?>
                    </div>

                    <div class="form-group">
                        <label for="description">สินค้า</label>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th class="">Title</th>
                                    <th>Description</th>
                                    <th>Pieces</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($item_data): ?>
                                    <?php foreach ($item_data as $item): ?>
                                        <tr>
                                            <th scope="row">
                                                <input class="form-check-input ml-auto" type="checkbox" name="items[]" value="<?= $item['id'] ?>" id="invalidCheck2">
                                            </th>
                                            <td><?= $item['title'] ?></td>
                                            <td><?= $item['description'] ?></td>
                                            <td>
                                                <input type="number" name="pieces[<?= $item['id'] ?>]" value="<?= $item['pieces'] ?? 0 ?>">

                                            </td>
                                            <td><input type="number" name="price[<?= $item['id'] ?>]" value="<?= $item['price'] ?? 0 ?>"></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="3" class="text-center">No Data Found</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</body>

</html>