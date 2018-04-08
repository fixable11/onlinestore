<?php

/**
 * Функция загрузки шаблона требуемой страницы
 *
 * 
 * @param  string $templateName Имя шаблона
 * @param  array  $vars Массив переменных, которые требуется передать в шаблон
 * @return buffer Содержимое шаблона
 */
function loadTemplate($templateName, $vars = []){
    extract($vars);
    ob_start();
    include "views/default/$templateName.php";
    return ob_get_clean();
}

/**
 *
 * Функция загрузки шаблона требуемой админ страницы
 *
 * @param  string $templateName Имя шаблона
 * @param  array  $vars Массив переменных, которые требуется передать в шаблон
 * @return buffer Содержимое шаблона
 */
function loadAdminTemplate($templateName, $vars = []){
    extract($vars);
    ob_start();
    include "views/admin/$templateName.php";
    return ob_get_clean();
}

/**
 * Функция для дебага
 *
 * @param null $value
 * @param int $die
 */
function d($value = null , $die = 0){
    echo 'Debug log <br> <pre>';
    print_r($value);
    echo ' </pre>';
    if($die) die;
}

/**
 * Функция перенаправление пользователя на заданный URI
 * 
 * @param string $url адрес перенаправления
 */
function redirect($url = '/'){
    header("Location: $url");
    exit();
}