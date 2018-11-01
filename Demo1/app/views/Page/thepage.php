<?php require_once 'app/views/_global/beforeContent.php'; ?>

<article class="blok">
    <header>
        <h1><?php echo $DATA['page']->title; ?></h1>
    </header>
    
    
    
    <main><?php echo $DATA['page']->content; ?></main>
</article>

<?php require_once 'app/views/_global/afterContent.php'; ?>