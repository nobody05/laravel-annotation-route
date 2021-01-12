<?php


namespace PhpOne\LaravelAnnotation\RouteStruce;


class File
{
    protected string $startTag = "<?php";
    protected string $enterKey = "\r\n";
    protected string $namespaceTag = "use Illuminate\Support\Facades\Route;";
    protected string $content = "";

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return self
     */
    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function appendContent(string $content): self
    {
        $this->content .= $this->enterKey. $content;
        return $this;
    }

    public function toString(): string
    {
        $s = $this->startTag;
        $s .= str_repeat($this->enterKey, 2);
        $s .= $this->namespaceTag;
        $s .= $this->content;

        return $s;
    }

}