<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Dodaj novu kategoriju.</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL ?>category_add">
        <div class="input-blok">
            <label for="f7_name">Naziv:</label>
            <input type="text" name="name" id="f7_name" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f7_type">Tip kategorije:</label>
            <select name="type" size="1">
                <option value="prihodi">Prihod</option>
                <option value="rashodi">Rashod</option>
            </select>
        </div>
        
        
        <button type="submit" class="button">Sačuvaj novi unos.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>category" class="button">Nazad na spisak kategorija.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>