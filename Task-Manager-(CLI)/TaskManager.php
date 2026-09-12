<?php

class TaskManager
{
    private array $tasks = [];

    public function addTask(Task $task): void
    {
        $this->tasks[] = $task;
    }

    public function removeTask(string $title): void
    {
        $this->tasks = array_filter(
            $this->tasks,
            fn($task) => $task->title !== $title
        );
    }

    public function listAll(): void
    {
        foreach ($this->tasks as $task) {
            echo $task->display() . "\n";
        }
    }

    public function listByStatus(string $status): void
    {
        $filtered = array_filter(
            $this->tasks,
            fn($task) => $task->status === $status
        );

        foreach ($filtered as $task) {
            echo $task->display() . "\n";
        }
    }


public function saveToFile(string $filename): void
{
    $data = array_map(fn($task) => [
        'title' => $task->title,
        'status' => $task->status,
    ], $this->tasks);

    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

public function loadFromFile(string $filename): void
{
    if (!file_exists($filename)) {
        throw new Exception("الملف غير موجود: {$filename}");
    }

    $content = file_get_contents($filename);
    $data = json_decode($content, true);

    $this->tasks = [];
    foreach ($data as $item) {
        $task = new Task($item['title']);
        $task->status = $item['status'];
        $this->tasks[] = $task;
    }
}

}