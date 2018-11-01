<!doctype html>
<html>
    <head>
        <title><?php echo $DATA['seo_title']; ?></title>
        <meta charset="utf-8">
        <link href="<?php Configuration::BASE_URL ?>assets/css/osnovni.css" rel="stylesheet"> 
        <link href="<?php Configuration::BASE_URL ?>assets/css/osnovni-mobile.css" rel="stylesheet">
        <link href="<?php Configuration::BASE_URL ?>assets/css/<?php echo $FoundRoute['Controller']; ?>.css" rel="stylesheet">
        <link href="<?php Configuration::BASE_URL ?>assets/css/<?php echo $FoundRoute['Controller']; ?>-mobile.css" rel="stylesheet">
    </head>
    <body>
        <section id="wrapper">
            <header id="header">
                <img alt="Promotivni baner 1" src="<?php Configuration::BASE_URL ?>assets/images/banner1.svg">
            </header>
            <nav id="nav">
                <?php if (Session::exists('user_id')): ?>
                    <?php include 'app/views/_global/menu-session.php'; ?>
                <?php else: ?>
                    <?php include 'app/views/_global/menu-no-session.php'; ?>
                <?php endif; ?>
            </nav>
            <main id="sadrzaj">
                
 