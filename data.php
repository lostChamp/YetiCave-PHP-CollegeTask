<?php
require_once('functions.php');

$is_auth = rand(0, 1);

$user_name = 'Konstantin'; // укажите здесь ваше имя

$categories = [
    "Доски и лыжи", "Крепления", "Ботинки", "Одежда", "Инструменты", "Разное"
];

$promo = [
    [
        "Item" => "2014 Rossignol District Snowboard",
        "Category" => "Доски и лыжи",
        "Price" => 10999,
        "Image" =>"img/lot-1.jpg",
        "ExpDate" => "2023-09-11",
    ],
    [
        "Item" => "DC Ply Mens 2016/2017 Snowboard",
        "Category" =>"Доски и лыжи",
        "Price" => 159999,
        "Image" =>"img/lot-2.jpg",
        "ExpDate" => "2023-09-13"
    ],
    [
        "Item" => "Крепления Union Contact Pro 2015 года размер L/XL",
        "Category" =>"Крепления",
        "Price" => 8000,
        "Image" =>"img/lot-3.jpg",
        "ExpDate" => "2023-09-14"
    ],
    [
        "Item" => "Ботинки для сноуборда DC Mutiny Charocal",
        "Category" =>"Ботинки",
        "Price" => 10999,
        "Image" =>"img/lot-4.jpg",
        "ExpDate" => "2023-09-15"
    ],
    [
        "Item" => "Куртка для сноуборда DC Mutiny Charocal",
        "Category" =>"Одежда",
        "Price" => 7500,
        "Image" =>"img/lot-5.jpg",
        "ExpDate" => "2023-09-16"
    ],
    [
        "Item" => "Маска Oakley Canopy",
        "Category" =>"Разное",
        "Price" => 5400,
        "Image" => "img/lot-6.jpg",
        "ExpDate" => "2023-09-17"
    ]
];
