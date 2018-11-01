<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Izmeni kategoriju "<?php echo htmlspecialchars($DATA['category']->name); ?>"</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL ?>category_edit_<?php echo htmlspecialchars($DATA['category']->category_id); ?>"> 
        <div class="input-blok">
            <label for="f8_name">Naziv:</label>
            <input type="text" name="name" id="f8_name" required class="input-field" pattern="[A-z 0-9\-]+" value="<?php echo htmlspecialchars($DATA['category']->name); ?>">
        </div>
        
        <button type="submit" class="button">Sačuvaj novi unos.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>category" class="button">Nazad na spisak kategorija.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>