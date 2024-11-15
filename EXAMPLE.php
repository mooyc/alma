<?php

# подключим класс АПИ
require_once '/alma.class.php';

# определим параметры
const TOKEN = "3v5...43v";
const INN   = "123...789"; 

# создаем экземпляр класса
$api = new Alma\Api(TOKEN, INN);

# Проверка доступности API
# /status
$api->getStatus();


# Получить информацию о товаре по УТ
# /element
$element = 20888;
$api->getElement( $element );


# Получить информацию о всех товарах
# /elements
$api->getElements();


# Получить информацию о всех ценах
# /prices
$api->getPrices();


# Получить информацию о всех props
# /properties
$api->getProperties();


# Получить информацию о всех остатках
# /quantity
$api->getQuantity();


# Получить информацию о всех категориях
# /category
$api->getCategory();