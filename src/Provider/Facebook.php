<?php

namespace Provider;

use SimpleXMLElement;
use Type\Format;

class Facebook implements ProviderInterface
{
    CONST XML_FILE_NAME = 'facebook-feed.xml';
    CONST JSON_FILE_NAME = 'facebook-feed.json';

    public static function create(string $format, array $products): void
    {
        switch ($format){
            case Format::XML:
                self::xml($products);
                break;
            case Format::JSON:
                self::json($products);
                break;
        }
    }

    /**
     * @param array $products
     * @return void
     */
    static function xml(array $products): void
    {
        $xml = new SimpleXMLElement('<?xml version="1.0"?><rss version="2.0" xmlns:g="http://base.google.com/ns/1.0"></rss>');

        $channel = $xml->addChild('channel');
        $channel->addChild('title', 'Facebook Feed');
        $channel->addChild('link', 'https://www.example.com');
        $channel->addChild('description', 'Products Facebook feed');

        foreach ($products as $product){
            $item = $channel->addChild('item');
            $item->addChild('g:g:id', $product->id);
            $item->addChild('g:g:title', $product->name);
            $item->addChild('g:g:price', number_format(floatval($product->price), 2));
            $item->addChild('g:g:google_product_category', $product->category);
        }

        $xml->saveXML(self::XML_FILE_NAME);
    }

    static function json(array $products): void
    {
        $data = array(
            'title' => 'Facebook Feed',
            'link' => 'https://www.example.com',
            'description' => 'Products Facebook feed',
            'items' => []
        );

        foreach ($products as $product){
            $item = [
                'g:id' => $product->id,
                'g:title' => $product->name,
                'g:price' => number_format(floatval($product->price), 2),
                'g:google_product_category' => $product->category
            ];
            $data['items'][] = $item;
        }
        $json = json_encode($data);

        file_put_contents(self::JSON_FILE_NAME, $json);
    }
}