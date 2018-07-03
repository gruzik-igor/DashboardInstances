<?php


namespace AppBundle\Twig;


use AppBundle\Entity\Instance;
use Curl\Curl;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {


        return array(

            new TwigFilter('getUsageLicenseCount', array($this, 'getUsageLicenseCount')),
        );
    }

    public function getUsageLicenseCount(Instance $instance)
        {
            $apiUrl = '/api/businessesCount.json';
            $curl = new Curl();
            $curl->get($instance->getDomain() . $apiUrl);

            $result = $curl->response;

            return $result->getUsageLicenseCount;
        }



}