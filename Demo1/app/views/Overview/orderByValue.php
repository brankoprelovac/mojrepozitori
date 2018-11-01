<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Spisak unosa na račun</h1>
    </header>
    
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>overview_add">Dodaj novi unos</a> 
        <a class="button" href="<?php echo Configuration::BASE_URL; ?>overview">Sortiraj po vremenu unosa</a></p>
    <table class="table" id="unosi">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ime</th>
                <th>Opis</th>
                <th>Napravljeno</th>
                <th>Kategorija</th>
                <th>Vrednost</th>
                <th colspan="2" class="align-center">Opcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($DATA['cash'] as $cash): ?>
            <tr>
                <th><?php echo $cash->cash_id; ?></th>
                <td><?php echo htmlspecialchars($cash->name); ?></td>
                <td><?php echo $cash->description; ?></td>
                <td><?php echo $cash->created_at; ?></td>
                <td>
                    <ul>
                        <?php foreach ($cash->categories as $cashCategory): ?>
                        <li data-ime-klase="<?php echo htmlspecialchars($cashCategory->name); ?>"><?php echo htmlspecialchars($cashCategory->name); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td data-vrednost-unosa="<?php echo $cash->value; ?>"><?php echo $cash->value; ?> din.</td>
                
                <td><?php Misc::url('overview_edit_' . $cash->cash_id, 'Izmeni') ?></td>
                <td><?php Misc::url('overview_delete_' . $cash->cash_id, 'Obrisi') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>