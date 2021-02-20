<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if (!empty($arResult["ITEMS"])):?>
	<?$this->SetViewTarget("catalog_top_view_content_tab");?><div class="item"><a href="#"><?=GetMessage("TOP_PRODUCT_HEADER")?></a></div><?$this->EndViewTarget();?>
	<div class="tab item">
		<div id="topProduct">
			<div class="wrap">
				<ul class="slideBox productList">
					<?foreach ($arResult["ITEMS"] as $index => $arElement):?>
						<?
							$this->AddEditAction($arElement["ID"], $arElement["EDIT_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
							$this->AddDeleteAction($arElement["ID"], $arElement["DELETE_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							$arElement["IMAGE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 240, "height" => 200), BX_RESIZE_IMAGE_PROPORTIONAL, false);
							if(empty($arElement["IMAGE"])){
								$arElement["IMAGE"]["src"] = SITE_TEMPLATE_PATH."/images/empty.png";
							}
						?>
						<li>
							<div class="item product" data-price-code="<?=implode("||", $arParams["PRICE_CODE"])?>">
						        <a href="#" class="removeFromWishlist label like_tis" data-id="<?= $arElement["ID"] ?>" style="wi"><img
                    src="<?= SITE_TEMPLATE_PATH ?>/img/like.png" alt="<?= GetMessage("WISHLIST_LABEL") ?>"
                    class="icon">Удалить из избранного</a>
								<div class="tabloid">
									<?if(!empty($arElement["PROPERTIES"]["OFFERS"]["VALUE"])):?>
										<div class="markerContainer">
											<?foreach ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker):?>
											    <div class="marker" style="background-color: <?=strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242"?>"><?=$marker?></div>
											<?endforeach;?>
										</div>
									<?endif;?>
									<?if(isset($arElement["PROPERTIES"]["RATING"]["VALUE"])):?>
									    <div class="rating">
									      <i class="m" style="width:<?=($arElement["PROPERTIES"]["RATING"]["VALUE"] * 100 / 5)?>%"></i>
									      <i class="h"></i>
									    </div>
								    <?endif;?>
									<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="picture">
										<img src="<?=(!empty($arElement["IMAGE"]["src"]) ? $arElement["IMAGE"]["src"] : SITE_TEMPLATE_PATH.'/images/empty.png')?>" alt="<?=$arElement["NAME"]?>">
										<span class="getFastView" data-id="<?=$arElement["ID"]?>">Подробнее</span>
									</a>
									<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="name"><span class="middle"><?=$arElement["NAME"]?></span></a>
									<?if(!empty($arElement["MIN_PRICE"])):?>
										<a class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
											<?if(!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
												<s class="discount"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></s>
											<?endif;?>
										</a>
									<?else:?>
										<a class="price"><?=GetMessage("REQUEST_PRICE_LABEL")?></a>
									<?endif;?>
										<div class="optional">
											<div class="row">
												<a href="#" class="fastBack label<?if(empty($arElement["PRICE"]) || $arElement["CAN_BUY"] === "N" || $arElement["CAN_BUY"] === false):?> disabled-0000<?endif;?>" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/fastBack.png" alt="" class="icon">Купить в 1 клик</a>
												<a href="#" class="addCompare label" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/compare.png" alt="" class="icon">К сравнению</a>
											</div>
											<div class="row">
												<a href="#" class="addWishlist label" data-id="<?=$arElement["~ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/wishlist.png" alt="" class="icon"><?=GetMessage("WISHLIST_LABEL")?></a>
												<?if($arElement["CATALOG_QUANTITY"] > 0):?>
													<?if(!empty($arElement["STORES"])):?>
														<a href="#" data-id="<?=$arElement["ID"]?>" class="inStock label changeAvailable getStoresWindow"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></a>
													<?else:?>
														<span class="inStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></span>
													<?endif;?>
												<?else:?>
													<?if($arElement["CAN_BUY"] === "Y" || $arElement["CAN_BUY"] === true):?>
														<a class="onOrder label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/onOrder.png" alt="" class="icon"><?=GetMessage("ON_ORDER")?></a>
													<?else:?>
														<a class="outOfStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/outOfStock.png" alt="" class="icon"><?=GetMessage("NOAVAILABLE")?></a>
													<?endif;?>
												<?endif;?>
											</div>
										</div>
								</div>
							</div>
						</li>
					<?endforeach;?>
				</ul>
				<a href="#" class="topBtnLeft"></a>
				<a href="#" class="topBtnRight"></a>
			</div>
		</div>
		<script>
			/**/$("#topProduct").dwCarousel({
				leftButton: ".topBtnLeft",
				rightButton: ".topBtnRight",
				countElement: 5,
				resizeElement: true,
				resizeAutoParams: {
					1920: 4,
					1500: 4,
					1200: 3,
					850: 2,
					480: 1
				}
});
		</script>
	</div>
<?endif;?>