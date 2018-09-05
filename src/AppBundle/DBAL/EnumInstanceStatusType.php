<?php

namespace AppBundle\DBAL;

class EnumInstanceStatusType extends EnumType
{
    protected $name = 'enum_instance_status_type';

    protected $values = array('active','suspended');
}