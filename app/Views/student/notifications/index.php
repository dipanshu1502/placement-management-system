<?= $this->include('student/layout/header') ?>
<?= $this->include('student/layout/sidebar') ?>

<div class="main">

    <div class="page-header">
        <h2>My Notifications</h2>
        <p class="text-muted mb-0">
            View all your notifications
        </p>
    </div>

    <div class="card shadow">

        <div class="card-body">

            <?php if (!empty($notifications)) : ?>

                <?php foreach ($notifications as $notification) : ?>

                    <div class="alert <?= $notification['is_read'] ? 'alert-light' : 'alert-primary' ?>">

                        <h6 class="mb-1">
                            <?= esc($notification['title']) ?>
                        </h6>

                        <p class="mb-1">
                            <?= esc($notification['message']) ?>
                        </p>

                        <small class="text-muted">
                            <?= date('d M Y h:i A', strtotime($notification['created_at'])) ?>
                        </small>

                    </div>

                <?php endforeach; ?>

            <?php else : ?>

                <div class="alert alert-info">
                    No notifications available.
                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->include('student/layout/footer') ?>