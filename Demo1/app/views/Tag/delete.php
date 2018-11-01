<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Da li ste sigurni da želite da izbrisete tag: "<?php echo htmlspecialchars($DATA['tags']->name); ?>"?</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL; ?>tag_delete_<?php echo htmlspecialchars($DATA['tags']->tag_id); ?>">
        
        <input type="hidden" name="confirmed" value="1">
        
        <button type="submit" class="button">Izbriši.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>tag" class="button">Nazad na listu tagova.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>