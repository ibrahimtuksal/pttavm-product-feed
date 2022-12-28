<?php

namespace Service;

use Exception;
use Provider\Google;
use Provider\Facebook;
use Type\Format;
use Type\Provider;

class FeedService
{
    /**
     * @param string $format
     * @param string $provider
     * @param array $products
     * @throws Exception
     */
    public function create(string $format, string $provider, array $products)
    {
        switch ($format){
            case Format::XML:
                $this->xml($provider, $products);
                break;
            case Format::JSON:
                $this->json($provider, $products);
                break;
            default:
                throw new Exception('FORMAT_NOT_FOUND');
        }
    }

    /**
     * @param string $provider
     * @param array $products
     * @throws Exception
     */
    private function xml(string $provider, array $products)
    {
        switch ($provider){
            case Provider::GOOGLE:
                Google::create(Format::XML, $products);
                break;
            case Provider::FACEBOOK:
                Facebook::create(Format::XML, $products);
                break;
            default:
                throw new Exception('PROVIDER_NOT_FOUND');
        }
    }

    /**
     * @param string $provider
     * @param array $products
     * @throws Exception
     */
    private function json(string $provider, array $products)
    {
        switch ($provider){
            case Provider::GOOGLE:
                Google::create(Format::JSON, $products);
                break;
            case Provider::FACEBOOK:
                Facebook::create(Format::JSON, $products);
                break;
            default:
                throw new Exception('PROVIDER_NOT_FOUND');
        }
    }
}