<!DOCTYPE html>
<html>
<head>
    <title>User Accounts</title>
</head>
<body>

    <h1>User Accounts</h1>

    <nav>
        <a href="<?= base_url('/') ?>">Home</a> |
        <a href="<?= base_url('about') ?>">About</a> |
        <a href="<?= base_url('customers') ?>">Customer Accounts</a> |
<a href="https://technicals-tfa4.onrender.com/users">
    User Accounts
</a>    </nav>

    <br>

    <a href="/users/new">Add User</a>

    <br><br>

    <table border="1" cellpadding="8">
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Action</th>
        </tr>

        <?php if (! empty($users)): ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php if (! empty($user['avatar'])): ?>
                            <img
                                src="<?= esc(base_url('uploads/avatars/' . $user['avatar'])) ?>"
                                alt="User Avatar"
                                width="80"
                                height="80"
                            >
                        <?php else: ?>
                            <img
                                src="<?= esc(base_url('uploads/avatars/placeholder.png')) ?>"
                                alt="Placeholder Avatar"
                                width="80"
                                height="80"
                            >
                        <?php endif; ?>
                    </td>

                    <td><?= esc($user['username']) ?></td>

                    <td><?= esc($user['full_name']) ?></td>

                    <td>
                        <a href="<?= base_url('users/edit/' . $user['id']) ?>">
                            Edit
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No user records found.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>
</html>