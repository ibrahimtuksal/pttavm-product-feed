<?php

namespace Provider;

use Exception;
use SimpleXMLElement;
use Type\Format;

class Google implements ProviderInterface
{
    CONST XML_FILE_NAME = 'google-merchant-feed.xml';
    CONST JSON_FILE_NAME = 'google-merchant-feed.json';

    /**
     * @throws Exception
     */
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
        $channel->addChild('title', 'Google Merchant Feed');
        $channel->addChild('link', 'https://www.example.com');
        $channel->addChild('description', 'Products Google Merchant feed');

        foreach ($products as $product){
            $item = $channel->addChild('item');
            $item->addChild('g:g:id', $product->id);
            $item->addChild('g:g:title', $product->name);
            $item->addChild('g:g:price', number_format(floatval($product->price), 2));
            $item->addChild('g:g:google_product_category', $product->category);
        }

        $xml->saveXML(self::XML_FILE_NAME);
    }

    /**
     * @param array $products
     * @return void
     * @throws Exception
     */
    static function json(array $products): void
    {
        $data = array(
            'title' => 'Google Merchant Feed',
            'link' => 'https://www.example.com',
            'description' => 'Products Google Merchant feed',
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