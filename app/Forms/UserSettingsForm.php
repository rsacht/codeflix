<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password',[
                'rules' => 'required|min:6|max:16|confirmed'
                //Confirmed: este password precisa ser confirmado para o formulário ser processado
            ])
            ->add('password_confirmation', 'password');
    }
}
