<?php
namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page;
use Grav\Common\Data\Blueprints;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class PrivateSitePlugin
 * @package Grav\Plugin
 */
class PrivateSitePlugin extends Plugin
{

    /**
     * @var
     */
    protected $_privateConfig;


    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents()
    {
        // Check for required plugins
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {

        if (!$this->grav['config']->get('plugins.login.enabled') || !$this->grav['config']->get('plugins.form.enabled') || !$this->grav['config']->get('plugins.email.enabled')) {
            throw new \RuntimeException('One of the required plugins is missing or not enabled');
        }
        
        if ($this->isAdmin()) {
            // Enable the main event we are interested in
            $this->enable([
                'onBlueprintCreated' => ['onBlueprintCreated', 0],
                'onGetPageTemplates' => ['onGetPageTemplates', 0]
            ]);
        } else {
            // Enable the main event we are interested in
            $this->_privateConfig = $this->grav['config']->get('plugins.private-site', null);
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 1000]
            ]);
            
        }

    }

    /**
     * Check if site/page is private
     */
    public function onPageInitialized()
    {
        if( isset($this->grav['page']->header()->access) && isset($this->grav['page']->header()->access['site.login'] )){
            return;
        }

        switch ($this->_privateConfig['private_site']) {
            case true:
            default:
                if ( isset($this->grav['page']->header()->access) && isset($this->grav['page']->header()->access['site.login']) ) {
                    if ($this->grav['page']->header()->access['site.login'] != true) {
                        $this->grav['page']->modifyHeader('access', array('site.login' => true));
                    }
                } else {
                    $this->grav['page']->modifyHeader('access', array('site.login' => true));
                }
                break;
            
            case false:
                if ( isset($this->grav['page']->header()->private) && $this->grav['page']->header()->private == true ){
                    $this->grav['page']->modifyHeader('access', array('site.login' => true));
                }
                break;
        }

    }

    /**
     * Extend Admin Page Blueprints
     */
    public function onBlueprintCreated(Event $event)
    {
        static $inEvent = false;
        /** @var Data\Blueprint $blueprint */
        if (0 === strpos($newtype, 'modular/')) {
        } else {
        $blueprint = $event['blueprint'];
        if (!$inEvent && $blueprint->get('form/fields/tabs', null, '/')) {
            $inEvent = true;
            $blueprints = new Blueprints(__DIR__ . '/blueprints/');
            $extends = $blueprints->get('private');
            $blueprint->extend($extends, false);
            $inEvent = false;
         }
        }
    }

    /**
     * Add page template types.
     */
    public function onGetPageTemplates(Event $event){
        /** @var Types $types */
        $types = $event->types;
        $types->register('private');
    }

}
