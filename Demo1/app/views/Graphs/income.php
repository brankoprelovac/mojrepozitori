<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">   
    
    <header>
        <h1 id="qqq">Grafiči prikaz prihoda u poslednjih 3 meseca.</h1>
        
        <link href="assets/css/morris.css" rel="stylesheet"/>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/raphael-min.js"></script>
        <script src="assets/js/morris.min.js"></script>
    </header>
    <p>Vaši prihodi u poslednja tri meseca iznosili su:</p>
    <ul>
        <li>Avgust: <b><?php echo ($DATA['avgust']->prihodi); ?></b> din.</li>
        <li>Septembar: <b><?php echo ($DATA['septembar']->prihodi); ?></b> din.</li>
        <li>Oktobar: <b><?php echo ($DATA['oktobar']->prihodi); ?></b> din.</li>
    </ul>
        
        <div id="bar-example" style="height: 250px;"></div>
        
        <script>
            
            new Morris.Bar({
            element: 'bar-example',
                data: [
                        { Mesec: 'Avgust', a: <?php echo ($DATA['avgust']->prihodi); ?>, b: <?php echo ($DATA['avgust']->balans); ?> },
                        { Mesec: 'Septembar', a: <?php echo ($DATA['septembar']->prihodi); ?>,  b: <?php echo ($DATA['septembar']->balans); ?> },
                        { Mesec: 'Oktobar', a: <?php echo ($DATA['oktobar']->prihodi); ?>,  b: <?php echo ($DATA['oktobar']->balans); ?> }
                ],
                xkey: 'Mesec',
                ykeys: ['a', 'b'],
                labels: ['Prihodi u dinarima', 'Balans za ovaj mesec'],
                barColors: ['#509920', '#9f9f9f'],
                gridTextSize: 14
            });
            
        </script>

    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs">Nazad na spisak grafikona</a></p>
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>