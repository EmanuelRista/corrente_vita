<?php
namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class OrderItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\OrderItem::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order-item');
        CRUD::setEntityNameStrings('elemento ordine', 'elementi ordine');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            'name' => 'order_id',
            'label' => 'ID Ordine',
            'type' => 'relationship',
            'entity' => 'order',
            'attribute' => 'id'
        ]);
        CRUD::addColumn([
            'name' => 'product.title',
            'label' => 'Prodotto',
            'type' => 'text'
        ]);
        CRUD::addColumn(['name' => 'quantity', 'label' => 'Quantità', 'type' => 'number']);
        CRUD::addColumn(['name' => 'price', 'label' => 'Prezzo', 'type' => 'number']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderItemRequest::class);

        CRUD::addField([
            'name' => 'order_id',
            'label' => 'Ordine',
            'type' => 'select',
            'entity' => 'order',
            'model' => 'App\Models\Order',
            'attribute' => 'id'
        ]);
        CRUD::addField([
            'name' => 'product_id',
            'label' => 'Prodotto',
            'type' => 'select',
            'entity' => 'product',
            'model' => 'App\Models\Product',
            'attribute' => 'title'
        ]);
        CRUD::addField(['name' => 'quantity', 'label' => 'Quantità', 'type' => 'number']);
        CRUD::addField(['name' => 'price', 'label' => 'Prezzo', 'type' => 'number', 'attributes' => ['step' => '0.01']]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
