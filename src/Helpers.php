<?php

if (!function_exists('datauri_decode')) {
    function datauri_decode($datauri) {
        return MarcoMdMj\DataURI\DataURIManager::decode($datauri);
    }
}

if (!function_exists('datauri_encode')) {
    function datauri_encode($path, $compose = true) {
        $container = MarcoMdMj\DataURI\DataURIManager::encode($path);
        return $compose ? $container->compose() : $container;
    }
}