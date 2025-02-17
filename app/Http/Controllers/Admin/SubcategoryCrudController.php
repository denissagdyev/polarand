<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Http\Requests\SubcategoryRequest;

class SubcategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Subcategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subcategory');
        CRUD::setEntityNameStrings('subcategory', 'subcategories');
    }

    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('category_id');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(SubcategoryRequest::class);

        CRUD::field('name');
        CRUD::field([
            'label' => "Category",
            'type' => 'select',
            'name' => 'category_id',
            'entity' => 'category',
            'model' => "App\Models\Category",
            'attribute' => 'name',
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(SubcategoryRequest::class);
        $this->setupCreateOperation();
    }
}