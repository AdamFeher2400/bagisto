@if ($cars->count())
<accordian :title="'{{ __('admin::app.catalog.products.cars') }}'" :active="true">
    <div slot="body">
        
        {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.cars.controls.before', ['product' => $product]) !!}

        <tree-view behavior="normal" value-field="id" name-field="cars" input-type="checkbox" items='@json($cars)' value='@json($product->cars->pluck("id"))'></tree-view>

        {!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.cars.controls.after', ['product' => $product]) !!}

    </div>
</accordian>
@endif