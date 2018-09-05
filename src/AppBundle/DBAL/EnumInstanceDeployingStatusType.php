<?php

namespace AppBundle\DBAL;

class EnumInstanceDeployingStatusType extends EnumType
{
    protected $name = 'enum_instance_deploying_status_type';

    protected $values = array('deployed', 'pending', 'deploying');
}