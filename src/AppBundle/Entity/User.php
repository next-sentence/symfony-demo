<?php

namespace AppBundle\Entity;

use SbS\AdminLTEBundle\Model\UserInterface;
use Sylius\Component\User\Model\User as BaseUser;

class User extends BaseUser implements UserInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
    * @var \SplFileInfo
    */
    protected $file;

    /**
     * @var string
     */
    protected $avatar;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $info;

    /**
     * @var \DateTime
     */
    protected $memberSince;

    /**
     * @return bool
     */
    public function hasAvatar()
    {
        return null !== $this->avatar;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __construct()
    {
        parent::__construct();

        $this->memberSince = new \DateTime();
    }

    /**
     * @return bool
     */
    public function hasFile()
    {
        return null !== $this->file;
    }

    /**
     * @return \SplFileInfo
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param \SplFileInfo $file
     */
    public function setFile(\SplFileInfo $file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param string $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }

    /**
     * @return \DateTime
     */
    public function getMemberSince()
    {
        return $this->memberSince;
    }

    /**
     * @param \DateTime $memberSince
     */
    public function setMemberSince($memberSince)
    {
        $this->memberSince = $memberSince;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

}