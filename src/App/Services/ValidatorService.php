<?php

declare(strict_types=1);

namespace App\Services;

use Framework\Validator;
use Framework\Rules\{
    RequiredRule,
    EmailRule,
    InRule,
    MatchRule,
    MinRule,
    UrlRule
};

class ValidatorService
{
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->validator->addRule('required', new RequiredRule());
        $this->validator->addRule('email', new EmailRule);
        $this->validator->addRule('min', new MinRule);
        $this->validator->addRule('in', new InRule);
        $this->validator->addRule('url', new UrlRule);
        $this->validator->addRule('match', new MatchRule);
    }

    public function validateRegister(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required', 'in:India,Canada,Mexico'],
            'socialMediaURL' => ['required', 'url'],
            'password' => ['required'],
            'confirmPassword' => ['required', 'match:password'],
            'tos' => ['required']
        ]);
    }

    public function validateLogin(array $formData)
    {
        $this->validator->validate($formData, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
    }

    public function validateEdit(array $formData)
    {
        $this->validator->validate($formData, [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'age' => ['required', 'min:18'],
            'country' => ['required', 'in:India,Canada,Mexico'],
            'socialMediaURL' => ['required', 'url']
        ]);
    }
}
