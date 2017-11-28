<?php

namespace CodeFlix\Forms;

use CodeFlix\Models\Category;
use CodeFlix\Models\Serie;
use Kris\LaravelFormBuilder\Form;

class VideoRelationForm extends Form
{
    public function buildForm()
    {
        $this->add('categories', 'entity', [
            'class' => Category::class,
            'property' => 'category',
            'selected' => $this->model->categories->pluck('id')->toArray(),
            'multiple' => true,
            'attr' => [
                'category' => 'categories[]'
            ]
        ])->add('serie_id', 'entity',[
           'class' => Serie::class,
           'property' => 'title',
           'empty_value' => 'Selecione a série'
        ]);
    }
}
