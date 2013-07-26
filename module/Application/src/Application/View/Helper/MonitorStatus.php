<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Class MonitorStatus
 * @package Application\View\Helper
 */
class MonitorStatus extends AbstractHelper
{


    /**
     * @param string $status
     * @return string
     */
    public function __invoke($status)
    {
        switch($status)
        {
            case 'OK':
                $image = 'success';
                break;
            case 'Warning':
                $image = 'warning';
                break;
            case 'Error';
                $image = 'danger';
                break;
            case 'Down';
                $image = 'inverse';
                break;
            default:
                $image = '';
                break;
        }

        return $image;
    }



}