<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    
    <header>
        <h1>Balans iznosi: <?php echo (($DATA['prihodi_total']) - ($DATA['rashodi_total'])); ?> dinara.</h1>
    </header>
    
    <div class="container">
    <div class="float-left">
        <table class="table2">
            <caption class="income">Prihodi</caption>
            <thead>
                <tr>
                    <th>Naziv unosa</th>
                    <th>Vrednost u dinarima</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($DATA['prihodi'] as $income): ?>
                <tr>
                    <td><?php echo htmlspecialchars($income->name); ?></td>
                    <td data-vrednost-unosa="<?php echo $income->value; ?>"><?php echo $income->value; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="float-right">
        <table class="table2">
            <caption class="revenue">Rashodi</caption>
            <thead>
                <tr>
                    <th>Naziv unosa</th>
                    <th>Vrednost</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($DATA['rashodi'] as $revenue): ?>
                <tr>
                    <td><?php echo htmlspecialchars($revenue->name); ?></td>
                    <td data-ballance_id="<?php echo $revenue->value; ?>"><?php echo $revenue->value; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    </div><br>
    
    <p id="suma_prihoda" value="<?php echo ($DATA['prihodi_total']); ?>">Celokupni iznos prihoda je: <b><?php echo ($DATA['prihodi_total']); ?></b> dinara.</p>
    <p id="suma_rashoda" value="<?php echo ($DATA['rashodi_total']); ?>">Celokupni iznos rashoda je: <b><?php echo ($DATA['rashodi_total']); ?></b> dinara.</p>
    <p>Totalni balans na Vašem racunu je <b><?php echo (($DATA['prihodi_total']) - ($DATA['rashodi_total'])); ?></b> dinara.</p>
    
    
    
    <script src="assets/js/main.js"></script>
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>