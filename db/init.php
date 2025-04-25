<?php

$database_file = __DIR__ . '/boygang.db';

// Create a new database, if the file doesn't exist and open it for reading/writing.
$db = new SQLite3($database_file, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

// Errors are emitted as warnings by default, enable proper error handling.
$db->enableExceptions(true);

// Create a table.
$db->query('CREATE TABLE IF NOT EXISTS "products" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" varchar(255) NOT NULL,
    "price" decimal(10,2) NOT NULL,
    "image" varchar(256) NOT NULL,
    "info" varchar(256) NOT NULL,
    "category" varchar(50) NOT NULL,
    "description" text NOT NULL
)');

// Insert data
$db->exec('BEGIN');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "category", "description")
    VALUES (1, "Whey Protein Gold", 799000.00, "whey_gold.jpg", "whey_gold.txt", "protein", "Sữa tăng cơ chất lượng cao")');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "category", "description")
    VALUES (2, "Creatine Monohydrate", 399000.00, "creatine.jpg","creatine.txt", "creatine", "Bổ sung năng lượng cho tập luyện")');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "category", "description")
    VALUES (3, "BCAA Recovery", 599000.00, "bcaa.jpg", "bcaa", "bcaa.txt", "Hỗ trợ phục hồi cơ bắp")');
$db->exec('COMMIT');

$db->close();

