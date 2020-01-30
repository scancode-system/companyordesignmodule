<table class="w-100 mb-3">
	@include('companyordesign::pdf.tables.thead')
	<tbody>
		@foreach($order->items as $item)
		<tr>
			@if($setting_pdf_image->show)
			<td class="border-bottom border-left border-dark p-2">
				<img src="{{ url($item->item_product->image) }}" class="width-75">
			</td>
			@endif
			<td class="border-bottom border-dark {{ (!$setting_pdf_image->show)?'border-left':'' }} p-2">{{ $item->item_product->sku }}</td>
			@loader(['loader_path' => 'pdf.items.tr'])
			<td class="border-bottom border-dark p-2">
				{{ $item->item_product->description }}
				<small class="text-info">{{ $item->observation }}</small>
			</td>
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->price)<br>
				<small>Desc. @percentage($item->discount)</small>
			</td>
			@if($setting_pdf_discount->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->discount_value)<br>
				<small>(@percentage($item->discount))</small>
			</td>
			@endif
			@if($setting_pdf_addition->show)
			<td class="border-bottom border-dark text-center p-2">
				@currency($item->addition_value)<br>
				<small>(@percentage($item->addition))</small>
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">@currency($item->price-$item->discount_value+$item->addition_value)</td>
			@if($setting_pdf_taxes->show)
			<td class="border-bottom border-dark text-center p-2">
				@foreach($item->taxes as $tax)
				@percentage($tax->porcentage)<br>
				<small>{{ $tax->name }}</small>
				@endforeach
			</td>
			@endif
			<td class="border-bottom border-dark text-center p-2">{{ $item->qty }}</td>
			<td class="border-bottom border-right border-dark text-center p-2">@currency($item->total_gross)
			</td>
		</tr> 
		@endforeach
	</tbody>
</table>  