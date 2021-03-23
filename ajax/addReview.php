<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Page\Asset::getInstance()->addJs('//www.google.com/recaptcha/api.js');
CModule::IncludeModule("iblock");
/*
$url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LcdxHYUAAAAACR_Wfz4I0ipKpAlPjl2rMQXyNih&response='.(array_key_exists('g-recaptcha-response', $_REQUEST) ? $_REQUEST["g-recaptcha-response"] : '').'&remoteip='.$_SERVER['REMOTE_ADDR'];
$resp = json_decode(file_get_contents($url), true);
*/

global $res;
global $APPLICATION;
$res = array();
    if ($_REQUEST['g-recaptcha-response']) {
        $httpClient = new \Bitrix\Main\Web\HttpClient;
        $result = $httpClient->post(
            'https://www.google.com/recaptcha/api/siteverify',
            array(
                'secret' => '6LcdxHYUAAAAACR_Wfz4I0ipKpAlPjl2rMQXyNih',
                'response' => $_REQUEST['g-recaptcha-response'],
                'remoteip' => $_SERVER['HTTP_X_REAL_IP']
            )
        );
		
// Название <input type="file">
$input_name = 'file';
 
// Разрешенные расширения файлов.
$allow = array();
 
// Запрещенные расширения файлов.
$deny = array(
	'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
	'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
	'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi'
);
 
// Директория куда будут загружаться файлы.
$path = __DIR__ . '/up/';
 
if (isset($_FILES[$input_name])) {
	// Проверим директорию для загрузки.
	if (!is_dir($path)) {
		mkdir($path, 0777, true);
	}
 
	// Преобразуем массив $_FILES в удобный вид для перебора в foreach.
	$files = array();
	$diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
	if ($diff == 0) {
		$files = array($_FILES[$input_name]);
	} else {
		foreach($_FILES[$input_name] as $k => $l) {
			foreach($l as $i => $v) {
				$files[$i][$k] = $v;
			}
		}		
	}	
	
	foreach ($files as $file) {
		$error = $success = '';
 
		// Проверим на ошибки загрузки.
		if (!empty($file['error']) || empty($file['tmp_name'])) {
			switch (@$file['error']) {
				case 1:
				case 2: $error = 'Превышен размер загружаемого файла.'; break;
				case 3: $error = 'Файл был получен только частично.'; break;
				case 4: $error = 'Файл не был загружен.'; break;
				case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
				case 7: $error = 'Не удалось записать файл на диск.'; break;
				case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
				case 9: $error = 'Файл не был загружен - директория не существует.'; break;
				case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
				case 11: $error = 'Данный тип файла запрещен.'; break;
				case 12: $error = 'Ошибка при копировании файла.'; break;
				default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
			}
		} elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
			$error = 'Не удалось загрузить файл.';
		} else {
			// Оставляем в имени файла только буквы, цифры и некоторые символы.
			$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
			$name = mb_eregi_replace($pattern, '-', $file['name']);
			$name = mb_ereg_replace('[-]+', '-', $name);
			
			// Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
			// Сделаем их транслит:
			$converter = array(
				'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
				'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
				'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
				'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
				'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
				'э' => 'e',   'ю' => 'yu',  'я' => 'ya', 
			
				'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
				'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
				'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
				'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
				'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
				'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
			);
 
			$name = strtr($name, $converter);
			$parts = pathinfo($name);
 
			if (empty($name) || empty($parts['extension'])) {
				$error = 'Недопустимое тип файла';
			} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
				$error = 'Недопустимый тип файла';
			} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
				$error = 'Недопустимый тип файла';
			} else {
				// Чтобы не затереть файл с таким же названием, добавим префикс.
				$i = 0;
				$prefix = '';
				while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
		  			$prefix = '(' . ++$i . ')';
				}
				$name = $parts['filename'] . $prefix . '.' . $parts['extension'];
 
				// Перемещаем файл в директорию.
				if (move_uploaded_file($file['tmp_name'], $path . $name)) {
					// Далее можно сохранить название файла в БД и т.п.
					$success = 'Файл «' . $name . '» успешно загружен.';
				} else {
					$error = 'Не удалось загрузить файл.';
				}
			}
		}
		
		// Выводим сообщение о результате загрузки.
		if (!empty($success)) {
			echo '<p>' . $success . '</p>';		
		} else {
			echo '<p>' . $error . '</p>';
		}
	}
}		
		
		

            $el = new CIBlockElement;
            global $USER;
            $id = $USER->GetID();
            $rsUser = CUser::GetByID($id);
            $arUser = $rsUser->Fetch();
            $PROP = array();
            $PROP["ADVANTAGE"] = $_POST['ADVANTAGE'];
            $PROP["DISADVANTAGE"] = $_POST['DISADVANTAGE'];
            $PROP["COMMENT"] = $_POST['COMMENT'];
            $PROP["PRODUCT"] = $_POST['PRODUCT'];
            $PROP["NAME"] = $_POST['NAME'];
            $PROP["RATE"] = $_POST['RATE'];

            $name = $_REQUEST['NAME_P'];
            $arLoadProductArray = Array(
                "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
                "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
                "IBLOCK_ID"      => 18,
                "PROPERTY_VALUES"=> $PROP,
                "NAME"           => $name,
                "ACTIVE"         => "N",            // активен
            );
	
            if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
                $res = array(
                    'status' => 'success',
                    'text'   => 'Спасибо! Ваш отзыв добавлен',
                );
            }

            $arEventFields = array(
                "USER_NAME"            => $PROP["NAME"],
                "ID"            => $PRODUCT_ID,
            );
            $message = 'Новый отзыв на сайте relaxa.ru от <b>'.$PROP["NAME"].'</b> <br>
			Комментарий: <b>'.$PROP["COMMENT"].'</b><br>
			Преимущества: <b>'.$PROP["ADVANTAGE"].'</b><br>
			Недостатки: <b>'.$PROP["DISADVANTAGE"].'</b><br>
			<a href="https://relaxa.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=18&type=content&ID='.$PRODUCT_ID.'&lang=ru">Редактировать</a>';
            CEvent::Send("ADD_REVIEW", "s1", $arEventFields,"N","47");
            mail('content@relaxa.ru','Новый отзыв на сайте relaxa.ru',$message,"From: info@relaxa.ru\r\n"
                ."Content-type: text/html; charset=utf-8\r\n"
                ."X-Mailer: PHP mail script");

    } else {
        $res = array(
            'status' => 'error',
            'text'   => 'ошибка! Заполните поля',
        );
    }

