<?php session_start(); ?>
<?php include 'header.php'; ?>
<h2>Task Report</h2>
<h3>Task Counts by Status</h3>
<ul>
    <?php foreach ($statusCounts as $status): ?>
        <li><?php echo htmlspecialchars($status['status']); ?>: <?php echo $status['count']; ?></li>
    <?php endforeach; ?>
</ul>
<h3>Overdue Tasks Count: <?php echo $overdueCount; ?></h3>
<h3>Category Summary</h3>
<ul>
    <?php foreach ($categorySummary as $cat): ?>
        <li><?php echo htmlspecialchars($cat['name']); ?> - Total: <?php echo $cat['total']; ?>, Completed: <?php echo $cat['done']; ?></li>
    <?php endforeach; ?>
</ul>
<?php include 'footer.php'; ?>
