<?php

namespace Modules\CompanyOrDesign\Services\Txt;

use Illuminate\Support\Facades\Storage;
use Modules\Order\Repositories\OrderRepository;
use Modules\Event\Repositories\SettingEventRepository;
use  ZipArchive;

class TxtOrderService 
{
	private $event_start;
	private $event_end;

	public function run()
	{
		$setting_event = SettingEventRepository::load();
		$this->event_start = $setting_event->start;
		$this->event_end = $setting_event->end;

		Storage::deleteDirectory('pedidos');
		$orders = OrderRepository::loadClosedOrders();

		foreach ($orders as $order) {
			$this->header($this->file_path($order), $order);
			foreach ($order->items as $item) {
				$this->item($this->file_path($order), $item);
			}
			$this->footer($this->file_path($order), $order);

		}

		
		$this->zip();
		//Storage::deleteDirectory('pedidos');
	}

	private function header($file_path, $order)
	{

		$shipping_company_id = $order->order_shipping_company->shipping_company_id;
		if($order->order_shipping_company->shipping_company)
		{
			if($order->order_shipping_company->shipping_company_id == 91747){
				//dd($this->event_end);
			}
			if($order->order_shipping_company->shipping_company->created_at->between($this->event_start, $this->event_end))
			{
				$shipping_company_id = 60000;
			}
		}

		

		Storage::append($file_path, 
			'*'.
			mb_substr(addString($order->id, 7, '0'), 0, 7).
			substr(addString(preg_replace('/[^0-9]/', '', $order->order_client->cpf_cnpj), 14, ' ', false), 0, 14).
			mb_substr(addString($order->order_saller->saller_id, 7, '0'), 0, 7).
			mb_substr(addString($order->order_payment->payment_id, 7, '0'), 0, 7).
			mb_substr(addString($shipping_company_id, 7, ' ', false), 0, 7).
			mb_substr($order->closing_date, 8, 2).
			mb_substr($order->closing_date, 5, 2) .
			mb_substr($order->closing_date, 0, 4) . 
			mb_substr($order->closing_date, 11, 2).
			mb_substr($order->closing_date, 14, 2).
			$order->delivery_name_alias);
	}

	private function item($file_path, $item)
	{

		$tax_ipi = $item->item_taxes()->where('module', 'ipi')->first();
		if($tax_ipi)
		{
			$ipi = $tax_ipi->porcentage;
		}else
		{
			$ipi = 0;
		}

		Storage::append($file_path,
			mb_substr(addString($item->product->barcode, 22, ' ', false), 0, 22).
			mb_substr(addString($item->qty, 6, '0'), 0, 6).
			mb_substr(addString(str_replace('.', '', $item->price), 7, '0'), 0, 7).
			mb_substr(addString(preg_replace('/[^0-9]/', '', $item->discount), 5, '0'), 0, 5).
			mb_substr(addString(preg_replace('/[^0-9]/', '', $item->addition), 5, '0'), 0, 5).			
			mb_substr(addString(preg_replace('/[^0-9]/', '', $ipi), 5, '0'), 0, 5).
			'0');
	}

	private function footer($file_path, $order)
	{
		Storage::append($file_path,
			'OBS'.$order->observation);
	}

	

	public function zip()
	{
		$files = Storage::allFiles('pedidos');
		$zip_path = storage_path('app/pedidos.zip'); 
		$zip = new ZipArchive;
		$zip->open($zip_path, ZipArchive::CREATE | ZipArchive::OVERWRITE);
		foreach ($files as $file) {
			$zip->addFile(storage_path('app/'.$file), $file);
		}
		$zip->close();
	}	

	private function file_path($order)
	{
		return 'pedidos/'.addString($order->id, 7, '0') . '.txt';
	}

	

	public function download()
	{
		$this->run();
		return response()->download(storage_path('app/pedidos.zip'))->deleteFileAfterSend();;
	}

}