echo json_encode($res);
/*
echo "<pre>"; print_r(file_get_contents($url)); echo "</pre>";

if($_REQUEST['NAME'] && $resp['success'] == true){
$el = new CIBlockElement;
global $USER;
$id = $USER->GetID();
$rsUser = CUser::GetByID($id);
$arUser = $rsUser->Fetch();
$PROP = array();
$PROP["ADVANTAGE"] = $_REQUEST['ADANTAGE'];
$PROP["DISADVANTAGE"] = $_REQUEST['DISADANTAGE'];
$PROP["COMMENT"] = $_REQUEST['COMMENT'];
$PROP["PRODUCT"] = $_REQUEST['PRODUCT'];
$PROP["NAME"] = $_REQUEST['NAME'];
$PROP["RATE"] = $_REQUEST['RATE'];

$name = $_REQUEST['NAME_P'];
$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
  "IBLOCK_SECTION_ID" => false,          // элемент лежит в корне раздела
  "IBLOCK_ID"      => 18,
  "PROPERTY_VALUES"=> $PROP,
  "NAME"           => $name,
  "ACTIVE"         => "N",            // активен
  );

if($PRODUCT_ID = $el->Add($arLoadProductArray))
$result = [
	'status' => 'success',
	'text'   => 'Спасибо! Ваш отзыв добавлен',
];

$arEventFields = array(
    "USER_NAME"            => $PROP["NAME"],
    "ID"            => $PRODUCT_ID,
    );
$message = '<a href="http://relaxa.ru/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=18&type=content&ID='.$PRODUCT_ID.'&lang=ru">Редактировать</a>';
CEvent::Send("ADD_REVIEW", "s1", $arEventFields,"N","47");
mail('info@relaxa.ru',' Новый отзыв на сайте relaxa.ru',$message,"From: info@relaxa.ru\r\n"
    ."Content-type: text/html; charset=utf-8\r\n"
    ."X-Mailer: PHP mail script");
}
else  $result = [
	'status' => 'error',
	'text'   => 'ошибка! Заполните поля',
];
echo json_encode($result);
*/
?>