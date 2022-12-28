<?php

namespace Provider;

interface ProviderInterface
{
    static function create(string $format, array $products): void;

    static function xml(array $products): void;

    static function json(array $products): void;
}