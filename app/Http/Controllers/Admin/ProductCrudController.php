<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
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
        CRUD::setEntityNameStrings('product', 'products');
    }

    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('description');
        CRUD::column('price');
        CRUD::column('category_id');
        CRUD::column('subcategory_id');
        CRUD::column('image');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('price');

        CRUD::field([
            'name' => 'category_id',
            'label' => 'Category',
            'type' => 'select',
            'entity' => 'category',
            'model' => "App\Models\Category",
            'attribute' => 'name',
        ]);

        CRUD::field([
            'name' => 'subcategory_id',
            'label' => 'Subcategory',
            'type' => 'select',
            'entity' => 'subcategory',
            'model' => "App\Models\Subcategory",
            'attribute' => 'name',
        ]);

        CRUD::field([
            'name' => 'image',
    'label' => 'Изображение',
    'type' => 'upload',
    'disk' => 'public',
    'prefix' => 'storage/products/',
    'upload' => true,
        ]);
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(ProductRequest::class);
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'image', // The db column name
            'label' => "Изображение", // Table column heading
            'type' => 'image',
             'prefix' => 'storage/products/',
             'height' => '200px',
             'width'  => 'auto',
        ]);
        // by default the Show operation will try to show all columns in the db table,
        // but we can easily customize which columns get shown in the table
        $this->setupListOperation();
    }

    public function store()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation();
    
        // Получаем данные из запроса
        $request = $this->crud->getRequest();
        $data = $request->request->all();
    
        // Перемещаем загруженный файл из временной директории в постоянное хранилище
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = 'products'; // Путь, куда нужно сохранить файл
            $filename = $file->hashName(); // Генерируем уникальное имя
            $path = $file->store($destinationPath, 'public');
    
            // Заменяем временный путь на конечное имя файла
            $data['image'] = $filename;
        }
    
        // Сохраняем данные в базу данных
        $item = Product::create($data);
        // $this->crud->create($this->crud->getStrippedSaveRequest($request)); // Старый код
    
        return redirect()->to($this->crud->route);
    }
    
    public function update()
    {
        $this->crud->setRequest($this->crud->validateRequest());
        $this->crud->unsetValidation();
    
        // Получаем данные из запроса
        $request = $this->crud->getRequest();
         $data = $request->request->all();
    
        // Перемещаем загруженный файл из временной директории в постоянное хранилище
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath = 'products'; // Путь, куда нужно сохранить файл
            $filename = $file->hashName(); // Генерируем уникальное имя
            $path = $file->store($destinationPath, 'public');
    
            // Удаляем старое изображение (если оно есть)
            $oldImage = Product::find($request->id)->image;
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
    
            // Заменяем временный путь на конечное имя файла
            $data['image'] = $filename;
        }
          $item = Product::find($request->id);
           $item->update($data);
    
        // $this->crud->update( // старый код
        //     $this->crud->entry->getKey(),
        //     $this->crud->getStrippedSaveRequest($request)
        // );
    
        return redirect()->to($this->crud->route);
    }
}