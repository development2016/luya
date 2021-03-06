<?php

namespace luya\admin\ngrest;

use yii;
use luya\admin\ngrest\render\RenderInterface;

/**
 * NgRest Base Object
 *
 * ```php
 * $config = new ngrest\Config();
 * $ngrest = new NgRest($config);
 * ```
 *
 * find from config
 *
 * ```php
 * $config = new NgRest::findConfig($ngRestConfigHash);
 * $ngrest = new NgRest($config);
 * ```
 *
 * render from ngrest
 *
 * ```php
 * $ngrest->render(new RenderCrud());
 * ```
 *
 * @author Basil Suter <basil@nadar.io>
 */
class NgRest
{
    private $config = null;

    private $render = null;

    public function __construct(ConfigInterface $configObject)
    {
        $configObject->onFinish();
        $this->config = $configObject;
    }

    public function render(RenderInterface $render)
    {
        $this->render = $render;
        $this->render->setConfig($this->config);
        return $this->render->render();
    }
    
    public static function createPluginObject($className, $name, $alias, $i18n, $args = [])
    {
        return Yii::createObject(array_merge([
            'class' => $className,
            'name' => $name,
            'alias' => $alias,
            'i18n' => $i18n,
        ], $args));
    }
}
