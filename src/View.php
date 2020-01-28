<?php

namespace SobreFramework\Core;

/**
 * Class View
 * @package SobreFramework\Core
 */
class View
{
    protected
        /** @var string The name of the view. */
        $name,
        /** @var array The data of the view. */
        $data = [];

    /**
     * View constructor.
     *
     * @constructor
     * @param string $name
     * @param array $data
     */
    public function __construct(string $name, array $data = [])
    {
        $this->setName($name);
        $this->setData($data);
    }

    /**
     * Generate the view HTML.
     *
     * @return $this
     */
    public function render(): self
    {
        $GLOBALS['VIEW_DATA'] = $this->getData();

        require('public/views/view_initializer.php');
        require(static::find($this->getName()));

        return $this;
    }

    /**
     * Get the name of the view.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the name of the view.
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the data of the view.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * Set the data of the view.
     *
     * @param array $data
     * @return $this
     */
    public function setData(array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Find a view file.
     *
     * @static
     * @param string $view
     * @return string
     */
    public static function find(string $view): string
    {
        return '_app_old/' . $view . '.vue.php';
    }

    /**
     * Create a new View instance.
     *
     * @static
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function make(string $view, array $data = []): View
    {
        return new static($view, $data);
    }
}
