<!DOCTYPE html>
<html>
<head>
    <title>New User</title>
</head>
<body>

    <h1>Add New User</h1>

    <nav>
        <a href="<?= base_url('/') ?>">Home</a> |
        <a href="<?= base_url('about') ?>">About</a> |
        <a href="<?= base_url('customers') ?>">Customer Accounts</a> |
        <a href="<?= base_url('users') ?>">User Accounts</a>
    </nav>

    <br>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/users/create" method="post">
    <?= csrf_field() ?>

        <label for="username">Username:</label><br>
        <input
            type="text"
            name="username"
            id="username"
            value="<?= old('username') ?>"
        >

        <br><br>

        <label for="full_name">Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            id="full_name"
            value="<?= old('full_name') ?>"
        >

        <br><br>

        <button type="submit">Save User</button>
    </form>

    <br>

    <a href="<?= base_url('users') ?>">Back to User Accounts</a>

</body>
</html>