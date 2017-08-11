<?php

namespace Packt\HelloWorld\Block;

use Magento\Framework\View\Element\Template;

class ChangeBlock extends \Packt\HelloWorld\Block\Landingspage
{
    public function getLandingsUrl()
    {
        return "google.com";
    }

    public function getRedirectUrl()
    {
        return 'youtube.com';
    }

}

?>