<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Member;

class MemberFactory()
{
    public function createMemberForRegistration()
    {
        $member = new Member();
        $member->setRegistrationDate(new \DateTime());
        $salt = md5(random_bytes(20));
        $member->setSalt($salt);

        return $member;
    }
}