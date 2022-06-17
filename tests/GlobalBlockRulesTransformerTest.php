<?php

namespace Brizy;


use PHPUnit\Framework\TestCase;

class GlobalBlockRulesTest extends TestCase
{
    public function executeUseCases(): array
    {
//#region CollectionTypes JSON
        $collectionTypesJSON = '
{
  "data": [
    {
      "id": "/collection_types/16695",
      "collection": [
        {
          "id": "/collection_items/17084",
          "title": "Post 1",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17532",
                  "title": "Red"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17538",
                    "title": "make a blog"
                  },
                  {
                    "id": "/collection_items/17539",
                    "title": "blog radio"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17085",
          "title": "Post 2",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17058",
                    "title": "Blog"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17531",
                  "title": "White"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17541",
                    "title": "daily blog"
                  },
                  {
                    "id": "/collection_items/17542",
                    "title": "how to start a blog for beginners"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17086",
          "title": "Post 3",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17080",
                    "title": "Portfolio"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17536",
                    "title": "how to start a blog"
                  },
                  {
                    "id": "/collection_items/17537",
                    "title": "blog"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17532",
                  "title": "Red"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            }
          ]
        },
        {
          "id": "/collection_items/17087",
          "title": "Post 4",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17058",
                    "title": "Blog"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17088",
          "title": "Post 5",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17080",
                    "title": "Portfolio"
                  }
                ]
              }
            }
          ]
        }
      ]
    },
    {
      "id": "/collection_types/16710",
      "collection": [
        {
          "id": "/collection_items/17081",
          "title": "Bmw 320m",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48854",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17544",
                    "title": "small cars"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48852",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            }
          ]
        },
        {
          "id": "/collection_items/17082",
          "title": "Toyota CHR",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48852",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17531",
                  "title": "White"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48854",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17545",
                    "title": "cars for kids"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17083",
          "title": "Volvo XC 60",
          "fields": []
        }
      ]
    },
    {
      "id": "/collection_types/16696",
      "collection": [
        {
          "id": "/collection_items/17059",
          "title": "home",
          "fields": [
            {},
            {}
          ]
        }
      ]
    }
  ]
}
';

