<?php 

namespace AppBundle\Security\Voter;

use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use AppBundle\Entity\News;
use AppBundle\Entity\Member;


class NewsVoter extends Voter
{
    const NEWS_VIEW = 'news.action.view';
    const NEWS_UPDATE = 'news.action.update';
    const NEWS_DELETE = 'news.action.delete';



    protected function supports($attribute, $subject)
    {
        return $subject instanceof News && in_array($attribute,[
            self::NEWS_VIEW,
            self::NEWS_UPDATE,
            self::NEWS_DELETE,
            ]);
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $news = $subject;

        $user = $token->getUser();

        switch($attribute)
        {
            case self::NEWS_VIEW:
                return true;
            case self::NEWS_UPDATE:
            case self::NEWS_DELETE:
                if(!$user instanceof Member)
                {
                    return false;
                }
                if($news->getAuthor() === $user)
                {
                    return true;
                }
                return false;
        }
    }
}