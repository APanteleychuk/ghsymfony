<?php

namespace Palex\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="Palex\BlogBundle\Repository\PostRepository")
 * @UniqueEntity(fields={"title"})
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Palex\BlogBundle\Entity\Category", inversedBy="posts")
     * @Assert\NotBlank()
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var string
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/jpg", "image/gif", "image/png"},
     *     mimeTypesMessage="Please upload jpg/gif formats"
     * )
     * @ORM\Column(type="string", length=50, nullable=true )
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Palex\BlogBundle\Entity\Comment", mappedBy="post")
     * @Assert\Valid()
     */
    private $comments;

    /**
     * @var Tag[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Palex\BlogBundle\Entity\Tag", inversedBy="posts")
     * @Assert\Valid()
     */
    private $tags;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $author;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     * @Gedmo\Timestampable()
     */
    private $dataCreated;

    public function __construct()
    {
        $this->setdataCreated(new \DateTime());
        $this->comments = new ArrayCollection();
        $this->tags = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param ArrayCollection|Comment[]$comments
     *
     * @return $this
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        foreach ($comments as $comment) {
            $comment->setPost($this);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     *
     * @param Comment $comment
     *
     * @return $this
     */
    public function addComment(Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * @param Comment $comment
     */
    public function removeComment(Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * @param ArrayCollection|Tag[] $tags
     *
     * @return $this
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * @return ArrayCollection|Tag[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Tag $tag
     *
     * @return $this
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * @param Category|null $category
     *
     * @return $this
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $author
     *
     * @return $this
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param \DateTime $dataCreated
     *
     * @return $this
     */
    public function setDataCreated($dataCreated)
    {
        $this->dataCreated = $dataCreated;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDataCreated()
    {
        return $this->dataCreated;
    }
}
