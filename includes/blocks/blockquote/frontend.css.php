<?php
/**
 * Frontend CSS & Google Fonts loading File.
 *
 * @since 2.0.0
 *
 * @package ugb
 */

// Adds Fonts.
\Vexaltrix\Presentation\Blocks\BlockJs::blocksBlockquoteGfont( $attr );

$tweetBtnPaddingTop    = isset( $attr['paddingBtnTop'] ) ? $attr['paddingBtnTop'] : $attr['tweetBtnVrPadding'];
$tweetBtnPaddingBottom = isset( $attr['paddingBtnBottom'] ) ? $attr['paddingBtnBottom'] : $attr['tweetBtnVrPadding'];
$tweetBtnPaddingLeft   = isset( $attr['paddingBtnLeft'] ) ? $attr['paddingBtnLeft'] : $attr['tweetBtnHrPadding'];
$tweetBtnPaddingRight  = isset( $attr['paddingBtnRight'] ) ? $attr['paddingBtnRight'] : $attr['tweetBtnHrPadding'];

if ( 'center' !== $attr['align'] || 'border' === $attr['skinStyle'] ) {
	$attr['authorSpace']       = 0;
	$attr['authorSpaceTablet'] = 0;
	$attr['authorSpaceMobile'] = 0;
}

// Set align to left for border style.
$textAlign = $attr['align'];

if ( 'border' === $attr['skinStyle'] ) {
	$textAlign = 'left';
}

$selectors = [
	' .vxt-blockquote__content'                       => [
		'color'         => $attr['descColor'],
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['descSpace'], $attr['descSpaceUnit'] ),
		'text-align'    => $textAlign,
	],
	' cite.vxt-blockquote__author'                    => [
		'color'      => $attr['authorColor'],
		'text-align' => $textAlign,
	],
	' .vxt-blockquote__skin-border blockquote.vxt-blockquote' => [ // for backward compatibility.
		'border-color'      => $attr['borderColor'],
		'border-left-style' => $attr['borderStyle'],
		'border-left-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderWidth'], $attr['borderWidthUnit'] ),
		'padding-left'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderGap'], $attr['borderGapUnit'] ),
		'padding-top'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPadding'], $attr['verticalPaddingUnit'] ),
		'padding-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPadding'], $attr['verticalPaddingUnit'] ),
	],
	'.vxt-blockquote__skin-border blockquote.vxt-blockquote' => [
		'border-color'      => $attr['borderColor'],
		'border-left-style' => $attr['borderStyle'],
		'border-left-width' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderWidth'], $attr['borderWidthUnit'] ),
		'padding-left'      => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderGap'], $attr['borderGapUnit'] ),
		'padding-top'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPadding'], $attr['verticalPaddingUnit'] ),
		'padding-bottom'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPadding'], $attr['verticalPaddingUnit'] ),
	],

	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon-wrap' => [ // For Backword.
		'background'    => $attr['quoteBgColor'],
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBorderRadius'], '%' ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteTopMargin'], 'px' ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBottomMargin'], 'px' ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteLeftMargin'], 'px' ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteRightMargin'], 'px' ),
		'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quotePadding'], $attr['quotePaddingType'] ),
	],
	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon' => [ // For Backword.
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
	],

	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon' => [
		'background'    => $attr['quoteBgColor'],
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBorderRadius'], $attr['quoteBorderRadiusUnit'] ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteTopMargin'], $attr['quoteUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBottomMargin'], $attr['quoteUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteLeftMargin'], $attr['quoteUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteRightMargin'], $attr['quoteUnit'] ),
		'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quotePadding'], $attr['quotePaddingType'] ),
	],
	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
		'fill'   => $attr['quoteColor'],
	],

	'.vxt-blockquote__style-style_1 .vxt-blockquote' => [
		'text-align' => $attr['align'],
	],

	' .vxt-blockquote__author-wrap'                   => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['authorSpace'],
			'px'
		),
	],
	' .vxt-blockquote__author-wrap img'               => [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidth'], 'px' ),
		'height'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidth'], 'px' ),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImgBorderRadius'], '%' ),
	],

	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-right img' => [
		'margin-left' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGap'], $attr['authorImageGapUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-top img' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGap'], $attr['authorImageGapUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-left img' => [
		'margin-right' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGap'], $attr['authorImageGapUnit'] ),
	],

	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon:hover svg' => [
		'fill' => $attr['quoteHoverColor'],
	],

	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon:hover' => [
		'background' => $attr['quoteBgHoverColor'],
	],

	'.vxt-blockquote__skin-border blockquote.vxt-blockquote:hover' => [
		'border-left-color' => $attr['borderHoverColor'],
	],
	// Backword css.
	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'fill'   => $attr['quoteColor'],
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSize'], $attr['quoteSizeType'] ),
	],
	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon:hover svg' => [
		'fill' => $attr['quoteHoverColor'],
	],

	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon-wrap:hover' => [
		'background' => $attr['quoteBgHoverColor'],
	],

	' .vxt-blockquote__skin-border blockquote.vxt-blockquote:hover' => [
		'border-left-color' => $attr['borderHoverColor'],
	],
	'.vxt-blockquote__align-center blockquote.vxt-blockquote' => [
		'text-align' => $attr['align'],
	],
	// End backword.
];

