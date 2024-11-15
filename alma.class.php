<?php

namespace Alma;

class Api
{
	private $token;
	private $inn;

	/**
	 * @param string $token обязательный параметр
	 * @param int $inn обязательный параметр
	 * 
	 * @return void
	 */
	public function __construct(string $token, int $inn)
	{
		$this->token = htmlspecialchars($token);
		$this->inn   = intval($inn);
	}

	/**
	 * Проверка доступности API
	 * 
	 * @return array
	 */
	public function getStatus()
	{
		$url = "/api/status/";

		return $this->makeRequest($url);
	}

	/**
	 * Получение информации товара по его коду
	 * 
	 * @param  int $code - КОД товара
	 * 
	 * @return array
	 */
	public function getElement(int $code)
	{
		$post['code'] = $code;

		$url = "/api/element/";

		return $this->makeRequest($url, $post);
	}

	/**
	 * Получение информации о всех элементах
	 * 
	 * @return array 
	 */
	public function getElements()
	{
		$url = "/api/elements/";

		return $this->makeRequest($url);
	}

	/**
	 * Получение информации о всех ценах для всех товаров
	 * 
	 * @return array
	 */
	public function getPrices()
	{
		$url = "/api/prices/";

		return $this->makeRequest($url);
	}

	/**
	 * Получить все свойства товаров
	 * 
	 * @return array
	 */
	public function getProperties()
	{
		$url = "/api/props/";

		return $this->makeRequest($url);
	}

	/**
	 * Получение всех остатков товаров
	 * 
	 * @return array
	 */
	public function getQuantity()
	{
		$url = "/api/quantity/";

		return $this->makeRequest($url);
	}

	/**
	 * Получить все категории 
	 * 
	 * @return array
	 */
	public function getCategory()
	{
		$url = "/api/category/";

		return $this->makeRequest($url);
	}

	/**
	 * Выполнение curl запроса к api ALMA.su
	 * 
	 * @param string $url  ссылка в end-point api
	 * @param array  $post (optional) POST данные
	 * 
	 * @return array  
	 */
	private function makeRequest(string $url, array $post = NULL)
	{
		$post['token'] = $this->token;
		$post['inn']   = $this->inn;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://dev.ret.su'.$url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
		$result = curl_exec($curl);
		$http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		curl_close($curl);

		return ['http' => $http, 'result' => $result];
	}

}