<?php
/**
 * ImageFieldRenderer
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Block\Adminhtml\Renderer;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Data\Form\Element\Factory as FormElementFactory;
use Magento\Framework\Data\Form\Element\Renderer\RendererInterface as FormElementRenderer;
use Magento\Framework\UrlInterface;

class ImageFieldRenderer extends Template implements FormElementRenderer
{
    /**
     * @var AbstractElement
     */
    private $element;

    /**
     * @var string
     */
    protected $_template = 'Staempfli_WidgetExtraFields::renderer/image-field-renderer.phtml';
    /**
     * @var FormElementFactory
     */
    private $formElementFactory;

    public function __construct(
        FormElementFactory $formElementFactory,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->formElementFactory = $formElementFactory;
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $this->element = $element;
        return $this->toHtml();
    }

    public function getElement(): AbstractElement
    {
        return $this->element;
    }

    public function getUploadButtonOnClickAction(string $elementId): string
    {
        $mediaBrowserAjaxUrl = $this->getUrl(
            'cms/wysiwyg_images/index',
            ['target_element_id' => $elementId, 'type' => 'file']
        );
        return "MediabrowserUtility.openDialog('$mediaBrowserAjaxUrl')";
    }

    public function getImageUrl(): string
    {
        if ($this->element->getData('value')) {
            return $this->element->getValue();
        }
        return "";
    }

    public function getMediaUrl(): string
    {
        return $this->_storeManager->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

}
