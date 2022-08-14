<?php

const ACCESS_READ = 1;

const ACCESS_CREATE = 2;

const ACCESS_UPDATE = 4;

const ACCESS_DELETE = 8;

// User as default can read, create and update something
$access = ACCESS_READ | ACCESS_CREATE | ACCESS_UPDATE;



if ($access & ACCESS_DELETE) {
    echo "YES";
}

// // Deny access rights to create something
// $user->access ^= User::ACCESS_CREATE;

echo render(1, 2, 3);