<?php

class TreeNode
{
    public $data;
    public $left;
    public $right;

    public function __construct($value)
    {
        $this->data = $value;
        $this->left = null;
        $this->right = null;
    }
}

// Function to build a binary tree from the given array representation
function buildTree($nodes, $index, $sz)
{
    if ($index < $sz) {
        if ($nodes[$index] === -1) {
            return null; // Null indicates no child
        }

        $root = new TreeNode($nodes[$index]);
        $root->left = buildTree($nodes, 2 * $index + 1, $sz);
        $root->right = buildTree($nodes, 2 * $index + 2, $sz);

        return $root;
    }
    return null;
}

// Function to perform in-order traversal and print the values
function inOrderTraversal($root)
{
    if ($root !== null) {
        inOrderTraversal($root->left);
        echo $root->data . " ";
        inOrderTraversal($root->right);
    }
}

// Function to calculate the sum of nodes greater than a given value
function sumOfNodes($root, $n)
{
    if ($root === null) {
        return 0;
    }

    $sum = 0;
    if ($root->data > $n) {
        $sum += $root->data;
    }

    $sum += sumOfNodes($root->left, $n);
    $sum += sumOfNodes($root->right, $n);

    return $sum;
}

// Read input from the console
fscanf(STDIN, "%d\n", $n);

fscanf(STDIN, "%d\n", $sz);

$nodes = array_map('intval', explode(' ', fgets(STDIN)));

// Build the tree
$root = buildTree($nodes, 0, $sz);

// Calculate and print the sum of nodes greater than n
$result = sumOfNodes($root, $n);
echo "$result";
