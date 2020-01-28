<?php

namespace SobreFramework\Core;

/**
 * Class Controller
 * @package SobreFramework\Core
 */
class Controller
{
    protected
        /** @var string The title page which is going to be displayed. */
        $title,
        /** @var Breadcrumb The breadcrumb linked to the controller. */
        $breadcrumb;

    protected static
        /** @var Controller The current used controller. */
        $current;

    /**
     * Controller constructor.
     *
     * @constructor
     */
    public function __construct()
    {
        $this->setBreadcrumb(new Breadcrumb);
        $this->getBreadcrumb()->add('Accueil', '/');

        self::setCurrent($this);
    }

    /**
     * Execute the controller process.
     *
     * @return mixed
     * @throws \Exception when the controller try to execute a process who's missing.
     */
    public function exec()
    {
        if (Server::isGetMethod()) {
            return $this->get();
        }

        if (Server::isPostMethod()) {
            return $this->post();
        }
    }

    /**
     * Execute the controller process when accessed with a GET HTTP request.
     *
     * @return mixed
     * @throws \Exception if the GET method process is missing.
     */
    public function get()
    {
        throw new \Exception('The GET method process is missing', 500);
    }

    /**
     * Execute the controller process when accessed with a POST HTTP request.
     *
     * @return mixed
     * @throws \Exception if the POST method process is missing.
     */
    public function post()
    {
        throw new \Exception('The POST method process is missing', 500);
    }

    /**
     * Get the title page which is going to be displayed.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title page which is going to be displayed.
     *
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the breadcrumb linked to the controller.
     *
     * @return Breadcrumb|null
     */
    public function getBreadcrumb(): ?Breadcrumb
    {
        return $this->breadcrumb;
    }

    /**
     * Set the breadcrumb linked to the controller.
     *
     * @param Breadcrumb|null $breadcrumb
     * @return $this
     */
    public function setBreadcrumb(?Breadcrumb $breadcrumb = null): self
    {
        $this->breadcrumb = $breadcrumb;

        return $this;
    }

    /**
     * Redirect to another URI.
     *
     * @static
     * @param string $uri
     * @return void
     */
    public static function redirect(string $uri): void
    {
        header('Location: ' . url($uri));
        exit();
    }

    /**
     * Get the current used controller.
     *
     * @static
     * @return Controller
     */
    public static function getCurrent(): Controller
    {
        return self::$current;
    }

    /**
     * Set the current used controller.
     *
     * @static
     * @param Controller $current
     * @return void
     */
    public static function setCurrent(Controller $current): void
    {
        self::$current = $current;
    }
}
