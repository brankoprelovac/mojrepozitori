<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Pregled po tagovima na računu!</h1>
    </header>
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>tag_add">Dodaj novi tag</a></p>
    <table class="table" id="spisak-kategorija">
        <thead>
            <th>ID</th>
            <th>Naziv taga</th>
            <th>Klasa taga</th>
            <th colspan="2" id="f9_options" class="align-center">Opcije</th>
        </thead>
        <tbody>
            <?php foreach ($DATA['tags'] as $tag): ?>
            <tr>
                <th><?php echo $tag->tag_id; ?></th>
                <td><?php echo htmlspecialchars($tag->name); ?></td>
                <td><?php echo htmlspecialchars($tag->image_class); ?></td>
                
                
                <td><?php Misc::url('tag_edit_' . $tag->tag_id, 'Izmeni') ?></td>
                <td><?php Misc::url('tag_delete_' . $tag->tag_id, 'Obrisi') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>