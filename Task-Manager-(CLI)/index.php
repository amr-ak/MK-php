<?php
require 'Task.php';
require 'TaskManager.php';

$manager = new TaskManager();

$manager->addTask(new Task("تعلم OOP في PHP"));
$manager->addTask(new Task("بناء نظام Task Manager"));
$manager->addTask(new Task("رفع المشروع على GitHub"));

echo "--- كل المهام ---\n";
$manager->listAll();

// نأخذ أول مهمة ونخليها منجزة
$task = new Task("تعلم OOP في PHP");
$manager->addTask($task);
$task->markAsDone();

echo "\n--- المهام المنجزة فقط ---\n";
$manager->listByStatus("done");

$manager->saveToFile('tasks.json');

$newManager = new TaskManager();

try {
    $newManager->loadFromFile('tasks.json');
    echo "\n--- تحميل من الملف ---\n";
    $newManager->listAll();
} catch (Exception $e) {
    echo "خطأ: " . $e->getMessage();
}

try {
    $newManager->loadFromFile('not_exist.json');
} catch (Exception $e) {
    echo "\nخطأ متوقع: " . $e->getMessage() . "\n";
}