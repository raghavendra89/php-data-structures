<?php

class Stack
{
    private $stack = [];
    private $limit;

    public function __construct($limit = false)
    {
        $this->limit = $limit;
    }

    public function push($item)
    {
        if ($this->limit && count($this->stack) == $limit) {
            throw new Exception("Stack is full!", 1);
        }

        array_push($this->stack, $item);
    }

    public function pop()
    {
        if (empty($this->stack)) {
            throw new Exception("Stack is empty!", 1);
        }

        return array_pop($this->stack);
    }

    public function top()
    {
        return end($this->stack);
    }

    public function isEmpty()
    {
        return empty($this->stack);
    }
}

// $stack = new Stack;
// $stack->push(1);
// $stack->push(5);
// $stack->push(9);

// print_r($stack->pop() . PHP_EOL); // 9
// print_r($stack->top() . PHP_EOL); // 5
// print_r($stack->pop() . PHP_EOL); // 5
// print_r($stack->pop() . PHP_EOL); // 1

// print_r($stack->isEmpty() . PHP_EOL); // True
