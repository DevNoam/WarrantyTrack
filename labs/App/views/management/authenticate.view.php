<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <?php loadView('partials/head'); ?>
</head>

<body>
    <section class="section">
        <div class="container">
            <h2 class="title">Login</h2>
            <form method="POST" action="/authenticate">
                <?php if (isset($errors)) { ?>
                    <?php foreach ($errors as $error => $value): ?>
                        <div class="notification is-danger"><?php echo $value; ?></div>
                    <?php endforeach; ?>
                <?php } ?>
                <div class="field">
                    <label class="label">User</label>
                    <div class="control">
                        <input class="input" type="text" name="username" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="password" required>
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <button class="button is-primary" type="submit">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>