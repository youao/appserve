<h1><?= $name; ?></h1>
<div>
    <?php foreach ($columns as $row) : ?>
        <div style="display: flex">
            <span style="flex: 1"><?= $row['COLUMN_NAME']; ?></span>
            <span style="flex: 1"><?= $row['COLUMN_TYPE']; ?></span>
            <span style="flex: 1"><?= $row['COLUMN_KEY']; ?></span>
            <span style="flex: 1"><?= $row['COLUMN_COMMENT']; ?></span>
        </div>
    <?php endforeach; ?>
</div>