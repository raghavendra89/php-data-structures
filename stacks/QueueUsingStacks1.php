<?php

// Dequeue operation is costlier

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
        // Push item into stack1
        $this->stack1->push($item);
    }

    public function deQueue()
    {
        if ($this->stack1->isEmpty() && $this->stack2->isEmpty()) {
            throw new Exception("Queue is empty!", 1);
        }

        // if stack2 is empty, move
        // elements from stack1
        if ($this->stack2->isEmpty()) {
            while (! $this->stack1->isEmpty()) {
                $this->stack2->push($this->stack1->pop());
            }
        }

        return $this->stack2->pop();
    }

    public function peek()
    {
        if ($this->stack1->isEmpty() && $this->stack2->isEmpty()) {
            throw new Exception("Queue is empty!", 1);
        }

        if ($this->stack2->isEmpty()) {
            while (! $this->stack1->isEmpty()) {
                $this->stack2->push($this->stack1->pop());
            }
        }

        return $this->stack2->top();
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