//#endregion

        return [
            [
                '{"id":"vkxirjeudirsufoiblywwxxscgevmrlwmdpz","data":{"type":"Section","value":{"_styles":["section"],"items":[],"_id":"vkxirjeudirsufoiblywwxxscgevmrlwmdpz","_thumbnailSrc":4282655,"_thumbnailWidth":600,"_thumbnailHeight":310,"_thumbnailTime":1655186017552},"blockId":"block2kit1294"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282718,"_thumbnailWidth":600,"_thumbnailHeight":310,"_thumbnailTime":1655187821366},"rules":[{"type":1,"appliedFor":1,"entityType":"/collection_types/16695","entityValues":["/collection_items/17530"]},{"type":1,"appliedFor":1,"entityType":"/collection_types/16695","entityValues":["/collection_items/17058"]},{"type":1,"appliedFor":1,"entityType":"/collection_types/16710","entityValues":["/collection_items/17544"]},{"type":1,"appliedFor":1,"entityType":"/collection_types/16710","entityValues":["/collection_items/17545"]},{"type":1,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"top","top":2,"bottom":2},"status":"publish"}',
                $collectionTypesJSON,
                '{"id":"vkxirjeudirsufoiblywwxxscgevmrlwmdpz","data":{"type":"Section","value":{"_styles":["section"],"items":[],"_id":"vkxirjeudirsufoiblywwxxscgevmrlwmdpz","_thumbnailSrc":4282655,"_thumbnailWidth":600,"_thumbnailHeight":310,"_thumbnailTime":1655186017552},"blockId":"block2kit1294"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282718,"_thumbnailWidth":600,"_thumbnailHeight":310,"_thumbnailTime":1655187821366},"rules":[{"type":1,"appliedFor":1,"entityType":"/collection_types/16695","entityValues":["/collection_type_fields/48850:/collection_items/17530"],"mode":"reference"},{"type":1,"appliedFor":1,"entityType":"/collection_types/16695","entityValues":["/collection_type_fields/48851:/collection_items/17530"],"mode":"reference"},{"type":1,"appliedFor":1,"entityType":"/collection_types/16695","entityValues":["/collection_type_fields/48127:/collection_items/17058"],"mode":"reference"},{"type":1,"appliedFor":1,"entityType":"/collection_types/16710","entityValues":["/collection_type_fields/48854:/collection_items/17544"],"mode":"reference"},{"type":1,"appliedFor":1,"entityType":"/collection_types/16710","entityValues":["/collection_type_fields/48854:/collection_items/17545"],"mode":"reference"},{"type":1,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"],"mode":"specific"}],"position":{"align":"top","top":2,"bottom":2},"status":"publish"}'
            ],
            [
                '{"id":"twvdtygqmumozrvpyrrdinubrqppwjrulxbn","data":{"type":"SectionHeader","value":{"_styles":["sectionHeader"],"items":[],"type":"animated","_id":"twvdtygqmumozrvpyrrdinubrqppwjrulxbn","_thumbnailSrc":4282714,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655187788431},"blockId":"block2kit14836"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282719,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655187824789},"rules":[{"type":1,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"top","top":1,"bottom":1},"status":"publish"}',
                $collectionTypesJSON,
                '{"id":"twvdtygqmumozrvpyrrdinubrqppwjrulxbn","data":{"type":"SectionHeader","value":{"_styles":["sectionHeader"],"items":[],"type":"animated","_id":"twvdtygqmumozrvpyrrdinubrqppwjrulxbn","_thumbnailSrc":4282714,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655187788431},"blockId":"block2kit14836"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282719,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655187824789},"rules":[{"mode":"specific","type":1,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"top","top":1,"bottom":1},"status":"publish"}',
            ],
            [
                '{"id":"lfydujcqmcyliwguvzjizgioncvmzooukthf","data":{"type":"Section","value":{"_styles":["section"],"items":[],"_id":"lfydujcqmcyliwguvzjizgioncvmzooukthf","_thumbnailSrc":4283248,"_thumbnailWidth":600,"_thumbnailHeight":160,"_thumbnailTime":1655380144146},"blockId":"block2kit2505"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4281876,"_thumbnailWidth":600,"_thumbnailHeight":164,"_thumbnailTime":1654687644922},"rules":[{"type":1,"appliedFor":1,"entityType":"/collection_types/16695"}],"position":{"align":"bottom","top":6,"bottom":6},"status":"publish"}',
                $collectionTypesJSON,
                '{"id":"lfydujcqmcyliwguvzjizgioncvmzooukthf","data":{"type":"Section","value":{"_styles":["section"],"items":[],"_id":"lfydujcqmcyliwguvzjizgioncvmzooukthf","_thumbnailSrc":4283248,"_thumbnailWidth":600,"_thumbnailHeight":160,"_thumbnailTime":1655380144146},"blockId":"block2kit2505"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4281876,"_thumbnailWidth":600,"_thumbnailHeight":164,"_thumbnailTime":1654687644922},"rules":[{"type":1,"appliedFor":1,"entityType":"/collection_types/16695"}],"position":{"align":"bottom","top":6,"bottom":6},"status":"publish"}',
            ],
            [
                '{"id":"avrulicejbzzfhvxfihdnpyysmoetxkyjlfx","data":{"type":"SectionHeader","value":{"_styles":["sectionHeader"],"items":[],"type":"static","_id":"avrulicejbzzfhvxfihdnpyysmoetxkyjlfx","_thumbnailSrc":4282642,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655185706176},"blockId":"block2kit14836"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282642,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655185706176},"rules":[{"type":1},{"type":2,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"top","top":0,"bottom":0},"status":"publish"}',
                $collectionTypesJSON,
                '{"id":"avrulicejbzzfhvxfihdnpyysmoetxkyjlfx","data":{"type":"SectionHeader","value":{"_styles":["sectionHeader"],"items":[],"type":"static","_id":"avrulicejbzzfhvxfihdnpyysmoetxkyjlfx","_thumbnailSrc":4282642,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655185706176},"blockId":"block2kit14836"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282642,"_thumbnailWidth":600,"_thumbnailHeight":38,"_thumbnailTime":1655185706176},"rules":[{"type":1},{"mode":"specific","type":2,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"top","top":0,"bottom":0},"status":"publish"}'
            ],
            [
                '{"id":"cglmmknjehwwhvwcklllnqbzhyihetaaqohz","data":{"type":"SectionFooter","value":{"_styles":["sectionFooter"],"items":[],"paddingType":"grouped","paddingTop":50,"paddingBottom":50,"padding":50,"tabletPaddingType":"ungrouped","tabletPaddingTop":35,"tabletPaddingBottom":0,"tabletPadding":25,"mobilePaddingType":"ungrouped","mobilePaddingTop":25,"mobilePaddingBottom":15,"mobilePadding":25,"bgColorPalette":"color3","bgColorHex":"#ffffff","bgColorOpacity":1,"tempBgColorOpacity":1,"tabsColor":"tabOverlay","tempBgColorPalette":"","borderRadius":0,"borderTopLeftRadius":0,"borderTopRightRadius":0,"borderBottomLeftRadius":0,"borderBottomRightRadius":0,"tempBorderTopLeftRadius":0,"tempBorderTopRightRadius":0,"tempBorderBottomLeftRadius":0,"tempBorderBottomRightRadius":0,"tabsState":"tabNormal","tabsCurrentElement":"tabCurrentElement","_id":"cglmmknjehwwhvwcklllnqbzhyihetaaqohz","bgColorType":"solid","tempBgColorType":"solid","gradientColorHex":"#009900","gradientColorOpacity":1,"tempGradientColorOpacity":1,"gradientColorPalette":"","tempGradientColorPalette":"","gradientType":"linear","gradientStartPointer":0,"gradientFinishPointer":100,"gradientActivePointer":"startPointer","gradientLinearDegree":90,"gradientRadialDegree":90,"_thumbnailSrc":4282358,"_thumbnailWidth":600,"_thumbnailHeight":98,"_thumbnailTime":1654862811951},"blockId":"block2kit15552"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282358,"_thumbnailWidth":600,"_thumbnailHeight":98,"_thumbnailTime":1654862811951},"rules":[{"type":1},{"type":2,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"bottom","top":7,"bottom":7},"status":"publish"}',
                $collectionTypesJSON,
                '{"id":"cglmmknjehwwhvwcklllnqbzhyihetaaqohz","data":{"type":"SectionFooter","value":{"_styles":["sectionFooter"],"items":[],"paddingType":"grouped","paddingTop":50,"paddingBottom":50,"padding":50,"tabletPaddingType":"ungrouped","tabletPaddingTop":35,"tabletPaddingBottom":0,"tabletPadding":25,"mobilePaddingType":"ungrouped","mobilePaddingTop":25,"mobilePaddingBottom":15,"mobilePadding":25,"bgColorPalette":"color3","bgColorHex":"#ffffff","bgColorOpacity":1,"tempBgColorOpacity":1,"tabsColor":"tabOverlay","tempBgColorPalette":"","borderRadius":0,"borderTopLeftRadius":0,"borderTopRightRadius":0,"borderBottomLeftRadius":0,"borderBottomRightRadius":0,"tempBorderTopLeftRadius":0,"tempBorderTopRightRadius":0,"tempBorderBottomLeftRadius":0,"tempBorderBottomRightRadius":0,"tabsState":"tabNormal","tabsCurrentElement":"tabCurrentElement","_id":"cglmmknjehwwhvwcklllnqbzhyihetaaqohz","bgColorType":"solid","tempBgColorType":"solid","gradientColorHex":"#009900","gradientColorOpacity":1,"tempGradientColorOpacity":1,"gradientColorPalette":"","tempGradientColorPalette":"","gradientType":"linear","gradientStartPointer":0,"gradientFinishPointer":100,"gradientActivePointer":"startPointer","gradientLinearDegree":90,"gradientRadialDegree":90,"_thumbnailSrc":4282358,"_thumbnailWidth":600,"_thumbnailHeight":98,"_thumbnailTime":1654862811951},"blockId":"block2kit15552"},"meta":{"extraFontStyles":[],"type":"normal","_thumbnailSrc":4282358,"_thumbnailWidth":600,"_thumbnailHeight":98,"_thumbnailTime":1654862811951},"rules":[{"type":1},{"mode":"specific","type":2,"appliedFor":1,"entityType":"/collection_types/16696","entityValues":["/collection_items/17059"]}],"position":{"align":"bottom","top":7,"bottom":7},"status":"publish"}'
            ]
        ];
    }

    public function executeFailCases(): array
    {
//#region CollectionTypes JSON
        $collectionTypesJSON = '
{
  "data": [
    {
      "id": "/collection_types/16695",
      "collection": [
        {
          "id": "/collection_items/17084",
          "title": "Post 1",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17532",
                  "title": "Red"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17538",
                    "title": "make a blog"
                  },
                  {
                    "id": "/collection_items/17539",
                    "title": "blog radio"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17085",
          "title": "Post 2",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17058",
                    "title": "Blog"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17531",
                  "title": "White"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17541",
                    "title": "daily blog"
                  },
                  {
                    "id": "/collection_items/17542",
                    "title": "how to start a blog for beginners"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17086",
          "title": "Post 3",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17080",
                    "title": "Portfolio"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48853",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17536",
                    "title": "how to start a blog"
                  },
                  {
                    "id": "/collection_items/17537",
                    "title": "blog"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48850",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17532",
                  "title": "Red"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48851",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            }
          ]
        },
        {
          "id": "/collection_items/17087",
          "title": "Post 4",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17058",
                    "title": "Blog"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17088",
          "title": "Post 5",
          "fields": [
            {},
            {
              "type": {
                "id": "/collection_type_fields/48127",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17080",
                    "title": "Portfolio"
                  }
                ]
              }
            }
          ]
        }
      ]
    },
    {
      "id": "/collection_types/16710",
      "collection": [
        {
          "id": "/collection_items/17081",
          "title": "Bmw 320m",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48854",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17544",
                    "title": "small cars"
                  }
                ]
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48852",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17530",
                  "title": "Black"
                }
              }
            }
          ]
        },
        {
          "id": "/collection_items/17082",
          "title": "Toyota CHR",
          "fields": [
            {
              "type": {
                "id": "/collection_type_fields/48852",
                "type": "reference"
              },
              "referenceValues": {
                "collectionItem": {
                  "id": "/collection_items/17531",
                  "title": "White"
                }
              }
            },
            {
              "type": {
                "id": "/collection_type_fields/48854",
                "type": "multiReference"
              },
              "multiReferenceValues": {
                "collectionItems": [
                  {
                    "id": "/collection_items/17545",
                    "title": "cars for kids"
                  }
                ]
              }
            }
          ]
        },
        {
          "id": "/collection_items/17083",
          "title": "Volvo XC 60",
          "fields": []
        }
      ]
    },
    {
      "id": "/collection_types/16696",
      "collection": [
        {
          "id": "/collection_items/17059",
          "title": "home",
          "fields": [
            {},
            {}
          ]
        }
      ]
    }
  ]
}
';

