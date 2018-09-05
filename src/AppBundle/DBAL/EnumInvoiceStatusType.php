<?php

namespace AppBundle\DBAL;

class EnumInvoiceStatusType extends EnumType
{
    protected $name = 'enum_invoice_status_type';

    protected $values = array('pending','paied','active');
}