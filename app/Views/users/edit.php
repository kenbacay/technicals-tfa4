<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

    <h1>Edit User</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div style="color: red;">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <p><?= esc($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form
        action="<?= base_url('users/update/' . $user['id']) ?>"
        method="post"
        enctype="multipart/form-data"
    >
        <?= csrf_field() ?>

        <label for="username">Username:</label><br>
        <input
            type="text"
            name="username"
            id="username"
            value="<?= old('username', $user['username']) ?>"
        >

        <br><br>

        <label for="full_name">Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            id="full_name"
            value="<?= old('full_name', $user['full_name']) ?>"
        >

        <br><br>

        <label for="avatar">Profile Picture:</label><br>
        <input
            type="file"
            name="avatar"
            id="avatar"
            accept=".jpg,.jpeg,.png"
        >

        <p>Allowed formats: JPG or PNG. Maximum size: 2MB.</p>

        <button type="submit">Update User</button>
    </form>

    <br>

    <a href="<?= base_url('users') ?>">Back to User Accounts</a>

</body>
</html>