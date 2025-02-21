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
        CRUD::field('short_description');
        CRUD::field('price');
        CRUD::field('size');

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

    // Обрабатываем загрузку изображения
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName(); // Можно использовать hashName() для уникальности
        $destinationPath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/products'; // Укажите полный путь

        try {
            $file->move($destinationPath, $filename);
             $data['image'] = $filename; // Сохраняем только имя файла
        } catch (\Exception $e) {
            \Log::error('Ошибка при загрузке файла: ' . $e->getMessage());
            // Обработка ошибки
            return back()->withErrors(['image' => 'Ошибка при загрузке файла']);
        }
    }

    // Создаем баннер, используя данные из запроса, включая имя файла
    $product = Product::create([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'short_description' => $request->input('short_description'),
        'price' => $request->input('price'),
        'size' => $request->input('size'),
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
        'image' => $filename, // Сохраняем только имя файла
    ]);

    // Возвращаемся к списку баннеров с сообщением об успехе
    return redirect()->route('crud.product.index')->with('success', 'Товар успешно создан!');
}

   public function update()
{
     $this->crud->setRequest($this->crud->validateRequest());
    $this->crud->unsetValidation();

    // Получаем данные из запроса
    $request = $this->crud->getRequest();
    $data = $request->request->all();

    // Получаем модель баннера для обновления
    $item = Product::find($request->id);

    // Проверяем, был ли загружен новый файл
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $destinationPath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/products'; // Полный путь

        try {
            // Перемещаем новый файл
            $file->move($destinationPath, $filename);
             $data['image'] = $filename; // Сохраняем имя файла

            // Удаляем старый файл (если он есть)
            $oldImage = $item->image;
            if ($oldImage) {
                $oldImagePath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/products/' . $oldImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                } else {
                    \Log::warning('Старое изображение не найдено: ' . $oldImagePath);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Ошибка при загрузке или удалении файла: ' . $e->getMessage());
            return back()->withErrors(['image' => 'Ошибка при загрузке или удалении файла']);
        }
    }

    // Обновляем данные баннера
    $item->update([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'short_description' => $request->input('short_description'),
        'price' => $request->input('price'),
        'size' => $request->input('size'),
        'category_id' => $request->input('category_id'),
        'subcategory_id' => $request->input('subcategory_id'),
        'image' => $filename,
    ]);

    return redirect()->route('crud.product.index')->with('success', 'Товар успешно обновлен!');
}
}