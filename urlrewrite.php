<?php
$arUrlRewrite=array (
    0 =>
        array (
            'CONDITION' => '#^={$arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"]}\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.smart.filter',
            'PATH' => '/bitrix/templates/dresscodeV2/components/bitrix/catalog/.default/section.php',
            'SORT' => 100,
        ),
    1 =>
        array (
            'CONDITION' => '#^/rasprodazha/([a-zA-Z\\d_-]+)/([a-zA-Z\\d_-]+)/(\\?.*){0,1}$#',
            'RULE' => 'SECTION_CODE=$1&ELEMENT_ID=$2',
            'ID' => '',
            'PATH' => '/rasprodazha/element.php',
            'SORT' => 100,
        ),
    2 =>
        array (
            'CONDITION' => '#^/rasprodazha/([a-zA-Z\\d_-]+)/(\\?.*){0,1}$$#',
            'RULE' => 'SECTION_CODE=$1&',
            'ID' => '',
            'PATH' => '/rasprodazha/section.php',
            'SORT' => 100,
        ),
    42 =>
        array (
            'CONDITION' => '#^/massazhnoe-oborudovanie/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/massazhnoe-oborudovanie/index.php',
            'SORT' => 100,
        ),
    4 =>
        array (
            'CONDITION' => '#^/bitrix/services/ymarket/#',
            'RULE' => '',
            'ID' => '',
            'PATH' => '/bitrix/services/ymarket/index.php',
            'SORT' => '100',
        ),
    36 =>
        array (
            'CONDITION' => '#^/zdorovie-krasota/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/zdorovie-krasota/index.php',
            'SORT' => 100,
        ),
    35 =>
        array (
            'CONDITION' => '#^/personal/order/#',
            'RULE' => '',
            'ID' => 'bitrix:sale.personal.order',
            'PATH' => '/personal/order/index.php',
            'SORT' => 100,
        ),
    40 =>
        array (
            'CONDITION' => '#^/rasprodazha/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/rasprodazha/_index.php',
            'SORT' => 100,
        ),
    39 =>
        array (
            'CONDITION' => '#^/dom-dacha/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/dom-dacha/index.php',
            'SORT' => 100,
        ),
    55 =>
        array (
            'CONDITION' => '#^/articles/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/articles/index.php',
            'SORT' => 100,
        ),
    38 =>
        array (
            'CONDITION' => '#^/terapiya/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/terapiya/index.php',
            'SORT' => 100,
        ),
    22 =>
        array (
            'CONDITION' => '#^/land/lp/#',
            'RULE' => NULL,
            'ID' => 'bitrix:landing.pub',
            'PATH' => '/land/lp/index.php',
            'SORT' => 100,
        ),
    43 =>
        array (
            'CONDITION' => '#^/fitnes/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/fitnes/index.php',
            'SORT' => 100,
        ),
    44 =>
        array (
            'CONDITION' => '#^/brands/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/brands/index.php',
            'SORT' => 100,
        ),
    23 =>
        array (
            'CONDITION' => '#^/qq/lp/#',
            'RULE' => NULL,
            'ID' => 'bitrix:landing.pub',
            'PATH' => '/qq/lp/index.php',
            'SORT' => 100,
        ),
    24 =>
        array (
            'CONDITION' => '#^/lp/lp/#',
            'RULE' => NULL,
            'ID' => 'bitrix:landing.pub',
            'PATH' => '/lp/lp/index.php',
            'SORT' => 100,
        ),
    41 =>
        array (
            'CONDITION' => '#^\\??(.*)#',
            'RULE' => '&$1',
            'ID' => 'bitrix:catalog.section',
            'PATH' => '/rasprodazha/_index.php',
            'SORT' => 100,
        ),
    49 =>
        array (
            'CONDITION' => '#^/sale/#',
            'RULE' => '',
            'ID' => 'bitrix:catalog',
            'PATH' => '/sale/index.php',
            'SORT' => 100,
        ),
    54 =>
        array (
            'CONDITION' => '#^/news/#',
            'RULE' => '',
            'ID' => 'bitrix:news',
            'PATH' => '/news/index.php',
            'SORT' => 100,
        ),
    21 =>
        array (
            'CONDITION' => '#^/lp/#',
            'RULE' => NULL,
            'ID' => 'bitrix:landing.pub',
            'PATH' => '/lp/index.php',
            'SORT' => 100,
        ),
);
