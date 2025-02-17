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
            $data = $request->request->all();

            // Перемещаем загруженный файл из временной директории в постоянное хранилище
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $destinationPath = 'banners'; // Путь, куда нужно сохранить файл
                $filename = $file->hashName(); // Генерируем уникальное имя
                $path = $file->store($destinationPath, 'public');

                // Заменяем временный путь на конечное имя файла
                $data['image'] = $filename;
            }

            // Сохраняем данные в базу данных
            $item = Banner::create($data);
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
            $destinationPath = 'banners'; // Путь, куда нужно сохранить файл
            $filename = $file->hashName(); // Генерируем уникальное имя
            $path = $file->store($destinationPath, 'public');

            // Удаляем старое изображение (если оно есть)
            $oldImage = Banner::find($request->id)->image;
            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }

            // Заменяем временный путь на конечное имя файла
            $data['image'] = $filename;
        }
          $item = Banner::find($request->id);
           $item->update($data);

        // $this->crud->update( // старый код
        //     $this->crud->entry->getKey(),
        //     $this->crud->getStrippedSaveRequest($request)
        // );

        return redirect()->to($this->crud->route);
    }
}