<?php

namespace CodeFlix\Forms;

use Kris\LaravelFormBuilder\Form;

class UserSettingsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('password', 'password')
            ->add('password_confirmation', 'password');
    }
}
