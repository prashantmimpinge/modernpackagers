{{ Form::text('name', trans('product::attributes.name'), $errors, $product, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('weight', "Product Weight (in grams)", $errors, $product, ['labelCol' => 2, 'required' => true]) }}
{{ Form::text('description', trans('product::attributes.description'), $errors, $product, ['labelCol' => 2, 'required' => true]) }}

<div class="row">
    <div class="col-md-8">
        {{ Form::select('brand_id', trans('product::attributes.brand_id'), $errors, $brands, $product) }}
        {{ Form::select('categories', trans('product::attributes.categories'), $errors, $categories, $product, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        {{ Form::select('tax_class_id', trans('product::attributes.tax_class_id'), $errors, $taxClasses, $product) }}
        {{ Form::select('tags', trans('product::attributes.tags'), $errors, $tags, $product, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        {{ Form::checkbox('is_active', trans('product::attributes.is_active'), trans('product::products.form.enable_the_product'), $errors, $product) }}
    </div>
</div>
