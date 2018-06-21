<?php

namespace AppBundle\Controller\API;

use AppBundle\Entity\Invoice;
use AppBundle\Entity\Resource;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
/**
 * Class LicenseController.
 *
 * @Rest\NamePrefix("api_")
 * @Rest\RouteResource("invoice")
 */
class InvoiceController extends FOSRestController
{

    /**
     * Return invoice by id.
     *
     * @Rest\View(serializerGroups={"default"})
     */
    public function getAction(Invoice $invoice)
    {
        return $invoice;
    }
}
