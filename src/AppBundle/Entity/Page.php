<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;

class Page implements ResourceInterface
{
    use TimestampableTrait;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescriptions;

    /**
     * @var string
     */
    protected $metaTitle;
    /**
     * @var ArrayCollection|Block[]
     */
    protected $blocks;

    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return string
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * @param string $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return string
     */
    public function getMetaDescriptions()
    {
        return $this->metaDescriptions;
    }

    /**
     * @param string $metaDescriptions
     */
    public function setMetaDescriptions($metaDescriptions)
    {
        $this->metaDescriptions = $metaDescriptions;
    }

    /**
     * @return string
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param string $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return Block[]|ArrayCollection
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param Block[]|ArrayCollection $blocks
     */
    public function setBlocks(ArrayCollection $blocks)
    {
        $this->blocks = $blocks;
    }

    public function hasBlocks()
    {
        return !$this->blocks->isEmpty();
    }

    public function hasBlock(Block $block)
    {
        return $this->blocks->contains($block);
    }

    public function addBlock(Block $block)
    {
        if (!$this->hasBlock($block)) {
            $this->blocks->add($block);
            $block->setPage($this);
        }
    }

    public function removeBlock(Block $block)
    {
        if ($this->hasBlock($block)) {
            $this->blocks->removeElement($block);
            $block->setPage(null);
        }
    }
}