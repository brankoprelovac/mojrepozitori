<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Prijava na naš sajt.</h1>
    </header>
    
    <form method="post">
        <div class="input-blok">
            <label for="f1_username">Korisničko ime:</label>
            <input type="text" name="username" id="f1_username" required class="input-field" pattern="^[a-z0-9]{4,}$">
        </div>
        
        <div class="input-blok">
            <label for="f1_password">Lozinka:</label>
            <input type="password" name="password" id="f1_password" required class="input-field" pattern="^.{6,}$">
        </div>
        
        <button type="submit" class="button">Ulogujte se.</button>
        
    </form>
    
    <?php if(isset($DATA['message'])): ?>
        <p><br><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
        
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>