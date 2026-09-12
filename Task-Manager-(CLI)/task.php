<?php

class Task
{
    public string $title;
    public string $status; // "pending" أو "done"

    public function __construct(string $title)
    {
        $this->title = $title;
        $this->status = "pending"; // كل مهمة جديدة تبدأ "قيد الانتظار"
    }

    public function markAsDone(): void
    {
        $this->status = "done";
    }

    public function display(): string
    {
        $symbol = $this->status === "done" ? "✅" : "⏳";
        return "{$symbol} {$this->title}";
    }
}