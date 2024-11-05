<?php

// Given two binary trees, the task is to find if both of them are identical or not. Two trees are identical when they have the same data and the arrangement of data is also the same.

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

function checkTrees($root1, $root2)
{
    // If both trees are empty, they are identical
    if ($root1 === null && $root2 === null) {
        return true;
    }

    // If only one tree is empty, they are not identical
    if ($root1 === null || $root2 === null) {
        return false;
    }

    return $root1->data === $root2->data
                && checkTrees($root1->left, $root2->left)
                && checkTrees($root1->right, $root2->right);
}

function checkIfIndential($nodes1, $nodes2)
{
    $root1 = buildTree($nodes1, 0, count($nodes1));
    $root2 = buildTree($nodes2, 0, count($nodes2));

    if (checkTrees($root1, $root2)) {
        return 'YES';
    }
    return 'NO';
}

print_r(checkIfIndential([1, 2, 3, 4, -1, -1, -1], [1, 2, 3, 4, -1, -1, -1]) . PHP_EOL); // YES
print_r(checkIfIndential([1, 2, 3, 4, -1, -1, -1], [1, 2, 3, -1, -1, 4, -1]) . PHP_EOL); // NO
