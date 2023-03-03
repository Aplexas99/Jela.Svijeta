<h1>Backend Zadatak</h1>

<br>
<br>

<?php
    if(isset($_GET['hr'])){
        $locale = 'hr';
        App::setLocale($locale);
    }

    if(isset($_GET['en'])){
        $locale = 'en';
        App::setLocale($locale);
    }
?>

<form action="" method="get">
    @csrf
    <button type="submit" name="hr">HR</button>
    <button type="submit" name="en">EN</button>



<h1>Meals</h1>
    <div class="meal">
        <ul>
        <?php


    echo "<pre>";
    echo json_encode($meals, JSON_PRETTY_PRINT);
    echo "</pre>";
?>
        </ul>
    </div>
