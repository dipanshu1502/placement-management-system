<?= $this->include('layout/header') ?>
<?= $this->include('super_admin/layout/sidebar') ?>

<div class="main">

    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>📜 Activity Logs</h2>
            <p class="text-muted mb-0">
                View all activities performed by administrators.
            </p>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4">

        <div class="card-header bg-light">
            <strong>🔍 Filter Activity Logs</strong>
        </div>

        <div class="card-body">

            <form method="get">

                <div class="row g-3">

                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input
                            type="text"
                            name="search"
                            class="form-control"
                            placeholder="Admin, Description, IP..."
                            value="<?= esc($search) ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Admin</label>

                        <select name="admin" class="form-select">

                            <option value="">All Admins</option>

                            <?php foreach ($admins as $item) : ?>

                                <option
                                    value="<?= $item['id'] ?>"
                                    <?= ($admin == $item['id']) ? 'selected' : '' ?>>

                                    <?= esc($item['name']) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Module</label>

                        <select name="module" class="form-select">

                            <option value="">All Modules</option>

                            <?php foreach ($modules as $item) : ?>

                                <option
                                    value="<?= esc($item) ?>"
                                    <?= ($module == $item) ? 'selected' : '' ?>>

                                    <?= esc($item) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Action</label>

                        <select name="action" class="form-select">

                            <option value="">All Actions</option>

                            <?php foreach ($actions as $item) : ?>

                                <option
                                    value="<?= esc($item) ?>"
                                    <?= ($action == $item) ? 'selected' : '' ?>>

                                    <?= esc($item) ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="col-md-3">
                        <label class="form-label">From Date</label>

                        <input
                            type="date"
                            name="from"
                            class="form-control"
                            value="<?= esc($from) ?>">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">To Date</label>

                        <input
                            type="date"
                            name="to"
                            class="form-control"
                            value="<?= esc($to) ?>">
                    </div>

                </div>

                <div class="mt-4">

                    <button class="btn btn-primary">
                        <i class="bi bi-search"></i>
                        Apply Filters
                    </button>

                    <a href="<?= current_url() ?>" class="btn btn-secondary">
                        Reset
                    </a>

                </div>

            </form>

        </div>

    </div>

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <strong>
                Showing <?= count($logs) ?> Activity Log(s)
            </strong>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th width="70">ID</th>
                            <th>Admin</th>
                            <th>Module</th>
                            <th width="120">Action</th>
                            <th>Description</th>
                            <th width="140">IP Address</th>
                            <th width="180">Date & Time</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($logs)) : ?>

                            <?php foreach ($logs as $log) : ?>

                                <?php

                                $badge = 'secondary';

                                switch ($log['action']) {

                                    case 'Created':
                                        $badge = 'success';
                                        break;

                                    case 'Updated':
                                        $badge = 'primary';
                                        break;

                                    case 'Deleted':
                                        $badge = 'danger';
                                        break;

                                    case 'Selected':
                                        $badge = 'success';
                                        break;

                                    case 'Rejected':
                                        $badge = 'warning';
                                        break;

                                    case 'Removed':
                                        $badge = 'danger';
                                        break;

                                    case 'Restored':
                                        $badge = 'info';
                                        break;
                                }

                                ?>

                                <tr>

                                    <td><?= $log['id'] ?></td>

                                    <td>
                                        👤 <?= esc($log['name']) ?>
                                    </td>

                                    <td>
                                        <?= esc($log['module']) ?>
                                    </td>

                                    <td>

                                        <span class="badge bg-<?= $badge ?>">
                                            <?= esc($log['action']) ?>
                                        </span>

                                    </td>

                                    <td>
                                        <?= esc($log['description']) ?>
                                    </td>

                                    <td>
                                        <?= esc($log['ip_address']) ?>
                                    </td>

                                    <td>
                                        <?= date('d M Y h:i A', strtotime($log['created_at'])) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>

                                <td colspan="7" class="text-center py-4">

                                    No activity logs found.

                                </td>

                            </tr>

                        <?php endif; ?>


                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">

            <small class="text-muted">
                Total Records: <?= $pager->getTotal() ?>
            </small>

            <?= $pager->links() ?>

        </div>

    </div>

</div>

<?= $this->include('layout/footer') ?>
