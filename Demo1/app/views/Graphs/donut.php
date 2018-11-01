<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
                
    <header>
        <h1 id="qqq">Grafiči prikaz odnosa prihoda i rashoda.</h1>
        
        <link href="assets/css/c3.css" rel="stylesheet"/>
        <script src="assets/js/d3.v5.min.js" charset="utf-8"></script>
        <script src="assets/js/c3.min.js"></script>
    </header>
    
    <p><p>Vaši prihodi i rashodi iznose:</p>
    <ul>
        <li>Prihodi: <b><?php echo ($DATA['suma_prihoda']); ?></b> din.</li>
        <li>Rashodi: <b><?php echo ($DATA['suma_rashoda']); ?></b> din.</li>
    </ul></p>
    <div id="donut-example" style="height: 350px;"></div>
        
        <script>
            
            var chart = c3.generate({
                bindto: '#donut-example',
                data: {
                columns: [
                    ['Prihodi', <?php echo htmlspecialchars($DATA['suma_prihoda']); ?>],
                    ['Rashodi', <?php echo htmlspecialchars($DATA['suma_rashoda']); ?> ],
                ],
                type : 'pie',
                colors: {
                    Prihodi: '#509920',
                    Rashodi: '#995030'
                },
                onclick: function (d, i) { console.log("onclick", d, i); },
                onmouseover: function (d, i) { console.log("onmouseover", d, i); },
                onmouseout: function (d, i) { console.log("onmouseout", d, i); }
                },
                legend: {
                    position: 'bottom'
                },
                pie: {
                    label: {
                        format: function (value, ratio, id) {
                            return d3.format('$')(value);
                        }
                    }
                }
            });
        </script>
        <p><i>Unutar pie charta iznosi su u $ umesto u Rsd.</i></p>
    
    <p><a class="button" href="<?php echo Configuration::BASE_URL; ?>graphs">Nazad na spisak grafikona</a></p>
                
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>