if ( $attr['enableTweet'] ) {
	$selectors['.vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button'] = [
		'color' => $attr['tweetLinkColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button svg'] = [
		'fill' => $attr['tweetLinkColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button'] = [ // for backward compatibility.
		'color'            => $attr['tweetBtnColor'],
		'background-color' => $attr['tweetBtnBgColor'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingLeft, $attr['paddingBtnUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingRight, $attr['paddingBtnUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
	];

	$selectors['.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button'] = [
		'color'            => $attr['tweetBtnColor'],
		'background-color' => $attr['tweetBtnBgColor'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingLeft, $attr['paddingBtnUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingRight, $attr['paddingBtnUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
	];

	$selectors['.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button svg'] = [
		'fill' => $attr['tweetBtnColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button'] = [
		'color'            => $attr['tweetBtnColor'],
		'background-color' => $attr['tweetBtnBgColor'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingLeft, $attr['paddingBtnUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingRight, $attr['paddingBtnUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingBottom, $attr['paddingBtnUnit'] ),
	];

	// Backword CSS.
	$selectors[' .vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button'] = [
		'color'            => $attr['tweetBtnColor'],
		'background-color' => $attr['tweetBtnBgColor'],
		'padding-left'     => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingLeft, $attr['paddingBtnUnit'] ),
		'padding-right'    => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingRight, $attr['paddingBtnUnit'] ),
		'padding-top'      => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingTop, $attr['paddingBtnUnit'] ),
		'padding-bottom'   => \Vexaltrix\Core\Support\Helper::getCssValue( $tweetBtnPaddingBottom, $attr['paddingBtnUnit'] ),
	];

	$selectors[' .vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:before'] = [
		'border-right-color' => $attr['tweetBtnBgColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button:hover'] = [
		'color' => $attr['tweetBtnHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button:hover'] = [
		'color'            => $attr['tweetBtnHoverColor'],
		'background-color' => $attr['tweetBtnBgHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover'] = [
		'color'            => $attr['tweetBtnHoverColor'],
		'background-color' => $attr['tweetBtnBgHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors[' .vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover:before'] = [
		'border-right-color' => $attr['tweetBtnBgHoverColor'],
	];

	// End Backword.

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button svg'] = [
		'fill' => $attr['tweetBtnColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:before'] = [
		'border-right-color' => $attr['tweetBtnBgColor'],
	];

	$selectors[' a.vxt-blockquote__tweet-button svg'] = [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSize'], $attr['tweetBtnFontSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSize'], $attr['tweetBtnFontSizeType'] ),
	];
 
	$iconMargin = is_rtl() ? 'margin-left' : 'margin-right';

	$selectors['.vxt-blockquote__tweet-icon_text a.vxt-blockquote__tweet-button svg'] = [
		$iconMargin => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetIconSpacing'], $attr['tweetIconSpacingUnit'] ),
	];

	// Hover CSS.
	$selectors['.vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button:hover'] = [
		'color' => $attr['tweetBtnHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-link a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button:hover'] = [
		'color'            => $attr['tweetBtnHoverColor'],
		'background-color' => $attr['tweetBtnBgHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover'] = [
		'color'            => $attr['tweetBtnHoverColor'],
		'background-color' => $attr['tweetBtnBgHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover svg'] = [
		'fill' => $attr['tweetBtnHoverColor'],
	];

	$selectors['.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button:hover:before'] = [
		'border-right-color' => $attr['tweetBtnBgHoverColor'],
	];
}

$tSelectors = [
	' a.vxt-blockquote__tweet-button svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSizeTablet'], $attr['tweetBtnFontSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSizeTablet'], $attr['tweetBtnFontSizeType'] ),
	],
	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon' => [
		'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quotePaddingTablet'], $attr['quotePaddingType'] ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteTopMarginTablet'], $attr['quotetabletUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBottomMarginTablet'], $attr['quotetabletUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteLeftMarginTablet'], $attr['quotetabletUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteRightMarginTablet'], $attr['quotetabletUnit'] ),
	],
	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeTablet'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeTablet'], $attr['quoteSizeType'] ),
	],
	'.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomTablet'], $attr['tabletPaddingBtnUnit'] ),
	],
	'.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopTablet'], $attr['tabletPaddingBtnUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomTablet'], $attr['tabletPaddingBtnUnit'] ),
	],
	// Backword css.
	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeTablet'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeTablet'], $attr['quoteSizeType'] ),
	],
	' .vxt-blockquote__author-wrap'       => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['authorSpaceTablet'],
			'px'
		),
	],
	' .vxt-blockquote__author-wrap img'   => [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthTablet'], 'px' ),
		'height'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthTablet'], 'px' ),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImgBorderRadiusTablet'], '%' ),
	],
	'.vxt-blockquote__skin-border blockquote.vxt-blockquote' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderGapTablet'], $attr['borderGapUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPaddingTablet'], $attr['verticalPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPaddingTablet'], $attr['verticalPaddingUnit'] ),
	],
	' .vxt-blockquote__content'           => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['descSpaceTablet'], $attr['descSpaceUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-right img' => [
		'margin-left'   => ( 'tablet' === $attr['stack'] ) ? '0px' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapTablet'], $attr['authorImageGapUnit'] ),
		'margin-bottom' => ( 'tablet' === $attr['stack'] ) ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapTablet'], $attr['authorImageGapUnit'] ) : '0px',
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-top img' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapTablet'], $attr['authorImageGapUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-left img' => [
		'margin-right'  => ( 'tablet' === $attr['stack'] ) ? '0px' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapTablet'], $attr['authorImageGapUnit'] ),
		'margin-bottom' => ( 'tablet' === $attr['stack'] ) ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapTablet'], $attr['authorImageGapUnit'] ) : '0px',
	],
];

$mSelectors = [
	' a.vxt-blockquote__tweet-button svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSizeMobile'], $attr['tweetBtnFontSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['tweetBtnFontSizeMobile'], $attr['tweetBtnFontSizeType'] ),
	],
	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon' => [
		'padding'       => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quotePaddingMobile'], $attr['quotePaddingType'] ),
		'margin-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteTopMarginMobile'], $attr['quotemobileUnit'] ),
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteBottomMarginMobile'], $attr['quotemobileUnit'] ),
		'margin-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteLeftMarginMobile'], $attr['quotemobileUnit'] ),
		'margin-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteRightMarginMobile'], $attr['quotemobileUnit'] ),
	],
	'.vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeMobile'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeMobile'], $attr['quoteSizeType'] ),
	],
	'.vxt-blockquote__tweet-style-classic a.vxt-blockquote__tweet-button' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomMobile'], $attr['mobilePaddingBtnUnit'] ),
	],
	'.vxt-blockquote__tweet-style-bubble a.vxt-blockquote__tweet-button' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnLeftMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-right'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnRightMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnTopMobile'], $attr['mobilePaddingBtnUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['paddingBtnBottomMobile'], $attr['mobilePaddingBtnUnit'] ),
	],
	' .vxt-blockquote__skin-quotation .vxt-blockquote__icon svg' => [
		'width'  => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeMobile'], $attr['quoteSizeType'] ),
		'height' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['quoteSizeMobile'], $attr['quoteSizeType'] ),
	],
	' .vxt-blockquote__author-wrap'       => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue(
			$attr['authorSpaceMobile'],
			'px'
		),
	],
	' .vxt-blockquote__author-wrap img'   => [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthMobile'], 'px' ),
		'height'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthMobile'], 'px' ),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImgBorderRadiusMobile'], '%' ),
	],
	' .vxt-blockquote__author-wrap img'   => [
		'width'         => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthMobile'], 'px' ),
		'height'        => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageWidthMobile'], 'px' ),
		'border-radius' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImgBorderRadiusMobile'], '%' ),
	],
	'.vxt-blockquote__skin-border blockquote.vxt-blockquote' => [
		'padding-left'   => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['borderGapMobile'], $attr['borderGapUnit'] ),
		'padding-top'    => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPaddingMobile'], $attr['verticalPaddingUnit'] ),
		'padding-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['verticalPaddingMobile'], $attr['verticalPaddingUnit'] ),
	],
	' .vxt-blockquote__content'           => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['descSpaceMobile'], $attr['descSpaceUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-right img' => [
		'margin-left'   => ( 'none' !== $attr['stack'] ) ? '0px' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapMobile'], $attr['authorImageGapUnit'] ),
		'margin-bottom' => ( 'none' !== $attr['stack'] ) ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapMobile'], $attr['authorImageGapUnit'] ) : '0px',
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-top img' => [
		'margin-bottom' => \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapMobile'], $attr['authorImageGapUnit'] ),
	],
	' .vxt-blockquote__author-wrap.vxt-blockquote__author-at-left img' => [
		'margin-right'  => ( 'none' !== $attr['stack'] ) ? '0px' : \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapMobile'], $attr['authorImageGapUnit'] ),
		'margin-bottom' => ( 'none' !== $attr['stack'] ) ? \Vexaltrix\Core\Support\Helper::getCssValue( $attr['authorImageGapMobile'], $attr['authorImageGapUnit'] ) : '0px',
	],
];

$combinedSelectors = [
	'desktop' => $selectors,
	'tablet'  => $tSelectors,
	'mobile'  => $mSelectors,
];

$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'tweetBtn', ' .vxt-blockquote a.vxt-blockquote__tweet-button', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'author', ' cite.vxt-blockquote__author', $combinedSelectors );
$combinedSelectors = \Vexaltrix\Core\Support\Helper::getTypographyCss( $attr, 'desc', ' .vxt-blockquote__content', $combinedSelectors );

$baseSelector = ( $attr['classMigrate'] ) ? '.vxt-block-' : '#vxt-blockquote-';

return \Vexaltrix\Core\Support\Helper::generateAllCss( $combinedSelectors, $baseSelector . $id );