//#endregion

        return [
            ['{}', $collectionTypesJSON, '{}'],
            ['', $collectionTypesJSON, "{}"],
            [null, $collectionTypesJSON, "{}"],
            ['{type: ""}', $collectionTypesJSON, '{}'],
            ['{value: ""}', $collectionTypesJSON, '{}']
        ];
    }

    /**
     * @dataProvider executeFailCases
     */
    public function testExecuteFails($gbStr, $colTStr, $expectedStr)
    {
        $globalBlock = json_decode($gbStr);
        $collectionTypes = $this->normalizeCollectionTypes(json_decode($colTStr));

        $this->expectException(\Exception::class);
        $context = new GlobalBlockRulesContext($globalBlock, $collectionTypes);
        $this->internalExecute($gbStr, $colTStr, $expectedStr, $context);
    }

    /**
     * @dataProvider executeUseCases
     * @throws \Exception
     */
    public function testExecute($gbStr, $colTStr, $expectedStr)
    {
        $globalBlock = json_decode($gbStr);
        $collectionTypes = $this->normalizeCollectionTypes(json_decode($colTStr));

        $context = new GlobalBlockRulesContext($globalBlock, $collectionTypes);
        $this->internalExecute($gbStr, $colTStr, $expectedStr, $context);
    }

    /**
     * @param $gbStr
     * @param $colTStr
     * @param $expectedStr
     * @param GlobalBlockRulesContext $context
     * @throws \Exception
     */
    protected function internalExecute($gbStr, $colTStr, $expectedStr, GlobalBlockRulesContext $context): void
    {
        $globalBlock = json_decode($gbStr);
        $collectionTypes = $this->normalizeCollectionTypes(json_decode($colTStr));
        $expected = json_decode($expectedStr);

        $transformer = new GlobalBlockRulesTransformer($globalBlock, $collectionTypes);
        $transformer->execute($context);
        $data = $context->getData();

        $this->assertEquals($data, $expected, "Migrated fails on rules");
    }

    /**
     * @param $collectionTypes
     * @return array
     */
    protected function normalizeCollectionTypes($collectionTypes): array
    {
        return array_reduce($collectionTypes->data, function ($acc, $type) {

            $fields = array_reduce($type->collection, function ($acc, $collection) {
                return array_merge($acc, $collection->fields);
            }, []);
            $fieldsRef = array_reduce($fields, function ($acc, $field) {
                $r = $acc;

                if (isset($field->type)) {
                    switch ($field->type->type) {
                        case "reference":
                        {
                            $ref = (object)[
                                "id" => $field->type->id,
                                "type" => "reference",
                                "entityValues" => [$field->referenceValues->collectionItem->id]
                            ];
                            $r = array_merge($acc, [$ref]);
                            break;
                        }
                        case "multiReference":
                        {
                            $entityValues = array_map(function ($item) {
                                return $item->id;
                            }, $field->multiReferenceValues->collectionItems);
                            $ref = (object)[
                                "id" => $field->type->id,
                                "type" => "multiReference",
                                "entityValues" => $entityValues
                            ];
                            $r = array_merge($acc, [$ref]);
                            break;
                        }
                    }
                }

                return $r;
            }, []);

            $collectionType = (object)[
                "id" => $type->id,
                "fields" => $fieldsRef
            ];

            return array_merge($acc, [$collectionType]);
        }, []);
    }
}
