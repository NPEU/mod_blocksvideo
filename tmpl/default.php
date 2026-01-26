<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_blocksvideo
 *
 * @copyright   Copyright (C) NPEU 2026.
 * @license     MIT License; see LICENSE.md
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;


$media_files_path = ComponentHelper::getParams('com_media')->get('file_path', 'files');

$video_exists = false;
$poster_filename = $params->get('video_poster');

$img_url  = false;
$mp4_url  = false;
$webm_url = false;

if (!empty($poster_filename)) {
    $img_obj  = HTMLHelper::cleanImageURL($poster_filename);
    $img_filepath = urldecode(JPATH_ROOT . '/' . $img_obj->url);

    if (file_exists($img_filepath)) {
        $img_url = str_replace(JPATH_ROOT . '/', Uri::root(), $img_filepath);

        $parts = pathinfo($img_filepath);

        // Check for mp4:
        $mp4_filepath = str_replace($parts['filename'], $parts['filename'] . '/' . $parts['filename'], str_replace('.png', '.mp4', $img_filepath));

        #echo '<pre>'; var_dump(file_exists($)); echo '</pre>'; exit;
        if (file_exists($mp4_filepath)) {
            $mp4_url = str_replace(JPATH_ROOT . '/', Uri::root(), $mp4_filepath);
            $video_exists = true;
        }

        // We can also check for the webm, but if it's not found we shouldn't abort thw whole thing:
        $webm_filepath = str_replace($parts['filename'], $parts['filename'] . '/' . $parts['filename'], str_replace('.png', '.webm', $img_filepath));

        if (file_exists($webm_filepath)) {
            $webm_url = str_replace(JPATH_ROOT . '/', Uri::root(), $webm_filepath);
        }
    }
}
?>
<div class="blocks-container blocksvideo-container">
<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>

<?php if ($video_exists) :?>
<video controls playsinline preload="metadata" poster="<?php echo $img_url; ?>" style="max-width: 100%;">
    <?php /* if ($webm_url) : ?>
    <source src="<?php echo $webm_url; ?>" type='video/webm; codecs="vp9, opus"'>
    <?php endif; ?>
    */ ?>
    <source src="<?php echo $mp4_url; ?>"  type='video/mp4; codecs="avc1.4d401f, mp4a.40.2"'>
</video>
<?php else: ?>
<p>The video could not be found.</p>
<?php endif; ?>
</div>