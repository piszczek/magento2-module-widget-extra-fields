<?php
/**
 * ImageField
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Staempfli\WidgetExtraFields\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Staempfli\WidgetExtraFields\Block\Adminhtml\Renderer\ImageFieldRenderer;

class ImageField extends Template
{

    public function prepareElementHtml(AbstractElement $element)
    {
        $fieldRenderer = $this->getLayout()->createBlock(ImageFieldRenderer::class);

        $widgetType = $this->getData('widgetType');
        $fieldRenderer->setData('widgetType', $widgetType ??'image');

        $element->setRenderer($fieldRenderer);
    }
}
