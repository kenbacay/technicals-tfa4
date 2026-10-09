<!DOCTYPE html>
<html>
<head>
    <title>New Customer</title>
</head>
<body>

    <h1>Add New Customer</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/about">About</a> |
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>
    </nav>

    <br>

    <?php if (isset($validation)): ?>
        <div style="color: red;">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <form action="/customers/create" method="post">

        <label for="full_name">Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            id="full_name"
            value="<?= old('full_name') ?>"
        >
        <br><br>

        <label for="email">Email:</label><br>
        <input
            type="email"
            name="email"
            id="email"
            value="<?= old('email') ?>"
        >
        <br><br>

        <label for="phone">Phone:</label><br>
        <input
            type="text"
            name="phone"
            id="phone"
            value="<?= old('phone') ?>"
        >
        <br><br>

        <button type="submit">Save Customer</button>

    </form>

</body>
</html>