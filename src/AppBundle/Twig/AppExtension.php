<?php


namespace AppBundle\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {


        return array(
            $apiUrl = '/api/businessesCount.json';
        $curl = new Curl();
        $curl->get($instance->getDomain() . $apiUrl);

        $result = $curl->response;
        $result->businessesCount;
            new TwigFilter('businessesCount', array($this, 'getUsageLicenseCount')),
        );
    }





}