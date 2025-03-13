<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('prodotto', 'prodotti');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'title', 'label' => 'Titolo']);
        CRUD::addColumn(['name' => 'price', 'label' => 'Prezzo', 'type' => 'number']);
        CRUD::addColumn(['name' => 'stock', 'label' => 'Stock', 'type' => 'number']);
        CRUD::addColumn([
            'name' => 'category.name',
            'label' => 'Categoria',
            'type' => 'text',

        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::addField(['name' => 'title', 'label' => 'Titolo', 'type' => 'text']);
        CRUD::addField(['name' => 'description', 'label' => 'Descrizione', 'type' => 'textarea']);
        CRUD::addField(['name' => 'price', 'label' => 'Prezzo', 'type' => 'number', 'attributes' => ['step' => '0.01']]);
        CRUD::addField(['name' => 'stock', 'label' => 'Stock', 'type' => 'number']);
        CRUD::addField([
            'name' => 'category_id',
            'label' => 'Categoria',
            'type' => 'select',
            'entity' => 'category',
            'model' => "App\Models\Category",
            'attribute' => 'name'
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
