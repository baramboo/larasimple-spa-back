<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    /***
     * @param null $id
     */
    protected function actAsUser($id = null)
    {
        if(!$id) return false;
        $session = \Session::start();

        $this->csrfToken = csrf_token();

        return Passport::actingAs(User::find($id));
    }

    /**
     * @return null[]
     */
    protected function csrfTokenHeader()
    {
        return ['X-CSRF-TOKEN' => $this->csrfToken];
    }

}
