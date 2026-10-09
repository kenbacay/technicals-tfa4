<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>

    <h1>Edit Customer</h1>

    <form action="<?= base_url('customers/update/' . $customer['id']) ?>" method="post">
        <?= csrf_field() ?>

        <label>Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name', $customer['full_name']) ?>"
        >

        <br><br>

        <label>Email:</label><br>
        <input
            type="email"
            name="email"
            value="<?= old('email', $customer['email']) ?>"
        >

        <br><br>

        <label>Phone:</label><br>
        <input
            type="text"
            name="phone"
            value="<?= old('phone', $customer['phone']) ?>"
        >

        <br><br>

        <button type="submit">Update Customer</button>
    </form>

    <br>

    <a href="<?= base_url('customers') ?>">Back to Customers</a>

</body>
</html>