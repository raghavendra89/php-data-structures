<?php

class Queue
{
    private $queue = [];
    private $limit;

    public function __construct($limit = false)
    {
        $this->limit = $limit;
    }

    public function enQueue($item)
    {
        if ($this->limit && count($this->queue) == $limit) {
            throw new Exception("Queue is full!", 1);
        }

        array_push($this->queue, $item);
    }

    public function deQueue()
    {
        if (empty($this->queue)) {
            throw new Exception("Queue is empty!", 1);
        }

        return array_shift($this->queue);
    }

    public function peek()
    {
        return $this->queue[0];
    }

    public function isEmpty()
    {
        return empty($this->queue);
    }
}

$queue = new Queue;
$queue->enQueue(1);
$queue->enQueue(5);
$queue->enQueue(9);

print_r($queue->deQueue() . PHP_EOL); // 1
print_r($queue->peek() . PHP_EOL); // 5
print_r($queue->deQueue() . PHP_EOL); // 5
print_r($queue->deQueue() . PHP_EOL); // 9

print_r($queue->isEmpty() . PHP_EOL); // True
