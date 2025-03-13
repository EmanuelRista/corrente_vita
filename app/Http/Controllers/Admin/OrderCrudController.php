<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('ordine', 'ordini');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'id', 'label' => 'ID Ordine']);
        CRUD::addColumn([
            'name' => 'user.email',
            'label' => 'Utente',
            'type' => 'text'
        ]);
        CRUD::addColumn(['name' => 'total', 'label' => 'Totale', 'type' => 'number']);
        CRUD::addColumn(['name' => 'status', 'label' => 'Stato']);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(OrderRequest::class);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Stato',
            'type' => 'select_from_array',
            'options' => [
                'pending' => 'In attesa',
                'completed' => 'Completato',
                'shipped' => 'Spedito'
            ],
        ]);
    }
}
