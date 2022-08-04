<?php

namespace MVC\Decorators;

class PageDecorator extends DecoratorFactory
{
    public $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function title()
    {
        return $this->page->title;
    }

    public function body()
    {
        return '<h1>' . $this->title() . '</h1>' . '<p>' . htmlspecialchars($this->page->content) . '</p>';
    }

    public function items()
    {
        return '<item>' .
                    '<title>' . htmlspecialchars($this->title()) . '</title>' .
                    '<content>' . htmlspecialchars($this->page->content) . '</content>' .
                '</item>';
    }
}
