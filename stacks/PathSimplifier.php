<?php

// You are given an absolute path for a Unix-style file system, which always begins with a slash '/'. Your task is to transform this absolute path into its simplified canonical path.

// The rules of a Unix-style file system are as follows:
// A single period '.' represents the current directory.
// A double period '..' represents the previous/parent directory.
// Multiple consecutive slashes such as '//' and '///' are treated as a single slash '/'.
// Any sequence of periods that does not match the rules above should be treated as a valid directory or file name. For example, '...' and '....' are valid directory or file names.
// The simplified canonical path should follow these rules:

// The path must start with a single slash '/'.
// Directories within the path must be separated by exactly one slash '/'.
// The path must not end with a slash '/', unless it is the root directory.
// The path must not have any single or double periods ('.' and '..') used to denote current or parent directories.
// Return the simplified canonical path.

require 'Stack.php';

function simplifyPath($fullPath)
{
    $fullPath = preg_replace('/\/+/', '/', $fullPath);

    $paths = explode('/', $fullPath);

    $stack = new Stack;
    foreach ($paths as $path) {
        if (! empty($path)) {
            $stack->push($path);
        }
    }

    $simplifiedPath = '';
    $skipNextPath = false;
    while (! $stack->isEmpty()) {
        $path = $stack->pop();

        if ($path == '..') {
            $skipNextPath = true;
        } else {
            if ($path != '.' && ! $skipNextPath) {
                $simplifiedPath = '/' . $path . $simplifiedPath;
            }

            $skipNextPath = false;
        }
    }

    $simplifiedPath = empty($simplifiedPath) ? '/' : $simplifiedPath;

    return $simplifiedPath;
}

print_r(simplifyPath('/home/') . PHP_EOL); // /home
print_r(simplifyPath('/home//foo/') . PHP_EOL); // /home/foo/
print_r(simplifyPath('/home/user/Documents/../Pictures') . PHP_EOL); // /home/user/Pictures
print_r(simplifyPath('/../') . PHP_EOL); // /
print_r(simplifyPath('/.../a/../b/c/../d/./') . PHP_EOL); // /.../b/d