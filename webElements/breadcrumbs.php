<?php

//dynamische ausgabe der breadcrumbs mit $page-variable in jeder unterseite
if($page == "dashboard") $breadcrumb = "Dashboard";
if($page == "profile") $breadcrumb = "Profil";
if($page == "inbox") $breadcrumb = "Postfach";
if($page == "universities") $breadcrumb = "Auswahlportal";
if($page == "apply") $breadcrumb = "Bewerben";
if($page == "faq") $breadcrumb = "FAQ";
if($page == "contact") $breadcrumb = "Kontakt";
if($page == "review") $breadcrumb = "Rezension";
if($page == "initial") $breadcrumb = "Initialer Antrag";


?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">» <a href="https://web06.iis.uni-bamberg.de/WIP/wip2122_g3">Startseite</a></li>
        <li class="breadcrumb-item active"><?php echo $breadcrumb; ?></li>
    </ol>
</nav>