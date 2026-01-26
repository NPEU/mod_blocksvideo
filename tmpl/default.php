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


$media_files_path = ComponentHelper::getParams('com_media')->get('file_path', 'files');

$video_exists = false;
$poster_filename  = $params->get('video_poster');
if (file_exists($filename)) {
    // Check for mp4:
    $mp4_filename = str_replace('.png', 'mp4', $poster_filename);

    # Need to add the sub folder and tody the path.

    if (file_exists($mp4_filename)) {
        $video_exists = true;
    }

    // We can also check for the webm, but if it's not found we shouldn't abort thw whole thing:
    $webm_filename = str_replace('.png', 'webm', $poster_filename);

    # Need to add the sub folder and tody the path.

    if (!file_exists($webm_filename)) {
        $webm_filename = false;
    }
}
?>
<div class="blocks-container blocksvideo-container">
<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>

<?php if ($video_exists) :?>
<video controls playsinline preload="metadata" poster="<?php echo $poster_filename; ?>">
    <?php /* if ($webm_filename) : ?>
    <source src="<?php echo $webm_filename; ?>" type='video/webm; codecs="vp9, opus"'>
    <?php endif; ?>
    */ ?>
    <source src="<?php echo $mp4_filename; ?>"  type='video/mp4; codecs="avc1.4d401f, mp4a.40.2"'>
</video>
<?php else: ?>
<p>The video could not be found.</p>
<?php endif; ?
</div>