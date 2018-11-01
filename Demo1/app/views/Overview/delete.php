<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Da li ste sigurni da želite da izbrisete ovaj unos: "<?php echo htmlspecialchars($DATA['cash']->name); ?>"?</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL; ?>overview_delete_<?php echo htmlspecialchars($DATA['cash']->cash_id); ?>">
        
        <input type="hidden" name="confirmed" value="1">
        
        <button type="submit" class="button">Izbriši.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>overview_" class="button">Nazad na spisak unosa.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>