<?php

namespace AppBundle\Repository;

/**
 * LicenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LicenseRepository extends \Doctrine\ORM\EntityRepository
{

    public function getIssuedLicenseCount()
    {
        $qb = $this->createQueryBuilder('entity');

        $result = $qb->select('entity.issued')
            ->getQuery()->getResult();

        if (is_array($result)) {
            $sum = 0;
            foreach ($result as $item){

                $sum += $item['issued'];

            }
        }

        return $sum;
    }


}
