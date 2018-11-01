<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Pregled po kategorija na racunu!</h1>
    </header>
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>category_add">Dodaj novu kategoriju</a></p>
    <table class="table" id="spisak-kategorija">
        <thead>
            <th>ID</th>
            <th>Naziv kategorije</th>
            <th>Tip kategorije</th>
            <th colspan="3" id="f6_options" class="align-center">Opcije</th>
        </thead>
        <tbody>
            <?php foreach ($DATA['category'] as $category): ?>
            <tr>
                <th><?php echo $category->category_id; ?></th>
                <td><?php echo htmlspecialchars($category->name); ?></td>
                <td><b><?php echo $category->type; ?></b></td>
                
                
                <td><?php Misc::url('category_' . $category->slug, 'Vidi unose za ovu kategoriju.') ?></td>
                <td><?php Misc::url('category_edit_' . $category->category_id, 'Izmeni') ?></td>
                <td><?php Misc::url('category_delete_' . $category->category_id, 'Obrisi') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>