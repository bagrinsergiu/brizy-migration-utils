<?php

namespace Brizy\Utils;

class Conditions {
	public static function getSurroundedIds( $blocks ) {
		$top    = array();
		$bottom = array();

		if ( count( $blocks ) > 0 ) {
			$i = 0;
			while ( $i <= count( $blocks ) - 1 ) {
				$currentBlock = $blocks[ $i ];
				if ( $currentBlock->type === "GlobalBlock" ) {
					array_push( $top, $currentBlock->value->globalBlockId );
				} else {
					break;
				}
				$i ++;
			}

			$i = 0;
			while ( $i <= count( $blocks ) - 1 ) {
				$currentBlock = $blocks[ count( $blocks ) - 1 - $i ];
				if ( $currentBlock->type === "GlobalBlock" ) {
					array_push( $bottom, $currentBlock->value->globalBlockId );
				} else {
					break;
				}
				$i ++;
			}
		}

		return array( $top, $bottom );
	}

	public static function isConditionBlock( $block ) {
		return $block->type === "GlobalBlock";
	}

	public static function array_find( $array, $callback ) {
		foreach ( $array as $key => $value ) {
			$result = $callback( $value, $key );
			if ( $result ) {
				return $result;
			}
		}

		return - 1;
	}

	public static function array_count( $arr, $callback ) {
		$i = 0;
		foreach ( $arr as $value ) {
			if ( $callback( $value ) ) {
				$i ++;
			}
		}

		return $i;
	}

	public static function turnIntoObject( $globalBlocks ) {
		$newGlobalBlocks = new stdClass();
		foreach ( $globalBlocks as $value ) {
			$newGlobalBlocks->{$value->uid} = $value;
		}

		return $newGlobalBlocks;
	}
}
