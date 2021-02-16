<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//$frame = $this->createFrame()->begin();
?>
    <div class="cart_block">

        <div class="cart__icon__header">
            <?if (!empty($arResult["NUM_PRODUCTS"])){?>
                <div class="adapt__num__products"><?=$arResult["NUM_PRODUCTS"]?></div>
                <a href="<?= SITE_DIR ?>personal/cart/"><img src="/bitrix/templates/dresscodeV2_new/images/ND/basket__header__icon.svg"></a>
            <?} else {?>
                <a href="<?= SITE_DIR ?>personal/cart/"><img src="/bitrix/templates/dresscodeV2_new/images/ND/basket__header__icon.svg">
				</a>
            <?}?>
        </div>

        <div class="cart__info__header">
            <div class="in__basket"><a class="cart__info__header" href="<?= SITE_DIR ?>personal/cart/">В корзине</a></div>
            <?if (!empty($arResult["NUM_PRODUCTS"])){?>
                <div class="stuff__in__basket__header"><a href="<?= SITE_DIR ?>personal/cart/"><span class="count"><?=$arResult["NUM_PRODUCTS"]?></span> (<span class="total"><?=$arResult["TOTAL_PRICE"]?></span>)</a></div>
            <?}else{?>
                <div class="no__stuff"><a class="cart__info__header" href="<?= SITE_DIR ?>personal/cart/">нет товаров</a></div>
            <?}?>
        </div>

    </div>


    <script type="text/javascript">
        window.topCartTemplate = "topCart5";
    </script>
<? //$frame->end(); ?>