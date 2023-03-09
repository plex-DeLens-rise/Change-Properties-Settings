<?php
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');

if (CModule::IncludeModule('iblock')) { ///Подключаем модуль информационного блока
    $properties = CIBlockProperty::GetList( ///Выбираем список свойств
        array("sort" => "asc", "name" => "asc"),
        array( "IBLOCK_ID" => 5, ">=ID"=>1) ///Прописываем фильтр, например, ID инфоблока, указываем диапазон выбранных свойств
    );
    while ($prop_fields = $properties->GetNext()) { ///Перебираем список свойств
            $propId = $prop_fields['ID']; ///Запоминаем ID свойства
            $arFields = array('SMART_FILTER' => 'Y', 'IBLOCK_ID' => 5, "DISPLAY_EXPANDED" => 'Y', "PROPERTY_TYPE" => 'L'); ///Задаём необходимые параметры свойству, например, подключаем его в смарт-фильтр,
                                                                                                                          ///делаем его развернутым, можем изменить тип свойства, в данном случае, список(L)
            $addToSmart = new CIBlockProperty();
            if (!$addToSmart->Update($propId, $arFields)) ///Обновляем параметры свойства, передавая ID свойства и набор указанных параметров
                echo $addToSmart->LAST_ERROR;

    }
}
?>
