<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die
?>

<?if($USER->IsAdmin()):?>
<a href="//localhost:8082/conference/admin.php">Новая заявка на конференцию</a>
<?else:?>
Вы приняты на конференцию <a href="">Скрыть</a>
<?endif;?>
</body>
</html>