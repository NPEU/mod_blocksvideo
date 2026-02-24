<?php

namespace NPEU\Module\Blocksvideo\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Registry\Registry;


/**
 * Helper for mod_blocksvideo
 *
 * @since  1.5
 */
class BlocksvideoHelper implements DatabaseAwareInterface
{
    use DatabaseAwareTrait;


    public function getVideo(Registry $config, SiteApplication $app): array
    {
        if (!$app instanceof SiteApplication) {
            return [];
        }
        //$db = $this->getDatabase();

        $video = [];


        return $video;
    }

}
