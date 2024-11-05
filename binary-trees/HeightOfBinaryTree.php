<?php

// Given a binary tree, the task is to find the maximum depth or height of the tree. The height of the tree is the number of vertices in the tree from the root to the deepest node.

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

// Returns "maxDepth" which is the number of nodes 
// along the longest path from the root node down 
// to the farthest leaf node.
function maxDepth($node) {
    if ($node === null)
        return 0;

    // compute the depth of left and right subtrees
    $lDepth = maxDepth($node->left);
    $rDepth = maxDepth($node->right);

    return max($lDepth, $rDepth) + 1;
}

function findHeight($nodes)
{
    $root = buildTree($nodes, 0, count($nodes));

    return maxDepth($root);
}

print_r(findHeight([12, 8, 18, 5, 11, -1, -1]) . PHP_EOL); // 3
print_r(findHeight([1, 2, 3, 4, -1, -1, 5, -1, -1, -1, -1, -1, -1, 6, 7]) . PHP_EOL); // 4
