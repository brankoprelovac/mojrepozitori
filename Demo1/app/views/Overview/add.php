<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Dodaj novi unos.</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL ?>overview_add">
        <div class="input-blok">
            <label for="f5_name">Naziv:</label>
            <input type="text" name="name" id="f5_name" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f5_description">Opis:</label>
            <input type="text" name="description" id="f5_description" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f5_value">Vrednost:</label>
            <input type="number" min="0.01" step="any" name="value" id="f5_value" required class="input-field"></input>
        </div>
        <div class="input-blok">
            <label for="f5_categories">Kategorije:</label>
            <select name="categories" size="1" id="f5_categories" required class="input-field">
                 <?php foreach($DATA['categories'] as $cat): ?>
                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <button type="submit" class="button">Sačuvaj novi unos.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>overview_" class="button">Nazad na listu unosa.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>