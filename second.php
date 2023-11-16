<?php

include './test/test.php';

echo 2 . '<br>';

// htmlspecialchars функция, которая не дает отработать скриптам, которые можно специально передать через инпуты
echo htmlspecialchars($_POST['test']);
