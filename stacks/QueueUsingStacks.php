<?php

require 'Stack.php';

class Queue
{
    private $stack1;
    private $stack2;

    public function __construct()
    {
        $this->stack1 = new Stack;
        $this->stack2 = new Stack;
    }

    public function enQueue($item)
    {
        // Move all elements from stack1 to stack2
        while (! $this->stack1->isEmpty()) {
            $this->stack2->push($this->stack1->pop());
        }

        // Push item into stack1
        $this->stack1->push($item);

        // Move back all elements to stack1 from stack2
        while (! $this->stack2->isEmpty()) {
            $this->stack1->push($this->stack2->pop());
        }
    }

    public function deQueue()
    {
        if ($this->stack1->isEmpty()) {
            throw new Exception("Queue is empty!", 1);
        }

        return $this->stack1->pop();
    }

    public function peek()
    {
        if ($this->stack1->isEmpty()) {
            throw new Exception("Queue is empty!", 1);
        }

        return $this->stack1->top();
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

