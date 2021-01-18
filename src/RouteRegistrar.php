<?php

namespace Thtg88\ContactRequest;

use Illuminate\Contracts\Routing\Registrar as Router;

class RouteRegistrar
{
    /**
     * The router implementation.
     *
     * @var \Illuminate\Contracts\Routing\Registrar
     */
    protected $router;

    /**
     * Create a new route registrar instance.
     *
     * @param \Illuminate\Contracts\Routing\Registrar $router
     *
     * @return void
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * Register routes for the package.
     *
     * @return void
     */
    public function all()
    {
        $this->router
            ->group(['as' => 'contact-request.'], static function ($router) {
                $router->post('contact-requests', 'ContactRequestController@submit')
                    ->name('submit');
            });
    }
}
