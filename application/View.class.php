<?php

class View
{
    public $filename;
    public $viewData = array();

    /**
     * @param string $controllerName
     * @param string $methodName
     * @param array $viewData
     *
     * @return self
     */
    public static function factory($controllerName, $methodName, $viewData)
    {
        $filename = "{$controllerName}/{$methodName}.tpl.php";

        $view = new self($filename);
        $view->viewData = $viewData;

        return $view;
    }

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->mediaDir = ROOT_URI . '/media';
    }

    public function render()
    {
        $filename = VIEW_DIRECTORY . '/' . $this->filename;

        if (!file_exists($filename)) {
            throw new Exception('View file not found: ' . $this->filename);
        }

        extract($this->viewData);
        include($filename);
    }

    public function url()
    {
        return call_user_func_array(array('Bootstrap', 'url'), func_get_args());
    }

    public function parsedown($text)
    {
        $result = Parsedown::instance()->text($text);
        return $result;
    }

    public function getActiveUser()
    {
        return Bootstrap::singleton()->getActiveUser();
    }

    public function tOr()
    {
        $args = func_get_args();

        $output = array_shift($args);

        while (trim($output) == '' && count($args) > 0) {
            $output = array_shift($args);
        }

        return $output;
    }

    public function secondsToHms($seconds)
    {
        return Bootstrap::singleton()->secondsToHms($seconds);
    }

    public function formatDate($time, $format = 'F j, Y h:i:sA')
    {
        if (!is_numeric($time)) {
            $time = strtotime($time);
        }

        return date($format, $time);
    }

    public function jiraMarkupToHtml($text)
    {
        $text = preg_replace('#{quote}(.*?){quote}#sm', '<blockquote>$1</blockquote>', $text);

        $text = nl2br($text);

        return $text;
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
        exit();
    }
}