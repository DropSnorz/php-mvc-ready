<?php declare(strict_types = 1);

require_once "Renderer.php";

class TwigRenderer implements Renderer
{
    private $renderer;

    public function __construct(Twig_Environment $renderer)
    {
        $this->renderer = $renderer;
    }

    public function render($template, $data = []) : string
    {
        return $this->renderer->render($template.".html", $data);
    }
}