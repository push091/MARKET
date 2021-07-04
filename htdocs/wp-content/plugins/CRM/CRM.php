<?php
/*
plugin name: CRM
*/


add_action( 'woocommerce_thankyou', 'my_custom_tracking' );
function my_custom_tracking( $order_id ) {
  // Подключаемся к серверу CRM
  define('CRM_HOST', 'marketkp.bitrix24.ru'); // Ваш домен CRM системы
  define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию
  define('CRM_PATH', '/crm/configs/import/lead.php'); // Путь к компоненту lead.rest

  
  // Авторизуемся в CRM под необходимым пользователем:
  // 1. Указываем логин пользователя Вашей CRM по управлению лидами
  define('CRM_LOGIN', 'd_m_k@mail.ru');
  // 2. Указываем пароль пользователя Вашей CRM по управлению лидами
  define('CRM_PASSWORD', '33366609dd');

  // Получаем информации по заказу
  $order = wc_get_order( $order_id );
  $order_data = $order->get_data();

  // Получаем базовую информация по заказу
  $order_id = $order_data['id'];
  $order_currency = $order_data['currency'];
  $order_payment_method_title = $order_data['payment_method_title'];
  $order_shipping_totale = $order_data['shipping_total'];
  $order_total = $order_data['total'];

  $order_base_info = "<hr><strong>Общая информация по заказу</strong><br>
  ID заказа: $order_id<br>
  Валюта заказа: $order_currency<br>
  Метода оплаты: $order_payment_method_title<br>
  Стоимость доставки: $order_shipping_totale<br>
  Итого с доставкой: $order_total<br>";

  // Получаем информация по клиенту
  $order_customer_id = $order_data['customer_id'];
  $order_customer_ip_address = $order_data['customer_ip_address'];
  $order_billing_first_name = $order_data['billing']['first_name'];
  $order_billing_last_name = $order_data['billing']['last_name'];
  $order_billing_email = $order_data['billing']['email'];
  $order_billing_phone = $order_data['billing']['phone'];

  $order_client_info = "<hr><strong>Информация по клиенту</strong><br>
  ID клиента = $order_customer_id<br>
  IP адрес клиента: $order_customer_ip_address<br>
  Имя клиента: $order_billing_first_name<br>
  Фамилия клиента: $order_billing_last_name<br>
  Email клиента: $order_billing_email<br>
  Телефон клиента: $order_billing_phone<br>";

  // Получаем информацию по доставке
  $order_billing_address_1 = $order_data['billing']['address_1'];
  $order_billing_address_2 = $order_data['billing']['address_2'];
  $order_billing_city = $order_data['billing']['city'];
  $order_billing_state = $order_data['billing']['state'];
  $order_billing_postcode = $order_data['billing']['postcode'];
  $order_billing_country = $order_data['billing']['country'];

  $order_billing_info = "<hr><strong>Информация по доставке</strong><br>
  Страна доставки: $order_billing_state<br>
  Город доставки: $order_billing_city<br>
  Индекс: $order_billing_postcode<br>
  Адрес доставки 1: $order_billing_address_1<br>";

  // Получаем информации по товару
  $order->get_total();
  $line_items = $order->get_items();
  foreach ( $line_items as $item ) {
    $product = $order->get_product_from_item( $item );
    $sku = $product->get_sku(); // артикул товара
    $id = $product->get_id(); // id товара
    $name = $product->get_name(); // название товара
    $stock_quantity = $product->get_stock_quantity(); // кол-во товара на складе
    $qty = $item['qty']; // количество товара, которое заказали
    $total = $order->get_line_total( $item, true, true ); // стоимость всех товаров, которые заказали, но без учета доставки

    $product_info[] = "<hr><strong>Информация о товаре</strong><br>
    Название товара: $name<br>
    ID товара: $id<br>
    Артикул: $sku<br>
    Заказали (шт.): $qty<br>
    Сумма заказа (без учета доставки): $total;";
  }

  $product_base_infо = implode('<br>', $product_info);

  $subject = "Заказ с сайта № $order_id";

  // Формируем параметры для создания лида в переменной $postData = array
  $postData = array(
    'TITLE' => $subject,
	'NAME' => $order_billing_first_name,
	'LAST_NAME' => $order_billing_last_name,
    'EMAIL_HOME' => $order_billing_email,
    'PHONE_MOBILE' => $order_billing_phone,
    'OPPORTUNITY' => $order_total,
    'ADDRESS_CITY' => $order_billing_city,
    'ADDRESS_POSTAL_CODE' => $order_billing_postcode,
    'ADDRESS_PROVINCE' => $order_billing_state,
    'ADDRESS_REGION' => $order_billing_state,
    'ADDRESS' => $order_billing_address_1,
    'COMMENTS' => $order_base_info.' '.$order_billing_info.' '.$product_base_infо
  );

  // Передаем данные из Woocommerce в Bitrix24
  if (defined('CRM_AUTH')) {
    $postData['AUTH'] = CRM_AUTH;
  } else {
    $postData['LOGIN'] = CRM_LOGIN;
    $postData['PASSWORD'] = CRM_PASSWORD;
  }

  $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
  if ($fp) {
    $strPostData = '';
    foreach ($postData as $key => $value)
    $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

    $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
    $str .= "Host: ".CRM_HOST."\r\n";
    $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $str .= "Content-Length: ".strlen($strPostData)."\r\n";
    $str .= "Connection: close\r\n\r\n";

    $str .= $strPostData;

    fwrite($fp, $str);

    $result = '';
    while (!feof($fp))
    {
      $result .= fgets($fp, 128);
    }
    fclose($fp);

    $response = explode("\r\n\r\n", $result);

    $output = '<pre>'.print_r($response[1], 1).'</pre>';
  } else {
    echo 'Connection Failed! '.$errstr.' ('.$errno.')';
  }
}