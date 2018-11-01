<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Izmeni unos "<?php echo htmlspecialchars($DATA['cash']->name); ?>"</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL; ?>overview_edit_<?php echo htmlspecialchars($DATA['cash']->cash_id); ?>">
        <div class="input-blok">
            <label for="f4_name">Naziv:</label>
            <input type="text" name="name" id="f4_name" required class="input-field" value="<?php echo htmlspecialchars($DATA['cash']->name); ?>" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f4_description">Opis:</label>
            <input type="text" name="description" id="f4_description" required class="input-field" value="<?php echo htmlspecialchars($DATA['cash']->description); ?>" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f4_value">Vrednost:</label>
            <input type="number" min="0.01" step="any" name="value" id="f4_value" required class="input-field" value="<?php echo htmlspecialchars($DATA['cash']->value); ?>"></input>
        </div>
        
        <div class="input-blok">
            <label>Kategorije:</label><br>
            
            <select name="categories" size="1" id="f5_categories" required class="input-field">
                 <?php foreach($DATA['categories'] as $cat): ?>
                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->name; ?></option>
                <?php endforeach; ?>
            </select>
            
        </div>
        
        <button type="submit" class="button">Sačuvaj izmene.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>overview_" class="button">Nazad na listu unosa.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>