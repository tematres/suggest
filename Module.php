<?php
namespace suggest;

use Composer\Semver\Comparator;
use Omeka\Module\AbstractModule;
use Laminas\EventManager\Event;
use Laminas\EventManager\SharedEventManagerInterface;
use Laminas\Mvc\Controller\AbstractController;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Renderer\PhpRenderer;

class Module extends AbstractModule
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getConfigForm(PhpRenderer $renderer)
    {
        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $apiUrl = $settings->get(
            Service\TemaTresDataTypeFactory::SETTING_API_URL,
            Service\TemaTresDataTypeFactory::DEFAULT_API_URL
        );

        return sprintf(
            '<div class="field">
                <div class="field-meta"><label for="valuesuggest_tematres_api_url">%s</label></div>
                <div class="inputs">
                    <input type="url" name="valuesuggest_tematres_api_url" id="valuesuggest_tematres_api_url" value="%s" required>
                    <p class="explanation">%s</p>
                </div>
            </div>',
            $renderer->translate('TemaTres services.php URL'), // @translate
            $renderer->escapeHtmlAttr($apiUrl),
            $renderer->translate('Enter the full URL to the TemaTres services.php endpoint.') // @translate
        );
    }

    public function handleConfigForm(AbstractController $controller)
    {
        $apiUrl = $controller->params()->fromPost('valuesuggest_tematres_api_url');
        if (!is_string($apiUrl)) {
            $controller->messenger()->addError('Enter a valid TemaTres services.php URL.'); // @translate
            return false;
        }
        $apiUrl = trim($apiUrl);
        $parts = parse_url($apiUrl);
        if (!filter_var($apiUrl, FILTER_VALIDATE_URL)
            || !is_array($parts)
            || !isset($parts['scheme'], $parts['host'], $parts['path'])
            || !in_array(strtolower($parts['scheme']), ['http', 'https'], true)
            || 'services.php' !== basename($parts['path'])
            || isset($parts['user'])
            || isset($parts['pass'])
            || isset($parts['fragment'])
            || isset($parts['query'])
        ) {
            $controller->messenger()->addError('Enter a valid TemaTres services.php URL.'); // @translate
            return false;
        }

        $settings = $this->getServiceLocator()->get('Omeka\Settings');
        $settings->set(Service\TemaTresDataTypeFactory::SETTING_API_URL, $apiUrl);
        return true;
    }

    public function onBootstrap(MvcEvent $event)
    {
        parent::onBootstrap($event);
        $acl = $this->getServiceLocator()->get('Omeka\Acl');
        $acl->allow(null, 'suggest\Controller\Index', 'proxy');
    }

    public function upgrade($oldVersion, $newVersion, ServiceLocatorInterface $services)
    {
        $conn = $services->get('Omeka\Connection');
        if (Comparator::lessThan($oldVersion, '1.16.1')) {
            // OCLC VIAF URIs were invalid. Fix them here.
            $conn->exec("UPDATE value SET uri = REPLACE(uri, 'www.viaf.org', 'viaf.org') WHERE type = 'valuesuggest:oclc:viaf';");
        }
    }

    public function attachListeners(SharedEventManagerInterface $sharedEventManager)
    {
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Item',
            'view.edit.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\ItemSet',
            'view.edit.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Media',
            'view.add.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            'Omeka\Controller\Admin\Media',
            'view.edit.after',
            [$this, 'prepareResourceForm']
        );
        $sharedEventManager->attach(
            '*',
            'data_types.value_annotating',
            [$this, 'addDataTypesToValueAnnotatingConfig']
        );
    }

    /**
     * Prepare resource forms for value suggest.
     *
     * @see https://github.com/devbridge/jQuery-Autocomplete
     * @param Event $event
     */
    public function prepareResourceForm(Event $event)
    {
        $view = $event->getTarget();
        $assetUrl = $view->plugin('assetUrl');
        $view->headLink()
            ->appendStylesheet($assetUrl('css/valuesuggest.css', 'suggest'));
        $view->headScript()
            ->appendFile($assetUrl('js/jQuery-Autocomplete/1.2.26/jquery.autocomplete.min.js', 'suggest'))
            ->appendFile($assetUrl('js/valuesuggest.js', 'suggest'))
            ->appendScript(sprintf(
                'var valueSuggestProxyUrl = "%s";',
                $view->escapeJs($view->url('admin/value-suggest/proxy'))
            ));
    }

    /**
     * Add Value Suggest data types as value annotating.
     *
     * @param Event $event
     */
    public function addDataTypesToValueAnnotatingConfig(Event $event)
    {
        $valueAnnotating = $event->getParam('data_types');
        $dataTypes = $this->getServiceLocator()->get('Omeka\DataTypeManager')->getRegisteredNames();
        foreach ($dataTypes as $dataType) {
            if (0 === strpos($dataType, 'valuesuggest:') || 0 === strpos($dataType, 'valuesuggestall:')) {
                $valueAnnotating[] = $dataType;
            }
        }
        $event->setParam('data_types', $valueAnnotating);
    }
}
