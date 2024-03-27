<?php

require_once 'DistributedFileSystem.php';

$dfs = new DistributedFileSystem();

try {
    $filename = "test.txt";
    $size = 1024;
    $dfs->storeFile($filename, $size);
    echo "Файл \"$filename\" успешно сохранен.\n";

    $file = $dfs->retrieveFile($filename);
    if ($file !== null) {
        echo "Файл \"$filename\" успешно извлечен.\n";
    } else {
        echo "Файл \"$filename\" не найден.\n";
    }

    $user = "user1";
    $dfs->grantAccess($user, $filename);
    echo "Пользователю \"$user\" предоставлен доступ к файлу \"$filename\".\n";

    $dfs->revokeAccess($user, $filename);
    echo "Доступ пользователю \"$user\" к файлу \"$filename\" отозван.\n";

    if ($dfs->checkAccess($user, $filename)) {
        echo "Пользователь \"$user\" имеет доступ к файлу \"$filename\".\n";
    } else {
        echo "Пользователь \"$user\" не имеет доступа к файлу \"$filename\".\n";
    }

} catch (Exception $e) {
    echo "Произошла ошибка: " . $e->getMessage() . "\n";
}
