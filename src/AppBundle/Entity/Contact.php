<?php

namespace AppBundle\Entity;

class Contact
{
    private $subject;

    private $sentFrom;

    private $sendTo;

    private $content;

    private $sentDate;

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }


    public function getSentFrom()
    {
        return $this->sentFrom;
    }

    public function setSentFrom($from)
    {
        $this->sentFrom = $from;
        return $this;
    }

    public function getSendTo()
    {
        return $this->sendTo;
    }

    public function setSendTo($dest)
    {
        $this->sendTo = $dest;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getSentDate()
    {
        return $this->sentDate;
    }

    public function setSentDate($sDte)
    {
        $this->sentDate = $sDate;
        return $this;
    }
}