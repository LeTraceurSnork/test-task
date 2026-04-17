<?php

$arSelect = Array("ID", "NAME", "PROPERTY_PRICE");
$arFilter = Array("IBLOCK_ID" => 12, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $price = $arFields["PROPERTY_PRICE_VALUE"];
    if($price > 1000){
        echo "<div class='item'>".$arFields['NAME']." - ".$price."$</div>";
    } else {
        echo "<div class='item sale'>".$arFields['NAME']." - ".$price."$ SALE</div>";
    }
}
