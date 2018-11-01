<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
            <header>
                <h1>Grafički prikaz stanja na racunu!</h1>
            </header>
    
    
    <table class="table">
        <thead>
            <tr>
                <th>Tip grafikona</th>
                <th>Opis</th>
                <th>Opcija</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Donut chart</td>
                <td>Prikaz trenutnog balansa na Vašem racunu.</td>
                <td><p><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs_donut">Pogledajte grafikon</a></p></td>
            </tr>
            <tr>
                <td>Bar chart</td>
                <td>Prikaz prihoda u poslednjih 3 meseca.</td>
                <td><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs_income">Pogledajte grafikon</a></td>
            </tr>
            <tr>
                <td>Bar chart</td>
                <td>Prikaz rashoda u poslednjih 3 meseca.</td>
                <td><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs_revenue">Pogledajte grafikon</a></td>
            </tr>
        </tbody>
    </table>
                
                
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>