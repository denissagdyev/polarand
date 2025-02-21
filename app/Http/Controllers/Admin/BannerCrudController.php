<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use Illuminate\Support\Facades\Storage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BannerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BannerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Banner::class);
        CRUD::setRouteName('banner');
        CRUD::setRoute(config('backpack.base.route_prefix') . '/banner');
        CRUD::setEntityNameStrings('banner', 'banners');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title');
        CRUD::column('image');
        CRUD::addColumn([
            'name' => 'is_active',
            'label' => 'Active',
            'type' => 'check'
        ]);
        CRUD::column('link');

    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BannerRequest::class);

        CRUD::field('title');
        CRUD::field([
            'name'      => 'image',
            'label'     => 'Изображение',
            'type'      => 'upload',
            'upload'    => true,
            'disk'      => 'public',
        ]);
        CRUD::field('link');
        CRUD::field([   // Boolean
            'name'         => 'is_active',
            'label'        => 'Is Active',
            'type'         => 'checkbox',
            // optionally override the Yes/No labels
            'options'   => [ // [left_value, right_value]. default null=>''
                            '0' => 'No',
                            '1' => 'Yes'
                        ]
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

     protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'image', // The db column name
            'label' => "Изображение", // Table column heading
            'type' => 'image',
             'prefix' => 'storage/banners/',
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
        $destinationPath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/banners'; // Укажите полный путь

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
    $banner = Banner::create([
        'title' => $request->input('title'),
        'image' => $filename, // Сохраняем только имя файла
        'link' => $request->input('link'),
        'is_active' => $request->input('is_active', false), // По умолчанию false, если не указано
    ]);

    // Возвращаемся к списку баннеров с сообщением об успехе
    return redirect()->route('banner.index')->with('success', 'Баннер успешно создан!');
}

   public function update()
{
     $this->crud->setRequest($this->crud->validateRequest());
    $this->crud->unsetValidation();

    // Получаем данные из запроса
    $request = $this->crud->getRequest();
    $data = $request->request->all();

    // Получаем модель баннера для обновления
    $item = Banner::find($request->id);

    // Проверяем, был ли загружен новый файл
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $destinationPath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/banners'; // Полный путь

        try {
            // Перемещаем новый файл
            $file->move($destinationPath, $filename);
             $data['image'] = $filename; // Сохраняем имя файла

            // Удаляем старый файл (если он есть)
            $oldImage = $item->image;
            if ($oldImage) {
                $oldImagePath = '/home/d/denmaytp/denmaytp.beget.tech/public/storage/banners/' . $oldImage;
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
        'title' => $request->input('title'),
        'image' => $data['image'] ?? $item->image, // Используем новое имя файла или старое, если файл не был загружен
        'link' => $request->input('link'),
        'is_active' => $request->input('is_active', false),
    ]);

    return redirect()->route('banner.index')->with('success', 'Баннер успешно обновлен!');
}
}