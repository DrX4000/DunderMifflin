<?php
include_once 'DBModel.php'; // Assurez-vous que ce fichier contient la connexion à la base de données.
?>

<script>
    <?php if (!empty($stocks)) : ?>
        const stockMax1 = <?= $stocks[0]['stock_max'] ?? '0'; ?>;
        const stockMax2 = <?= $stocks[1]['stock_max'] ?? '0'; ?>;
        const stockMax3 = <?= $stocks[2]['stock_max'] ?? '0'; ?>;
    <?php else : ?>
        const stockMax1 = 0;
        const stockMax2 = 0;
        const stockMax3 = 0;
    <?php endif; ?>
</script>



