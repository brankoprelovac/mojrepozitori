<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Uspešno ste se ulogovali na nas sajt! Spisak korisnika</h1>
    </header>
    
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>home_add">Dodaj novog korisnika!</a></p>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Korisničko ime</th>
                <th>Ime i Prezime</th>
                <th>E-mejl</th>
                <th colspan="2">Opcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($DATA['korisnici'] as $item): ?>
            <tr>
                <th><?php echo $item->user_id; ?></th>
                <td><?php echo htmlspecialchars($item->username); ?></td>
                <td><?php echo $item->lastname; ?></td>
                <td><?php echo $item->email; ?></td>
                
                <td><a href="<?php echo Configuration::BASE_URL; ?>home_edit_<?php echo $item->user_id; ?>">Izmeni</a></td>
                <td><a href="<?php echo Configuration::BASE_URL; ?>home_delete_<?php echo $item->user_id; ?>">Obriši</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>