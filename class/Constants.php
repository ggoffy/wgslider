<?php

declare(strict_types=1);


namespace XoopsModules\Wgslider;

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgSlider module for xoops
 *
 * @copyright    2026 XOOPS Project (https://xoops.org)
 * @license      GPL 2.0 or later
 * @package      wgslider
 * @author       Goffy - wedega - Email:webmaster@wedega.com - Website:https://wedega.com
 */

/**
 * Interface  Constants
 */
interface Constants
{
    // Constants for tables
    public const int TABLE_CATEGORY = 0;
    public const int TABLE_IMAGE = 1;

    // Constants for status
    public const int STATUS_NONE         = 0;
    public const int STATUS_OFFLINE      = 1;
    public const int STATUS_ONLINE       = 2;
    public const int STATUS_INVALID_SIZE = 3;

    // Constants for display type
    public const int DISPLAY_BLOCK = 1;
    public const int DISPLAY_KEY   = 2;

    // Constants for slideshows
    public const int SLIDESHOW_DEFAULT = 1;
    public const int SLIDESHOW_BT3     = 2;
    public const int SLIDESHOW_BT5     = 3;
    public const int SLIDESHOW_SWIPER  = 4;
    public const int SLIDESHOW_SPLIDE  = 5;

}
