<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Registrujte se</h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL ?>home_add">
        <div class="input-blok">
            <label for="f4_username">Korisničko ime:</label>
            <input type="text" name="username" id="f4_username" required class="input-field" pattern="^[a-z0-9]{4,}$">
        </div>
        <div class="input-blok">
            <label for="f4_password">Šifra:</label>
            <input type="password" name="password" id="f4_password" required class="input-field" pattern="^.{6,}$">
        </div>
        <div class="input-blok">
            <label for="f4_password2">Šifra ponovo:</label>
            <input type="password" name="password2" id="f4_password2" required class="input-field" pattern="^.{6,}$">
        </div>
        
        <div class="input-blok">
            <label for="f4_lastname">Ime i Prezime:</label>
            <input type="text" name="fullname" id="f4_fullname" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f4_email">E-mejl adresa:</label>
            <input type="email" name="email" id="f4_email" required class="input-field"></input>
        </div>
        
        <button type="submit" class="button">Sačuvaj novog korisnika.</button>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>