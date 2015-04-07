<?php
/**
 * OpenGraphPluginBase widget class file.
 *
 * @author Evan Johnson <thaddeusmt - AT - gmail - DOT - com>
 * @author Ianaré Sévi (original author) www.digitick.net
 * @link https://github.com/splashlab/yii-facebook-opengraph
 * @copyright &copy; Digitick <www.digitick.net> 2011
 * @copyright Copyright &copy; 2012 SplashLab Social  http://splashlabsocial.com
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License v3.0
 *
 */
namespace YiiFacebook\Plugins;

use Yii;

/**
 * Base class for all facebook widgets.
 *
 * Initializes required properties for widgets and sets Open Graph  properties.
 *
 * @see http://developers.facebook.com/plugins
 * @see http://developers.facebook.com/docs/opengraph
 *
 */
abstract class OpenGraphPluginBase extends \CWidget
{
    /**
     * @var string Name of plugin to render
     */
    protected $tagName;

    /**
     * Unset this from \CWidget property to fix and error where it was passing
     * data-skin="default" to the Social plugins
     * @var null
     */
    public $skin = null;

    /**
     * @return void Make sure that the JS SDK is enabled
     * @throws \CException if JavaScript SDK is disabled
     */
    public function init()
    {
        parent::init();
        if (!Yii::app()->facebook->jsSdk) {
            throw new \CException('Facebook JS SDK not enabled.');
        }
        if (!Yii::app()->facebook->xfbml) {
            throw new \CException('Facebook XFBML parsing is not enabled.');
        }
    }


    /**
     * @param string $name the name of the Facebook Social Plugin
     * @param array $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function renderTag($name, $params)
    {
        if (Yii::app()->facebook->html5) {
            $this->makeHtml5Tag('fb-' . $name, $params);
        } else {
            $this->makeXfbmlTag('fb:' . $name, $params);
        }
    }

    /**
     * @param string $class the name of the Facebook Social Plugin
     * @param array $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function makeHtml5Tag($class, $params)
    {
        $content = '';
        if (isset($params['text'])) {
            $content = $params['text'];
            unset($params['text']);
        }
        $newParams = array();
        $newParams['class'] = $class;
        foreach ($params as $key => $data) {
            $newParams["data-" . str_replace('_', '-', $key)] = $data;
        }
        echo \CHtml::openTag('div', $newParams) . $content . \CHtml::closeTag('div');
    }

    /**
     * @param string $tagName the name of the Facebook Social Plugin
     * @param array $params the parameters for the Facebook Social Plugin
     * @return void
     */
    protected function makeXfbmlTag($tagName, $params)
    {
        $content = '';
        if (isset($params['text'])) {
            $content = $params['text'];
            unset($params['text']);
        }
        echo \CHtml::openTag($tagName, $params), $content, \CHtml::closeTag($tagName);
    }

    /**
     * Grabs public properties of the class for passing to the plugin creator.
     * @return array Associative array
     */
    protected function getParams()
    {
        $ref = new \ReflectionObject($this);
        $props = $ref->getProperties(\ReflectionProperty::IS_PUBLIC);

        $params = array();
        foreach ($props as $k => $v) {
            $name = $v->name;
            if ($this->$name !== null && !is_array($this->$name)) {
                if (is_bool($this->$name)) {
                    $value = ($this->$name === true) ? 'true' : 'false';
                } else {
                    $value = $this->$name;
                }
                $params[$name] = $value;
            }
        }
        return $params;
    }

    /**
     * Render the widget
     * Uses the subclass $tagName property to render tag
     */
    public function run()
    {
        parent::run();
        $params = $this->getParams();
        $this->renderTag($this->tagName, $params);
    }

}
