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
    protected $permalink;

    /**
     * @var string
     */
    protected $metaKeywords;

    /**
     * @var string
     */
    protected $metaDescription;

    /**
     * @var string
     */
    protected $metaTitle;
    /**
     * @var ArrayCollection|Block[]
     */
    protected $blocks;

    /**
     * @var Page
     */
    protected $parent;

    /**
     * @var ArrayCollection|Page[]
     */
    protected $children;

    /**
     * @var Page
     */
    protected $root;

    /**
     * @var integer
     */
    protected $level;

    /**
     * @var integer
     */
    protected $left;

    /**
     * @var integer
     */
    protected $right;

    /**
     * @var string
     */
    protected $template;

    /**
     * Page constructor.
     */
    public function __construct()
    {
        $this->blocks = new ArrayCollection();
        $this->children = new ArrayCollection();
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
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * @param string $permalink
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
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
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param string $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
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

    /**
     * @return Page
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Page $parent
     */
    public function setParent(Page $parent = null)
    {
        $this->parent = $parent;
    }

    /**
     * @return Page[]|ArrayCollection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Page[]|ArrayCollection $children
     */
    public function setChildren($children)
    {
        $this->children = $children;
    }
    public function hasChildrens()
    {
        return !$this->blocks->isEmpty();
    }

    public function hasChildren(Page $page)
    {
        return $this->children->contains($page);
    }

    public function addChildren(Page $page)
    {
        if (!$this->hasChildren($page)) {
            $this->children->add($page);
            $page->setParent($this);
        }
    }

    public function removeChildren(Page $page)
    {
        if ($this->hasChildren($page)) {
            $this->children->removeElement($page);
            $page->setParent(null);
        }
    }

    /**
     * @return Page
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param Page $root
     */
    public function setRoot($root)
    {
        $this->root = $root;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * @return int
     */
    public function getLeft()
    {
        return $this->left;
    }

    /**
     * @param int $left
     */
    public function setLeft($left)
    {
        $this->left = $left;
    }

    /**
     * @return int
     */
    public function getRight()
    {
        return $this->right;
    }

    /**
     * @param int $right
     */
    public function setRight($right)
    {
        $this->right = $right;
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param string $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }
}