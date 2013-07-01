<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class MonitorAlertingStatus
 * @package Application\View\Helper
 */
class MonitorAlertingStatus extends AbstractHelper
{


    /**
     * @param bool $status
     * @return string
     */
    public function __invoke($status)
    {
        switch($status)
        {
            case true:
                $image = 'ok';
                break;
            case false:
                $image = 'remove';
                break;
            default:
                $image = 'question-sign';
                break;
        }

        return $image;
    }



}