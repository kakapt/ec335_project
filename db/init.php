<?php

$database_file = __DIR__ . '/boygang.db';

// Create a new database, if the file doesn't exist and open it for reading/writing.
$db = new SQLite3($database_file, SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE);

// Errors are emitted as warnings by default, enable proper error handling.
$db->enableExceptions(true);

// Create tables.
$db->query('CREATE TABLE IF NOT EXISTS "users" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "username" varchar(255) UNIQUE NOT NULL,
    "password" varchar(255) NOT NULL,
    "email" varchar(255) UNIQUE NOT NULL,
    "created_at" DATETIME DEFAULT CURRENT_TIMESTAMP
)');

$db->query('CREATE TABLE IF NOT EXISTS "categories" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" varchar(50) UNIQUE NOT NULL
)');

$db->query('CREATE TABLE IF NOT EXISTS "products" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" varchar(255) NOT NULL,
    "price" decimal(10,2) NOT NULL,
    "image" varchar(256) NOT NULL,
    "info" varchar(256) NOT NULL,
    "description" text NOT NULL,
    "category_id" INTEGER,
    FOREIGN KEY ("category_id") REFERENCES "categories"("id") ON DELETE SET NULL
)');

$db->query('CREATE TABLE IF NOT EXISTS "orders" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "user_id" INTEGER NOT NULL,
    "order_date" DATETIME DEFAULT CURRENT_TIMESTAMP,
    "total_amount" decimal(10,2) NOT NULL,
    "status" varchar(50),
    FOREIGN KEY ("user_id") REFERENCES "users"("id") ON DELETE CASCADE
)');

$db->query('CREATE TABLE IF NOT EXISTS "order_items" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "order_id" INTEGER NOT NULL,
    "product_id" INTEGER NOT NULL,
    "quantity" INTEGER NOT NULL CHECK (quantity > 0),
    "price_at_purchase" decimal(10,2) NOT NULL,
    FOREIGN KEY ("order_id") REFERENCES "orders"("id") ON DELETE CASCADE,
    FOREIGN KEY ("product_id") REFERENCES "products"("id") ON DELETE CASCADE
);');

// Insert data
$db->exec('BEGIN');
$db->query('INSERT INTO "categories" ("id", "name")
    VALUES (1, "protein")');
$db->query('INSERT INTO "categories" ("id", "name")
    VALUES (2, "creatine")');
$db->query('INSERT INTO "categories" ("id", "name")
    VALUES (3, "bcaa")');
$db->exec('COMMIT');

$db->exec('BEGIN');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "description", "category_id")
    VALUES (1, "Whey Protein Gold", 799000.00, "whey_gold.jpg", "whey_gold.txt", "Sữa tăng cơ chất lượng cao", 1)');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "description", "category_id")
    VALUES (2, "Creatine Monohydrate", 399000.00, "creatine.jpg","creatine.txt", "Bổ sung năng lượng cho tập luyện", 2)');
$db->query('INSERT INTO "products" ("id", "name", "price", "image", "info", "description",  "category_id")
    VALUES (3, "BCAA Recovery", 599000.00, "bcaa.jpg", "bcaa.txt", "Hỗ trợ phục hồi cơ bắp", 3)');
$db->exec('COMMIT');

$db->exec('BEGIN');
$db->query('INSERT INTO "users" ("id", "username", "password", "email")
    VALUES (1, "kakapt", "123456", "phuocthinhvu@gmail.com")');
$db->query('INSERT INTO "users" ("id", "username", "password", "email")
    VALUES (2, "dgt", "123456", "dgt@gmail.com")');
$db->query('INSERT INTO "users" ("id", "username", "password", "email")
    VALUES (3, "nct", "123456", "nct@gmail.com")');
$db->query('INSERT INTO "users" ("id", "username", "password", "email")
    VALUES (4, "nguyen", "123456", "nguyen@gmail.com")');
$db->exec('COMMIT');

$db->exec('BEGIN');
$db->query('INSERT INTO "orders" ("id", "user_id", "total_amount", "status")
    VALUES (1, 1, 2999.00, "COMPLETED")');
$db->query('INSERT INTO "orders" ("id", "user_id", "total_amount", "status")
    VALUES (2, 2, 3999.00, "COMPLETED")');
$db->query('INSERT INTO "orders" ("id", "user_id", "total_amount", "status")
    VALUES (3, 3, 4999.00, "COMPLETED")');
$db->query('INSERT INTO "orders" ("id", "user_id", "total_amount", "status")
    VALUES (4, 4, 5999.00, "COMPLETED")');
$db->exec('COMMIT');

$db->close();
