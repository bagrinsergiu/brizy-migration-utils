<?php

namespace Brizy;


use Brizy\Utils\UUId;

/**
 * Class DataToProjectTransformer
 * @package Brizy
 */
class DataToProjectTransformer implements DataTransformerInterface
{


    /**
     * @param DataToProjectContext $context
     *
     * @return mixed
     */
    public function execute(ContextInterface $context)
    {
        $defaults = $this->getDefaults($context->getBuildPath());
        $styles = $this->getStyles($context->getBuildPath());
        $fonts = $this->getFonts($context->getBuildPath());

        return $this->merge($context->getData(), $defaults, $styles, $fonts);
    }

    /**
     * @param $buildPath
     *
     * @return array
     */
    private function getStyles($buildPath)
    {
        $templates = json_decode(
            file_get_contents(
                $buildPath.
                DIRECTORY_SEPARATOR."templates".
                DIRECTORY_SEPARATOR."meta.json"
            )
        );
        $result = array();

        foreach ($templates->templates as $template) {
            foreach ($template->styles as $style) {
                $result[] = $style;
            }
        }

        return $result;
    }

    /**
     * @param $buildPath
     *
     * @return array
     */
    private function getFonts($buildPath)
    {
        $fonts = json_decode(
            file_get_contents(
                $buildPath.
                DIRECTORY_SEPARATOR."googleFonts.json"
            )
        );
        $result = array();

        foreach ($fonts->items as $font) {
            $result[] = $font;
        }

        return $result;
    }

    /**
     * @param $styles
     * @param $id
     *
     * @return | null
     */
    private function getStyle($styles, $id)
    {
        foreach ($styles as $style) {
            if ($style && $style->id === $id) {
                return $style;
            }
        }

        return null;
    }

    /**
     * @param $buildPath
     *
     * @return mixed
     */
    private function getDefaults($buildPath)
    {
        $data = json_decode(
            file_get_contents(
                $buildPath.
                DIRECTORY_SEPARATOR."defaultData.json"
            )
        );
        $styles = json_decode(
            file_get_contents(
                $buildPath.
                DIRECTORY_SEPARATOR."defaultStyles.json"
            )
        );
        $fonts = json_decode(
            file_get_contents(
                $buildPath.
                DIRECTORY_SEPARATOR."defaultFonts.json"
            )
        );

        return array(
            'data' => $data,
            'styles' => $styles,
            'fonts' => $fonts,
        );

    }

    /**
     * @param $styles
     * @return array
     */
    private function addStyleFontType($styles)
    {
        $finalStyles = array();

        foreach ($styles as $style) {
            $style->fontFamilyType = "google";
            $finalStyles[] = $style;
        }

        return $finalStyles;
    }

    /**
     * @param $globals
     * @param $default
     * @param $styles
     * @param $fonts
     *
     * @return mixed
     */
    private function merge($globals, $default, $styles, $fonts)
    {
        $resultData = $default->data;
        $resultStyles = $default->styles;
        $resultFonts = $default->fonts;

        // extraFont
        if (isset($globals->extraFonts)) {
            $extraFonts = $globals->extraFonts;
            $finalFonts = array();

            foreach ($extraFonts as $fontKey) {
                foreach ($fonts as $font) {
                    $fontFamilyToKey = preg_replace('/\s+/', '_', strtolower($font->family));

                    if ($fontKey === $fontFamilyToKey) {
                        $font->brizyId = UUId::uuid();
                        $finalFonts[] = $font;
                    }
                }
            }

            $resultFonts->google = (object)array('data' => $finalFonts);

            unset($globals->extraFonts);
        }

        // selectedStyle
        if (isset($globals->styles) && isset($globals->styles->_selected)) {
            $resultData->selectedStyle = $globals->styles->_selected;

            unset($globals->styles->_selected);
        }

        // extraFontStyles
        if (isset($globals->styles) && isset($globals->styles->_extraFontStyles)) {
            $resultData->extraFontStyles = $this->addStyleFontType($globals->styles->_extraFontStyles);
            unset($globals->styles->_extraFontStyles);
        }

        // styles
        // styles -> copy default
        if (isset($globals->styles) && isset($globals->styles->default)) {
            $resultStyles->styles[0]->colorPalette = $globals->styles->default->colorPalette;
            $resultStyles->styles[0]->fontStyles = $this->addStyleFontType($globals->styles->default->fontStyles);

            unset($globals->styles->default);
        }

        // styles -> copy others
        if (isset ($globals->styles)) {
            foreach ($globals->styles as $id => $data) {
                $style = $this->getStyle($styles, $id);
                if (!is_object($style)) {
                    continue;
                }
                $resultStyles->styles[] = (object)array(
                    "id" => $id,
                    "title" => $style->title,
                    "colorPalette" => $data->colorPalette,
                    "fontStyles" => $this->addStyleFontType($data->fontStyles),
                );
            }
        }

        // styles -> missing selected style data
        $selected_style_data_present = false;
        foreach ($resultData->styles as $style) {
            if ($style->id === $resultData->selectedStyle) {
                $selected_style_data_present = true;
            }
        }
        if (!$selected_style_data_present) {
            $selected_style = $this->getStyle($styles, $resultData->selectedStyle);
            if (is_object($selected_style)) {
                $resultStyles->styles[] = (object)array(
                    "id" => $selected_style->id,
                    "title" => $selected_style->title,
                    "colorPalette" => $selected_style->colorPalette,
                    "fontStyles" => $this->addStyleFontType($selected_style->fontStyles),
                );
            }
        }

        return array(
            'data' => $resultData,
            'styles' => $resultStyles,
            'fonts' => $resultFonts,
        );
    }
}
