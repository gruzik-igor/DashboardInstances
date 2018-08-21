<?php

namespace AppBundle\Repository;

/**
 * InvoiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InvoiceRepository extends \Doctrine\ORM\EntityRepository
{

    public function getPriceInvoiceCount()
    {
        $qb = $this->createQueryBuilder('entity');

        $result = $qb->select('entity.price')
            ->getQuery()->getResult();

        if (is_array($result)) {
            $sum = 0;
            foreach ($result as $item){

                $sum += $item['price'];

            }
        }

        return $sum;
    }
    public function getInvoices()
    {
        $qb = $this->createQueryBuilder('entity');


        return $result;
    }

}
