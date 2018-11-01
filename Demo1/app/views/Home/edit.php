<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Izmeni korisnika <?php echo htmlspecialchars($DATA['korisnik']->username); ?></h1>
    </header>
    
    <form method="post" action="<?php echo Configuration::BASE_URL; ?>home_edit_<?php echo htmlspecialchars($DATA['korisnik']->user_id); ?>">
        <div class="input-blok">
            <label for="f3_username">Korisničko ime:</label>
            <input type="text" name="username" id="f3_username" required class="input-field" value="<?php echo htmlspecialchars($DATA['korisnik']->username); ?>">
        </div>
        
        <div class="input-blok">
            <label for="f3_fullname">Ime i Prezime:</label>
            <input type="text" name="fullname" id="f3_fullname" required class="input-field" value="<?php echo htmlspecialchars($DATA['korisnik']->fullname); ?>">
        </div>
        
        <div class="input-blok">
            <label for="f3_email">E-mejl adresa:</label>
            <input type="email" name="email" id="f3_email" required class="input-field" value="<?php echo htmlspecialchars($DATA['korisnik']->email); ?>"></input>
        </div>
        
        <button type="submit" class="button">Sačuvaj izmene.</button>
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>home_" class="button">Nazad na spisak korisnika.</a>
        
    </form>
    
    <?php if (isset($DATA['message'])): ?>
    <p><?php echo htmlspecialchars($DATA['message']); ?></p>
    <?php endif; ?>
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>