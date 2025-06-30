<?php if (isset($_GET['image'])): ?>
    <img src="upload/<?= htmlspecialchars($_GET['image']) ?>" alt="Afbeelding">
<?php else: ?>
    <p>Geen afbeelding gevonden.</p>
<?php endif; ?>
