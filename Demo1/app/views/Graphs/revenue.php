<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">                

    <header>
        <h1 id="qqq">Grafički prikaz rashoda u poslednjih 3 meseca.</h1>
        
        <link href="assets/css/morris.css" rel="stylesheet"/>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/raphael-min.js"></script>
        <script src="assets/js/morris.min.js"></script>
    </header>
    <p>Vaši rashodi u poslednja tri meseca iznosili su:</p>
    <ul>
        <li>Avgust: <b><?php echo ($DATA['avgust']->rashodi); ?></b> din.</li>
        <li>Septembar: <b><?php echo ($DATA['septembar']->rashodi); ?></b> din.</li>
        <li>Oktobar: <b><?php echo ($DATA['oktobar']->rashodi); ?></b> din.</li>
    </ul>

    <div id="bar-example" style="height: 250px;"></div>
        
        <script>
            
            new Morris.Bar({
            element: 'bar-example',
                data: [
                        { Mesec: 'Avgust', a: <?php echo ($DATA['avgust']->rashodi); ?>, b: <?php echo ($DATA['avgust']->balans); ?> },
                        { Mesec: 'Septembar', a: <?php echo ($DATA['septembar']->rashodi); ?>,  b: <?php echo ($DATA['septembar']->balans); ?> },
                        { Mesec: 'Oktobar', a: <?php echo ($DATA['oktobar']->rashodi); ?>,  b: <?php echo ($DATA['oktobar']->balans); ?> }
                ],
                xkey: 'Mesec',
                ykeys: ['a', 'b'],
                labels: ['Rashodi u dinarima', 'Balans za ovaj mesec'],
                barColors: ['#995030', '#9f9f9f'],
                gridTextSize: 14
            });
            
        </script>
    
    
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs">Nazad na spisak grafikona</a></p>
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>