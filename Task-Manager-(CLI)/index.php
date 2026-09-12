<?php
require 'Task.php';

$task1 = new Task("تعلم OOP في PHP");
echo $task1->display();
echo "\n";

$task1->markAsDone();
echo $task1->display();