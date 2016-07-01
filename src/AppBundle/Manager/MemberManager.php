<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Member;
use Doctrine\ORM\EntityManager;
use Psr\Log\LoggerInterface;

class MemberManager
{
    private $em;
    private $version;
    private $logger;

    public function __construct(EntityManager $em, LoggerInterface $logger)
    {
        $this->em = $em;
        $this->logger = $logger;
    }

    /**
     * @param Member[] $list
     */
    public function updateCreationDate(array $list)
    {
        $nbUpdated = 0;
        foreach ($list as $member) {
            if (null === $member->getRegistrationDate()) {
                $member->setRegistrationDate(new \DateTime());
                // $nbUpdated = $nbUpdated + 1;
                ++$nbUpdated;

                $this->logger->notice($member->getUsername().'has been updated.');
            }
        }

        $this->em->flush();

        return $nbUpdated;
    }
}
