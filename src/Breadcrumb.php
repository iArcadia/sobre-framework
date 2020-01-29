<?php

namespace SobreFramework\Core;

/**
 * Class Breadcrumb
 * @package SobreFramework\Core
 */
class Breadcrumb
{
    protected
        /** @var array The list of items of the breadcrumb. */
        $items = [];

    /**
     * Get the items of the breadcrumb.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->items;
    }

    /**
     * Set the items of the breadcrumb.
     *
     * @param array $items
     * @return $this
     */
    public function set(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Add an item to the breadcrumb.
     *
     * @param string $label
     * @param string|null $url
     * @return $this
     */
    public function add(string $label, ?string $url = null): self
    {
        array_push($this->items, [
            'label' => $label,
            'url' => ($url) ? url($url) : null
        ]);

        return $this;
    }

    /**
     * Render the HTML of the breadcrumb.
     *
     * @return void
     */
    public function render(): void
    {
        require_once('public/views/breadcrumb.blade.php');
    }
}
