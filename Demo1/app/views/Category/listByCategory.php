<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Spisak unosa za kategoriju "<?php echo htmlspecialchars($DATA['ime_kategorije']) ?>"!</h1>
    </header>
    
    <table class="table" id="unosi-za-kategoriju">
        <thead>
            <tr>
                <th>ID</th>
                <th>Naziv</th>
                <th>Opis</th>
                <th>Vrednost</th>
                <th colspan="3" id="f6_options" class="align-center">Opcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($DATA['category'] as $unos): ?>
            <tr>
                <th><?php echo $unos->cash_id; ?></th>
                <td><?php echo htmlspecialchars($unos->name); ?></td>
                <td><?php echo $unos->description; ?></td>
                <td><?php echo $unos->value; ?> din.</td>
                
                <td><?php Misc::url('overview_edit_' . $unos->cash_id, 'Izmeni') ?></td>
                <td><?php Misc::url('overview_delete_' . $unos->cash_id, 'Obrisi') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>category">Nazad na listu kategorija.</a></p>
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>
