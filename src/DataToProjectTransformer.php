<?php

namespace Brizy;

use Brizy\Utils\UUId;

/**
 * Class DataToProjectTransformer
 * @package Brizy
 */
class DataToProjectTransformer implements DataTransformerInterface {

	/**
	 * @var string
	 */
	private $buildPath;

	/**
	 * DataToProjectMigration constructor.
	 *
	 * @param $buildPath
	 */
	public function __construct( $buildPath ) {
		$this->buildPath = $buildPath;
	}

	/**
	 * @param $gb
	 *
	 * @return mixed
	 */
	public function execute( $gb ) {
		$defaults = $this->getDefaults();
		$styles   = $this->getStyles();
		$fonts    = $this->getFonts();

		return $this->merge( $gb, $defaults, $styles, $fonts );
	}

	private function getStyles() {
		$templates = json_decode( file_get_contents( $this->buildPath .
		                                             DIRECTORY_SEPARATOR . "templates" .
		                                             DIRECTORY_SEPARATOR . "meta.json" ) );
		$result    = array();

		foreach ( $templates->templates as $template ) {
			foreach ( $template->styles as $style ) {
				$result[] = $style;
			}
		}

		return $result;
	}

	private function getFonts() {
		$fonts  = json_decode( file_get_contents( $this->buildPath .
		                                          DIRECTORY_SEPARATOR . "googleFonts.json" ) );
		$result = array();

		foreach ( $fonts->items as $font ) {
			$result[] = $font;
		}

		return $result;
	}

	private function getStyle( $styles, $id ) {
		foreach ( $styles as $style ) {
			if ( $style && $style->id === $id ) {
				return $style;
			}
		}

		return null;
	}

	private function getDefaults() {
		return json_decode( file_get_contents( $this->buildPath .
		                                       DIRECTORY_SEPARATOR . "defaults.json" ) );
	}

	private function merge( $globals, $default, $styles, $fonts ) {
		$result = $default;

		// extraFont
		if ( isset( $globals->extraFonts ) ) {
			$extraFonts = $globals->extraFonts;
			$finalFonts = array();

			foreach ( $extraFonts as $fontKey ) {
				foreach ( $fonts as $font ) {
					$fontFamilyToKey = preg_replace( '/\s+/', '_', strtolower( $font->family ) );

					if ( $fontKey === $fontFamilyToKey ) {
						$font->brizyId = UUId::uuid();
						$finalFonts[]  = $font;
					}
				}
			}

			$result->fonts->google->data = $finalFonts;

			unset( $globals->extraFonts );
		}

		// selectedStyle
		if ( isset( $globals->styles ) && isset( $globals->styles->_selected ) ) {
			$result->selectedStyle = $globals->styles->_selected;

			unset( $globals->styles->_selected );
		}

		// extraFontStyles
		if ( isset( $globals->styles ) && isset( $globals->styles->_extraFontStyles ) ) {
			$result->extraFontStyles = $globals->styles->_extraFontStyles;

			unset( $globals->styles->_extraFontStyles );
		}

		// styles
		// styles -> copy default
		if ( isset( $globals->styles ) && isset( $globals->styles->default ) ) {
			$result->styles[0]->colorPalette = $globals->styles->default->colorPalette;
			$result->styles[0]->fontStyles   = $globals->styles->default->fontStyles;

			unset( $globals->styles->default );
		}

		// styles -> copy others
		if ( isset ( $globals->styles ) ) {
			foreach ( $globals->styles as $id => $data ) {
				$style = $this->getStyle( $styles, $id );
				if ( ! is_object( $style ) ) {
					continue;
				}
				$result->styles[] = (object) array(
					"id"           => $id,
					"title"        => $style->title,
					"colorPalette" => $data->colorPalette,
					"fontStyles"   => $data->fontStyles
				);
			}
		}

		// styles -> missing selected style data
		$selected_style_data_present = false;
		foreach ( $result->styles as $style ) {
			if ( $style->id === $result->selectedStyle ) {
				$selected_style_data_present = true;
			}
		}
		if ( ! $selected_style_data_present ) {
			$selected_style = $this->getStyle( $styles, $result->selectedStyle );
			if ( is_object( $selected_style ) ) {
				$result->styles[] = (object) array(
					"id"           => $selected_style->id,
					"title"        => $selected_style->title,
					"colorPalette" => $selected_style->colorPalette,
					"fontStyles"   => $selected_style->fontStyles
				);
			}
		}

		return $result;
	}


}
