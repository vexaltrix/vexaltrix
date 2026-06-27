<?php
/**
 * Frontend JS File.
 *
 * @since 2.15.0
 *
 * @package ugb
 */

/**
 * Adding this comment to avoid PHPStan errors of undefined variable as these variables are defined else where.
 *
 * @var string $id
 */

$blockName = 'icon';
$selector   = '.vxt-block-' . $id;
$js         = '';

$js .= \Vexaltrix\BlocksConfig\Icon\Icon::renderIconClick( $id );

return $js;
