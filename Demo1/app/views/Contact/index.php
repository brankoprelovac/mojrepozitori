<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    <header>
        <h1>Kontaktirajte nas.</h1>
    </header>
    
    <form method="post" action="contact_send">
        <div class="input-blok">
            <label for="f1_email">Adresa e-poste:</label>
            <input type="email" name="email" id="f1_email" required class="input-field">
        </div>
        
        <div class="input-blok">
            <label for="f1_subject">Naslov poruke:</label>
            <input type="text" name="subject" id="f1_subject" required class="input-field" pattern="[A-z 0-9\-]+">
        </div>
        
        <div class="input-blok">
            <label for="f1_text">Tekst poruke:</label>
            <textarea name="text" rows="10" id="f1_text" required class="input-field" pattern="[A-z 0-9\-]+"></textarea>
        </div>
        
        <button type="submit" class="button">Pošaljite poruku</button>
        
    </form>
</article>
<?php require_once 'app/views/_global/afterContent.php'; ?>