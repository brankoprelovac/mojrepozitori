<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Dodaj novi tag.</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL ?>tag_add">
        <div class="input-blok">
            <label for="f9_name">Naziv:</label>
            <input type="text" name="name" id="f9_name" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f9_classes">Klasa:</label>
            <input type="text" name="classes" id="f9_classes" required class="input-field" pattern="[a-z0-9\-]+">
        </div>
        
        
        <button type="submit" class="button">Sačuvaj novi unos.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>tag" class="button">Nazad na spisak kategorija.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>